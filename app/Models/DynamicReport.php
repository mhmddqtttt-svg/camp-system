<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicReport extends Model
{
    protected $fillable = [
    'title',
    'description',
    'is_open',
    'expire_at',
    'duration_minutes',
'opened_at',
];
protected $casts = [
    'expire_at' => 'datetime',
];

    public function fields()
    {
        return $this->hasMany(DynamicReportField::class);
    }

    public function responses()
    {
        return $this->hasMany(DynamicReportResponse::class);
    }
}