<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>ورود - آزمون ساز ویرا</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/viraLogoSmall.png') }}"/>
    <link href="{{ asset('assets/css/tabler.rtl.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/tabler-flags.rtl.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/tabler-payments.rtl.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/tabler-vendors.rtl.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/demo.rtl.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"/>

    <script src="{{ asset('assets/js/tabler.min.js') }}"></script>

  </head>
  <body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="."><img src="{{ asset('assets/img/viraLogo.png') }}" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="/authenticate" method="post" autocomplete="off">
          @csrf
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label rtl">نام کاربری</label>
              <input type="text" class="form-control rtl" name="username" placeholder="نام کاربری را وارد کنید">
            </div>

            <div class="mb-2">
              <label class="form-label rtl">
                گذرواژه
              </label>
              <div class="input-group ">
                <input type="password" class="form-control rtl" name="password"  placeholder="گذرواژه را وارد کنید"  autocomplete="off">
              </div>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">ورود</button>
            </div>
          </div>
        </form>
      </div>
      <x-alert type="error" :message=" $message ?? '' "/>
    </div>
  </body>

</html>