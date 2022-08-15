<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index() {
        // $products = Product::all();
        $products = ProductResource::collection(Product::all());
        return response()->json($products);
    }

    public function show($id) {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function store(StoreProductRequest $request) {
        $data = $request->validated();
        $product = Product::create($data);

        return response()->json($product);
    }

    public function update(StoreProductRequest $request, $id) {
        $product = Product::find($id);
        $product->update($request->validated());

        return response()->json($product);
    }

    public function destroy($id) {
        $product = Product::find($id);
        $product->delete();

        return response()->json($product);
    }
}
