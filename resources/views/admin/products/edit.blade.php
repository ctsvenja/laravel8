@extends('layouts.app')

@section('css')
    <style>
    .img-area{
        display: flex;
        flex-wrap: wrap;
    }
    .img{
        width: 200px;
        height: 200px;
        background-position: center;
        background-size: cover;
        margin-right: 15px;
        margin-bottom: 15px;
        border: 1px solid black;
        position: relative;
    }
    .del-btn{
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background-color: red;
        color:#FFF;
        line-height: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        right: 0;
        top:0;
        transform: translate(40%,-40%);
        cursor: pointer;
    }    
    </style>    
@endsection

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">最新消息 - 編輯</div>

                <div class="card-body">
                    <form method="POST" action="/admin/products/update/{{$product->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="type_id" class="col-sm-2 col-form-label" >類型</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" class="form-control" id="type" name="type" value="{{$product->type}}" required> --}}
                                <select class="form-control" name="type_id" id="type_id" required>
                                    @foreach ( $productTypes as $productType)
                                        <option value="{{$productType->id}}" @if ($productType->id == $product->type_id) selected
                                            
                                        @endif>{{$productType->name}}</option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">名稱</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">價格</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="info" class="col-sm-2 col-form-label">簡介</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="info" id="info" rows="5" required>{{$product->info}}"</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="img" class="col-sm-2 col-form-label">主要照片</label>
                            <div class="col-sm-10">
                                <img src="{{$product->img}}" width="400" alt="">
                                <input type="file" accept="image/*" class="form-control" id="img" name="img" value="{{$product->img}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imgs" class="col-sm-2 col-form-label">其他照片</label>
                            <div class="col-sm-10">
                                <div class="img-area">
                                @foreach ( $product ->productImgs as $img)
                                    {{-- <img src="{{asset($img ->img)}}" width="200" class="mb-3" alt="">                                 --}}
                                    <div class="img" style="background-image: url('{{asset($img ->img)}}')">
                                    <div class="del-btn" data-id={{$img->id}}>X</div>
                                    </div>
                                @endforeach
                                </div>
                                <input type="file" accept="image/*" class="form-control" id="imgs" name="imgs[]" multiple>
                                
                            </div>
                        </div>


                        
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">修改</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
// window.onload=function (){

        // 選到所有的刪除按鈕
        var btns = document.querySelectorAll('.del-btn');
        // 將所有刪除按鈕綁定監聽事件
        btns.forEach(function (btn) {
            btn.addEventListener('click',function () {
                // 按下按鈕後要發生的事情
                if(confirm('你確定要刪這張圖片嗎?')){
                    // 確定要刪後發生的事情
                    var imgId = this.getAttribute('data-id');
                    
                    // 新東西 fetch POST
                    var formData = new FormData();
                    formData.append('id', imgId);
                    formData.append('_token','{{ csrf_token()}}');
                    var delbtn = this;

                    fetch('/admin/products/delete_img', {
                        method: 'POST',
                        body: formData
                    })
                    .then(function (response) {
                        return response.text();                        
                    })
                    .then(function (result) {
                        if(result == 'success'){
                            delbtn.parentElement.remove();
                        }
                    })
                }        
            })
        })
    // }

    </script>
@endsection