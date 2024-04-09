<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Profile extends Model
{
    use HasFactory;
    protected  $fillable = ['name', 'age', 'gender'];


        /**
         * The roles that belong to the Profile
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function songs(){
        {
            return $this->belongsToMany(Song::class,'posts_profiles');
        }
    }
}


