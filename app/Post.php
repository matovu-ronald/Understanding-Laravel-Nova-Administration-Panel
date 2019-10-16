<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $casts = [
        'publish_at' => 'datetime',
        'publish_until' => 'datetime',
    ];

    public function category ()
    {
        return $this->belongsTo('App\Category');
    }

    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}
