<?php

namespace App\Http\Controllers;

use App\Domain\Services\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseHttp;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAll()
    {
        try {
            $response = $this->productService->getAll();
        } catch (\Exception $exception) {
            return $this->returnResponse([], $exception->getMessage(), $exception->getCode());
        }

        return $this->returnResponse($response, 'Produtos retornados!', ResponseHttp::HTTP_OK);
    }

    public function getById(int $id)
    {
        try {
            $response = $this->productService->getById($id);
        } catch (\Exception $exception) {
            return $this->returnResponse([], $exception->getMessage(), $exception->getCode());
        }

        return $this->returnResponse($response, 'Produtos retornados!', ResponseHttp::HTTP_OK);
    }

    public function update(int $id, Request $request)
    {
        try {
            $response = $this->productService->update($request->all(), $id, $request->image);
        } catch (\Exception $exception) {
            return $this->returnResponse([], $exception->getMessage(), $exception->getCode());
        }

        return $this->returnResponse($response, 'Produto atualizado com sucesso!', ResponseHttp::HTTP_OK);
    }

    public function store(Request $request)
    {
        try {
            $response = $this->productService->store($request->all(), $request->image);
        } catch (\Exception $exception) {
            return $this->returnResponse([], $exception->getMessage(), $exception->getCode());
        }

        return $this->returnResponse($response, 'Produto cadastrado com sucesso!', ResponseHttp::HTTP_OK);
    }

    public function delete(int $id)
    {
        try {
            $this->productService->delete($id);
        } catch (\Exception $exception) {
            return $this->returnResponse([], $exception->getMessage(), $exception->getCode());
        }

        return $this->returnResponse([], 'Produto deletado com sucesso!', ResponseHttp::HTTP_OK);
    }
}
