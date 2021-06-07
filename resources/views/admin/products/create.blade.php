@extends('layouts.app')

@section('css')
    
@endsection

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">商品 - 新增</div>

                <div class="card-body">
                    <form method="POST" action="/admin/products/store" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="type_id" class="col-sm-2 col-form-label">類型</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" class="form-control" id="type" name="type" required> --}}
                                <select class="form-control" name="type_id" id="type_id" required>
                                    @foreach ( $productTypes as $productType)
                                        <option value="{{$productType->id}}">{{$productType->name}}</option>   
                                    @endforeach
                                </select>
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">名稱</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">價格</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" name="price" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="info" class="col-sm-2 col-form-label">簡介</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="info" id="info" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="img" class="col-sm-2 col-form-label">主要照片</label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="img" name="img" required>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imgs" class="col-sm-2 col-form-label">其他照片</label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="imgs" name="imgs[]" multiple required>
                                
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">新增</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    
@endsection