<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use SweetAlert2\Laravel\Swal;

class ClientContoller extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */


    public static function middleware(): array
    {
        return [
            new Middleware('permission:client.voire', only:['index', 'show']),
            new Middleware('permission:client.creer', only:['create', 'store']),
            new Middleware('permission:client.modifier', only:['edite', 'update']),
            new Middleware('permission:client.supprimer', only:['destroy']),
           
        ];
    }


    public function index(Request $request)
    {
        //
        
        $search = $request->input('search');
       
        

        if (session(('supprimer'))) {
            // Toast with pause on hover
            Swal::error([
                'title' => session('supprimer'),
                'icon' => 'error',
                'showConfirmButton' => true ,
                'timer' => 20000,           
            ]);
           
        }

        
        $clients = Client::with(['user', 'menages'])->get();
    
        return view('clients.index', compact('clients', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $validated = $request->validate([

            'nom' => 'required|min:3',
            'prenom' => 'required|min:3',
            'email' => 'required|email',
            'contacte' => 'required|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password|min:8'

        ]);

        
        DB::transaction(function() use($validated){
            $user = User::create([
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'email' => $validated['email'],
                'contacte' => $validated['contacte'],
                'password' => $validated['password'],
            ]);

            Client::create([
                'user_id' => $user->id
            ]);    

        });


        return to_route('clients.index');
        //envoyer un message apres creation
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
       
        $client->load(['user', 'menages']);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
        
        $validated = $request->validate([

            'nom' => 'required|min:3',
            'prenom' => 'required|min:3',
            'email' => ['required', Rule::unique('users', 'email')-> ignore($client->user_id)],
            'contacte' => ['required', Rule::unique('users', 'contacte')-> ignore($client->user_id)],
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password|min:8'

        ]);

        
            $client->user->update([
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'email' => $validated['email'],
                'contacte' => $validated['contacte'],
                'password' => $validated['password'],
            ]);


        return to_route('clients.index');

        //envoyer un message apres modification
    
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //

        $menage = DB::table('menages as m')->join('clients as c', 'm.id', '=', 'm.client_id')->select('est_abonnee')->get();
        if(!$menage){
            $client->delete();
            return to_route('clients.index');
        }else{
           
            return to_route('clients.index')->with("supprimer", "vous avez des menages actifs" );
        }
        

        

    }
}
