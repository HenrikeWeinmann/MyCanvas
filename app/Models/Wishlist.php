<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    use HasFactory;
    public function user()
        {
            return $this->belongsTo('App\User');
        }

}
