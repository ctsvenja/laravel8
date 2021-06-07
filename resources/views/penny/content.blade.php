@extends('layouts.template')

@section('css')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
@endsection

@section('main')
<section class="cart mt-5 pt-5 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12 p-0"><img class="w-100" src="{{asset($product->img)}}" alt=""></div>
      <div class="col-lg-6 col-md-12 p-4">
        <h1>{{$product->name}}</h1>
            <div class="pr-3 d-flex">
              <div><i class="fas fa-star" style="color: rgb(255, 204, 0);"></i></div>
              <div><i class="fas fa-star" style="color: rgb(255, 204, 0);"></i></div>
              <div><i class="fas fa-star" style="color: rgb(255, 204, 0);"></i></div>
              <div><i class="fas fa-star" style="color: rgb(255, 204, 0);"></i></div>
              <div><i class="fas fa-star mr-2" style="color: rgb(140, 140, 140);"></i></div>
              <span class="h5"> | 4 Reviews</span>
              <!-- <img src="./img/facebook.png" width="15" height="15" alt=""> 
              <img src="./img/twitter.png" width="15" height="15" alt=""> 
              <img src="./img/speech-bubble.png" width="15" height="15" alt=""> -->
          </div>
          <hr>
        <div class="py-3"> 
        <p>{{$product->info}}</p>
        </div>  
        <div>
          <div class="d-flex">
              <span class="mr-3">Color</span>
              <div class="rounded-circle bg-light mr-1"
                  style="width: 24px; height: 24px; border:2px solid rgb(209,213,219);cursor:pointer;"></div>
              <div class="rounded-circle bg-dark mr-1"
                  style="width: 24px; height: 24px; border:2px solid rgb(209,213,219); cursor:pointer;"></div>
              <div class="rounded-circle mr-4"
                  style="width: 24px; height: 24px; border:2px solid rgb(209,213,219);cursor:pointer; background-color: #6366F1;">
              </div>
              <span class="mr-2">Size</span>
              <select name="" id="" style="width: 79px;">
                  <option value="SM">SM</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
              </select>
              <span class="ml-4 mr-2">Quantity</span>
              <select name="" id="" style="width: 79px;">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
              </select>
          </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
          <h2>NT$ {{$product->price}}</h2>
          <div class="btn">
            <button type="button" class="btn btn-primary">Add to Cart</button>
            <!-- <img src="./img/heart.png" alt="" width="40" height="40"> -->
          </div>
      </div>
      </div>
    </div>
  </div>
</section>
@endsection 

@section('js')
@endsection
