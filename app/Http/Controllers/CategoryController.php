<?php

namespace App\Http\Controllers;

use App\Domain\Services\CategoryService;
use Illuminate\Http\Response as ResponseHttp;


class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getAll()
    {
        try {
            $response = $this->categoryService->getAll();
        } catch (\Exception $exception) {
            return $this->returnResponse([], $exception->getMessage(), $exception->getCode());
        }

        return $this->returnResponse($response, 'Categorias retornadas!', ResponseHttp::HTTP_OK);
    }

    public function getById(int $id)
    {
        try {
            $response = $this->categoryService->getById($id);
        } catch (\Exception $exception) {
            return $this->returnResponse([], $exception->getMessage(), $exception->getCode());
        }

        return $this->returnResponse($response, 'Categoria retornada!', ResponseHttp::HTTP_OK);
    }
}
