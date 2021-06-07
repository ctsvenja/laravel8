@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
<style>
    img {
        width: 150px;
    }
</style>
@endsection


@section('main')
<div class="container ">
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary ml-auto" href="/admin/products/create">新增商品</a>
    </div>
    <hr>
    <table id="table_id_example" class="display">

        <thead>
            <tr>
                <th>類型</th>
                <th>名稱</th>
                <th>價格</th>
                <th>簡介</th>
                <th>照片</th>
                <th>操作</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>

                <td>{{$product->productType->name}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->info}}</td>
                <td><img src="{{asset($product->img)}}" alt="" width="200"></td>
                <td>
                    <a class="btn btn-success ml-1" href="/admin/products/edit/{{$product->id}}">編輯</a>
                    <button class="delete btn btn-danger ml-1" data-id={{$product->id}}>刪除</button>
                    {{-- <button class="delete btn btn-danger ml-1" data-id="#delete_{{$product->id}}">刪除</button>
                    <form id="delete_{{$product->id}}" action="/admin/product/delete/{{$product->id}}" method="POST">
                        @csrf
                    </form> --}}


                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('js')
<script>
    window.onload=function (){
 
    var deleteBtns= document.querySelectorAll('.delete')
    deleteBtns.forEach(function (deleteBtn) {
        deleteBtn.addEventListener('click',function () {
            if(confirm('確定要刪除嗎？')){
                var id = this.getAttribute('data-id');
                location.href='/admin/products/delete/'+id;
            }            
        })
    })
}
</script>
<script type="text/javascript" charset="utf8" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.js" defer>
</script>
<script>
    // window.addEventListener('load',function () {
    //     $('#table_id_example').DataTable();;  
    // });

    $(document).ready( function () {
    $('#table_id_example').DataTable();
} );
</script>
@endsection