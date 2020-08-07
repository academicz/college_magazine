<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property mixed name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $id
 * @property mixed email
 * @property mixed phone
 * @property int user_type
 * @property int status
 * @property mixed $student_details
 * @property mixed $faculty_details
 */
class User extends Model
{
    public function student_details()
    {
        return $this->hasOne('App\Models\StudentDetails', 'user_id');
    }

    public function faculty_details()
    {
        return $this->hasOne('App\Models\FacultyDetails', 'user_id');
    }

    public function login()
    {
        return $this->hasOne('App\Models\Login', 'user_id');
    }

    public function article()
    {
        return $this->hasMany('App\Models\Article', 'user_id');
    }

}
