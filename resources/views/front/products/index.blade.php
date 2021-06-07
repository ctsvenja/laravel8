@extends('layouts.template')

@section('css')
<style>
  .none{
    display:none;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.16.6/sweetalert2.min.css" integrity="sha512-/D4S05MnQx/q7V0+15CCVZIeJcV+Z+ejL1ZgkAcXE1KZxTE4cYDvu+Fz+cQO9GopKrDzMNNgGK+dbuqza54jgw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection 

@section('main')
<div class="album py-5 bg-light">
    <div class="container">
<!-- product --> 
<a href="/products" class="btn btn-secondary mb-3 type_btn" data-type="all">全部</a>
@foreach ($productTypes as $productType)
{{-- <a href="/products/{{$productType->id}}"class="btn btn-secondary mb-3 type_btn" ">{{$productType->name}}</a> --}}
<a href="/products?typeId={{$productType->id}}" class="btn btn-secondary mb-3 type_btn" ">{{$productType->name}}</a>
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
            <button type="button" class="btn btn-sm btn-outline-success mb-1 add-btn" data-id="{{$product->id}}" style="width: 49.14px;" >Buy</button>
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
{{-- <script>
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
</script> --}}
<script>
  var addBtns = document.querySelectorAll('.add-btn');

  addBtns.forEach(function (addBtn) {
    addBtn.addEventListener('click',function () {
      var productId = this.getAttribute('data-id');
      // console.log(productId);
      var formData = new FormData();
      formData.append('_token','{{ csrf_token() }}');
      formData.append('productId',productId);

      fetch('/shopping_cart/add',{
        'method':'POST',
        'body':formData
      })
      .then(function(response){
        return response.text();
      })
      .then(function (data) {
        console.log(data);
        if(data=='success'){
          Swal.fire({
            icon: 'success',
            title: '成功加入購物車',
            showConfirmButton:false,
            timer:1500
          })
        }
      })
     
    });
  }); 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.16.6/sweetalert2.min.js" integrity="sha512-CrNI25BFwyQ47q3MiZbfATg0ZoG6zuNh2ANn/WjyqvN4ShWfwPeoCOi9pjmX4DoNioMQ5gPcphKKF+oVz3UjRw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection