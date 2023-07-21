<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class RolesController extends Controller
{
    public function __construct()  
    {  
        $this->middleware('role.owner')->only(['edit', 'show', 'destroy']);  
    }  
      
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {   
        return view('roles.index', ['roles' => $request->user()->roles ]);        
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
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->roles()->create($validated);

        return redirect(route('roles.index'))->with('success', 'Role created');
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
        return view('roles.edit')->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    { 
        $validated = $request->validated(); 

        $role->update($validated);

        return redirect(route('roles.index'))->with('success', 'Role updated');   
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
