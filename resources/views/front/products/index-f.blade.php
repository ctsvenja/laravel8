@extends('layouts.template')

@section('css')
<style>
  .none{
    display:none;
  }
</style>
@endsection 

@section('main')
<div class="album py-5 bg-light">
    <div class="container">
<!-- product --> 
<button class="btn btn-secondary mb-3 type_btn" data-type="all">全部</button>
@foreach ($productTypes as $productType)
<button class="btn btn-secondary mb-3 type_btn" data-type="{{$productType->id}}">{{$productType->name}}</button>
@endforeach
<div class="row">

@foreach ($products as $product)
  <div class="col-md-4" data-type="{{$product->type_id}}">
    <div class="card mb-4 shadow-sm">
      <img src="{{asset($product->img)}}" alt="" width="100%" >
      <div class="card-body">
        <h3>{{$product->name}}</h3>
        <p class="card-text">{{$product->info}}</p>
        <div class="d-flex justify-content-between align-items-center">
          <div class="button-group">
            <a href="/products/content/{{$product->id}}"  class="btn btn-sm btn-outline-secondary mr-2 mb-1">View</a>
            {{-- <button type="button" class="btn btn-sm btn-outline-secondary mr-2 mb-1">View</button> --}}
            <button type="button" class="btn btn-sm btn-outline-success mb-1" style="width: 49.14px;" >Buy</button>
          </div>
          <div class="font-weight-bold" style="font-size: 1.5em;">NT${{$product->price}}</div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
<!-- end of product -->
@endsection

@section('js')
<script>
  // 取得所有類別按鈕
  var typeBtns = document.querySelectorAll('.type_btn');
  // 幫每顆按鈕綁定監聽事件
  typeBtns.forEach(function (btn) {
    btn.addEventListener('click',function () {
      var typeId = this.getAttribute('data-type');
      if(typeId!='all'){
      // 如果不是選到all的話
      // 幫所有人加上隱藏
      document.querySelectorAll('.col-md-4').forEach(function (product) {
        product.classList.add('none');
      });
      // 把符合條件的取消隱藏
      var targetProducts = document.querySelectorAll('.col-md-4[data-type="'+typeId+'"]');
      targetProducts.forEach(function (product) {
        product.classList.remove('none');
      });
      }else{
      // 如果是all的話，全部人取消隱藏
      document.querySelectorAll('.col-md-4').forEach(function (product) {
        product.classList.remove('none');
      });
      }
    });
    
  })
</script>
@endsection