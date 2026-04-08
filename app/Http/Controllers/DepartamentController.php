<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Departament; 
use App\Models\Modul;
use App\Models\Professor;


class DepartamentController extends Controller{
    
    // Llistar Departaments

    public function index(Request $request){

        $query = Departament::query()->with('professor');
        
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('searchModulNom')) {
            $query->whereHas('moduls', function($q) use ($request) {
            $q->where('nom', 'like', '%' . $request->searchModulNom . '%');
            });
        }

        if ($request->filled('professor_id')) {
            $query->where('professor_id', $request->professor_id);
        }

        if ($request->order === 'asc') {
            $query->orderBy('nom', 'asc');
        } elseif ($request->order === 'desc') {
            $query->orderBy('nom', 'desc');
        } else { $query->orderBy('nom', 'asc');
        }

        if ($request->order === 'moduls_asc') {
            $query->withCount('moduls')->orderBy('moduls_count', 'asc');
        }

        if ($request->order === 'moduls_desc') {
            $query->withCount('moduls')->orderBy('moduls_count', 'desc');
        }
        
        $departaments = $query->get(); 
        $professors = Professor::orderBy('cognoms')->get();

        return view('departament.list', compact('departaments','professors'));
    }

    // Formulari de creació

    public function create() {
        $professors = Professor::orderBy('cognoms')->get();
        $moduls = Modul::orderBy('nom')->get();
        return view('departament.new', compact('professors','moduls'));
    }

    // Guardar nou departament
    public function store(Request $request){
            
            $request->validate([
            'nom' => 'required|max:20|regex:/^[A-Za-z].*/',
            'descripcio' => 'nullable|string|max:50',
            'professor_id' => 'required|unique:departaments,professor_id',
            ],[
            'nom.required' =>   'El nom es obligatori',
            'nom.max' => 'El nom com a maxim ha de ser de 20 caracters',
            'nom.regex' => 'El nom del departament no pot començar per número',
            'descripcio.max' => "Les descripcions dels departaments han de ser com a maxim de 50 caracters",
            'professor_id.unique' => "Aquest professor ja esta en un altre departament",
            ]);

            try {

                DB::transaction(function () use ($request) {
                    $departament = Departament::create([
                        'nom' => $request->nom,
                        'descripcio' => $request->descripcio,
                        'professor_id' => $request->professor_id,
                    ]);

                    Modul::whereIn('id', $request->moduls ?? []) 
                        ->update(['departament_id' => $departament->id]);
                });

                return redirect()->route('departaments.index')
                                ->with('status', 'Departament creat correctament');

            }catch (\Throwable $e) {
                dd("ERROR REAL:", $e->getMessage());
            }
    }

    // Editar departament

    public function edit($id) {
        $departament = Departament::findOrFail($id);
        $professors = Professor::orderBy('cognoms')->get();
        $moduls = Modul::orderBy('nom')->get();
        return view('departament.edit', compact('departament', 'professors','moduls')); 
    }


    public function update(Request $request, $id)
    {
        $departament = Departament::findOrFail($id);            
            $request->validate([
            'nom' => 'required|max:20|regex:/^[A-Za-z].*/',
            'descripcio' => 'nullable|string|max:50',
            'professor_id' => 'required|unique:departaments,professor_id,' . $departament->id . ',id'
            ],[
            'nom.required' =>   'El nom es obligatori',
            'nom.max' => 'El nom com a maxim ha de ser de 20 caracters',
            'nom.regex' => 'El nom del departament no pot començar per número',
            'descripcio.max' => "Les descripcions dels departaments han de ser com a maxim de 50 caracters",
            'professor_id.unique' => "Aquest professor ja esta en un altre departament",
            ]);

            try{
                DB::transaction(function () use ($request, $departament) {
                    $departament->update([
                        'nom' => $request->nom,
                        'descripcio' => $request->descripcio,
                        'professor_id' => $request->professor_id,
                    ]);

                    Modul::where('departament_id', $departament->id) 
                        ->update(['departament_id' => null]);

                    Modul::whereIn('id', $request->moduls ?? []) 
                        ->update(['departament_id' => $departament->id]);
                });

                return redirect()->route('departaments.index')
                    ->with('status', 'Departament actualitzat correctament');

            }catch (\Throwable $e) {
            dd("ERROR REAL:", $e->getMessage());
        }
    }

    // Eliminar departament

    public function destroy($id){

    $departament = Departament::findOrFail($id);

    $departament->moduls()->update(['departament_id' => null]);

    $departament->delete();

    return redirect()->route('departaments.index')->with('status', 'Departament eliminat correctament');

    }

    public function showModuls($id){
    $departament = Departament::with(['professor', 'moduls.professor'])->findOrFail($id);

    return view('departament.moduls', compact('departament'));
    }


}
