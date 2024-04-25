<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\CreateProductRequest;
use App\Services\ProductService;
use HttpResponseException;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class ProductController extends Controller
{
    private $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    public function store(CreateProductRequest $request){
        try {
            $validated = $request->validated();
            $image = $request->file('image');
            $product = $this->productService->createProduct($request->all(), $image);
            return response()->json([$product], 201);
        }catch (\Exception $e) {
            return response()->json([$e->getMessage()]);
        }
    }
    public function listAll(Request $request){
        try {
            $products = $this->productService->listProducts($request->all());
            return response()->json([$products]);
        }catch (\Exception $e) {
            return response()->json([$e->getMessage()]);
        }
    }
    public function show($id){
        try {
            return $this->productService->findById($id);
        }catch (\Exception $e) {
            return response()->json([$e->getMessage()]);
        }
    }

    public function delete($id){
        try {
            return $this->productService->deleteProduct($id);
        }catch (\Exception $e) {
            return response()->json([$e->getMessage()]);
        }
    }
    public function update(CreateProductRequest $request, $id){
        try {
            return $this->productService->updateProduct($request->all(), $id);
        }catch (\Exception $e) {
            return response()->json([$e->getMessage()]);
        }
    }
}
