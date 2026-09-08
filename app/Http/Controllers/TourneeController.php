<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\LigneTournee;
use App\Models\SweetAlert;
use App\Models\Tournee;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SweetAlert2\Laravel\Swal;

class TourneeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:tournee.voire', only: ['index', 'show']),
            new Middleware('permission:tournee.creer', only: ['create', 'store']),
            new Middleware('permission:tournee.modifier', only: ['edit', 'update']),
            new Middleware('permission:tournee.annuler', only: ['demarertournee']),
            new Middleware('permission:tournee.terminer', only: ['terminertournee']),
            new Middleware('permission:tournee.demarer', only: ['demarertournee']),
            new Middleware('permission:tournee.supprimer', only: ['destroy']),

        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Tournee::with([
            'zone',
        ]);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
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

        // dd(session('success'));
        SweetAlert::sweetAlertMessage();

        // dd(Auth::user()->roles->first()->name,Auth::user()->employe->id);

        // dd(Auth::user()->roles->first()->name);
        // dd();
        if (!in_array(Auth::user()->roles->first()->name, ['responssable', 'comptable'])) {
            // dd("zzz");
            // dd(Auth::user()->employe->id);
            $query->whereJsonContains('employes_id', (string) Auth::user()->employe->id);
        }

        $tournees = $query->latest('id')->paginate(8);
        // dd($tournees);
        return view('tournees.index', compact('tournees'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //recuperer les user qui on le roles : agent collecte 
        $users = User::with('employe')->role(4)->get();
        // dd($users);
        $zones = Zone::all();
        return view('tournees.create', compact('zones', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'employes_id' => 'required|array|exists:employes,id',
            'zone_id' => 'required|integer|exists:zones,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        // dd($validated);
        // dd("fini");


        DB::transaction(function () use ($validated) {

            $code = Tournee::latest('id')->first()->id + 1;
            if ($code < 10000) {
                $code = "0000" . $code;
                $code = substr($code, -5);
            }
            $tournee = Tournee::create([
                'code' => $code,
                'employes_id' => json_encode($validated['employes_id']),
                'zone_id' => $validated['zone_id'],
                'date' => $validated['date'],
            ]);

            $zones = Zone::with('quartiers.menages')->where('id', $validated['zone_id'])->first();
            // dump($zones->quartiers->menages);

            foreach ($zones->quartiers as $quartier) {
                // dump($quartier->menages);
                foreach ($quartier->menages as $menage) {
                    LigneTournee::create([
                        'tournee_id' => $tournee->id,
                        'menage_id' => $menage->id,
                    ]);
                    // dump($menage->designation);
                }
            }
        });

        //envoyer un message a l'employer et a tout les menages de la zone


        return redirect()->route('tournees.index')->with('success', 'tournee créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tournee $tournee)
    {
        //
        SweetAlert::sweetAlertMessage();
        $ligne_tournees =  LigneTournee::where('tournee_id', $tournee->id)->latest('id')->paginate(8)->withQueryString();
        $employes = Employe::whereIn('id', json_decode($tournee->employes_id))->with('user')->get();
        // dd($employes);
        // dd($ligne_tournees);
        return view('tournees.show', compact('tournee', 'ligne_tournees', 'employes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tournee $tournee)
    {
        // $users = User::with('employe')->role(4)->get();
        // $employes = Employe::all();
        $employes = Employe::all();
        $zones = Zone::all();
        return view('tournees.edit', compact('tournee', 'zones', 'employes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tournee $tournee)
    {
        //
        $validated = $request->validate([
            'employes_id' => 'required|array|exists:employes,id',
            'zone_id' => 'required|integer|exists:zones,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        // dump($tournee);
        // dd($validated);

        $tournee->update([
            'employes_id' => $validated['employes_id'],
            'zone_id' => $validated['zone_id'],
            'date' => $validated['date'],
        ]);

        return redirect()->route('tournees.index')->with('success', 'tournee mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     * @model Tournee $tournee
     */
    public function destroy(Tournee $tournee)
    {
        //

        if ($tournee->status == "TERMINEE") {
            return redirect()->route('tournees.index')->with('error', 'cette tournee ne peux pas etre supprimer!!.');
        }
        $tournee->delete();
        return redirect()->route('tournees.index')->with('success', 'tournee supprimer avec succès.');
    }



    public function demarertournee(Tournee $tournee)
    {
        //
        // dd($tournee);
        // dd("demarertournee");
        $tournee->update(['status' => 'EN_COUR']);
        return redirect()->route('tournees.show', $tournee->id)->with('success', 'tournee démarré avec succès.');
    }


    public function annulertournee(Tournee $tournee)
    {
        //
        // dd("annulertournee");
        $tournee->update(['status' => 'PREVU']);
        return redirect()->route('tournees.show', $tournee->id)->with('success', 'tournee annulé avec succès.');
    }


    public function terminertournee(Tournee $tournee)
    {

        // dd("terminertournee");
        $tournee_id = $tournee->id;
        $ligne_menage = LigneTournee::where('tournee_id', $tournee_id)->where('status', 'NON_VIDER')->first();
        if ($ligne_menage) {
            return redirect()->route('tournees.show', $tournee_id)
                ->with([
                    'error' => "Vous n'avez pas vider le menage de: " . $ligne_menage->menage->designation . " à " . $ligne_menage->menage->quartier->designation,
                    'text' => ' '
                ]);
        }
        // dd("zzzz");

        $tournee->update(['status' => 'TERMINEE']);
        return redirect()->route('tournees.show', $tournee_id)->with('success', 'Tournee terminé avec succès.');
    }


    public function terminerLigneTournee(LigneTournee $lignetournee)
    {
        //
        // dd($lignetournee);
        // dd("terminertournee");

        $status = $lignetournee->tournee->status;
        if ($status == 'PREVU') {
            return redirect()->route('tournees.show', $lignetournee->tournee->id)
                ->with([
                    'error' => "Vous devez demarer la Tournée avant d'effectuer cette operation ",
                    'text' => ' '
                ]);
        } elseif ($status == 'TERMINEE') {
            return redirect()->route('tournees.show', $lignetournee->tournee->id)->with('success', 'Vous avez déja valider la Tournée.');
        }

        $lignetournee->update(['status' => 'VIDER']);

        return redirect()->route('tournees.show', $lignetournee->tournee->id)->with('success', 'Vous avez vider le Menage de ' . $lignetournee->menage->designation);
    }
}
