<?php

namespace HDSSolutions\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Laravel\DataTables\CashBookDataTable as DataTable;
use HDSSolutions\Laravel\Http\Request;
use HDSSolutions\Laravel\Models\CashBook as Resource;
use HDSSolutions\Laravel\Models\User;
use HDSSolutions\Laravel\Models\Currency;
use Illuminate\Support\Facades\DB;

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

        // load users
        $users = User::ordered()->get();
        // load currencies
        $currencies = Currency::ordered()->get();

        // show create form
        return view('cash::cash_books.create', compact('users', 'currencies'));
    }

    public function store(Request $request) {
        // start a transaction
        DB::beginTransaction();

        // cast to boolean
        if ($request->has('is_public')) $request->merge([ 'is_public' => filter_var($request->is_public, FILTER_VALIDATE_BOOLEAN) ]);

        // create resource
        $resource = new Resource( $request->input() );

        // save resource
        if (!$resource->save())
            // redirect with errors
            return back()->withInput()
                ->withErrors( $resource->errors() );

        // sync cash_book users
        if ($request->has('users')) $resource->users()->sync(
            // get users as collection
            $users = collect($request->get('users'))
                // filter empty users
                ->filter(fn($user) => $user !== null)
            );

        // commit changes to database
        DB::commit();

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
        // load users
        $users = User::ordered()->get();
        // load currencies
        $currencies = Currency::ordered()->get();

        // show edit form
        return view('cash::cash_books.edit', compact('resource',
            'users',
            'currencies',
        ));
    }

    public function update(Request $request, Resource $resource) {
        // start a transaction
        DB::beginTransaction();

        // cast to boolean
        if ($request->has('is_public')) $request->merge([ 'is_public' => filter_var($request->is_public, FILTER_VALIDATE_BOOLEAN) ]);

        // save resource
        if (!$resource->update( $request->input() ))
            // redirect with errors
            return back()->withInput()
                ->withErrors( $resource->errors() );

        // sync cash_book users
        if ($request->has('users')) $resource->users()->sync(
            // get users as collection
            $users = collect($request->get('users'))
                // filter empty users
                ->filter(fn($user) => $user !== null)
            );

        // commit changes to database
        DB::commit();

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
