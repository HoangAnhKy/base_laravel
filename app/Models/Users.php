<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users extends Table
{
    use HasFactory;

    public $fillable = ["name_user", "birthdate", "email", "password", "position"];
    public static $condition = ["users.del_flag" => UNDEL, "users.status" => ACTIVE];


    public function getformatBirthdateAttribute()
    {
        return ( new \DateTime($this->birthdate))->format("Y-m-d");
    }
}
