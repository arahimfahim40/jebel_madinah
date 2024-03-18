<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        /* $this->middleware(['permission:user-view|user-create|user-edit|user-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:user-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:user-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:user-delete'], ['only' => ['destroy']]); */
        $this->user = $user;
    }

    public function index(){

        return view('admin.user.list' );
    }

    public function create(Request $request){

        $this->validate($request, [
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'timezone' => 'required',
            'photo' => 'mimes:jpg,png,jpeg,bmp,gif|max:1024'
        ]);

        $new_user = new User();
        $new_user->name = $request['fullname'];
        $new_user->username = $request['username'];
        $new_user->email = $request['email'];
        $new_user->password = Hash::make($request['password']);
    

    }

}


?>

