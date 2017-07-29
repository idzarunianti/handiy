<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $fillable = ['title', 'category_id', 'thumbnail'];

    public function steps()
    {
        return $this->hasMany(PhotoTutorial::class);
    }
    
}