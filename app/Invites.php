<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invites extends Model
{
    protected $fillable
        = [
            'id',
            'sender_id',
            'receiver_id',
            'status'
        ];
}
