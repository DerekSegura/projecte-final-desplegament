<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Professor;
use Illuminate\Support\Facades\File;


class ProfessorController extends Controller{
    
    // Llistar Professor

    public function list(){
        $ordre = null;
        $ordreDireccio = null;

        $professors = Professor::all();

        return view('professor.list', [
            'professors' => $professors,
            'ordre' => $ordre,
            'ordreDireccio' => $ordreDireccio,
        ]);
    }

    // Crear Professor

    public function new(Request $request){
        if ($request->isMethod('post')) {
            
            $request->validate([
            'nom' => 'required|max:20',
            'cognoms' => 'required|max:30',
            'email' => 'required|email|unique:professors',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
            ],[
            'nom.required' => 'El nom es obligatori',
            'nom.max' => 'El nom com a maxim ha de ser de 20 caracters',
            'cognoms.required' => 'Els cognoms son obligatoris',
            'cognoms.max' => 'Els cognoms han de ser com a maxim de 30 caracters',
            'email.required' => "L'email es obligatori",
            'email.email' => "L'email ha de ser de format email",
            'email.unique' => "L'email ha de ser unic per professor",
            'foto.image' => 'El fitxer ha de ser una imatge',
            'foto.mimes' => 'Les imatges han de ser JPG, JPEG, PNG o GIF',
            'foto.max' => 'La imatge no pot superar els 2MB',
            ]);
            
            $professor = new Professor();
            $professor->nom = $request->nom;
            $professor->cognoms = $request->cognoms;
            $professor->email = $request->email;

            $ruta = config('app.imatges.ruta');
            if($request->hasFile('foto')){
                $file = $request-> file('foto');

                $extensio = $file->getClientOriginalExtension();

                $filename = strtolower($request->nom . "_" . $request->cognoms . "_" . time() . "." . $extensio);

                $file->move(public_path($ruta), $filename);
                
                $professor->foto = $filename;
            }

            $professor->save();

            return redirect()->route('professor_list');
        }
        
        
        return view('professor.new');
    }

    // Editar professor

    public function edit(Request $request, $id)
    {
        $professor = Professor::find($id);
        if (!$professor) {
            return redirect()->route('professor_list')->with('error', 'Professor no trobat.');
        }

        if ($request->isMethod('post')) {
            
            $request->validate([
            'nom' => 'required|max:20',
            'cognoms' => 'required|max:30',
            'email' => 'required|email|unique:professors,email,' . $professor->id,
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
            ],[
            'nom.required' => 'El nom es obligatori',
            'nom.max' => 'El nom com a maxim ha de ser de 20 caracters',
            'cognoms.required' => 'Els cognoms son obligatoris',
            'cognoms.max' => 'Els cognoms han de ser com a maxim de 30 caracters',
            'email.required' => "L'email es obligatori",
            'email.email' => "L'email ha de ser de format email",
            'email.unique' => "L'email ha de ser unic per professor",
            'foto.image' => 'El fitxer ha de ser una imatge',
            'foto.mimes' => 'Les imatges han de ser JPG, JPEG, PNG o GIF',
            'foto.max' => 'La imatge no pot superar els 2MB',
            ]);
            
            $professor->nom = $request->nom;
            $professor->cognoms = $request->cognoms;
            $professor->email = $request->email;

            $ruta = config('app.imatges.ruta');

            if ($request->has('eliminar_foto') && $professor->foto) {
                $fotoPath = public_path($ruta . '/' . $professor->foto);
                if (File::exists($fotoPath)) {
                    File::delete($fotoPath);
                }
                $professor->foto = null;
            }

            if ($request->hasFile('foto')) {

                if ($professor->foto && File::exists(public_path($ruta . '/' . $professor->foto))) {
                    File::delete(public_path($ruta . '/' . $professor->foto));
                }

                $file = $request->file('foto');
                $extensio = $file->getClientOriginalExtension();
                $filename = strtolower($request->nom . "_" . $request->cognoms . "_" . time() . "." . $extensio);

                $file->move(public_path($ruta), $filename);
                $professor->foto = $filename;
            }

            $professor->save();

            return redirect()->route('professor_list');
        }

        return view('professor.edit', ['professor' => $professor]);
    }

    // Eliminar Professor

    public function delete($id){
    $professor = Professor::find($id);
    if (!$professor) {
        return redirect()->route('professor_list');
    }

    $ruta = config('app.imatges.ruta');

    if ($professor->foto && File::exists(public_path("$ruta/$professor->foto"))) {
        File::delete(public_path("$ruta/$professor->foto"));
    }

    $professor->delete();

    return redirect()->route('professor_list');
    }


    // Ordenar Professor

    public function ordenar(Request $request){
        
    $ordre = $request->input('ordre');
    $ordreDireccio = $request->input('ordreDireccio','asc');

    $query = Professor::query();

    if ($ordre) {
        $query->orderBy($ordre, $ordreDireccio);
    }

    $professors = $query->get();

    return view('professor.list', [
        'professors' => $professors,
        'ordre' => $ordre,
        'ordreDireccio' => $ordreDireccio
    ]);
    }
}
