<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class UserController extends Controller
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

            $query = User::select('users.*')->orderBy('id', 'desc');
            return $datatables->eloquent($query)

                ->addColumn('phone', function (User $user) {

                    return (!empty($user->phone)) ? $user->phone : ' ';
                })
                ->editColumn('status', function (User $user) {

                    return ($user->status == 0 ? '<span class="label label-lg font-weight-bold label-light-danger label-inline">Disabled</span>' : '<span class="label label-lg font-weight-bold label-light-success label-inline">Enabled</span>');
                })
                ->addColumn('action', function (User $user) {
                    return
                        (Auth::guard('admin')->user()->id == 1 || auth()->user()->hasPermissionTo('Edit Users') ? ' <a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>' : '') .
                        (Auth::guard('admin')->user()->id == 1 || auth()->user()->hasPermissionTo('Delete Users') ? '<a data-toggle="modal" href="#admin-delete" data-href="' . route('admin.users.destroy', $user->id) . '" class="btn btn-sm btn-danger btn-icon admin-delete" title="Delete"><i class="la la-trash"></i></a>' : '') .
                        (Auth::guard('admin')->user()->id == 1 || auth()->user()->hasPermissionTo('View Users') ? '<a href="' . route('admin.users.show', $user->id) . '" class="btn btn-sm btn-clean btn-icon" title="View details"><i class="la la-eye"></i></a>' : '');

                })
                ->rawColumns(['action', 'status', 'phone'])
                ->make(true);
        }

        return view('admin.users.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.form')->with([
            'user' => new User(),
            //'countries' => Country::where('status', 1)->where('phone_prefix', '!=', null)->get(),
            'roles' => Role::where('guard_name', 'admin')->where('id', '!=', 1)->get()->pluck('name'),
            'user_role' => '',
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
        //

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',

        ]);
        //dd($request->all());
        $request->request->add(['password' => Hash::make($request->password)]);
        $user = User::create($request->all());
        $user->assignRole($request->role);
        return redirect()->route('admin.users.index')->with('message', ' User Added Successfully..');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.detail')->with([
            'user' => User::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.form')->with([
            'user' => $user,
            //'countries' => Country::where('status', 1)->where('phone_prefix', '!=', null)->get(),
            'roles' => Role::where('guard_name', 'admin')->where('id', '!=', 1)->get()->pluck('name'),
            'user_role' => $user->getRoleNames()->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id . '',
            'phone' => 'required|numeric|unique:users,phone,' . $user->id . ',id',
        ]);

        if ($request->get('password')) {
            $rules['password'] = 'required|min:8|confirmed';
            $rules['password_confirmation'] = 'required|same:password';

            $this->validate($request, $rules);
        }

        $user->fill($request->only(['name', 'email', 'status', 'phone']));

        if ($request->get('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
        $user->syncRoles($request->input('role'));

        return redirect()->route('admin.users.index')->with('message', ' User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('success');
    }
}
