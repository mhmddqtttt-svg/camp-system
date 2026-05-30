<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FamilyProfile;

class FamilyRequest extends Model
{
    protected $fillable = [

        'status',

        'payment_status',

        'amount',

        'payment_image',

        'full_name',

        'identity_number',

        'password',

        'phone',

        'email',

        'camp_id',
    ];

    public function profile()
    {
        return $this->hasOne(FamilyProfile::class, 'family_request_id');
    }
}
