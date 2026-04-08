<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumne extends Model{

    protected $fillable = [
        'nom',
        'cognoms',
        'dni',
        'data_naixement',
        'telefon',
        'grup',
    ];
    protected $dates = ["data_naixement"];

    public function grupRel(){
    return $this->belongsTo(Grup::class, 'grup');
    }

    public function moduls(){
    return $this->belongsToMany(Modul::class, 'matricules', 'alumne_id', 'modul_id')
                ->withPivot('nota')
                ->withTimestamps();
    }


}