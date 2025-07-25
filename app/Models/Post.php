<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable=[
        'title',
        'content',
        'image_path',
        'is_published',
        'category_id'
    ];

    //relacion uno a muchos inversa
    public function category(){
        return $this->belongsTo(Category::class);

    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
