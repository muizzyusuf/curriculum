<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramLearningOutcome extends Model
{
    use HasFactory;

    protected $primaryKey = 'pl_outcome_id';

    public function learningOutcomes(){
        return $this->belongsToMany('App\Models\LearningOutcome')->using('App\Models\OutcomeMap'); 
    }

    public function category()
    {
        return $this->belongsTo('App\Models\PLOCategory','plo_category_id', 'plo_category_id');
    }
}
