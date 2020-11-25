<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseUser extends Model
{
    use HasFactory;

    protected $table = 'course_users';

    protected $primaryKey = ['course_id','user_id'];

    public $incrementing = false;

}
