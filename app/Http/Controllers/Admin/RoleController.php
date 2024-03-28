<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request){
        $paginate = $request->paginate ? $request->paginate : 10;
        $roles = Role::when(!empty($request->searchValue), function ($q) use ($request) {
            $q->where('name', 'LIKE', "%$request->searchValue%");
        })->withCount('permissions')->paginate($paginate);
        if ($request->ajax()) {
          return view('admin.roles.data', compact('roles',  'paginate'));
        }
        return view('admin.roles.list', compact('roles',  'paginate'));
    }

    public function create(Request $request)
    {
      $perms = DB::table('permissions')->orderBy('group_name')->get();
        $permissions = array();
        foreach ($perms as $p){
            if(!array_key_exists($p->group_name, $permissions))
                $permissions[$p->group_name] = [$p->id=>$p->name];
            else 
                $permissions[$p->group_name][$p->id] = $p->name;
        }
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|unique:roles,name',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'exists:permissions,id',
        ]);
        try {
          $role = Role::create(["name" => $request['role']]);
          $role->permissions()->sync($request['permissions']);

          return redirect()->route('roles.show', ['id' => $role->id])->with('success', 'Saved successfully!');
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->with('error', 'Something went wrong, cannot save the user.');
        }
    }

    public function edit($id){
        
      $perms = DB::table('permissions')->orderBy('group_name')->get();

        $permissions = array();
        foreach ($perms as $p){
            if(!array_key_exists($p->group_name, $permissions))
                $permissions[$p->group_name] = [$p->id=>$p->name];
            else 
                $permissions[$p->group_name][$p->id] = $p->name;
        }

        $role = Role::with('permissions')->find($id);

        $has_permissions = [];
        foreach($role->permissions as $p){
            array_push($has_permissions, $p->id);
        }
        return view('admin.roles.update', compact('role','permissions','has_permissions'));
  }

  public function update(Request $request, $id){
    $this->validate($request, [
      'role' => 'required|unique:roles,name,'.$id,
      'permissions' => 'required|array|min:1',
      'permissions.*' => 'exists:permissions,id',
    ]);

    try {
        $role = Role::findOrFail($id);
        $role->update(["name" => $request['role']]);
        $role->permissions()->sync($request['permissions']);
        
        return redirect()->route('roles.show', ['id' => $id])->with('success', 'Updated successfully!');
    } catch (Exception $ex) {
        return redirect()->route('roles.show', ['id' => $id])->with('error', 'Something went wrong, cannot update the user.');
    }
 }

  public function show($id){
      $role = Role::with('permissions')->find($id);
      return view('admin.roles.view',compact('role'));
  }
}