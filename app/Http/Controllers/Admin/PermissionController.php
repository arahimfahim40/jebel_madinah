<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request){      
        $paginate = $request->paginate ? $request->paginate : 10;
        $permissions = Permission::when(!empty($request->searchValue), function ($q) use ($request) {
          $q->where('name', 'LIKE', "%$request->searchValue%");
          $q->orWhere('group_name', 'LIKE', "%$request->searchValue%");
      })->orderBy('group_name', 'desc')->paginate($paginate); 
        if ($request->ajax()) {
          return view('admin.permissions.data', compact('permissions',  'paginate'));
        }
        return view('admin.permissions.list', compact('permissions',  'paginate'));
    }
}