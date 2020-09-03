<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'author',
        'link',
        'publication_date',
        'category_id',
        'front_image',
    ];

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
