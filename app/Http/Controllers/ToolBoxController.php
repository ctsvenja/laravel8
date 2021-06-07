<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ToolBoxController extends Controller
{
    public function summernoteStore(Request $request)
    {
        // 接前端的資料
        // 判斷有沒有img的檔案
        if($request->hasFile('imgs')){
            $path = [];
            foreach ($request->imgs as $img) {
                // 把圖片儲存後將路徑儲存到path陣列中
                array_push($path, $this->fileUpload($img,'summernote'));
            }
            return $path;
        }
        return 'fail';
    }

    public function summernoteDelete($id,Request $request)
    {
        // 確認有沒有接到資料
        // dd($request->all());
        
        //清除資料 回傳success
        File::delete(public_path().$request->src);
        return 'success';
    }

    private function fileUpload($file, $dir)
    {
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/')) {
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/' . $dir)) {
            mkdir('upload/' . $dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time() . md5(rand(100, 200))) . '.' . $extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path() . '/upload/' . $dir . '/' . $filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/' . $dir . '/' . $filename;
    }
}
