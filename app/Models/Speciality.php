<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = [
        'name'
    ];

    public function doctor()
    {

        return $this->hasOne(Doctor::class);
    }
}
