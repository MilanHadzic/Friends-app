<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable
        = [
            'id',
            'sender_id',
            'receiver_id',
            'status'
        ];

    public function user()
    {
        return $this->belongsTo('App\User', 'sender_id', 'id');
    }
}
