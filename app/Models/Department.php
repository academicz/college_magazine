<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed department_name
 * @property mixed $course
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Department extends Model
{
    public function course()
    {
        return $this->hasMany('App\Models\Course', 'department_id', 'id');
    }
}
