<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'phone',
//        'company',
        'holdings',
        'consent',
        'reason_for_attending',
        'attending_masterclass',
        'master_classes',
        'is_zenith_customer','ran'
    ];

    public function qrcode(): HasOne
    {
        return $this->hasOne(QrCode::class);
    }

    public function validateduser()
    {
        return $this->belongsTo(ValidatedUser::class,'ran','ran');
    }
}
