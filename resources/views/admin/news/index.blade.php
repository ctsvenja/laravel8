@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
<style>
    img {
        width: 150px;
    }

    tbody tr td {
        word-break: break-all;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 500px;
    }
</style>
@endsection


@section('main')
<div class="container ">
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary ml-auto" href="/admin/news/create">新增消息</a>
    </div>
    <hr>
    <table id="table_id_example" class="display">

        <thead>
            <tr>
                <th>標題</th>
                <th>日期</th>
                <th>圖片</th>
                {{-- <th>內文</th> --}}
                <th>操作</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($newsData as $news)
            <tr>
                <td>{{$news->title}}</td>
                <td>{{$news->date}}</td>
                <td><img src="{{asset($news->img)}}" alt=""></td>
                {{-- <td width="400">{{$news->content}}</td> --}}
                <td>
                    <a class="btn btn-success ml-1" href="/admin/news/edit/{{$news->id}}">編輯</a>
                    <button class="delete btn btn-danger ml-1" data-id={{$news->id}}>刪除</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('js')
<script>
    var deleteBtns= document.querySelectorAll('.delete')
    deleteBtns.forEach(function (deleteBtn) {
        deleteBtn.addEventListener('click',function () {
            if(confirm('確定要刪除嗎？')){
                var id = this.getAttribute('data-id');
                location.href='/admin/news/delete/'+id;
            }            
        })
    })
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