<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Alumne;
use App\Models\Grup;
use App\Models\Modul;
use Illuminate\Support\Facades\DB; 

class AlumneController extends Controller{

    // Llistar Alumnes
    public function list(Request $request){
        $cercar = $request->input('cercar');
        $notaMin = $request->input('nota_min');

        $query = Alumne::query();

        if ($cercar) {
            $query->where(function($q) use ($cercar){
                $q->where('dni', 'like', "%$cercar%")
                  ->orWhere('cognoms', 'like', "%$cercar%");
            });
        }

        if ($notaMin !== null && $notaMin !== '') {
            $query->whereHas('moduls', function($q) use ($notaMin) {
                $q->where('nota', '>=', $notaMin);
            });
        }

        $alumnes = $query->get();
        return view('alumne.list', compact('alumnes', 'cercar'));
    }

    // Crear Alumne
    public function new(Request $request){
        $grups = Grup::orderBy('nom')->get();
        $moduls = Modul::orderBy('nom')->get(); 

        if ($request->isMethod('post')) {

            $request->validate([
                'nom' => 'required|max:20',
                'cognoms' => 'required|max:30',
                'dni' => 'required|max:9|unique:alumnes,dni',
                'data_naixement' => 'required|date|before:today',
                'telefon' => 'nullable|max:9',
                'grup' => 'nullable|exists:grups,id',
            ],[
            'nom.required' =>   'El nom es obligatori',
            'nom.max' => 'El nom com a maxim ha de ser de 20 caracters',
            'cognoms.required' => "Els cognoms son obligatoris",
            'cognoms.max' => "Els cognoms dels alumnes han de ser com a maxim de 30 caracters",
            'dni.required' => "El dni es obligatori",
            'dni.max' => "El dni com a maxim ha de ser de 9 caracters",
            'dni.unique' => "Aquest dni es unic per alumne",
            'data_naixement.date' => "La data de naixement ha de ser de tipus data ",
            'data_naixement.before' => "La data de naixement ha de ser abans d'avui",
            'telefon.max' => "El telefon com a maxim ha de ser de 9 caracters",
            ]);

            try {

            DB::transaction(function () use ($request) {

                $alumne = new Alumne();
                $alumne->nom = $request->nom;
                $alumne->cognoms = $request->cognoms;
                $alumne->dni = $request->dni;
                $alumne->data_naixement = $request->data_naixement;
                $alumne->telefon = $request->telefon;
                $alumne->grup = $request->grup;
                $alumne->save();
                if ($request->grup) {
                    cookie()->queue('last_grup', $request->grup, 60);
                }

                if ($request->has('moduls')) {

                    $notes = $request->input('notes', []);

                    //dd($request->moduls, $request->notes);

                    foreach ($request->moduls as $modul_id) {
                        $nota = $notes[$modul_id] ?? null;
                        if ($nota === "") $nota = null;

                        $alumne->moduls()->attach($modul_id, ['nota' => $nota]);
                    }
                }

                if ($request->has('simular_error')) {
                    throw new \Exception("Simulació de rollback");
                }

            });

            return redirect()->route('alumne_list')
                             ->with('status', 'Alumne creat correctament');

        } catch (\Throwable $e) {
            dd("ERROR REAL:", $e->getMessage(), $e->getTraceAsString());
        }
    }

    $lastGrup = request()->cookie('last_grup');
    return view('alumne.new', compact('grups', 'moduls', 'lastGrup'));
}

    

    // Editar alumne
    public function edit(Request $request, $id){
        $alumne = Alumne::with('moduls')->find($id);
        if (!$alumne) {
            return redirect()->route('alumne_list')->with('error', 'Alumne no trobat.');
        }
        
        $grups = Grup::orderBy('nom')->get();
        $moduls = Modul::orderBy('nom')->get();

        if ($request->isMethod('post')) {

            $request->validate([
                'nom' => 'required|max:20',
                'cognoms' => 'required|max:30',
                'dni' => 'required|max:9|unique:alumnes,dni,'.$alumne->id,
                'data_naixement' => 'required|date|before:today',
                'telefon' => 'nullable|max:9',
                'grup' => 'nullable|exists:grups,id',
                'notes.*' => 'nullable|numeric|min:0|max:10'
            ],[
            'nom.required' =>   'El nom es obligatori',
            'nom.max' => 'El nom com a maxim ha de ser de 20 caracters',
            'cognoms.required' => "Els cognoms son obligatoris",
            'cognoms.max' => "Els cognoms dels alumnes han de ser com a maxim de 30 caracters",
            'dni.required' => "El dni es obligatori",
            'dni.max' => "El dni com a maxim ha de ser de 9 caracters",
            'dni.unique' => "Aquest dni es unic per alumne",
            'data_naixement.date' => "La data de naixement ha de ser de tipus data ",
            'data_naixement.before' => "La data de naixement ha de ser abans d'avui",
            'telefon.max' => "El telefon com a maxim ha de ser de 9 caracters",
            ]);

            DB::transaction(function () use ($request, $alumne) {

                $alumne->nom = $request->nom;
                $alumne->cognoms = $request->cognoms;
                $alumne->dni = $request->dni;
                $alumne->data_naixement = $request->data_naixement;
                $alumne->telefon = $request->telefon;
                $alumne->grup = $request->grup;
                $alumne->save();

                $syncData = [];

                if ($request->has('moduls')) {
                    $notes = $request->input('notes', []);

                    foreach ($request->moduls as $modul_id) {
                        $nota = $notes[$modul_id] ?? null;
                        if ($nota === "") $nota = null;

                        $syncData[$modul_id] = ['nota' => $nota];
                    }
                }

                $alumne->moduls()->sync($syncData);
            });

            return redirect()->route('alumne_list')->with('status', 'Alumne actualitzat correctament');
        }

        return view('alumne.edit', compact('alumne', 'grups', 'moduls'));
    }


    // Eliminar alumne
    public function delete($id){
        $alumne = Alumne::find($id);
        if (!$alumne) {
            return redirect()->route('alumne_list');
        }

        // Eliminar matrícules abans
        $alumne->moduls()->detach();

        // Ara sí, eliminar alumne
        $alumne->delete();

        return redirect()->route('alumne_list');
    }

}
