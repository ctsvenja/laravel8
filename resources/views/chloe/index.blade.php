@extends('layouts.template')
@section('css')
<style>
    
</style>
@endsection
    
@section('main')

<main>
    <div class="container d-flex justify-content-center flex-wrap">
        
        @foreach ($products as $product)
            
        <div class="card mx-3 my-2" style="width: 18rem;">
            <img src="{{$product->img}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h4 class="card-title">商品名稱{{$product->name}}</h4>
                <h5 class="card-title">商品類型{{$product->type}}</h5>
                <h5 class="card-title">商品價格{{$product->price}}</h5>

                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
                <a href="/products/content/{{$product->id}}" class="btn btn-primary">More</a>
            </div>
        </div>
        @endforeach
        
        
        
    </div>
</main>
@endsection

@section('js')
    <script>     
    </script>    
@endsection

    
