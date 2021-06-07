<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use Illuminate\Http\Request;

class ProductFrontController extends Controller
{
    //
    // public function productIndex($typeId=null)
    // {
    //     if($typeId){
    //         // 如果有type的話，取出對應資料
    //         $products = Product::where('type_id',$typeId)->get();
    //     }else{
    //         // 如果沒有type的話，取出全部資料
    //         $products = Product::get();
    //     }
    //     $productTypes=ProductType::get();
    //     // $products=Product::get();
    //     return view('front.products.index',compact('products','productTypes'));
    // }
    public function productIndex(Request $request)
    {
        if($request->typeId){
            // 如果有type的話，取出對應資料
            $products = Product::where('type_id',$request->typeId)->get();
        }else{
            // 如果沒有type的話，取出全部資料
            $products = Product::get();
        }
        $productTypes=ProductType::get();
        // $products=Product::get();
        return view('front.products.index',compact('products','productTypes'));
    }

    public function productContent($id)
    {
        $product=Product::find($id);
        return view('front.products.content',compact('product'));
    }
}
