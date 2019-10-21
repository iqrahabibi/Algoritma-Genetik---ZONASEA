<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargotransactions';
    protected $fillable = ['name_cargo','latlng', 'capacity'];
}
