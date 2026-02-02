<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'type',
        'category',
        'participants',
        'registration_deadline',
        'status',
        'image'
    ];

    protected $casts = [
        'date' => 'date',
        'registration_deadline' => 'date',
    ];
}