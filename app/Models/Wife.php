<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wife extends Model
{
    protected $fillable = [
        'camp_member_id',

        'first_name',
        'father_name',
        'grandfather_name',
        'family_name',

        'identity_number',

        'birth_date',
        'age',
    ];

    public function campMember()
    {
        return $this->belongsTo(CampMember::class);
    }
}
