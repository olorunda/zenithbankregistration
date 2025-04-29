<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = [
        'date_admitted',
        'date_admitted_master_class'
    ];
    public function setdateAdmittedMasterClassAttributes()
    {
        if (is_null($this->date_admitted_master_class)) {
            return 'N/A';
        }
        return $this->date_admitted_master_class;
    }

    public function registration(){
        return $this->belongsTo(Registration::class,'registration_id')->withDefault([]);
    }


}
