<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'Start-time',
        'End-time',
        'Screen',
        'poster',
    ];


    public $timestamps = false;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    public function reservations(){
        return $this->hasMany(Reservation::class);

    }
}

