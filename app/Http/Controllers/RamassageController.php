<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Tournee;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use SweetAlert2\Laravel\Swal;

class RamassageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:ramassage.voire', only: ['index', 'show']),
            new Middleware('permission:ramassage.creer', only: ['create', 'store']),
            new Middleware('permission:ramassage.modifier', only: ['edit', 'update']),
            new Middleware('permission:ramassage.annuler', only: ['demarerRamassage']),
            new Middleware('permission:ramassage.terminer', only: ['terminerRamassage']),
            new Middleware('permission:ramassage.demarer', only: ['demarerRamassage']),
            new Middleware('permission:ramassage.supprimer', only: ['destroy']),

        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Tournee::with([
            'employe.user',
            'zone',
        ]);

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('zone', function ($q) use ($search) {
                $q->where('designation', 'like', "%$search%");
            })->orWhereHas('employe.user', function ($q) use ($search) {
                $q->where('nom', 'like', "%$search%");
            });
        }



        // Date début
        if ($request->filled('date_debut')) {
            $query->whereDate('date', '>=', $request->date_debut);
        }

        // Date fin
        if ($request->filled('date_fin')) {
            $query->whereDate('date', '<=', $request->date_fin);
        }


        //sucess message avec sweet alert
        if (session('success')) {
            Swal::success([
                'title' => session('success'),
                'showConfirmButton' => false,
                "timer" => 2000,
            ]);
        }


        $ramassages = $query->latest()->paginate(8);
        // dd($ramassages);
        return view('ramassages.index', compact('ramassages'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //recuperer les user qui on le roles : agent collecte 

        // $users = DB::table('users')
        //     ->join('employes', 'employes.user_id  as employe_id', "users.id")
        //     ->join('model_has_roles', 'model_has_roles.model_id', 'users.id')
        //     ->where('role_id', 4)->get();

        $users = User::with('employe')
            ->role(4)
            ->get();


        // $users = Employe::all();                                                         


        // foreach ($users as $user) {
        //     dump($user->contacte);
        // }
        // dd($users);
        $zones = Zone::all();
        return view('ramassages.create', compact('zones', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employe_id' => 'required|integer|exists:employes,id',
            'zone_id' => 'required|integer|exists:zones,id',
            'date' => 'required|date|after_or_equal:today',
        ]);


        Tournee::create([
            'employe_id' => $validated['employe_id'],
            'zone_id' => $validated['zone_id'],
            'date' => $validated['date'],
        ]);

        //envoyer un message a l'employer et a tout les menages de la zone


        return redirect()->route('ramassages.index')->with('success', 'Ramassage créé avec succès.');
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
    public function edit(Tournee $ramassage)
    {
        $employes = Employe::all();
        $zones = Zone::all();
        return view('ramassages.edit', compact('ramassage', 'zones', 'employes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tournee $ramassage)
    {
        //
        $validated = $request->validate([
            'employe_id' => 'required|integer|exists:employes,id',
            'zone_id' => 'required|integer|exists:zones,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        // dump($ramassage);
        // dd($validated);

        $ramassage->update([
            'employe_id' => $validated['employe_id'],
            'zone_id' => $validated['zone_id'],
            'date' => $validated['date'],
        ]);

        return redirect()->route('ramassages.index')->with('success', 'Ramassage mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    public function demarerRamassage(Tournee $tournee)
    {
        //
        // dd($tournee);
        // dd("demarerRamassage");
        $tournee->update(['statut' => 'EN_COUR']);
        return redirect()->route('ramassages.index')->with('success', 'Ramassage démarré avec succès.');
    }


    public function annulerRamassage(Tournee $tournee)
    {
        //

        // dd("annulerRamassage");
        $tournee->update(['statut' => 'PREVU']);
        return redirect()->route('ramassages.index')->with('success', 'Ramassage annulé avec succès.');
    }


    public function terminerRamassage(Tournee $tournee)
    {
        //
        // dd("terminerRamassage");
        $tournee->update(['statut' => 'TERMINEE']);
        return redirect()->route('ramassages.index')->with('success', 'Ramassage terminé avec succès.');
    }
}
