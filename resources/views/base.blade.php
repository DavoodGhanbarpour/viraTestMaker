<!doctype html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>
            سیستم آزمون ساز ویرا
            -
            {{ $pageTitle ?? '' }}
        </title>
        <link rel="icon" type="image/png" href="{{ asset('storage/viraLogoSmall.png') }}"/>
        <link href="{{ asset('assets/css/tabler.rtl.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('assets/css/tabler-flags.rtl.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('assets/css/tabler-payments.rtl.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('assets/css/tabler-vendors.rtl.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('assets/css/demo.rtl.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"/>
        <link href="{{ asset('assets/css/persian-datepicker.min.css') }}" rel="stylesheet"/>
        @yield('sidebar')
        @yield('styles')
    </head>
    <body class="antialiased" id="mainBody">
        <div class="wrapper">
            {{-- {{ include('includes/header.blade.php') }} --}}
            {{-- {{ include('includes/navbar.blade.php') }} --}}
            @include('includes.header')
            
            @include('includes.'.strtolower(Auth::user()->role).'_navbar')
            <div class="page-wrapper">
                <div class="container-xl">
                    <div class="page-header d-print-none">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="page-title">
                                    {{ $pageTitle ?? '' }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="container-xl mainContainer">
                        @yield('content')
                    </div>
                </div>

                <x-alert :type="'error'" :message="''"/>


                <footer class="footer footer-transparent d-print-none">
                    <div class="container">
                        <div class="row text-center align-items-center flex-row-reverse">
                            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                                <ul class="list-inline list-inline-dots mb-0">
                                    <li class="list-inline-item">
                                        تمامی حقوق محفوظ میباشد.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </body>
</html>


<script src="{{ asset('assets/js/tabler.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/libraries/jquery.js') }}"></script>
<script src="{{ asset('assets/js/libraries/persian-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/libraries/persian-date.min.js') }}"></script>

@yield('scripts')