@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">最新消息 - 編輯</div>

                <div class="card-body">
                    <form method="POST" action="/admin/news/update/{{$news->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">標題</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" required
                                    value="{{$news->title}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">日期</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="date" name="date" required
                                    value="{{$news->date}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="img" class="col-sm-2 col-form-label ">圖片</label>
                            <div class="col-sm-10">
                                <img src="{{asset($news->img)}}" alt="" width="300" class="mb-2">
                                <input type="file" accept="image/*" class="form-control" id="img" name="img"
                                    value="{{asset($news->img)}}" required>
                                {{-- <span>{{asset($news->img)}}</span> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">內容</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="content" rows="5"
                                    required>{{$news->content}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">修改</button>
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
<script>
       $(document).ready(function() {
  $('#content').summernote({
  callbacks: {
    onImageUpload: function(files) {
        var formData = new FormData();
        formData.append('_token','{{ csrf_token() }}');
        formData.append('img', files[0]);

        fetch('/admin/summernote/store',{
            method:'POST',
            body: formData
        })
        .then(function(response){
            return response.text();
        })
        .then(function (path){
            $('#content').summernote('insertImage',path);
        });
    }
  }
});
});
</script>
@endsection