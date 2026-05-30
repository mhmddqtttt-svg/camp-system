<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'family_request_id',
        'delegate_id',
        'report',
        'status',
    ];

    public function family()
    {
        return $this->belongsTo(FamilyRequest::class, 'family_request_id');
    }

    public function delegate()
    {
        return $this->belongsTo(User::class, 'delegate_id');
    }
}
