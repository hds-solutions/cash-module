<?php

namespace HDSSolutions\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Laravel\DataTables\CashBookDataTable as DataTable;
use HDSSolutions\Laravel\Http\Request;
use HDSSolutions\Laravel\Models\CashBook as Resource;
use HDSSolutions\Laravel\Models\Currency;

class CashBookController extends Controller {

    public function __construct() {
        // check resource Policy
        $this->authorizeResource(Resource::class, 'resource');
    }

    public function index(Request $request, DataTable $dataTable) {
        // check only-form flag
        if ($request->has('only-form'))
            // redirect to popup callback
            return view('backend::components.popup-callback', [ 'resource' => new Resource ]);

        // load resources
        if ($request->ajax()) return $dataTable->ajax();

        // return view with dataTable
        return $dataTable->render('cash::cash_books.index', [
            'count'                 => Resource::count(),
            'show_company_selector' => !backend()->companyScoped(),
        ]);
    }

    public function create(Request $request) {
        // force company selection
        if (!backend()->companyScoped()) return view('backend::layouts.master', [ 'force_company_selector' => true ]);

        // load currencies
        $currencies = Currency::all();

        // show create form
        return view('cash::cash_books.create', compact('currencies'));
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
            redirect()->route('backend.cash_books');
    }

    public function show(Request $request, Resource $resource) {
        // redirect to list
        return redirect()->route('backend.cash_books');
    }

    public function edit(Request $request, Resource $resource) {
        // load currencies
        $currencies = Currency::all();

        // show edit form
        return view('cash::cash_books.edit', compact('currencies', 'resource'));
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
        return redirect()->route('backend.cash_books');
    }

    public function destroy(Request $request, Resource $resource) {
        // delete resource
        if (!$resource->delete())
            // redirect with errors
            return back()
                ->withErrors( $resource->errors() );

        // redirect to list
        return redirect()->route('backend.cash_books');
    }

}
