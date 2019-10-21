<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    protected $table = 'vessels';
    protected $fillable = ['id','name_vessels','max_capacity','min_capacity','lat', 'lng', 'speed'];
}
