<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $table = 'checkout';
    public function user()
        {
            return $this->belongsTo('App\Modles\User');
        }
}
