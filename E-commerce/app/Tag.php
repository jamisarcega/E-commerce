<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    

    public function product()
    {
         return $this->belongsToMany(Product::class);
    }
}
