<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'url',
        'background_image'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
