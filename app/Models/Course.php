<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey ='course_id';

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\Program');
    }
}


