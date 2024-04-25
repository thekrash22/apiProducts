<?php

namespace App\Services;

use App\Repository\ProductRepository;
use Illuminate\Contracts\Auth\Guard;
use Ramsey\Uuid\Uuid;
class ProductService{
    private ProductRepository $productRepository;
    protected $auth;
    private $imageUploadService;
    public function __construct(ProductRepository $productRepository, Guard $auth, ImageUploadService $imageUploadService){
        $this->productRepository = $productRepository;
        $this->auth = $auth;
        $this->imageUploadService = $imageUploadService;

    }

    public function createProduct(array $data, $image){
        if ($image) {
            $imagePath = $this->imageUploadService->uploadImage($image);
            $data['image'] = $imagePath;
        }
        $data['uuid'] = Uuid::uuid4()->toString();
        $data['user_id'] = $this->auth->id();

        return $this->productRepository->create($data);
    }

    public function listProducts($request){
        if (!isset($request['is_active'])){
            $request['is_active'] = 1;
        }
        elseif ($request['is_active'] == 2) {
            unset($request['is_active']);
        }

        return $this->productRepository->listAll($request);
    }

    public function findById($id){
        return $this->productRepository->find($id);
    }

    public function updateProduct($id, array $data){
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id){
        return $this->productRepository->delete($id);
    }

}
