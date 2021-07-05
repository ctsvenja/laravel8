<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\ToolBoxController;

class CartCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Cart::isEmpty()){
            return redirect('/products')
        ->with(ToolBoxController::swal('warning','結帳失敗','請選擇商品後結帳'));
        }else{
            return $next($request);
        }
    }
}
