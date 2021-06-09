<?php

namespace App\Http\Controllers;


use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function add(Request $request)
    {   
        // dd($request->all());     
        $product= Product::find($request->productId);
        // 新增一筆產品至購物車
        // 有時需判斷有無商品 避免惡意竄改
        if($product){
            \Cart::add(array(
                'id' => $product->id, // 商品ID必須唯一
                'name' => $product->name, // 商品名稱
                'price' => $product->price, //商品價格
                'quantity' => 1, //商品數量
                'attributes' => array(
                    'img'=>$product->img
                ) // 自定義參數
            ));
            return 'success';
        }else{
            return 'fail';
        }
    }
    public function list()
    {
        // 查看購物車現有內容
        $cartCollection = \Cart::getContent();
        // dd($cartCollection);
        return view('front.shoppingcart.cart01',compact('cartCollection'));
    }
}
