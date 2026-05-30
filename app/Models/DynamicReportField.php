<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicReportField extends Model
{
    protected $fillable = [
    'dynamic_report_id',
    'label',
    'type',
    'min_age',
    'max_age',
];

    public function report()
    {
        return $this->belongsTo(DynamicReport::class, 'dynamic_report_id');
    }
}