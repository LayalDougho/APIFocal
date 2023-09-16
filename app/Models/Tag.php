<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table='tags';

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        // return $this->belongsToMany(Post::class);
        return $this->morphedByMany(Post::class, 'taggable');
    }

    
}
