@extends('layouts.template')
@section('css')
<style>
    *{
        box-sizing: border-box;
    }
    main{
        padding: 0;
        width: 100%;
        display: flex;            
        justify-content: center;
    }
    section{
        width: 80%; 
    }
    .top{
        display: flex;
        justify-content: center;
        position: relative;
    }
    .top .heading-block{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .top .heading-img{
        width: 75px;
        height: 75px;
    }
    .top .item-wrap{
        display: flex;
        position: absolute;
        right: 0;
        bottom: 0;
    }
    .top .item-wrap .item{
        margin: 0 10px;
    }
    .bottom{
        display: flex;
        flex-wrap: wrap; 
        margin: 20px 0;
    }
    .bottom .news-img{
        width: 25vw;
        height: 16.666vw;
        background-position: center;
        background-size: cover;
    }
    .bottom .news-block{
        margin-left: 20px;
        /* flex:1; */
        min-width:1px;
    }
    .bottom .news-block .latest-news{
        color: white;
        display: inline;
        background-color: #A44CC4;
        padding: 5px 10px;
    }
    .number{
        color:#DB3B00;
    }
    .bottom .news-block .date{
        margin-bottom: 10px;
    }
</style>
@endsection
    
@section('main')
<main>
    <section>
        <div class="top">
            <div class="heading-block">
                <div class="heading-img">
                    <img src="https://www.taiwan.net.tw/att/topTitleImg/21_0001001.svg" alt="">
                </div>
                <div class="heading-text">
                    <h1>最新消息</h1>
                </div>
                <div class="item-wrap">
                    <div class="item">資料總筆數：<span class="number">175</span></div>
                    <div class="item">每頁筆數：<span class="number">10</span></div>
                    <div class="item">總頁數：<span class="number">18</span></div>
                    <div class="item">目前頁次：<span class="number">1</span></div>
                    
                
                </div>
            </div>
        </div>
        <hr>
        @foreach ($newsData as $news)                
        <div class="bottom">
            <div class="news-img" style="background-image:url({{$news->img}})" alt=""></div>
            <div class="news-block">
                <div class="latest-news">
                    最新消息
                </div>
                <div class="title">
                    <a href="/news/content/{{$news->id}}"><h2>{{$news->title}}</h2></a>
                </div>
                <div class="date number">
                    {{$news->date}}
                </div>
                <div class="detail">
                    {!! $news->content !!}
                </div>
            </div>
            @endforeach


        </div>
    </section>
</main>
@endsection

@section('js')
    <script>     
    </script>    
@endsection

    
