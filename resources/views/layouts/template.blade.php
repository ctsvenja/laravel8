<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    * {
      box-sizing: border-box;
      font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji';
    }

    body,
    html {
      padding: 0;
      margin: 0;
    }

    header nav a {
      padding: 16px;
    }

    header nav .navbar-nav li a {
      margin: 0 0 0 16px;
      padding: 8px 16px;
    }

    section {
      margin-bottom: 100px;
    }

    .fas.fa-star,
    .far.fa-star {
      color: #6366F1;
      font-size: 14px;
      margin-right: -4px;
    }

    .map .card {
      position: absolute;
      top: 50%;
      right: 10%;
      transform: translateY(-50%);
      box-shadow: rgba(0, 0, 0, 0.35) 0px 3px 10px;
    }

    footer:first-of-type {
      padding-bottom: 100px;
    }
  </style>
  @yield('css')
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg d-flex">
      <div class="container">
        <a class="navbar-brand" href="/">
          <img src="{{ asset('./img/logo.svg') }}" height="60" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
          aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link text-body ml-3" href="/news">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-body ml-3" href="/products">Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-body ml-3" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-body ml-3" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-body ml-3" href="./bootstrap-cart01.html"><i class="fas fa-shopping-cart"
                  style="font-size: 25px;"></i></a>
            </li>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fas fa-user-circle" style="font-size: 25px;"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="nav-link" href="{{ route('login') }}">login</a>
                <a class="nav-link" href="{{ route('register') }}">register</a>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>
    @yield('main')
  </main>

  <footer class="footer mt-auto container ">
    <div class="row">
      <div class="col-12 col-md-3 text-center text-md-left mx-auto my-auto ">
        <img class="mb-2" src="{{ asset('img/logo2.svg') }}" alt="" width="40" height="40">數位方塊
        <small class="d-block mb-3 text-muted">Air plant banjo lyft occupy retro adaptogen indego</small>
      </div>
      <div class="col-12 col-md-9">
        <div class="row">
          <div class="col-12 col-lg-3 col-md-6 text-center">
            <h5>CATEGORIES</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">First Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Second Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Third Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Fourth Link</a></li>
            </ul>
          </div>
          <div class="col-12 col-lg-3 col-md-6 text-center">
            <h5>CATEGORIES</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">First Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Second Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Third Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Fourth Link</a></li>
            </ul>
          </div>
          <div class="col-12 col-lg-3 col-md-6 text-center">
            <h5>CATEGORIES</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">First Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Second Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Third Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Fourth Link</a></li>
            </ul>
          </div>
          <div class="col-12 col-lg-3 col-md-6 text-center">
            <h5>CATEGORIES</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">First Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Second Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Third Link</a></li>
              <li><a class="text-muted" href="https://getbootstrap.com/docs/4.6/examples/pricing/#">Fourth Link</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <footer class="footer mt-auto py-3 bg-light ">
    <div class="container bg-light d-flex flex-wrap justify-content-between align-items-center">
      <p class="m-0 "> © 2020 Tailblocks — @knyttneve</p>
      <p class="">
        <i class="fab fa-facebook-f text-muted mr-2"></i>
        <i class="fab fa-twitter text-muted mr-2"></i>
        <i class="fab fa-instagram text-muted mr-2"></i>
        <i class="fab fa-linkedin-in text-muted mr-2"></i>
      </p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
  </script>
  @yield('js')
</body>
</html>