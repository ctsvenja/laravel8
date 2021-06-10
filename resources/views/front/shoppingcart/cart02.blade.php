@extends('layouts.template')
@section('css')
<style>
  .cart-block {
    width: 100%;
    background-color: #D1D5DB;
    margin: 0 auto;
    padding: 3% 0;
    display: flex;
    justify-content: center;
  }

  .cart-detail {
    border-radius: 10px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 1px 5px;
    min-width: 320px;
    max-width: 950px;
    width: 70%;
    height: 95%;
    background-color: #F3F4F6;
  }

  .number {
    width: 40px;
    height: 40px;
    background-color: rgb(16, 185, 129);
    border-radius: 50%;
    color: #FFF;
    text-align: center;
    line-height: 40px;
  }
</style>
@endsection
@section('main')
<main>
  <div class="cart-block">
    <div class="cart-detail p-5">
      <div class="shopping-progress ">
        <h4 class="font-weight-bold">購物車</h4>
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
              <div class="progress-bar" role="progressbar" style="width: 50%;background-color: #6EE7B7" ;
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <!-- step 3  -->
            <div class="rounded-circle text-center"
              style="width: 40px; height: 40px; line-height: 40px; background-color: #ffffff;">3
            </div>
            <div class="progress position-absolute"
              style="width: 17%;max-width: 180px; height: 8px; transform: translateX(148%);">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
              </div>
            </div>
            <!-- step 4  -->
            <div class="rounded-circle text-center"
              style="width: 40px; height: 40px; line-height: 40px; background-color: #ffffff;">4
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
        <form action="/shopping_cart/payment/check" method="POST">
          @csrf
          <div class="payment">
            <h4>付款方式</h4>
            @php
            $payment = Session::get('payment');
            // dd($payment);
            @endphp
            <div class="container">
              <div class="col">
                <label class="row d-flex align-items-center py-1">
                  <input class="mr-2" type="radio" name="payment" value="CD" @if ($payment=="CD" ) checked @endif
                    required>
                  <h5 class="m-0">信用卡付款</h5>
                </label>
                <hr />
                <label class="row d-flex align-items-center py-1">
                  <input class="mr-2" type="radio" name="payment" value="ATM" @if ($payment=="ATM" ) checked @endif
                    required>
                  <h5 class="m-0">網路ATM</h5>
                </label>
                <hr />
                <label class="row d-flex align-items-center py-1">
                  <input class="mr-2" type="radio" name="payment" value="CVS" @if ($payment=="CVS" ) checked @endif
                    required>
                  <h5 class="m-0">超商代碼</h5>
                </label>
              </div>
            </div>
            <hr />
            <div class="shipment">
              <h4>運送方式</h4>
              @php
              $shipment = Session::get('shipment');
              @endphp
              <div class="container">
                <div class="col">
                  <label class="row d-flex align-items-center py-1">
                    <input class="mr-2" type="radio" name="shipment" value="BC" @if ($shipment=="BC" ) checked @endif
                      required>
                    <h5 class="m-0">黑貓宅配</h5>
                  </label>
                  <hr />
                  <label class="row d-flex align-items-center py-1">
                    <input class="mr-2" type="radio" name="shipment" value="CV" @if ($shipment=="CV" ) checked @endif
                      required>
                    <h5 class="m-0">超商店到店</h5>
                  </label>
                </div>
              </div>
            </div>
          </div>
        {{-- </form> --}}
        <hr />
        <div class="total-detail">
          <div class="container ">
            <div class="row  ">
              <div class="col-9 d-flex flex-column align-items-end">
                <div class="row text-muted">數量：</div>
                <div class="row text-muted">小計：</div>
                <div class="row text-muted">運費：</div>
                <div class="row text-muted">總計：</div>
              </div>
              @php
              $subTotal = \Cart::getSubTotal();
              $shipment = \Cart::getSubTotal() > 1000 ? 0 : 60;
              @endphp
              <div class="col-3 d-flex flex-column align-items-end">
                <div class="row ">{{\Cart::getTotalQuantity()}}</div>
                <div class="row">${{number_format($subTotal)}}</div>
                <div class="row ">${{number_format($shipment)}}</div>
                <div class="row ">${{number_format($subTotal + $shipment)}}</div>
              </div>
            </div>
          </div>
        </div>
        <hr />
        <div class="action-button d-flex justify-content-between align-items-center">
          <a href="/shopping_cart/list" class="btn btn-outline-primary btn-lg">上一步</a>
          <button type="submit" class="btn btn-primary btn-lg">下一步</button>
        </div>
      </form>
      </div>
    </div>
</main>
@endsection
@section('js')

@endsection