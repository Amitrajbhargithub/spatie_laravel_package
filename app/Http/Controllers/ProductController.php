<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:can-show-product|can-edit-product|can-delete-product', ['only' => ['index','show']]);
        $this->middleware('permission:can-show-product', ['only' => ['create','store']]);
        $this->middleware('permission:can-edit-product', ['only' => ['edit','update']]);
        $this->middleware('permission:can-delete-product', ['only' => ['destroy']]);
    }

    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',compact('products'));
    }
    

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        Product::create($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
    
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
    
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    public function update(Request $request, Product $product)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
