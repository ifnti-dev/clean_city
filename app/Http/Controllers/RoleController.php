<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use SweetAlert2\Laravel\Swal;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->input('search');
        $query = Role::query();
        if($search){
            $query->where('name', 'like', "%$search%");
        }

        if (session(('success'))) {
            // Toast with pause on hover
            if (session('text')) {
                Swal::success([
                    'title' => session('success'),
                    'text' => session('text'),
                    'showConfirmButton' => true,
                ]);
            } else {
                Swal::success([
                    'title' => session('success'),
                    'text' => session('text'),
                    'timer' => 2000,
                    'showConfirmButton' => false,
                ]);
            }
        }

        if (session(('errors'))) {
            Swal::error([
                'title' => session('errors'),
                'text' => session('text'),
                'timer' => 2000,
                'showConfirmButton' => false,
            ]);
        }


        $roles = $query->paginate(4);
        return view('roles.index', compact('roles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'role' => 'required|min:5'
        ]);

        $role = Role::create([
            'name' => $data['role'],
        ]);




        return to_route('roles.index')->with("success", "vous avez enregistrer un nouveau role ".strtoupper($data['role']) );
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
        //
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //

        
        $data = $request->validate([
            'role' => ['required', Rule::unique('roles')-> ignore($role->id, 'id'), 'min:5'],  
        ]);

       


        $role->update([
            'name' => $data['role'],
        ]);



        return to_route('roles.index')->with("success", "vous avez enregistrer un nouveau role ".strtoupper($data['role']) );


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();

        return to_route('roles.index');

    }
}
