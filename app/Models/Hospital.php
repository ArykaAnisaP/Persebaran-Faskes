<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hospital extends Model
{
    protected $table = 'hospital';
    use HasFactory;

    protected $fillable = [
        'namahospital',
        'alamat',
        'latitude',
        'longitude', 
        'jambuka',
        'jamtutup',
        'layanan',   
    ];
}
