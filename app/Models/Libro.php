<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    // Indicar los campos que si se pueden llenar
    protected $fillable = ['nombre', 'autor', 'editorial', 'precio'];
}