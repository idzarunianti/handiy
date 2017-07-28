<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $primaryKey = 'bookmarks_id';

    protected $fillable = ['username', 'tutorials_id'];

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class, 'tutorials_id');
    }
}