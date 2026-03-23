<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model{

    protected $fillable = [
        'nom',
        'hores',
        'professor_id',
        'departament_id',
    ];

    public function professor(){
        return $this->belongsTo(Professor::class);
    }

    public function departament(){
        return $this->belongsTo(Departament::class);
    }

    public function alumnes(){
    return $this->belongsToMany(Alumne::class, 'matricules', 'modul_id', 'alumne_id')
                ->withPivot('nota')
                ->withTimestamps();
    }
    
    public function matricules() {
        return $this->hasMany(Matricula::class, 'modul_id');
    } 


}