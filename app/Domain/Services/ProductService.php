<?php

namespace App\Domain\Services;


use App\Domain\Repositories\CategoryRepository;
use App\Domain\Repositories\ProductRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function store(array $payload, UploadedFile $file): array
    {
        $category = $this->categoryRepository->find($payload['category_id']);

        if (!$category) {
            throw new \Exception('Categoria não encontrada', 404);
        }

        foreach ($payload as $key => $value) {
            $payload[$key] = is_string($value) ? Str::upper($value) : $value;
        }

        $nameFile = $this->saveFile($file);

        $payload['image'] = Storage::url($nameFile);

        return $this->productRepository->updateOrCreate($payload)->toArray();
    }

    public function delete(int $id): bool
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            throw new \Exception('Produto não encontrado', 404);
        }

        return $this->productRepository->delete($product);
    }

    public function update(array $payload , int $id): array
    {
        $category = $this->categoryRepository->find($payload['category_id']);

        if (!$category) {
            throw new \Exception('Categoria não encontrada', 404);
        }

        $product = $this->productRepository->find($id);

        if (!$product) {
            throw new \Exception('Produto não encontrado', 404);
        }

        foreach ($payload as $key => $value) {
            $payload[$key] = is_string($value) ? Str::upper($value) : $value;
        }

        $payload['id'] = $id;

        return $this->productRepository->update($product, $payload)->toArray();
    }

    public function getAll()
    {
        $product = $this->productRepository->all();

        if (!$product) {
            throw new \Exception('Nenhum produto encontrado', 404);
        }

        return $product->toArray();
    }

    public function getById(int $id)
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            throw new \Exception('Produto não encontrado', 404);
        }

        return $product->toArray();
    }

    private function saveFile(UploadedFile $file): string
    {
        $name = uniqid(date('HisYmd'));
        $extension = $file->extension();
        $nameFile = "{$name}.{$extension}";

        return $file->storeAs('products', $nameFile);;
    }
}
