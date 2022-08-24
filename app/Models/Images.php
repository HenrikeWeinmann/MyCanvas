<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    public function user()
        {
            return $this->belongsTo('App\User');
        }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     protected $fillable = [
        'title',
        'artist',
        'description',
        'image_path',
        'price',
        'sold',
    ];


}
