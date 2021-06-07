<?php

namespace App\Http\Controllers;

use App\News;
use App\ProductType;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }
    public function newsIndex()
    {
        $newsData=News::get();
        return view('front.news.index',compact('newsData'));
    }

    public function newsContent($id)
    {
        $newsDetail=News::find($id);
        return view('front.news.content',compact('newsDetail'));
    }

    public function productTypeIndex()
    {
        $productTypes=ProductType::get();
        return view('front.producttypes.index',compact('productTypes'));
    }

}
