@extends('layouts.template')

@section('css')
<style>
    * {
        box-sizing: border-box;
    }

    main {
        padding: 0;
        width: 100%;    
        height: 100vh;    
        display: flex;
        justify-content: center;
    }

    section {
        width: 80%;
    }

    .content-top .content-items {
        display: flex;
    }

    .content-top .content-items .content-item {
        margin-right: 10px;
    }

    .number {
        color: #DB3B00;
    }
    img {
        width: 500px;
    }
</style>
@endsection
@section('main')

<main>
    <div class="container ">
        <div class="product">
            <div class="product-top d-flex">
                <img src="{{$product->img}}" class="" alt="...">
                <div class="product-detail ml-3">
                    <h4 class="card-title">商品名稱 {{$product->name}}</h4>
                    <h5 class="card-title">商品類型 {{$product->type}}</h5>
                    <h5 class="card-title">商品價格 {{$product->price}}</h5>
                </div>
            </div>
            <hr>
            <div class="div">商品簡介</div>
            <p>{{$product->content}}</p>
        </div>
    </div>

</main>
@endsection    
@section('js')
    
@endsection
    
