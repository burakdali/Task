<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductsController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }
    public function getProducts(Request $req)
    {
        if ($req->ajax()) {
            $data = Product::select('id', 'name', 'description', 'created_at')->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($data) {
                $actionBtn = '<button type="button" class="edit btn btn-success btn-sm" id="' . $data->id . '">Edit</button> <button type="button" class="delete btn btn-danger btn-sm" id="' . $data->id . '">Delete</button>';
                return $actionBtn;
            })->rawColumns(['action'])->make(true);
        }
    }
    public function addProduct()
    {
        return view('admin.products.add');
    }
    public function saveProduct(Request $req)
    {
        $req->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image'],
        ]);
        $image = $req->file('image')->store('public/products');
        Product::create([
            'name' => $req->name,
            'description' => $req->description,
            'image' => $image,
        ]);
        return redirect()->back();
    }
    public function deleteProduct($id)
    {
        if (request()->ajax()) {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['result' => 'Deleted succesfully']);
        }
    }
    public function editProduct($id)
    {
        if (request()->ajax()) {
            $data = Product::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
}
