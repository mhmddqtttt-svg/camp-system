<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicReportResponse extends Model
{
    protected $fillable = [
        'dynamic_report_id',
        'user_id',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function report()
    {
        return $this->belongsTo(DynamicReport::class, 'dynamic_report_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
