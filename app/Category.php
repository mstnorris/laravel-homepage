<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'color'
    ];

    public function sites() {
        return $this->hasMany(Site::class);
    }
}
