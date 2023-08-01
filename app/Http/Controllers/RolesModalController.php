<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RolesModalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("index");
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
        $request->validate([
            'moreFields.*.name' => 'required|unique:roles'
        ],
        [
            'moreFields.*.name' => 'The role field is required and must be unique!'
        ]);
     
        foreach ($request->moreFields as $key => $value) {
            $request->user()->roles()->updateOrCreate($value);
        }
     
        return back()->with('success', 'New role has been added.');
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
    public function edit(Role $role)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    { 
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        
    }
}
