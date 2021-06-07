@extends('layouts.template')

@section('css')
<style>
    * {
        box-sizing: border-box;
    }

    main {
        padding: 0;
        width: 100%;    
        height: 100vh;    
        display: flex;
        justify-content: center;
    }

    section {
        width: 80%;
    }

    .content-top .content-items {
        display: flex;
    }

    .content-top .content-items .content-item {
        margin-right: 10px;
    }

    .number {
        color: #DB3B00;
    }
</style>
@endsection
@section('main')

<main>
    <section>
        <div class="content">
            <div class="content-top">
                                
                <div class="content-title">                    
                    <h1>{{$newsDetail->title}}</h1>
                </div>
                <div class="content-items">
                    <div class="content-item">發布日期：<span class="number date">{{$newsDetail->date}}</span></div>
                    <div class="content-item">瀏覽次數：<span class="number">{{$newsDetail->view}}</span></div>
                </div>
            </div>
            <hr>
            <div class="content-bottom">
                {!!$newsDetail->content!!}
            
            </div>
        </div>
    </section>
</main>
@endsection    
@section('js')
    
@endsection
    
