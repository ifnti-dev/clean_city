<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\SweetAlert;

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
        if ($request->filled('search')) {
            $query->where('name', 'like', "%$search%");
        }

        SweetAlert::sweetAlertMessage();

        $roles = $query->paginate(10)->withQueryString();
        return view('roles.index', compact('roles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permissions = Permission::query()
            ->where('guard_name', (new Role())->guard_name)
            ->orderBy('name')
            ->get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Le guard précise le type d'authentification auquel le rôle et ses permissions appartiennent.
        $guardName = (new Role())->guard_name;
        // Ne conserver que les données valides et les permissions du même guard.
        $data = $request->validate([
            'role' => ['required', 'string', 'min:5', Rule::unique('roles', 'name')->where('guard_name', $guardName)],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['required', 'integer', Rule::exists('permissions', 'id')->where('guard_name', $guardName)],
        ]);

        $role = Role::create([
            'name' => $data['role'],
        ]);
        // Attribuer au rôle les permissions sélectionnées dans le formulaire.
        $permissions = Permission::query()
            ->where('guard_name', $guardName)
            ->whereIn('id', $data['permissions'] ?? [])
            ->get();
        $role->syncPermissions($permissions);

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
        $permissions = Permission::query()
            ->where('guard_name', $role->guard_name)
            ->orderBy('name')
            ->get();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //

        // Valider le nom du rôle et les permissions choisies.
        $data = $request->validate([
            'role' => [
                'required',
                'string',
                'min:5',
                Rule::unique('roles', 'name')->where('guard_name', $role->guard_name)->ignore($role->id),
            ],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => [
                'required',
                'integer',
                Rule::exists('permissions', 'id')->where('guard_name', $role->guard_name),
            ],
        ]);

        $role->update([
            'name' => $data['role'],
        ]);
        // Synchroniser remplace la liste actuelle par les permissions sélectionnées.
        $permissions = Permission::query()
            ->where('guard_name', $role->guard_name)
            ->whereIn('id', $data['permissions'] ?? [])
            ->get();
        $role->syncPermissions($permissions);

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
