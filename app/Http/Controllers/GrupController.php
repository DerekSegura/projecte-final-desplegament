<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Grup;
use Illuminate\Support\Facades\File;
use App\Models\Professor;


class GrupController extends Controller{
    
    // Llistar Grups

    public function list(){
        $grups = Grup::all();
        return view('grup.list', ['grups' => $grups,]);
    }

    // Crear Grup

    public function new(Request $request){
        $professors = Professor::orderBy('cognoms')->get();

        if ($request->isMethod('post')) {
            
            $request->validate([
            'nom' => 'required|max:20',
            'aula' => 'required|max:30',
            'tutor' => 'required|unique:grups,professor_id'
            ],[
            'nom.required' =>   'El nom es obligatori',
            'nom.max' => 'El nom com a maxim ha de ser de 20 caracters',
            'aula.required' => "L'aula es obligatoria",
            'aula.max' => "Els noms de les aules han de ser com a maxim de 30 caracters",
            'tutor.required' => "El tutor es obligatori",
            'tutor.unique' => "Aquest professor ja és tutor d'un altre grup",
            ]);
            
            $grup = new Grup();
            $grup->nom = $request->nom;
            $grup->aula = $request->aula;
            $grup->professor_id = $request->tutor;

            $grup->save();

            return redirect()->route('grup_list');
        }
        
        
        return view('grup.new', ['professors' => $professors]);
    }

    // Editar grup

    public function edit(Request $request, $id)
    {
        $grup = Grup::find($id);
        if (!$grup) {
            return redirect()->route('grup_list')->with('error', 'grup no trobat.');
        }
        
        $professors = Professor::orderBy('cognoms')->get();

        if ($request->isMethod('post')) {
            
            $request->validate([
            'nom' => 'required|max:20',
            'aula' => 'required|max:30',
            'tutor' => 'required|unique:grups,professor_id,' . $grup->id . ',id'
            ],[
            'nom.required' =>   'El nom es obligatori',
            'nom.max' => 'El nom com a maxim ha de ser de 20 caracters',
            'aula.required' => "L'aula es obligatoria",
            'aula.max' => "Els noms de les aules han de ser com a maxim de 30 caracters",
            'tutor.required' => "El tutor es obligatori",
            'tutor.unique' => "Aquest professor ja és tutor d'un altre grup",
            ]);
            
            $grup->nom = $request->nom;
            $grup->aula = $request->aula;
            $grup->professor_id = $request->tutor;

            $grup->save();

            return redirect()->route('grup_list');
        }

        return view('grup.edit', [ 'grup' => $grup, 'professors' => $professors ]);
    }

    // Eliminar grup

    public function delete($id){
    $grup = Grup::find($id);
    if (!$grup) {
        return redirect()->route('grup_list');
    }
    $grup->delete();

    return redirect()->route('grup_list');
    }
}
