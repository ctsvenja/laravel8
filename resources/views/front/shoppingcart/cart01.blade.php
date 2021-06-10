@extends('layouts.template')

@section('css')
<style>
    .cart-block{
    width: 100%;
    background-color: #D1D5DB;
    margin: 0 auto;
    padding: 3% 0;
    display: flex;
    justify-content: center;
}

.cart-detail{ 
    border-radius: 10px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 1px 5px;
    min-width:320px;
    max-width:950px;
    width:70%;
    height:95%;
    background-color: #F3F4F6;
}

.number{
    width: 40px;
    height: 40px;
    background-color: 	rgb(16,185,129);
    border-radius: 50%;
    color: #FFF;
    text-align: center;
    line-height: 40px;
}</style>    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.6/sweetalert2.css" integrity="sha512-RS1E7VTq+q/sM0LogtWnvuXvfhs3JwPVJr4P9GAV3bGoIaaVhJNhSC8BVbPac1aXrzD3njrBpq7PbENlzmT8RQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('main')
<div class="cart-block">
    <div class="cart-detail p-5">
      <div class="shopping-progress ">
        <h4 class="font-weight-bold">購物車</h4>
        <div class="pt-3">
          <div class="d-flex justify-content-around position-relative align-items-center">
            <!-- step 1  -->
            <div class="rounded-circle text-center text-white"
                  style="width: 40px; height: 40px; line-height: 40px; background-color: #10B981;">1
            </div>
            <div class="progress position-absolute"
                style="width: 17%;max-width: 180px; height: 8px;transform: translateX(-148%);">
                <div class="progress-bar" role="progressbar" style="width: 50%;background-color: #6EE7B7;"
                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <!-- step 2  -->
            <div class="rounded-circle text-center"
                style="width: 40px; height: 40px; line-height: 40px; background-color: #ffffff;">2
            </div>
            <div class="progress position-absolute" style="width: 17%;max-width: 180px; height: 8px;">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <!-- step 3  -->
            <div class="rounded-circle text-center"
                style="width: 40px; height: 40px; line-height: 40px; background-color: #ffffff;">3
            </div>
            <div class="progress position-absolute"
                style="width: 17%;max-width: 180px; height: 8px; transform: translateX(148%);">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <!-- step 4  -->
            <div class="rounded-circle text-center"
                style="width: 40px; height: 40px; line-height: 40px; background-color: #ffffff;">4
            </div>
          </div>
          <div id="process-text" class="d-flex justify-content-around px-2">
              <div class="pt-2">確認購物車</div>
              <div class="pt-2 pr-3">付款與運送方式</div>
              <div class="pt-2 mr-4">填寫資料</div>
              <div class="pt-2 pr-2">完成訂購</div>
          </div>
        </div>
      <hr />
      <div class="order-detail">
        <h4>訂單明細</h4>
        <div class="container">
          @foreach ( $cartCollection as $product )
          <div class="row">
            <div class="col-12 col-md-6 d-flex align-items-center">
                {{-- @php
                    $img = $product->attributes->img;
                @endphp --}}
                <button type="button" class="del-btn" data-id="{{$product->id}}"> X </button>
              <img class="rounded-circle" style="width: 60px; height: 60px;" src="{{$product->attributes->img}}" alt=""/>
              <div class="food-description ml-2 ">
                <p class="m-0">{{$product->name}}</p>
                <p class="m-0 text-muted" >#41551</p>
              </div>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-end ">
                <div class="quantity ml-1">
                    <button type="button" class="minus border-0 rounded">-</button>
                    <input class="qty" type="" style="width: 30px;" data-id="{{$product->id}}" value="{{$product->quantity}}" >
                    <button type="button" class="plus border-0 rounded">+</button>
                </div>
                <div class="price ml-1" data-price="{{$product->price}}">{{number_format($product->quantity*$product->price)}}</div>    
            </div>
          </div>
          <hr />
          @endforeach
          
          
      <div class="total-detail">
        <div class="container ">
          <div class="row  ">
            <div class="col-9 d-flex flex-column align-items-end">
              <div class="row text-muted">數量：</div>
              <div class="row text-muted">小計：</div>
              <div class="row text-muted">運費：</div>
              <div class="row text-muted">總計：</div>
            </div>
            <div class="col-3 d-flex flex-column align-items-end">
              <div class="row" id="total-qty"></div>
              <div class="row" id="sub-price"></div>
              <div class="row" id="shipping-fee"></div>
              <div class="row" id="total-price"></div>
            </div>
          </div>
        </div>
      </div>
      <hr />
      <div class="action-button d-flex justify-content-between align-items-center">
        <a href="/products" class="previous text-body"><i class="fas fa-arrow-left"></i>返回購物</a>
        <a href="/shopping_cart/payment" class="btn btn-primary ml-auto btn-lg">下一步</a>
      </div>
    </div>
</div>
@endsection

@section('js')
<script>
    window.addEventListener('load',shoppingCartCalc());
    var minusBtns = document.querySelectorAll('.minus');
    var plusBtns = document.querySelectorAll('.plus');
    var qtyInputs = document.querySelectorAll('.qty');
    var delBtns = document.querySelectorAll('.del-btn');
    function calcProductPrice(Element) {
        // 觸發事件元素的父層
        var controlArea = Element.parentElement;
        var input = controlArea.querySelector('.qty');
        var price = controlArea.nextElementSibling;
        var newPrice = (price.getAttribute('data-price') * input.value).toLocaleString();
        price.innerText = newPrice;
        shoppingCartCalc();
    }

    function shoppingCartCalc() {
        var totalQty = 0;
        var subPrice = 0;
        var shippingFee = 60;
        var totalPrice = 0;

        var qtyInputs = document.querySelectorAll('.qty');
        qtyInputs.forEach(function (qtyInput) {
            totalQty += Number(qtyInput.value);

            var price = qtyInput.parentElement.nextElementSibling.getAttribute('data-price');
            subPrice += price*( qtyInput.value );
        });
        document.querySelector('#total-qty').innerText = totalQty.toLocaleString();
        document.querySelector('#sub-price').innerText = subPrice.toLocaleString();
        if(subPrice >= 1000){
            shippingFee = 0;
        }
        document.querySelector('#shipping-fee').innerText = shippingFee.toLocaleString();

        totalPrice = subPrice + shippingFee;
        document.querySelector('#total-price').innerText = totalPrice.toLocaleString();
    }

    function shoppingCartUpdate(element,input,qty) {
        var productId = input.getAttribute('data-id');
        // console.log(productId);     
        var formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('productId',productId);
        formData.append('qty',qty);

        fetch('/shopping_cart/update',{
            'method':'POST',
            'body':formData
        }).then(function (response) {
            return response.text();
        }).then(function (data) {
            input.value = data;
            calcProductPrice(element);
            shoppingCartCalc();            
        }) 
    }
    
    plusBtns.forEach(function (plusBtn){
        plusBtn.addEventListener('click', function () {
        // this.previousElementSibling 
        // 當前元素前面的元素，在此處也就是取得input
        var input = this.previousElementSibling;  
        var qty = Number(input.value) + 1 ;        
        shoppingCartUpdate(this,input,qty);
        });
    });

    minusBtns.forEach(function (minusBtn){
        minusBtn.addEventListener('click', function () {
        // this.nextElementSibling 
        // 取得當前元素後面的元素，在此處也就是取得input
        // console.log(this.nextElementSibling);
        var input = this.nextElementSibling;
        var inputValue = Number(input.value);
        if (inputValue > 1 ){
        var qty = Number(input.value) - 1 ;
        }
        shoppingCartUpdate(this,input,qty);
        });     
    });

    qtyInputs.forEach(function name(qtyInput) {
        qtyInput.addEventListener('change',function () {
            var input = this;
            // if(Number(input.value) < 1 ){
            //     qty = 1;
            // }else{
            //     qty = Number(input.value);
            // }
            
            var qty = Number(input.value);
            if(qty < 1 ){
                qty = 1;
            }

            shoppingCartUpdate(this,input,qty);           
        })
    })

    delBtns.forEach(function (delBtn) {
        delBtn.addEventListener('click',function () {
            var formData = new FormData();
            formData.append('_token','{{ csrf_token() }}');
            formData.append('productId',this.getAttribute('data-id'));

            delBtnElement = this;
            fetch('/shopping_cart/delete',{
                'method':'POST',
                'body':formData
            }).then(function (response){
                return response.text();
            }).then(function (data) {
                if(data == 'success'){
                    var productArea = delBtnElement.parentElement.parentElement;
                    productArea.nextElementSibling.remove();
                    productArea.remove();
                    shoppingCartCalc();
                    Swal.fire({
                        icon: 'success',
                        title: '移除成功',
                        showConfirmButton: false,
                        time:700
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '移除失敗',
                        showConfirmButton: false,
                        time:700
                    })
                }
                
            })

            
        })


    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.6/sweetalert2.min.js" integrity="sha512-WrWL0HFmRt8gy0zGIFB5pZg+lI/Bdp4iXqXCJEItYqeuICmOlPOyhn2hG3X+/o19B7HIlwKeKRXTjkuHzkhlqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection