<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PLOCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'plo_category_id';

    public function plos()
    {
        return $this->hasMany('App\Models\ProgramLearningOutcome');
    }
}
