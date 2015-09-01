<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'title',
        'url',
        'icon',
        'color'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
