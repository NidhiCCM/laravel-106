<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
           $currentUser=auth()->user()->id;
            $roles = Role::where('user_id', $currentUser)   
                        ->orderBy('created_at', 'asc')         
                        ->paginate(5) ;                           
            return view('roles.index')->with('roles', $roles ); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',           
        ]);
        $role = new Role;
        $role->name= $request->input('name');
        $role->user_id= auth()->user()->id;
        $role->save();
        return redirect('/roles')->with('success', 'Role Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) 
    {
        $role = Role::find($id);
        return view('roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        if(auth()->user()->id !== $role->user_id){
            return redirect('/roles')->with('error', 'Unauthorized Page');
        }
        return view('roles.edit')->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',            
        ]);      
		$role = Role::find($id);
        if(auth()->user()->id !== $role->user_id){
            return redirect('/roles')->with('error', 'Unauthorized Page');
        }
        $role->name = $request->input('name');
        $role->save();
        return redirect('/roles')->with('success', 'Role Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if(auth()->user()->id !==$role->user_id){
            return redirect('/roles')->with('error', 'Unauthorized Page');
        }
        $role->delete();
        return redirect('/roles')->with('success', 'Role Removed');
    }
}
