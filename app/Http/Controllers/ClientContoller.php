<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clients = Client::with('user')->get();
        return view('clients.index', compact('clients'));
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
                'user_id' => $user->user_id
            ]);


        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
