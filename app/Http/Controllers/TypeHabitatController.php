<?php

namespace App\Http\Controllers;

use App\Models\TypeHabitat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use SweetAlert2\Laravel\Swal;

class TypeHabitatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->input('search');
        $query = TypeHabitat::query();

        if($search){
            $query->where('designation', 'like', "%$search%");
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

        $typeHabitats = $query->paginate(4);
        return view('typeHabitats.index', compact('typeHabitats', 'search')); 

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('typeHabitats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'designation' => 'required|min:5'
        ]);

        $role = TypeHabitat::create([
            'designation' => $validated['designation'],
        ]);

        return to_route('typeHabitats.index')->with("success", "Vous avez enregistrer le type d'Habitat ".strtoupper($validated['designation']) );


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
    public function edit(TypeHabitat $typeHabitat)
    {
        //
        return view('typeHabitats.edit', compact('typeHabitat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeHabitat $typeHabitat)
    {
        //
         $validated = $request->validate([
            'designation' => ['required', Rule::unique('type_habitats')->ignore($typeHabitat->id, 'id')],
        ]);

        $typeHabitat->update([
            'designation' => $validated['designation'],
        ]);

        return to_route('typeHabitats.index')->with("success", "Vous avez enregistrer le type d'Habitat ".strtoupper($validated['designation']) );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeHabitat $typeHabitat)
    {
        //
        dd("dddd");
        $typeHabitat->delete();
        return view('typeHabitats.index')->with("succes", "vous avez supprime l'habitat".strtoupper($typeHabitat->designation));

    }
}
