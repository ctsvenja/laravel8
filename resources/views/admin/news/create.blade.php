@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">最新消息 - 新增</div>

                <div class="card-body">
                    <form method="POST" action="/admin/news/store" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">標題</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">日期</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="img" class="col-sm-2 col-form-label">圖片</label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="img" name="img" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">內容</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="content" rows="5" required></textarea>
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
<script>
    $(document).ready(function() {
        $('#content').summernote({
            callbacks: {
                // onImageUpload: function(files) {
                // var formData = new FormData();
                // formData.append('_token','{{ csrf_token() }}');
                // // 這裡name改imgs 檔案帶入files 

                // // 跑foreach 讓圖片一張一張插入
                // for (var i = 0 ; i < files.length ; i++){
                //     formData.append('imgs[]', files[i]);
                // }
                // // 資料要送往的地方(後端)
                // fetch('/admin/summernote/store',{
                //  // 以POST方式傳送
                //  method:'POST',
                //  body: formData
                // })
                // // 取得的資料轉換為json()格式
                // .then(function(response){
                //     return response.json();
                // })
                // // 把從前端傳出去後回傳的$path，拿來儲存圖片
                // .then(function (path){
                //     // console.log(typeof path); ->array
                //     path.forEach(function (img) {
                //         // 上傳圖片至server並建立insertImage
                //         $('#content').summernote('insertImage',img);                                
                //     });
                // });
                // },
                onMediaDelete: function(element){
                    // console.log(element.attr('src'));
                    // 取得圖片的src
                    // 將資料送至後端
                    var formData = new FormData();
                    formData.append('_token','{{ csrf_token() }}');
                    formData.append('src',element.attr('src'))
                    // 將圖片的src存起來傳去後端
                    fetch('/admin/summernote/delete',{
                        method:'POST',
                        body:formData
                    })    
                    .then(function (response){
                        return response.text();
                    })
                    .then(function (data){
                        console.log(data);
                    })

                }
            }
        });
    });
</script>

@endsection