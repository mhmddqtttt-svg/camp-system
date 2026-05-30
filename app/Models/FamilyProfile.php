<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyProfile extends Model
{
    protected $fillable = [
        'user_id',
        'family_request_id',

        'identity_number',
        'first_name',
        'father_name',
        'grandfather_name',
        'family_name',

        'birth_date',
        'age',

        'phone',
        'backup_phone',

        'gender',
        'marital_status',
        'family_members_count',
    ];

    public function family()
    {
        return $this->belongsTo(FamilyRequest::class, 'family_request_id');
    }

    public function wives()
    {
        return $this->hasMany(FamilyProfileWife::class, 'family_profile_id');
    }
}
