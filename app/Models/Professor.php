<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model{

    protected $fillable = [
        'nom',
        'cognoms',
        'email',
        'foto',
    ];

    public function grup(){
        return $this->hasOne(Grup::class);
    }

    public function moduls(){
        return $this->hasMany(Modul::class);
    }

}