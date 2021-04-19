<?php

namespace HDSSolutions\Finpar\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Finpar\DataTables\CashLineDataTable as DataTable;
use HDSSolutions\Finpar\Http\Request;
use HDSSolutions\Finpar\Models\Cash;
use HDSSolutions\Finpar\Models\CashLine as Resource;

class CashLineController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DataTable $dataTable) {
        // check only-form flag
        if ($request->has('only-form'))
            // redirect to popup callback
            return view('backend::components.popup-callback', [ 'resource' => new Resource ]);

        // load resources
        if ($request->ajax()) return $dataTable->ajax();

        // return view with dataTable
        return $dataTable->render('cash::cash_lines.index', [ 'count' => Resource::count() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        // load open cashes
        $cashes = Cash::open()->with([
            'cashBook.currency',
        ])->get();
        // get selected cash
        $cash = $cashes->firstWhere('id', $request->cash);

        // show create form
        return view('cash::cash_lines.create', compact('cashes', 'cash'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // cast to boolean
        // $request->merge([ 'show_home' => $request->show_home == 'on' ]);

        // create resource
        $resource = new Resource( $request->input() );

        // save resource
        if (!$resource->save())
            // redirect with errors
            return back()
                ->withErrors( $resource->errors() )
                ->withInput();

        // check return type
        return $request->has('only-form') ?
            // redirect to popup callback
            view('backend::components.popup-callback', compact('resource')) :
            // redirect to resources list
            redirect()->route('backend.cashes.show', $resource->cash);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource) {
        // load inventory data
        $resource->load([
            'cashBook.currency',
            'lines',
        ]);
        // redirect to list
        return view('cash::cash_lines.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource) {
        // check if document is already approved or processed
        if ($resource->isApproved() || $resource->isProcessed())
            // redirect to show route
            return redirect()->route('backend.cashes.show', $resource);

        // load cash_books
        $cash_books = CashBook::all();
        // show edit form
        return view('cash::cash_lines.edit', compact('cash_books', 'resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // cast show_home to boolean
        // $request->merge([ 'show_home' => $request->show_home == 'on' ]);

        // find resource
        $resource = Resource::findOrFail($id);

        // save resource
        if (!$resource->update( $request->input() ))
            // redirect with errors
            return back()
                ->withErrors( $resource->errors() )
                ->withInput();

        // redirect to list
        return redirect()->route('backend.cashes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // find resource
        $resource = Resource::findOrFail($id);
        // delete resource
        if (!$resource->delete())
            // redirect with errors
            return back();
        // redirect to list
        return redirect()->route('backend.cashes');
    }

}
