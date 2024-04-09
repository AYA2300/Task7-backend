<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image', 'audio','artist_id'];

    public function artist(){
      return  $this->belongsTo(Artist::class); //relacionamento 1:N
    }

    public function profiles(){
        return $this->belongsToMany(Profile::class,'posts_profiles');
    }
}
