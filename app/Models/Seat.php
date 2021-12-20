<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'column-number',
        'row-number',
        'availability',
        'room-id',
    ];

    public $timestamps = false;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);

    }
}
