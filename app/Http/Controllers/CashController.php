<?php

namespace HDSSolutions\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Laravel\DataTables\CashDataTable as DataTable;
use HDSSolutions\Laravel\Http\Request;
use HDSSolutions\Laravel\Models\Cash as Resource;
use HDSSolutions\Laravel\Models\CashBook;
use HDSSolutions\Laravel\Traits\CanProcessDocument;

class CashController extends Controller {
    use CanProcessDocument;

    public function __construct() {
        // check resource Policy
        $this->authorizeResource(Resource::class, 'resource');
    }

    protected function documentClass():string {
        // return class
        return Resource::class;
    }

    protected function redirectTo():string {
        // go to resource view
        return 'backend.cashes.show';
    }

    public function index(Request $request, DataTable $dataTable) {
        // check only-form flag
        if ($request->has('only-form'))
            // redirect to popup callback
            return view('backend::components.popup-callback', [ 'resource' => new Resource ]);

        // load resources
        if ($request->ajax()) return $dataTable->ajax();

        // load CashBooks
        $cashBooks = CashBook::all();

        // return view with dataTable
        return $dataTable->render('cash::cashes.index', compact('cashBooks') + [ 'count' => Resource::count() ]);
    }

    public function create(Request $request) {
        // load cash_books
        $cash_books = CashBook::all();

        // show create form
        return view('cash::cashes.create', compact('cash_books'));
    }

    public function store(Request $request) {
        // cast to boolean
        // $request->merge([ 'show_home' => $request->show_home == 'on' ]);

        // create resource
        $resource = new Resource( $request->input() );

        // save resource
        if (!$resource->save())
            // redirect with errors
            return back()->withInput()
                ->withErrors( $resource->errors() );

        // check return type
        return $request->has('only-form') ?
            // redirect to popup callback
            view('backend::components.popup-callback', compact('resource')) :
            // redirect to resources list
            redirect()->route('backend.cashes');
    }

    public function show(Request $request, Resource $resource) {
        // load inventory data
        $resource->load([
            'cashBook',
            'lines' => fn($line) => $line
                ->with([
                    'cash',
                    // 'currency',
                ]),
        ]);

        // redirect to list
        return view('cash::cashes.show', compact('resource'));
    }

    public function edit(Request $request, Resource $resource) {
        // check if document is already approved or processed
        if ($resource->isApproved() || $resource->isProcessed())
            // redirect to show route
            return redirect()->route('backend.cashes.show', $resource);

        // load cash_books
        $cash_books = CashBook::all();

        // show edit form
        return view('cash::cashes.edit', compact('cash_books', 'resource'));
    }

    public function update(Request $request, Resource $resource) {
        // cast show_home to boolean
        // $request->merge([ 'show_home' => $request->show_home == 'on' ]);

        // save resource
        if (!$resource->update( $request->input() ))
            // redirect with errors
            return back()->withInput()
                ->withErrors( $resource->errors() );

        // redirect to list
        return redirect()->route('backend.cashes');
    }

    public function destroy(Request $request, Resource $resource) {
        // delete resource
        if (!$resource->delete())
            // redirect with errors
            return back()
                ->withErrors( $resource->errors() );

        // redirect to list
        return redirect()->route('backend.cashes');
    }

}
