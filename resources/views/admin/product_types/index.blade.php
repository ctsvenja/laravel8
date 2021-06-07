@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
<style>
img{
    width:150px;
}

</style>    
@endsection


@section('main')
<div class="container ">
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary ml-auto" href="/admin/product_types/create">新增類型</a>
    </div>
        <hr>
    <table id="table_id_example" class="display">

    <thead>
        <tr>
            <th>類型</th>
            <th style="width:200px">操作</th>          


        </tr>
    </thead>
    <tbody>
        @foreach ($producttypes as $producttype)   
        <tr>
            <td>{{$producttype->name}}</td>
            <td>
                <a class="btn btn-success ml-1" href="/admin/product_types/edit/{{$producttype->id}}">編輯</a>
                <button class="delete btn btn-danger ml-1" data-id={{$producttype->id}}>刪除</button>
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
                location.href='/admin/product_types/delete/'+id;
            }            
        })
    })
}







    </script>  
<script type="text/javascript" charset="utf8" src="http://code.jquery.com/jquery-1.10.2.min.js" ></script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.js" defer></script>
<script>
    // window.addEventListener('load',function () {
    //     $('#table_id_example').DataTable();;  
    // });

    $(document).ready( function () {
    $('#table_id_example').DataTable();
} );
</script>    
@endsection