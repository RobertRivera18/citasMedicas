<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    protected $fillable = [

        'user_id',
        'blood_type_id',
        'allergies',
        'cronic_conditions',
        'surgical_history',
        'family_history',
        'observations',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',

    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bloodType(){
        $this->belongsTo(BloodType::class);
    }
}
