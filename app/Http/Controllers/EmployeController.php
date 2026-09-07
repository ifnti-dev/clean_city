<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\SweetAlert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use SweetAlert2\Laravel\Swal;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::where('name','!=','client')->get();
        $query = Employe::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                    ->orWhere('prenom', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('contacte', 'like', "%$search%");
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('user.roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        SweetAlert::sweetAlertMessage();

        // withQueryString : serve les paramètres de la requete dans la pagination
        // cet a dire que si on fait une recherche et qu'on change de page, la recherche sera conservee
        $employes = $query->latest('id')->paginate(8)->withQueryString();
        return view('employes.index', compact('employes', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //role sans client
        $roles = Role::whereNotIn('name', ['client'])->get();
        return view('employes.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'contacte' => ['required', 'string', 'max:255', 'unique:users,contacte'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => ['required', 'exists:roles,name'],
        ]);

        $password = DB::transaction(function () use ($validatedData) {
            $password = Str::random(10);

            $user = User::create([
                'nom' => $validatedData['nom'],
                'prenom' => $validatedData['prenom'],
                'contacte' => $validatedData['contacte'],
                'email' => $validatedData['email'],
                'password' => Hash::make($password),
            ]);


            Employe::create([
                'user_id' => $user->id,
            ]);

            $user->assignRole($validatedData['role']);

            return $password;
        });

        return redirect()
            ->route('employes.index')
            ->with([
                'success' => 'Employé créé avec succès.',
                'text' => "Le mot de passe généré pour l'employé est : $password",
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employe $employe)
    {
        //
        return view('employes.show', compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employe $employe)
    {
        //
        $roles = Role::whereNotIn('name', ['client'])->get();
        return view('employes.edit', compact('employe', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employe $employe)
    {
        //
        $validatedData = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'contacte' => ['required', 'string', 'max:255', 'unique:users,contacte,' . $employe->user_id],
            'email' => ['required', 'email', 'unique:users,email,' . $employe->user_id],
            'role' => ['required', 'exists:roles,name'],
        ]);

        DB::transaction(function () use ($validatedData, $employe) {
            $user = $employe->user;
            $user->update([
                'nom' => $validatedData['nom'],
                'prenom' => $validatedData['prenom'],
                'contacte' => $validatedData['contacte'],
                'email' => $validatedData['email'],
            ]);

            // Update the role
            if (!$user->hasRole($validatedData['role'])) {
                $user->syncRoles([$validatedData['role']]);
            }
        });

        return redirect()
            ->route('employes.index')
            ->with('success', 'Employé mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employe $employe)
    {
        // on ne supprime pas on peut lui archiver
        $employe->user->delete();
        return redirect()
            ->route('employes.index')
            ->with('success', 'Employé supprimé avec succès.');
    }
}
