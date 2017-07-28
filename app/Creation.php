<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Creation extends Model
{
    protected $primaryKey = 'creation_id';

    protected $fillable = ['username', 'kreasi', 'tutorial_id','photo'];

    public function tutorial(){
        return $this->belongsTo(Tutorial::class);
    }
}