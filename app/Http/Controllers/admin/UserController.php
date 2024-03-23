<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
//use Intervention\Image\Facades\Image;
//use Image;

class UserController extends Controller
{
    ///protected $user;
    public function __construct()
    {
        /* $this->middleware(['permission:user-view|user-create|user-edit|user-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:user-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:user-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:user-delete'], ['only' => ['destroy']]); */
       // $this->user = $user;
    }

    public function index(Request $request){

        $paginate = $request->paginate ? $request->paginate : 10;
        $users = User::with('time_zones:id,name')->orderBy('id', 'desc')->paginate($paginate);
        
        //echo "<pre />"; print_r($users); exit;

        if ($request->ajax()) {
          return view('admin.user.data', compact('users',  'paginate'));
        }
        return view('admin.user.list', compact('users',  'paginate'));
    }

    public function create(){
        $timezones = DB::table('time_zones')->get();
        $roles = DB::table('roles')->get();
        $perms = DB::table('permissions')->orderBy('group_name')->get();
        $permissions = array();
        foreach ($perms as $p){
            if(!array_key_exists($p->group_name, $permissions))
                $permissions[$p->group_name] = [$p->id=>$p->name];
            else 
                $permissions[$p->group_name][$p->id] = $p->name;
        }
        return view('admin.user.create', compact('timezones','roles','permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'time_zone_id' => 'required|exists:time_zones,id',
            'photo' => 'mimes:jpg,png,jpeg,bmp,gif|max:1024',
            'roles.*' => 'exists:roles,id',
            'permissions.*' => 'exists:permissions,id',
        ]);

        try {
            $user = User::create([
                "name" => $request['name'],
                "username" => $request['username'],
                "email" => $request['email'],
                "time_zone_id" => $request['time_zone_id'],
                "password" => bcrypt($request['password']),
            ]);
            if($request['roles']){
                $user->roles()->sync([$request['roles']]);
            }
            $user->permissions()->sync($request['permissions']);
            return redirect()->back()->with('success', 'Saved successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong, cannot save the user.');
        }
    }

    public function edit($id){
        
        $timezones = DB::table('time_zones')->get();
        $roles = DB::table('roles')->get();
        $perms = DB::table('permissions')->orderBy('group_name')->get();
        $permissions = array();

        foreach ($perms as $p){
            if(!array_key_exists($p->group_name, $permissions))
                $permissions[$p->group_name] = [$p->id=>$p->name];
            else
                $permissions[$p->group_name][$p->id] = $p->name;
        }

        $user = User::with(['time_zones:id,name','permissions','roles'])->find($id);
        $has_permissions = [];
        foreach($user->permissions as $p){
            array_push($has_permissions, $p->id);
        }

        return view('admin.user.update',compact('user','timezones','roles','permissions','has_permissions'));
    }

    /* public function update(Request $request, $id){

        dd("that is good.");
        $this->validate($request, [
            'name' => 'required|string',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'nullable',
            'time_zone_id' => 'required|exists:time_zones,id',
            'photo' => 'mimes:jpg,png,jpeg,bmp,gif|max:1024',
            'roles.*' => 'exists:roles,id',
            'permissions.*' => 'exists:permissions,id',
        ]);
        dd($request);
        try {
            $password = $request['password']?[ "password" => bcrypt($request['password'])]: [];
            $user = User::where('id',$id)->update(array_merge( [
                "name" => $request['name'],
                "username" => $request['username'],
                "email" => $request['email'],
                "time_zone_id" => $request['time_zone_id'],
            ],$password));
            if($request['roles']){
                $user->roles()->sync([$request['roles']]);
            }
            $user->permissions()->sync($request['permissions']);
            
            return redirect()->back()->with('success', 'Saved successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong, cannot save the user.');
        }
    } */
}


?>

