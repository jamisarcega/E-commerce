<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function store()
    {
         return $this->belongsTo('App\Store');
    }
    public function image()
    {
         return $this->hasOne('App\Image');
    }
    public function comment()
    {
     return $this->hasMany('App\Comment');
    }
    public function wishlist()
    {
     return $this->hasMany('App\Wishlist');
    }

//     many-to-many
    public function tags()
    {
         return $this->belongsToMany(Tag::class);
    }
}
