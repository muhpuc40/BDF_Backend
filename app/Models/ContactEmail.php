<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEmail extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'ip_address',
        'status',
        'reply_message',
        'replied_at'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];
}