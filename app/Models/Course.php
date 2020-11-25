<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = 'courses';

    protected $primaryKey ='course_id';

    protected $fillable = ['course_code', 'course_num', 'course_title', 'program_id', 'status', 'assigned', 'type'];

    protected $guarded = ['course_id'];

    public function users(){
        return $this->belongsToMany('App\Models\User', 'course_users', 'course_id', 'user_id');
    }

    public function learningActivities(){
        return $this->hasMany('App\Models\LearningActivity', 'course_id','course_id');
    }

    public function assessmentMethods(){
        return $this->hasMany('App\Models\AssessmentMethod', 'course_id','course_id');
    }

    public function learningOutcomes(){
        return $this->hasMany('App\Models\LearningOutcome', 'course_id','course_id');
    }


    public function program() 
    {
        return $this->belongsTo('App\Models\Program', 'program_id', 'program_id');
    }
}


