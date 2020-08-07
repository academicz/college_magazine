<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed department_id
 * @property mixed course_name
 * @property mixed $department
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Course extends Model
{
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\StudentDetails', 'course_id', 'id');
    }
}
