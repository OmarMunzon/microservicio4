<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Ministerio extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'ministerios';

    protected $fillable = [
        'nombre',
        'fecha_creacion',
        'descripcion',
        'miembro_id'
    ];
    
    public $timestamps = false;

    // protected $casts = [
    //     'fecha_creacion' => 'datetime',
    // ];
}
