<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderByDesc('created_at')->get();

        return response()->json(
            ['products' => $products], 200
        );
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
                'qty' => 'required|numeric'
            ],
        );

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->save();

        return response()->json(
            [
                'message' => 'Product added successfully',
                'product' => $product
            ], 201
        );
    }

    public function show($id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()->json(
                ['message' => 'Product not found'], 200
            );
        }

        return response()->json(
            ['product' => $product], 200
        );
        
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()->json(
                ['message' => 'Product not found'], 200
            );
        }

        $product->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product,
        ], 200);
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()->json(
                ['message' => 'Product not found'], 200
            );
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
