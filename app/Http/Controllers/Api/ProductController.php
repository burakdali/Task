<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function addProduct(Request $req)
    {
        $req->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image'],
        ]);
        $image = $req->file('image')->save('public/products');
        $product = Product::create([
            'name' => $req->input('name'),
            'description' => $req->input('description'),
            'image' => $image,
        ]);
        return response()->json($product);
    }
    public function updateProduct(Request $req)
    {
        $req->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image'],
        ]);
        $product = Product::find($req->input('id'));
        $image = $product->image;
        if ($req->hasFile('image')) {
            Storage::delete($product->image);
            $image = $req->file('image')->store('public/categories');
        }
        $product->update([
            'name' => $req->input('name'),
            'description' => $req->input('description'),
            'image' => $image,
        ]);
        return response()->json($product);
    }
    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }
    public function deleteProduct(Request $req)
    {
        $assigned = DB::table('user_product')->where('product_id', $req->input('id'))->get();

        if ($assigned->isEmpty()) {
            $product = Product::find($req->input('id'));
            $product->delete();
            return response()->json("Product deleted succesfully");
        } else {
            return response()->json("this product is assigned to user and we cant delete it for you");
        }
    }
}
