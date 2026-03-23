<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Modul;
use Illuminate\Support\Facades\File;
use App\Models\Professor;

class ModulController extends Controller{
    
    // Llistar Moduls amb filtre

    public function list(Request $request){

        $professor_id = $request->input('professor_id');

        $order = $request->input('order');

        $professors = Professor::orderBy('cognoms')->get();

        $query = Modul::query();

        if($professor_id){
            $query->where('professor_id', $professor_id);
        }

        // Ordenar por horas
        if ($order === 'hores_asc') {
            $query->orderBy('hores', 'asc');
        } elseif ($order === 'hores_desc') {
            $query->orderBy('hores', 'desc');
        }

        $moduls = $query->get();

        return view('modul.list', [
            'moduls' => $moduls,
            'professors' => $professors, 
            'selected_professor' => $professor_id,
            'order' => $order,
        ]);
    }

    // Crear Modul

    public function new(Request $request){
        $professors = Professor::orderBy('cognoms')->get();

        if ($request->isMethod('post')) {
            
            $request->validate([
            'nom' => 'required|string|max:40',
            'hores' => 'required|integer|min:1',
            'professor_id' => 'nullable|exists:professors,id'
            ],[
            'nom.required' => 'El nom es obligatori',
            'nom.max' => 'El nom com a maxim ha de ser de 40 caracters',
            'hores.required' => "Les hores son obligatories",
            'hores.integer' => "Les hores han de ser de un numero enter",
            'hores.min' => "El minim d'hores ha de ser 1",
            'professor_id.exists' => "El professor seleccionat no existeix",
            ]);
            
            $modul = new Modul();
            $modul->nom = $request->nom;
            $modul->hores = $request->hores;
            $modul->professor_id = $request->professor_id;

            $modul->save();

            return redirect()->route('modul_list');
        }
        
        
        return view('modul.new', ['professors' => $professors]);
    }

    // Editar modul

    public function edit(Request $request, $id)
    {
        $modul = Modul::find($id);
        if (!$modul) {
            return redirect()->route('modul_list')->with('error', 'modul no trobat.');
        }
        $professors = Professor::orderBy('cognoms')->get();

        if ($request->isMethod('post')) {
            
            $request->validate([
            'nom' => 'required|string|max:40',
            'hores' => 'required|integer|min:1',
            'professor_id' => 'nullable|exists:professors,id'
            ],[
            'nom.required' => 'El nom es obligatori',
            'nom.max' => 'El nom com a maxim ha de ser de 40 caracters',
            'hores.required' => "Les hores son obligatories",
            'hores.integer' => "Les hores han de ser de un numero enter",
            'hores.min' => "El minim d'hores ha de ser 1",
            'professor_id.exists' => "El professor seleccionat no existeix",
            ]);
            
            $modul->nom = $request->nom;
            $modul->hores = $request->hores;
            $modul->professor_id = $request->professor_id;

            $modul->save();

            return redirect()->route('modul_list');
        }

        return view('modul.edit', [ 'modul' => $modul, 'professors' => $professors ]);
    }

    // Eliminar modul

    public function delete($id){
    $modul = Modul::find($id);
    if (!$modul) {
        return redirect()->route('modul_list');
    }
    $modul->delete();

    return redirect()->route('modul_list');
    }

}
