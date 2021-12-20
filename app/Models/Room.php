<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'number-of-seats'
    ];

    public $timestamps = false;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    public function seats(){
        return $this->hasMany(Seat::class);

    }

    public function reservations(){
        return $this->hasMany(Reservation::class);

    }
}
