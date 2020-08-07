<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed reg_no
 * @property mixed course_id
 * @property mixed user_id
 * @property mixed $course
 */
class StudentDetails extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }
}
