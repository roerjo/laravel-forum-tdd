<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
