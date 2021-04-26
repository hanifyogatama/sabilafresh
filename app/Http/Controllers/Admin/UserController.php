<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

use App\Authorizable;
use Session;
use DB;

class UserController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::all();

        // $this->data['users'] = User::first()->paginate(10);
        $userAdmins = User::orderBy('id', 'asc')->get();
        $userCustomers = User::where('is_admin', '0')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users.index', compact('roles', 'userAdmins', 'userCustomers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->data['roles'] = Role::pluck('name', 'id');

        return view('admin.users.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama_depan' => 'bail|required|min:2',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'roles' => 'required|min:1'
            ],

            [
                'nama_depan.required' => 'nama harus diisi',
                'email.required' => 'email harus diisi',
                'email.email' => 'cek kembali format email cth. example@example.com',
                'email.unique:users' => 'email sudah terdaftar',
                'password.required' => 'password harus diisi',
                'password.min' => 'password min 8 karakter',
                'roles.required' => 'role belum dipilih',
            ]
        );

        $request->merge(['password' => bcrypt($request->get('password'))]);

        DB::transaction(function () use ($request) {
            if ($user = User::create($request->except('roles', 'permissions'))) {
                $this->syncPermissions($request, $user);

                // Session::flash('success', 'User berhasil dibuat');
            } else {
                Session::flash('error', 'User gagal dibuat');
            }
        });

        return redirect('admin/users')->with('success-add', 'success');
    }

    /**
     * Sync roles and permissions
     *
     * @param Request $request
     * @param $user
     * @return string
     */
    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if (!$user->hasAllRoles($roles)) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['user'] = User::find($id);
        $this->data['roles'] = Role::pluck('name', 'id');
        $this->data['permissions'] = Role::all('name', 'id');

        return view('admin.users.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate(
            $request,
            [
                'nama_depan' => 'bail|required|min:2',
                'email' => 'required|email|unique:users,email,' . $id,
            ],

            [
                'nama_depan.required' => 'nama harus diisi',
                'email.required' => 'email harus diisi',
                'email.email' => 'cek kembali format email cth. example@example.com',
                'email.unique:users' => 'email sudah terdaftar',
                'password.min' => 'password min 8 karakter',
            ]
        );


        // Get the user
        $user = User::findOrFail($id);

        DB::transaction(function () use ($request, $user) {
            // Update user
            $user->fill($request->except('roles', 'permissions', 'password'));

            // check for password change
            if ($request->get('password')) {
                $user->password = bcrypt($request->get('password'));
            }

            $this->syncPermissions($request, $user);

            $user->save();

            // Session::flash('success', 'User has been saved');
        });

        return redirect('admin/users')->with('success-edit', 'success');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('Admin')) {
            Session::flash('error', 'Unable to remove an Admin user');
            return redirect('admin/users');
        }

        $user->delete();
        // Session::flash('success', 'User has been deleted');
        return redirect('admin/users')->with('success-delete', 'success');
    }
}
