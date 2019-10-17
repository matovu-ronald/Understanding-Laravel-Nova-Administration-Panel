<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable, Actionable;

    protected $casts = [
        'publish_at' => 'datetime',
        'publish_until' => 'datetime',
    ];

    protected $fillable = ['is_published'];

    public function category ()
    {
        return $this->belongsTo('App\Category');
    }

    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function tags ()
    {
        return $this->belongsToMany('App\Tag');
    }
}
