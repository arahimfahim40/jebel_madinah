<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use Intervention\Image\Facades\Image;
//use Image;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $paginate = $request->paginate ? $request->paginate : 10;
        $users = User::when(!empty($request->searchValue), function ($q) use ($request) {
            $q->where('name', 'LIKE', "%$request->searchValue%");
            $q->orWhere('username', 'LIKE', "%$request->searchValue%");
            $q->orWhere('email', 'LIKE', "%$request->searchValue%");
        })->when(!empty($request->user_status), function ($q) use ($request) {
            $q->where('status', $request->user_status);
        })->where('email', '!=', 'admin@gmail.com')
            ->with(['time_zones', 'createdBy', 'updatedBy'])
            ->orderBy('id', 'desc')
            ->paginate($paginate);
        if ($request->ajax()) {
            return view('admin.users.data', compact('users',  'paginate'));
        }
        return view('admin.users.list', compact('users',  'paginate'));
    }

    public function create()
    {
        $timezones = DB::table('time_zones')->get();
        $roles = DB::table('roles')->get();
        $perms = DB::table('permissions')->orderBy('group_name')->get();
        $permissions = array();
        foreach ($perms as $p) {
            if (!array_key_exists($p->group_name, $permissions))
                $permissions[$p->group_name] = [$p->id => $p->name];
            else
                $permissions[$p->group_name][$p->id] = $p->name;
        }
        return view('admin.users.create', compact('timezones', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'username' => 'required|unique:users|unique:customers,email',
            'email' => 'required|unique:users|unique:customers,email',
            'password' => 'required',
            'status' => 'required|string|in:Active,Inactive',
            'time_zone_id' => 'required|exists:time_zones,id',
            'photo' => 'mimes:jpg,png,jpeg,bmp,gif|max:1024',
            'roles.*' => 'exists:roles,id',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $user = Auth::user();
        try {
            $user = User::create([
                "name" => $request['name'],
                "username" => $request['username'],
                "email" => $request['email'],
                "time_zone_id" => $request['time_zone_id'],
                "password" => bcrypt($request['password']),
                "status" => $request["status"],
                "created_by" => $user->id,
                "updated_by" => $user->id,
            ]);
            if ($request['roles']) {
                $user->roles()->sync([$request['roles']]);
            }
            $user->permissions()->sync($request['permissions']);
            return redirect()->route('users.show', ['id' => $user->id])->with('success', 'Saved successfully!');
        } catch (Exception $ex) {
            return redirect()->route('users.index')->with('error', 'Something went wrong, cannot save the user.');
        }
    }

    public function edit($id)
    {

        $timezones = DB::table('time_zones')->get();
        $roles = DB::table('roles')->get();
        $perms = DB::table('permissions')->orderBy('group_name')->get();
        $permissions = array();

        foreach ($perms as $p) {
            if (!array_key_exists($p->group_name, $permissions))
                $permissions[$p->group_name] = [$p->id => $p->name];
            else
                $permissions[$p->group_name][$p->id] = $p->name;
        }

        $user = User::with(['time_zones:id,name', 'permissions', 'roles'])->find($id);
        $has_permissions = [];
        foreach ($user->permissions as $p) {
            array_push($has_permissions, $p->id);
        }

        return view('admin.users.update', compact('user', 'timezones', 'roles', 'permissions', 'has_permissions'));
    }

    public function show($id)
    {

        $timezones = DB::table('time_zones')->get();
        $roles = DB::table('roles')->get();
        $perms = DB::table('permissions')->orderBy('group_name')->get();
        $permissions = array();

        foreach ($perms as $p) {
            if (!array_key_exists($p->group_name, $permissions))
                $permissions[$p->group_name] = [$p->id => $p->name];
            else
                $permissions[$p->group_name][$p->id] = $p->name;
        }

        $user = User::with(['time_zones:id,name', 'permissions', 'roles'])->find($id);
        $has_permissions = [];
        foreach ($user->permissions as $p) {
            array_push($has_permissions, $p->id);
        }
        return view('admin.users.view', compact('user', 'timezones', 'roles', 'permissions', 'has_permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'username' => 'required|unique:customers,email|unique:users,username,' . $id . '',
            'email' => 'required|unique:customers,email|unique:users,email,' . $id,
            'password' => 'nullable',
            'status' => 'required|string|in:Active,Inactive',
            'time_zone_id' => 'required|exists:time_zones,id',
            'photo' => 'mimes:jpg,png,jpeg,bmp,gif|max:1024',
            'roles.*' => 'exists:roles,id',
            'permissions.*' => 'exists:permissions,id',
        ]);
        $user = Auth::user();
        try {
            $user = User::findOrFail($id);
            $password = $request['password'] ? ["password" => bcrypt($request['password'])] : [];
            $user->update(array_merge([
                "name" => $request['name'],
                "username" => $request['username'],
                "email" => $request['email'],
                "time_zone_id" => $request['time_zone_id'],
                "status" => $request["status"],
                "updated_by" => $user->id,
            ], $password));

            $roles = [];
            if ($request['roles']) $roles = [$request['roles']];

            $user->roles()->sync($roles);
            $user->permissions()->sync($request['permissions']);

            return redirect()->route('users.show', ['id' => $id])->with('success', 'Saved successfully!');
        } catch (Exception $ex) {
            return redirect()->route('users.show', ['id' => $id])->with('error', 'Something went wrong, cannot save the user.');
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->id == $id) return redirect()->route('users.show', ['id' => $id])->with('error', 'Something went wrong, cannot delete the user.');
        try {
            User::where('id', $id)->update(['deleted_by' => $user->id]);
            User::find($id)->delete();
            return redirect()->route('users.index')->with('success', 'Deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->route('users.show', ['id' => $id])->with('error', 'Something went wrong, cannot delete the user.');
        }
    }
}