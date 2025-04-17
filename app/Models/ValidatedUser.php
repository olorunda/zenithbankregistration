<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidatedUser extends Model
{
    use HasFactory;

    protected $fillable = ['ran',
                            'chn',
                            'name',
                            'holdings',
                            'address',
                            'phone_num',
                            'emails'];

}
