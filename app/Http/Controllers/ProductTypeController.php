<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    //
    public function index()
    {
        $producttypes = ProductType::get()->all();
        return view('admin.product_types.index', compact('producttypes'));
    }

    public function create()
    {
        return view('admin.product_types.create');
    }


    public function store(Request $request)
    {
        $requsetData = $request->all();
        // dd($requsetData);
        ProductType::create($requsetData);
        return redirect('/admin/product_types');
    }


    public function edit($id)
    {
        // $producttype = ProductType::find($id);
        $producttype = ProductType::with('products')->find($id);

        return view('admin.product_types.edit', compact('producttype'));
    }


    public function update($id, Request $request)
    {
        $producttype = ProductType::find($id);
        $requestData = $request->all();
        
        $producttype->update($requestData);
        return redirect('/admin/product_types');
    }


    public function delete($id)
    {
        $producttype = ProductType::find($id);
        $producttype->delete();
        return redirect('/admin/product_types');
    }


}
