<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $primaryKey = 'bookmarks_id';

    protected $fillable = ['username', 'tutorial_id'];

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }
}