<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    //
    public function index()
    {
        $newsData = News::get()->all();
        return view('admin.news.index', compact('newsData'));
    }
    public function create()
    {
        return view('admin.news.create');
    }
    public function store(Request $request)
    {
        // News::create($request->all());
        // return redirect('/admin/news');

        $requestData = $request->all();

        if ($request->hasFile('img')) {
            $file = $request->file('img');

            $path = Storage::disk('myfile')->putFile('news', $file);
            $requestData['img'] = '/upload/' . $path;
        }

        $parser = xml_parser_create();
        // 將字串進行解析
        xml_parse_into_struct($parser, $request->content, $tags);
        // $news->content為要解析的東西
        // $tags為解析後html內的各個標籤
        // dd($tags);
        foreach ($tags as $tag) {
            // 找出所有img標籤
            if ($tag['tag'] == 'IMG') {
                // 取出src
                $first_src = $tag['attributes']['SRC'];
                // dd($first_src);

                // 判斷有沒有base64
                if (strpos($first_src, ';base64,') !== false) {
                    // **base64 to img 並儲存，取得path**
                    $path = $this->base64fileUpload($first_src, 'summernote');
                    // dd($path);

                    // **$request->content 中目前的$first_src 取代成path**
                    $requestData['content'] = $this->replace_first_str($first_src, $path, $requestData['content'], 1);
                    // dd($requestData['content']);
                }
            }
        }
        News::create($requestData);
        return redirect('/admin/news');
    }
    private function replace_first_str($search_str, $replacement_str, $src_str)
    {
        return (false !== ($pos = strpos($src_str, $search_str))) ? substr_replace($src_str, $replacement_str, $pos, strlen($search_str)) : $src_str;
    }
    public function edit($id)
    {
        $news = News::find($id);
        return view('admin.news.edit', compact('news'));
    }
    public function update($id, Request $request)
    {
        // News::find($id)->update($request->all());
        // return redirect('/admin/news');

        $item = News::find($id);
        $requestData = $request->all();
        if ($request->hasFile('img')) {
            $old_image = $item->img;
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'news');
            $requestData['img'] = $path;
            File::delete(public_path() . $old_image);
        }

        $item->update($requestData);
        return redirect('/admin/news');
    }
    public function delete($id)
    {
        $news = News::find($id);
        // **刪除主要圖片**
        $old_image = $news->img;
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }

        // 建立一個解析器
        $parser = xml_parser_create();
        // 將字串進行解析
        xml_parse_into_struct($parser, $news->content, $tags);
        // $news->content為要解析的東西
        // $tags為解析後html內的各個標籤
        // dd($tags);
        foreach ($tags as $tag) {
            // 找出所有img標籤
            if ($tag['tag'] == 'IMG') {
                // 取出src
                $first_src = $tag['attributes']['SRC'];
                // 刪除圖片
                File::delete(public_path() . $first_src);
            }
        }

        // **刪除summernote裡的圖片**
        // 正則表達式 (條件,要解析的內容,解析後的內容)
        // preg_match_all( '@src="([^"]+)"@' , $news->content, $match);
        // // array_pop移除並回傳最後一個
        // $srcs = array_pop($match);
        // // 跑foreach 將陣列裡的資料刪除
        // foreach ($srcs as $src) {
        //     File::delete(public_path().$src);
        // }

        // dd($match,array_pop($match));

        // 刪除整筆資料
        $news->delete();
        return redirect('/admin/news');
    }

    private function base64fileUpload($base64, $dir)
    {
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/')) {
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/' . $dir)) {
            mkdir('upload/' . $dir);
        }
        // 將$base64去蕪存菁 剩下逗號之後的編碼
        $base64_code = preg_replace('/^data:image\/\w+;base64,/', '', $base64);
        // 取得檔案的副檔名 extension
        $type = explode(';', $base64)[0];
        $extension = explode('/', $type)[1]; // png or jpg etc


        // 檔案名稱會被重新命名
        // 產生檔名
        $filename = strval(time() . md5(rand(100, 200))) . '.' . $extension;
        // 產生路徑
        $path = '/upload/' . $dir . '/' . $filename;

        // 使用intervetion image套件 儲存到指定路徑
        $img = Image::make($base64_code);
        // resize 防止圖片尺寸過大
        $img->resize(1920, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        // 儲存到指定路徑 80為壓縮品質
        $img->save(public_path() . $path, 80);

        //回傳 資料庫儲存用的路徑格式
        return $path;
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
