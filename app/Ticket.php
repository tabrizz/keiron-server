<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = [
        'description', 
        'user_id', 
        'taken'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
