<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content=" پیدا کردن کارتریج مناسب برای پرینتر و اطلاع از مشخصات و نحوه خرید با کارتریج یاب " />
    <meta name="keywords" content="کارتریج 44a، قیمت کارتریج، پرینتر، کارتریج، خرید کارتریج، کارتریج hp">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175972244-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-175972244-1');
    </script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>
        @if(isset($seoTitle))
            {{ $seoTitle }}
        @else
            کارتریج یاب
        @endif
    </title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-169187036-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-169187036-1');
    </script>
</head>
<body id="page-top">
    <div id="loading-div" class="stopLoading">
        <img src="{{ \Illuminate\Support\Facades\URL::asset('/images/loading_3.gif') }}" />
    </div>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top rtl" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="{{ URL::to('/') }}">
                <img class="" width="40" src="{{ URL::asset('assets/img/tools-and-utensils.svg')}}" alt="" />
                کارتریج یاب
            </a>

            <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                منو  <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse flex-grow-0" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/cartridges">کارتریج ها</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">درباره ما</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">تماس</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')


    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    @yield('next-scripts')
</body>

</html>
