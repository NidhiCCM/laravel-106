<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRoleRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{
    public function __construct()  
    {  
        $this->middleware('role.owner')->only(['edit', 'show', 'destroy']);  
    }    
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {   
        $user = User::find(Auth::user()->roles);
        $roles = Role::whereBelongsTo($user)->get(); 

        return view('roles.index', compact('roles'));        
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
    public function store(StoreRoleRequest $request):RedirectResponse
    {
        $validated = $request->validated();
        $request->user()->roles()->create($validated);

        return redirect(route('roles.index'))->with('success', 'Role Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role) 
    {
        return view('roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('roles.edit')->with('role',$role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoleRequest $request, Role $role)
    { 
        $request->validated();    
        $role->name = $request->input('name');
        $role->save();

        return redirect(route('roles.index'))->with('success', 'Role Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        
        return redirect(route('roles.index'))->with('success', 'Role Removed');
    }
}
