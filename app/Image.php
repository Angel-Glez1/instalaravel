<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    // Que tabla va a administar
    protected $table = "images";

    // Relacion uno a mucho (Image - Comentarios)
    public function comments()
    {
        return $this->hasMany('App\Comment', 'image_id')->orderby('id', 'desc');
    }

    // Relacion uno a muchos con los likes
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    // Relacion One to Many Inversa (Images - User)
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
