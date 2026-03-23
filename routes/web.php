<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\GrupController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\AlumneController;
use App\Http\Controllers\DepartamentController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/guest', function () {
    return redirect()->route('professor_list');
})->name('guest_access');



Route::get('/dashboard', function () {
    return redirect()->route('professor_list');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::resource('professors', ProfessorController::class)->middleware('auth');

// Professors:

Route::get('/professors', [ProfessorController::class, 'list'])->name('professor_list');

Route::get('/professors/ordenar', [ProfessorController::class, 'ordenar'])->name('professor_ordenar');

Route::match(['get', 'post'], '/professors/new', [ProfessorController::class, 'new'])->name('professor_new');

Route::match(['get', 'post'], '/professors/{id}/edit', [ProfessorController::class, 'edit'])->name('professor_edit');

Route::get('/professors/{id}/delete', [ProfessorController::class, 'delete'])->name('professor_delete');

// Grups:

Route::get('/grups', [GrupController::class, 'list'])->name('grup_list');

Route::match(['get', 'post'], '/grups/new', [GrupController::class, 'new'])->name('grup_new');

Route::match(['get', 'post'], '/grups/{id}/edit', [GrupController::class, 'edit'])->name('grup_edit');

Route::get('/grups/{id}/delete', [GrupController::class, 'delete'])->name('grup_delete');

// Moduls:

Route::get('/moduls', [ModulController::class, 'list'])->name('modul_list');

Route::match(['get', 'post'], '/moduls/new', [ModulController::class, 'new'])->name('modul_new');

Route::match(['get', 'post'], '/moduls/{id}/edit', [ModulController::class, 'edit'])->name('modul_edit');

// Alumnes:

Route::get('/alumnes', [AlumneController::class, 'list'])->name('alumne_list');

Route::get('/alumnes/ordenar', [AlumneController::class, 'ordenar'])->name('alumne_ordenar');

Route::match(['get', 'post'], '/alumnes/new', [AlumneController::class, 'new'])->name('alumne_new');

Route::match(['get', 'post'], '/alumnes/{id}/edit', [AlumneController::class, 'edit'])->name('alumne_edit');

Route::get('/alumnes/{id}/delete', [AlumneController::class, 'delete'])->name('alumne_delete');

Route::get('/moduls/{id}/delete', [ModulController::class, 'delete'])->name('modul_delete');

// Departament:

Route::resource('departaments', DepartamentController::class);

Route::get('/departaments/{id}/moduls', [DepartamentController::class, 'showModuls'])->name('departaments.moduls');

require __DIR__.'/auth.php';
