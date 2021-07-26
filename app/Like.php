<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    // Relacion One to Many Inversa (Images - User)
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Relacion One to Many Inversa (Images - User)
    public function image()
    {
        return $this->belongsTo('App\Image');
    }
}
