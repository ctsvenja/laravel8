@extends('layouts.template')

@section('css')
@endsection 

@section('main')
<div class="album py-5 bg-light">
    <div class="container">
<!-- product --> 
<div class="row">
@foreach ($products as $product)
  <div class="col-md-4">
    <div class="card mb-4 shadow-sm">
      <img src="{{asset($product->img)}}" alt="" width="100%" >
      <div class="card-body">
        <h3>{{$product->name}}</h3>
        <p class="card-text">{{$product->info}}</p>
        <div class="d-flex justify-content-between align-items-center">
          <div class="button-group">
            <a href="/product/content/{{$product->id}}"  class="btn btn-sm btn-outline-secondary mr-2 mb-1">View</a>
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
@endsection