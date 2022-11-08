<?php

namespace App\Models;

class Product extends BaseModel
{
    protected $table = 'product';

    protected $fillable = [
        'name',
        'image',
        'category_id'
    ];

    protected $with = ['category'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
