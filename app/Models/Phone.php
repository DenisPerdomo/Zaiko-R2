<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'extension',
        'serial_number',
        'imei',

    ];


    public function device()
    {
        return $this->belongsTo(Device::class,'id');
    }


}
