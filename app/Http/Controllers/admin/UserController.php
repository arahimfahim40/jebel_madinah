<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
//use Intervention\Image\Facades\Image;
//use Image;

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


        $paginate = $request->paginate ? $request->paginate : 10;
        $status = in_array($request->status, Vehicle::VEHICLE_STATUS) ? $request->status : '';
        // dd($request->status);
        $vehicles = Vehicle::with('location:id,name')
        ->when(!empty($status), function ($q) use ($status) {
            $q->where('status', $status);
        })->paginate($paginate);
        if ($request->ajax()) {
          return view('admin.user.data', compact('vehicles', 'status', 'paginate'));
        }
        
        return view('admin.user.list', compact('vehicles', 'status', 'paginate'));


        //return view('admin.user.list' );
    }

    public function create(Request $request){

        $this->validate($request, [
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'timezone' => 'required|numeric',
            'photo' => 'mimes:jpg,png,jpeg,bmp,gif|max:1024'
        ]);


       /*  $imagePathAndName = '';
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $imagename = time() . '.' . $photo->getClientOriginalExtension();
            $destinationPath = public_path('images/user');
            $thumb_img = Image::make($photo->getRealPath())->resize(267, 286);
            $thumb_img->save($destinationPath . '/' . $imagename, 80);
            $photo->move($destinationPath, $imagename);
            $imagePathAndName = "images/user/" . $imagename;
        } else {
            $imagePathAndName = "img/avatars/profile.png";
        } */
       

        $new_user = new User();
        $new_user->name = $request['fullname'];
        $new_user->username = $request['username'];
        $new_user->email = $request['email'];
        $new_user->password = bcrypt($request['password']);
        //$add_user->photo = $imagePathAndName;
        
        try {
            $new_user->save();
            return redirect()->back()->with('success', 'Saved successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong, cannot save the user.');
        }
    

    }

}


?>

