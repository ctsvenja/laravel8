@extends('layouts.template')
@section('css')
    
@endsection
@section('main')
<main>
    <div class="cart-block">
      <div class="cart-detail p-5">
        <div class="shopping-progress ">
          <h4 style="font-weight: bold;">購物車</h4>
          
                  <!-- progressbar -->
                  <div class="pt-3">
                    <div class="d-flex justify-content-around position-relative align-items-center">
                      <!-- step 1  -->
                      <div class="rounded-circle text-center text-white"
                        style="width: 40px; height: 40px; line-height: 40px; background-color: #10B981;">1
                      </div>
                      <div class="progress position-absolute"
                        style="width: 17%;max-width: 180px; height: 8px;transform: translateX(-148%);">
                        <div class="progress-bar" role="progressbar" style="width: 100%;background-color: #6EE7B7;"
                          aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <!-- step 2  -->
                      <div class="rounded-circle text-center text-white"
                        style="width: 40px; height: 40px; line-height: 40px; background-color:#10B981;">2
                      </div>
                      <div class="progress position-absolute" style="width: 17%;max-width: 180px; height: 8px;">
                        <div class="progress-bar" role="progressbar" style="width: 100%;background-color: #6EE7B7" ;
                          aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <!-- step 3  -->
                      <div class="rounded-circle text-center text-white"
                        style="width: 40px; height: 40px; line-height: 40px; background-color: #10B981;">3
                      </div>
                      <div class="progress position-absolute"
                        style="width: 17%;max-width: 180px; height: 8px; transform: translateX(148%);">
                        <div class="progress-bar" role="progressbar" style="width: 100%;background-color: #6EE7B7" ;
                          aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <!-- step 4  -->
                      <div class="rounded-circle text-center text-white"
                        style="width: 40px; height: 40px; line-height: 40px; background-color: #10B981;">4
                      </div>
                    </div>
                    <div id="process-text" class="d-flex justify-content-around px-2">
                      <div class="pt-2">確認購物車</div>
                      <div class="pt-2 pr-3">付款與運送方式</div>
                      <div class="pt-2 mr-4">填寫資料</div>
                      <div class="pt-2 pr-2">完成訂購</div>
                    </div>
                  </div>
                  <hr />
                  <div class="order-detail">
                    <h2 class="text-center font-weight-bold">訂單成立</h2>
                    <h4>訂單明細</h4>
                    <div class="container">
                      <div class="row">
                        <div class="col-12 col-md-6 d-flex align-items-center">
                          <img class="rounded-circle" style="width: 60px; height: 60px;" src="./img/food01.jpg"
                            alt="" />
                          <div class="food-description ml-2 ">
                            <p class="m-0">Chicken momo</p>
                            <p class="m-0 text-muted">#41551</p>
                          </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-end ">
                          <div class="quantity mr-2">X1</div>
                          <div class="price ml-1">$10.50</div>
                        </div>
                      </div>
                      <hr />
                      <div class="row">
                        <div class="col-12 col-md-6 d-flex align-items-center">
                          <img class="rounded-circle" style="width: 60px; height: 60px;" src="./img/food02.jpg"
                            alt="" />
                          <div class="food-description ml-2 ">
                            <p class="m-0">Spicy Mexican potatoes</p>
                            <p class="m-0 text-muted">#66999</p>
                          </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-end ">
                          <div class="quantity mr-2">X1</div>
                          <div class="price ml-1">$10.50</div>
                        </div>
                      </div>
                      <hr />
                      <div class="row">
                        <div class="col-12 col-md-6 d-flex align-items-center">
                          <img class="rounded-circle" style="width: 60px; height: 60px;" src="./img/food03.jpg"
                            alt="" />
                          <div class="food-description ml-2 ">
                            <p class="m-0">Breakfast</p>
                            <p class="m-0 text-muted">#86577</p>
                          </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-end ">
                          <div class="quantity mr-2">X1</div>
                          <div class="price ml-1">$10.50</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="send-information pt-3">
                    <h4>寄送資料</h4>
                    <div class="container">
                    </div>
                    <div class="col">
                      <div class="row py-2">
                        <div class="col-2 p-1 ">
                          <h5 class="font-weight-normal">姓名</h5>
                        </div>
                        <div class="col-10">
                          <h5 class="font-weight-normal">王曉明</h5>
                        </div>
                      </div>
                      <div class="row py-2">
                        <div class="col-2 p-1">
                          <h5 class="font-weight-normal">電話</h5>
                        </div>
                        <div class="col-10">
                          <h5 class="font-weight-normal">0912345678</h5>
                        </div>
                      </div>
                      <div class="row py-2">
                        <div class="col-2 p-1">
                          <h5 class="font-weight-normal">E-mail</h5>
                        </div>
                        <div class="col-10">
                          <h5 class="font-weight-normal">abc123@gmail.com</h5>
                        </div>
                      </div>
                      <div class="row py-2">
                        <div class="col-2 p-1">
                          <h5 class="font-weight-normal">地址</h5>
                        </div>
                        <div class="col-10">
                          <h5 class="font-weight-normal">409 台中市小鎮村英雄路1號</h5>
                        </div>
                      </div>
                    </div>

                    <div class="total-detail">
                      <div class="container ">
                        <div class="row  ">
                          <div class="col-9 d-flex flex-column align-items-end">
                            <div class="row text-muted">數量：</div>
                            <div class="row text-muted">小計：</div>
                            <div class="row text-muted">運費：</div>
                            <div class="row text-muted">總計：</div>
                          </div>
                          <div class="col-3 d-flex flex-column align-items-end">
                            <div class="row ">3</div>
                            <div class="row">$24.90</div>
                            <div class="row ">$24.90</div>
                            <div class="row ">$24.90</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr />
                    <div class="action-button d-flex justify-content-end align-items-center">
                      <a href="./bootstrap-index.html"><button class="btn btn-primary ml-auto btn-lg">返回首頁</button></a>
                    </div>
                  </div>
                </div>
  </main>    
@endsection
@section('js')
    
@endsection