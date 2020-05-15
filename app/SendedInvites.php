<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendedInvites extends Model
{
    protected $fillable
        = [
            'id',
            'sender_id',
            'receiver_id',
            'status'
        ];
}
