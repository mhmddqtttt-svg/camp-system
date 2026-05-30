<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampTransferRequest extends Model
{
    protected $fillable = [
        'user_id',
        'from_camp_id',
        'to_camp_id',
        'to_delegate_id',
        'reason',
        'status',
    ];

    // العائلة
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // المخيم الحالي
    public function fromCamp()
    {
        return $this->belongsTo(Camp::class, 'from_camp_id');
    }

    // المخيم الجديد
    public function toCamp()
    {
        return $this->belongsTo(Camp::class, 'to_camp_id');
    }

    // المندوب الجديد
    public function delegate()
    {
        return $this->belongsTo(User::class, 'to_delegate_id');
    }
}
