<?php

namespace App\Domain\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    protected $model = Product::class;
}
