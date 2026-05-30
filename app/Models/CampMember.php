<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampMember extends Model
{
    protected $fillable = [
        'user_id',
        'camp_id',

        'first_name',
        'father_name',
        'grandfather_name',
        'family_name',

        'identity_number',

        'phone',
        'backup_phone',

        'birth_date',
        'age',

        'gender',
        'marital_status',
        'family_members_count',
    ];

    public function wives()
    {
        return $this->hasMany(Wife::class, 'camp_member_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function camp()
    {
        return $this->belongsTo(\App\Models\Camp::class, 'camp_id');
    }
}
