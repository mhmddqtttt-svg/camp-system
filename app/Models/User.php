<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'identity_number',
        'role',
        'status',
        'camp_id',
        'whatsapp_group_link',
        'shelter_manager',
        'shelter_phone',
        'shelter_alt_phone',
        'shelter_address',
        'shelter_gps',
        'shelter_camp_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function camp()
{
    return $this->belongsTo(\App\Models\Camp::class, 'camp_id');
}
}