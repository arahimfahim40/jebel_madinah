<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $locations = Location::when(!empty($request->searchValue), function ($q) use ($request) {
            $q->where('name', 'LIKE', "%$request->searchValue%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate($paginate);
        if ($request->ajax()) {
          return view('admin.locations.data', compact('locations', 'paginate'));
        }
        return view('admin.locations.list', compact('locations', 'paginate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:locations,name']);
        $user = Auth::user();
        try {
          $location = Location::create([
            "name" => $request['name'],
            "created_by" => $user->id,
            "updated_by" => $user->id
        ]);
          return redirect()->route('locations.index')->with('success', 'Saved successfully!');
        } catch (Exception $ex) {
            return redirect()->route('locations.index')->with('error', 'Something went wrong, cannot save the user.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, ['name' => 'required|unique:locations,name,'.$id]);
        $user = Auth::user();
        try {

            $location = Location::findOrFail($id);
            $location->update([
                "name" => $request['name'],
                "updated_by" => $user->id
            ]);
            return redirect()->route('locations.index')->with('success', 'Saved successfully!');
        } catch (Exception $ex) {
            return redirect()->route('locations.index')->with('error', 'Something went wrong, cannot save the user.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        try{
            Location::where('id',$id)->update(['deleted_by' => $user->id]);
            Location::find($id)->delete();
            return redirect()->route('locations.index')->with('success', 'Deleted successfully!');
        } catch(Exception $ex) {
            return redirect()->route('locations.show', ['id' => $id])->with('error', 'Something went wrong, cannot delete the user.');
        }
    }
}