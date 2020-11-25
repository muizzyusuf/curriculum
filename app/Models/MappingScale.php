<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingScale extends Model
{
    use HasFactory;

    protected $primaryKey = 'map_scale_id';

    public function programs()
    {
        return $this->belongsToMany('App\Models\Program','mapping_scale_programs' ,'map_scale_id', 'program_id');
    }
}
