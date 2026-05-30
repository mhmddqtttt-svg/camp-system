<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Camp extends Model
{
    protected $fillable = [
        'name',
        'governorate',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
