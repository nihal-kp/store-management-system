<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class StoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Datatables $datatables)
    {
        if ($request->ajax()) {

            $query = Store::select('stores.*')->orderBy('id','desc');

            return $datatables->eloquent($query)

                ->editColumn('status', function (Store $store) {
                    return ($store->status == 0 ? '<span class="label label-lg font-weight-bold label-light-danger label-inline">Disabled</span>' : '<span class="label label-lg font-weight-bold label-light-success label-inline">Enabled</span>');
                })
                
                ->addColumn('actions', function (Store $store) {
                    return ('<a href="' . route('admin.stores.edit', $store->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a> <a data-toggle="modal" href="#store-delete" data-href="' . route('admin.stores.destroy', $store->id) . '" class="btn btn-sm btn-danger btn-icon store-delete" title="Delete"><i class="la la-trash"></i></a>');
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }
        
        return view('admin.stores.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stores.form')->with([
            'store' => new Store(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        
        $store = Store::create($request->all());
        return redirect()->route('admin.stores.index')->with('message', 'Data Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store, Request $request)
    {
        return view('admin.stores.detail')->with(['store' => Store::find($store->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        return view('admin.stores.form')->with([
            'store' => Store::find($store->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $store->update($request->all());

        return redirect()->route('admin.stores.index')->with('message', ' Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return response()->json('success');
    }
}
