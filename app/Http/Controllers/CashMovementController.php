<?php

namespace HDSSolutions\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Laravel\DataTables\CashMovementDataTable as DataTable;
use HDSSolutions\Laravel\Http\Request;
use HDSSolutions\Laravel\Models\Cash;
use HDSSolutions\Laravel\Models\CashBook;
use HDSSolutions\Laravel\Models\CashMovement as Resource;
use HDSSolutions\Laravel\Models\ConversionRate;
use HDSSolutions\Laravel\Traits\CanProcessDocument;

class CashMovementController extends Controller {
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
        // go to cash movements view
        return 'backend.cash_movements.show';
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
        return $dataTable->render('cash::cash_movements.index', compact('cashBooks') + [
            'count'                 => Resource::count(),
            'show_company_selector' => !backend()->companyScoped(),
        ]);
    }

    public function create(Request $request) {
        // force company selection
        if (!backend()->companyScoped()) return view('backend::layouts.master', [ 'force_company_selector' => true ]);

        // load open cashes
        $cashes = Cash::open()->get();

        // get current conversion rates
        $conversion_rates = ConversionRate::valid()->get();

        // show create form
        return view('cash::cash_movements.create', compact('cashes', 'conversion_rates'));
    }

    public function store(Request $request) {
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
            redirect()->route('backend.cash_movements');
    }

    public function show(Request $request, Resource $resource) {
        // load inventory data
        $resource->load([
            'cash.cashBook.currency',
            'toCash.cashBook.currency',
        ]);

        // redirect to list
        return view('cash::cash_movements.show', compact('resource'));
    }

    public function edit(Request $request, Resource $resource) {
        // check if document is already approved or processed
        if ($resource->isApproved() || $resource->isProcessed())
            // redirect to show route
            return redirect()->route('backend.cash_movements.show', $resource);

        // load open cashes
        $cashes = Cash::open()->get();
        // get current conversion rates
        $conversion_rates = ConversionRate::valid()->get();

        // show edit form
        return view('cash::cash_movements.edit', compact('cashes', 'conversion_rates', 'resource'));
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
        return redirect()->route('backend.cash_movements');
    }

    public function destroy(Request $request, Resource $resource) {
        // delete resource
        if (!$resource->delete())
            // redirect with errors
            return back()
                ->withErrors( $resource->errors() );

        // redirect to list
        return redirect()->route('backend.cash_movements');
    }

}
