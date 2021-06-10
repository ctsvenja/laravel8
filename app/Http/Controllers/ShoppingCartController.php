<?php

namespace App\Http\Controllers;


use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{
    public function add(Request $request)
    {
        // dd($request->all());     
        $product = Product::find($request->productId);
        // 新增一筆產品至購物車
        // 有時需判斷有無商品 避免惡意竄改
        if ($product) {
            \Cart::add(array(
                'id' => $product->id, // 商品ID必須唯一
                'name' => $product->name, // 商品名稱
                'price' => $product->price, //商品價格
                'quantity' => 1, //商品數量
                'attributes' => array(
                    'img' => $product->img
                ) // 自定義參數
            ));
            return 'success';
        } else {
            return 'fail';
        }
    }
    public function update(Request $request)
    {
        $qty = intval($request->qty) < 1 ? 1 :$request->qty;
        if($request->productId){
            \Cart::update($request->productId, array(
                'quantity' =>array(
                'relative' => false,
                'value' => $qty, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
                ),  
            ));

              $product = \Cart::get($request->productId);
                            
            return $product->quantity;
        }else{
            return 'fail';
        }
    }

    public function list()
    {
        // 查看購物車現有內容
        $cartCollection = \Cart::getContent()->sortBy('id');
        // dd($cartCollection);
        return view('front.shoppingcart.cart01', compact('cartCollection'));
    }

    public function payment(Request $request)
    {
        // 購物車空車的時候
        if(\Cart::isEmpty()){
            return redirect('/products')
            ->with(ToolBoxController::swal('warning','結帳失敗','請選擇商品後結帳'));          
            
        }else{
            // 購物車有內容物的時候
            return view ('front.shoppingcart.cart02');
        }
    }

    public function paymentCheck(Request $request)
    {
        Session::put('payment',$request->payment);
        Session::put('shipment',$request->shipment);
        return view('front.shoppingcart.cart03');
    }

    public function delete(Request $request)
    {
        if ($request->productId) {
            \Cart::remove($request->productId);
            return 'success';
        } else {
            return 'fail';
        }
    }
}
