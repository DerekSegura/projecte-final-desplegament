<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $fillable = [
        'alumne_id',
        'modul_id',
        'nota'
    ];

    protected $table = 'matricules';
    
    public function modul()
    {
        return $this->belongsTo(Modul::class, 'modul_id');
    }
}
