<?php

namespace HDSSolutions\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Laravel\Http\Request;
use HDSSolutions\Laravel\Models\Cash;
use HDSSolutions\Laravel\Models\CashLine as Resource;

class CashLineController extends Controller {

    public function __construct() {
        // check resource Policy
        $this->authorizeResource(Resource::class, 'resource');
    }

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
            redirect()->route('backend.cashes.show', $resource->cash);
    }

}
