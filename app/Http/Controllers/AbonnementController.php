<?php

namespace App\Http\Controllers;


use App\Models\Abonnement;
use App\Models\Client;
use App\Models\Menage;
use App\Models\Quartier;
use App\Models\Tarif;
use App\Models\TypeHabitat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SweetAlert2\Laravel\Swal;


class AbonnementController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:abonnement.voire', only: ['index', 'show']),
            new Middleware('permission:abonnement.creer', only: ['create', 'store']),
            new Middleware('permission:abonnement.modifier', only: ['edite', 'update']),
            new Middleware('permission:abonnement.supprimer', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.

     */
    public function index(Request $request)
    {
        //
        $query = Abonnement::with([
            'menage.client.user'
        ]);




        // dump($query->get());

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('menage', function ($q) use ($search) {
                $q->where('code', 'like', "%$search%")
                    ->orWhere('designation', 'like', "%$search%");
            })->orWhereHas('menage.client.user', function ($q) use ($search) {
                $q->where('nom', 'like', "%$search%");
            });
        }


        if ($request->filled('etat')) {
            $query->where('etat', $request->etat);
        }

        // Filtre en règle
        if ($request->filled('en_regle')) {
            $query->whereHas('menage', function ($q) use ($request) {
                $q->where('est_en_regle', $request->en_regle);
            });
        }

        // Date début
        if ($request->filled('date_debut')) {
            $query->whereDate('date_debut', '>=', $request->date_debut);
        }

        // Date fin
        if ($request->filled('date_fin')) {
            $query->whereDate('date_fin', '<=', $request->date_fin);
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

        if (session(('erros'))) {
            Swal::error([
                'title' => session('erros'),
                'timer' => 2000,
                'showConfirmButton' => false,
            ]);
        }

        $abonnements = $query->where('deleted_at', null)->latest()->paginate(8);
        return view('abonnees.index', compact('abonnements'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clients = Client::all();
        $quartiers = Quartier::all();
        $type_habitats = TypeHabitat::all();
        return view('abonnees.create', compact('clients', 'type_habitats', 'quartiers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $validated = $request->validate([
            "client_id" => "required|integer|exists:clients,id",
            "designation" => "required|string|min:3|unique:menages",
            "longitude" => "required|numeric",
            "latitude" => "required|numeric",
            'type_habitat_id' =>  "required|integer|exists:type_habitats,id",
            'quartier_id' =>  "required|integer|exists:quartiers,id",
        ]);

        // dd($validated);

        $menage = DB::transaction(function () use ($validated) {

            $code = "0000" . Menage::latest('id')->first()->id;
            $code = substr($code, -5);
            // dd($code);

            $menage = Menage::create([
                'code' => $code,
                'designation' => $validated['designation'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'est_abonnee' => true,
                'est_radier' => false,
                'est_en_regle' => true,
                'client_id' => $validated['client_id'],
                'type_habitat_id' => $validated['type_habitat_id'],
                'quartier_id' => $validated['quartier_id'],
            ]);


            Abonnement::create([
                'menage_id' => $menage->id,
                'employe_save_id' => Auth::user()->employe->id
            ]);

            return $menage;
        });

        if ($menage) {
            return to_route('abonnements.index')->with([
                "success" => "L'Abonnement de  " . strtoupper($menage->designation) . " est Creer",
                "text" => "Voici le Code du Menage: " . strtoupper($menage->code)

            ]);
        }

        return to_route('abonnements.index')->with("erros", "Ressayer la creation de cette abonnement  ");
    }

    /**
     * Display the specified resource.
     */
    public function show(Abonnement $abonnement)
    {

        if (session('text')) {
            Swal::success([
                'title' => session('success'),
                'text' => session('text'),
                'timer' => 2000,
                'showConfirmButton' => false,
            ]);
        }
        return view('abonnees.show', compact('abonnement'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Abonnement $abonnement)
    {
        // dd($abonnement);
        $clients = Client::all();
        $quartiers = Quartier::all();
        // $tarifs = Tarif::all();
        $type_habitats = TypeHabitat::all();
        return view('abonnees.edit', compact('abonnement', 'clients', 'type_habitats', 'quartiers'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Abonnement $abonnement)
    {
        // dd($request->all());

        $validated = $request->validate([
            "date_debut" => "required|date:after_now ",
            "date_fin" => "date|nullable",
            "client_id" => "required|integer|exists:clients,id",
            "designation" => "required|string|min:3|unique:menages,designation," . $abonnement->menage->id,
            // "tarif_id" => "required|integer|exists:tarifs,id",
            "longitude" => "required|integer",
            "latitude" => "required|integer",
            'type_habitat_id' =>  "required|integer|exists:type_habitats,id",
            'quartier_id' =>  "required|integer|exists:quartiers,id",
        ]);

        DB::transaction(function () use ($validated, $abonnement) {

            $abonnement->menage->update([
                'designation' => $validated['designation'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'est_abonnee' => true,
                'est_radier' => false,
                'est_en_regle' => true,
                'client_id' => $validated['client_id'],
                'type_habitat_id' => $validated['type_habitat_id'],
                'quartier_id' => $validated['quartier_id'],
            ]);

            $abonnement->update([
                'date_debut' => $validated['date_debut'],
                'date_fin' => $validated['date_fin'] ? $validated['date_debut'] : null,
                // 'tarif_id' => $validated['tarif_id'],
            ]);
        });

        // envoyer un message au client , qu'il a ete adhere a espoir plus

        return to_route('abonnements.index')->with([
            "success" => "L'Abonnement de  " . strtoupper($abonnement->menage->designation) . " est Modifier",
            "text" => "Voici le Code du Menage: " . $abonnement->menage->code

        ]); //" est creer avec succes,

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Abonnement $abonnement)
    {
        //
        // dd("delete");
        $abonnement->delete();
        return to_route('abonnements.index')->with("success", "L'Abonnement de  " . strtoupper($abonnement->menage->designation) . " est Supprimer");
    }


    public function traiterUnAbonnement(Abonnement $abonnement)
    {
        // dump("traiterUnAbonnement");
        // dump($abonnement);
        // dd($abonnement->menage);
        $abonnement->update(
            ['status' => 'EN_COUR_DE_TRAITEMENT']
        );
        return to_route('abonnements.show', $abonnement->id)->with("success", "L'abonnement de " . strtoupper($abonnement->menage->designation) . "est en cour de traitement");
    }

    public function rejeterUnAbonnement(Abonnement $abonnement)
    {
        //
        // dd("rejeterUnAbonnement");
        $abonnement->update(
            ['status' => 'REJETER']
        );
        return to_route('abonnements.show', $abonnement->id)->with("success", "Vouse avez Rejeter l'abonnement de: " . strtoupper($abonnement->menage->designation));
    }

    public function approuverUnAbonnement(Abonnement $abonnement)
    {
        // dd("approuverUnAbonnement");
        $abonnement->update(
            [
                'date_debut' => now(),
                'status' => 'APPROUVER',
                'employe_approuve_id' => Auth::user()->employe->id,
                'etat' => 'ACTIF'
            ]
        );
        return to_route('abonnements.show', $abonnement->id)->with("success", "Vous avez approuver l'abonnement de " . strtoupper($abonnement->menage->designation));
    }


    public function desabonneeUnMenage(Abonnement $abonnement)
    {
        // dd("desabonnee");
        $abonnement->menage->update(
            ['est_abonnee' => false]
        );
        $abonnement->update(
            ['etat' => 'INACTIF']
        );
        return to_route('abonnements.index')->with("success", "Vouse avez Desabonnée " . strtoupper($abonnement->menage->designation));
    }


    public function radierUnMenage(Abonnement $abonnement)
    {
        $abonnement->menage->update(
            ['est_radier' => true]
        );
        return to_route('abonnements.index')->with("success", "Vouse avez Radier " . strtoupper($abonnement->menage->designation));
    }
}
