<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

        $requsetData = $request->all();

        if ($request->hasFile('img')) {
            $file = $request->file('img');

            $path = Storage::disk('myfile')->putFile('news', $file);
            $requsetData['img'] = '/upload/' . $path;

            // $path = $this->fileUpload($file, 'news');
            // $requsetData['img'] = $path;
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

                // base64 to img 並儲存，取得path

                // $request->content 中目前的$first_src 取代成path
            }
        }


        News::create($requsetData);
        return redirect('/admin/news');
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
