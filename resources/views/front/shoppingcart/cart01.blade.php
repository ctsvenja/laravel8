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
              <img class="rounded-circle" style="width: 60px; height: 60px;" src="{{$product->attributes->img}}" alt=""/>
              <div class="food-description ml-2 ">
                <p class="m-0">{{$product->name}}</p>
                <p class="m-0 text-muted" >#41551</p>
              </div>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-end ">
                <div class="quantity ml-1">
                    <button type="button" class="minus border-0 rounded">-</button>
                    <input type="" style="width: 30px;" value="{{$product->quantity}}">
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
              <div class="row ">3</div>
              <div class="row">$24.90</div>
              <div class="row ">$24.90</div>
              <div class="row ">$24.90</div>
            </div>
          </div>
        </div>
      </div>
      <hr />
      <div class="action-button d-flex justify-content-between align-items-center">
        <a href="./bootstrap-index.html" class="previous text-body"><i class="fas fa-arrow-left"></i>返回購物</a>
        <a href="./bootstrap-cart02.html"><button class="btn btn-primary ml-auto btn-lg">下一步</button></a>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script>
    var minusBtns = document.querySelectorAll('.minus');
    var plusBtns = document.querySelectorAll('.plus');

    plusBtns.forEach(function (plusBtn){
        plusBtn.addEventListener('click', function () {
        // this.previousElementSibling 
        // 當前元素前面的元素，在此處也就是取得input
        var input = this.previousElementSibling;
        input.value = Number(input.value)+ 1;
        
        // 取得price元素
        var price = this.parentElement.nextElementSibling;
        var newPrice = (price.getAttribute('data-price') * input.value).toLocaleString();
        price.innerText = newPrice;
        });
    });

    minusBtns.forEach(function (minusBtn){
        minusBtn.addEventListener('click', function () {
        // this.nextElementSibling 
        // 取得當前元素後面的元素，在此處也就是取得input
        // console.log(this.nextElementSibling);
        var input = this.nextElementSibling;
        if (input.value !=='1'){
        input.value = input.value *1 - 1;
        }   
        // console.log(input.value);
        
        // 取得price元素
        var price = this.parentElement.nextElementSibling;
        var newPrice = (price.getAttribute('data-price') * input.value).toLocaleString();
        price.innerText = newPrice;
        
                    
        });
    });
</script>
@endsection