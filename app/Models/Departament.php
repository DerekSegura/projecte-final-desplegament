<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model{

    protected $fillable = [
        'nom',
        'descripcio',
        'professor_id'
    ];

    public function professor(){
    return $this->belongsTo(Professor::class, 'professor_id');
    }

    public function moduls(){
    return $this->hasMany(Modul::class, 'departament_id');
    }

}