<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $department
 * @property int user_id
 * @property mixed department_id
 */
class FacultyDetails extends Model
{
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }
}
