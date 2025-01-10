<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Gender;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\Media;
use Illuminate\Support\Facades\Mail;
use App\Mail\Register;
use App\Mail\AccountVerified;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        if ($request->ajax()) {

            $query = Customer::select('customers.*')->orderBy('id','desc');

            return $datatables->eloquent($query)

                ->editColumn('status', function (Customer $customer) {
                    return ($customer->status == 0 ? '<span class="label label-lg font-weight-bold label-light-danger label-inline">Disabled</span>' : '<span class="label label-lg font-weight-bold label-light-success label-inline">Enabled</span>');
                })
              
                ->editColumn('verification_status', function (Customer $customer) {
                    return ($customer->verification_status == 0 ? '<span class="label label-lg font-weight-bold label-light-danger label-inline">Not Verified</span>' : '<span class="label label-lg font-weight-bold label-light-success label-inline">Verified</span>');
                })
                
                ->addColumn('action', function (Customer $customer) {
                    return (Auth::guard('admin')->user()->id == 1 || auth()->user()->hasPermissionTo('Edit Customer') ? '<a href="' . route('admin.customers.edit', $customer->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>' : '');
                })
                ->rawColumns(['action', 'status', 'verification_status'])
                ->make(true);
        }
        
        return view('admin.customers.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.form')->with([
            'customer' => new Customer(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|unique:customers',
            'password' => 'required|min:8',
        ]);
        
        $customer = Customer::create(array_merge($request->all(), ['password' => Hash::make($request->password), 'otp_verification_status' => 1, 'verification_otp' => null]));
        
        Mail::to($customer->email, $customer->name)->send(new Register($customer));
        
        return redirect()->route('admin.customers.index')->with('message', 'Data Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer, Request $request, Datatables $datatables)
    {
        return view('admin.customers.detail')->with(['customer' => Customer::find($customer->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customers.form')->with([
            'customer' => Customer::find($customer->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $customer->id . ',id,deleted_at,NULL',
            'phone' => 'required|numeric|unique:customers,phone,' . $customer->id . ',id,deleted_at,NULL',
            'password' => 'nullable|min:8'
        ]);

        // $customer->fill($request->only(['name', 'email', 'status', 'phone']));

        if ($request->filled('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        } else {
            $request->request->remove('password');
        }

        $old_verification_status = $customer->verification_status;
        $customer->update($request->all());
        
        if($customer->verification_status == 1 && $old_verification_status == 0) {
            Mail::to($customer->email, $customer->name)->send(new AccountVerified($customer));
        }

        //$customer->phone_prefix = trim($request->phone_prefix,"+");
        // $customer->save();

        return redirect()->route('admin.customers.index')->with('message', ' Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json('success');
    }
}
