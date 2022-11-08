<?php

namespace App\Domain\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    protected $model = Category::class;
}
