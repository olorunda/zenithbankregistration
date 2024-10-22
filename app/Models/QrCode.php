<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QrCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function registration() : BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function attendance() : BelongsTo
    {
        return $this->belongsTo(Attendance::class, 'registration_id', 'registration_id');
    }
}
