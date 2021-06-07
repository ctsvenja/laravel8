<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImg;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductAdminController extends Controller
{
    //
    public function index()
    {
        // $products = Product::get()->all();
        $products = Product::with('productType')->get();

        $productTypes = ProductType::get();
        return view('admin.products.index', compact('products', 'productTypes'));
    }
    public function create()
    {
        $productTypes = ProductType::get();
        return view('admin.products.create', compact('productTypes'));
    }
    public function store(Request $request)
    {
        $requestData = $request->all();
        // 單一檔案
        // if ($request->hasFile('img')) {
        //     $file = $request->file('img');
        //     $path = $this->fileUpload($file, 'products');
        //     $requsetData['img'] = $path;
        //  }

        // 單一檔案(主要圖片)
        // 判斷是否有img這個檔案
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            // 把檔案存下來
            // 前面是資料夾 後面是檔案 (Storage是原生的)
            $path = Storage::disk('myfile')->putFile('product', $file);
            // $path /hgkgkhk.jpg
            $requestData['img'] = '/upload/' . $path;            
        }
        // dd($requestData);
        $product = Product::create($requestData);
        // Product::create($requestData);
        // $new_product_id = $new_product->id;
        // 多個檔案(其他圖片)
        $imgs = $request->file('imgs');
        foreach ($imgs as $img) {
            // 存檔並取得檔案在myfile內的路徑
            $path = Storage::disk('myfile')->putFile('product',$img);
            // 取得檔案在public的完整路徑
            $publicPath = Storage::disk('myfile')->url($path);
            // 存到資料庫
            ProductImg::create([
                'product_id'=>$product->id, //把product_id 存成 上方處理過的$product id
                'img'=>$publicPath
            ]);
        }
        // Product::create($requsetData);
        return redirect('/admin/products');
    }
    public function edit($id)
    {
        $productTypes = ProductType::get();
        $product = Product::with('productType','productImgs')->find($id);
        return view('admin.products.edit', compact('product', 'productTypes'));
    }
    public function update($id, Request $request)
    {
        // $item = Product::find($id);
        // $requestData = $request->all();
        // if ($request->hasFile('img')) {
        //     $old_image = $item->img;
        //     $file = $request->file('img');
        //     $path = $this->fileUpload($file, 'products');
        //     $requestData['img'] = $path;
        //     File::delete(public_path() . $old_image);
        // }

        // $item->update($requestData);
        // return redirect('/admin/products');

        $product = Product::find($id);
        $requestData = $request->all();
        if ($request->hasFile('img')) {
            // 要加絕對路徑才刪的掉
            File::delete(public_path() . $product->img);
            $file = $request->file('img');
            $path = Storage::disk('myfile')->putFile('product', $file);
            $requestData['img'] = Storage::disk('myfile')->url($path);
        }  

        foreach($request->imgs ?? [] as $file){
            $path = $this-> fileUpload($file,'product');
            ProductImg::create([
                'product_id'=> $product->id,
                'img'=>$path
            ]);
        }

        $product->update($requestData);
        return redirect('/admin/products');
    }
    public function delete($id)
    {
        // Product::find($id)->delete();

        // $item = Product::find($id);
        // $old_image = $item->img;
        // if (file_exists(public_path() . $old_image)) {
        //     File::delete(public_path() . $old_image);
        // }
        // $item->delete();    

        // return redirect('/admin/products');

        // $product = Product::find($id);
        // File::delete(public_path() . $product->img);
        // $product->delete();
        // return redirect('/admin/products');
        $product = Product::with('productImgs')->find($id);
        //刪除主要圖片檔案
        File::delete(public_path().$product->img);
        //刪除其他圖片
        foreach ($product->productImgs as $img){
            // 刪除其他圖片檔案
            File::delete(public_path().$img->img);
            // 刪除其他圖片資料
            $img->delete();
        }
        // 刪除產品資料

        
        $product->delete();
        return redirect('/admin/products');
    }

    public function delete_img(Request $request)
    {
        // dd($request->all());
        $img = ProductImg::find($request->id);
        // dd($img);
        File::delete(public_path().$img->img);
        $img->delete();

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
