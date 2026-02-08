<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_name',
        'university',
        'president',
        'general_secretary',
        'contact',
        'email',
        'location',
        'established',
        'members',
        'status',
        'facebook_url'
    ];

    protected $casts = [
        'members' => 'string',
    ];
}