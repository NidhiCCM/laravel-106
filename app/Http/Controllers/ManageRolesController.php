<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str; 

class RolesController extends Controller
{
    public function __construct()  
    {  
        $this->middleware('role.owner')->only(['edit', 'show', 'update', 'destroy']);  
    }  
      
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $data = $request->user()->roles;
        if ($request->ajax()) {
  
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('name'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                
                                return Str::contains($row['name'], $request->get('name')) ? true : false;
                            });
                        }
   
                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))){
                                    return true;
                                }else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                                    return true;
                                }
   
                                return false;
                            });
                        }
                    })
                    ->addColumn('action', function($row){
   
                            $btn = '<a href="'.route('roles.edit', $row->id).'" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                        Edit
                                    </a>';
   
                            $btn = $btn.'<a href="'.route('roles.show', $row->id).'" class="ml-2  inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                         Show
                                        </a>';
                            $btn = $btn.'<form 
                                            id="delete_form" 
                                            action="'.route('roles.destroy', $row->id).'" 
                                            method="POST" 
                                            style="display: inline-block;">
                                            '.csrf_field().'
                                            '.method_field("DELETE").'
                                            <button 
                                                class="ml-2 delete-btn inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 ">
                                                Delete
                                            </button>
                                        </form>';
                            return $btn;
                    })         
                    ->rawColumns(['action'])
                    ->make(true);       
        }
      
        return view('roles.index');
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
        
        return redirect(route('roles.index'))->with('success', 'Role deleted');
    }
}
