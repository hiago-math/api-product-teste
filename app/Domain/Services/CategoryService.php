<?php

namespace App\Domain\Services;

use App\Domain\Repositories\CategoryRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->all()->toArray();
    }

    public function getById(int $id)
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            throw new \Exception('Produto não encontrado', 404);
        }

        return $category->toArray();
    }
}
