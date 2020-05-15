<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title> کارتریج یاب </title>
</head>
<body id="page-top">
    <div id="loading-div" class="stopLoading">
        <img src="{{ \Illuminate\Support\Facades\URL::asset('/images/loading_3.gif') }}" />
    </div>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top rtl" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="{{ URL::to('/') }}">کارتریج یاب</a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                منو  <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#cartridge">آساک سیستم</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">درباره ما</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">تماس</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    @yield('master-head')

    <!-- cartridge Section-->
    @yield('cartridge-items')

    <!-- About Section-->
    <section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container rtl">
        <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white">
            آساک سیستم؛ بزرگترین فروشگاه اینترنتی ماشین آلات و ملزومات چاپ دیجیتال
        </h2>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- About Section Content-->
        <div class="row">
            <div class="col ml-auto text-justify"><p class="lead">
                    وب سایت آساک سیستم با دارا بودن نماد اعتماد الکترونیک دو ستاره مانند سایت های معتبری مثل دیجی کالا و داشتن گواهی امنیتی SSL بستری ایمن جهت خرید آنلاین از سراسر کشور را مهیا نموده به طوریکه خریدار می تواند به راحتی و در هر ساعت از شبانه روز کالای مورد نیاز را سفارش داده و مبلغ آن را به صورت آنلاین پرداخت نماید.
                <br>
                    فروشگاه اینترنتی آساک سیستم با معرفی صدها محصول در زمینه چاپ دیجیتال به همراه تصاویر، مشخصات فنی، ویدئوهای آموزشی و قیمت های به روز امکان بررسی، مقایسه و خرید هوشمندانه را جهت کاربران فراهم نموده است.
                </p></div>
        </div>
        <!-- About Section Button-->
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-outline-light" href="https://asaksystem.ir/">
                <i class="fas fa-shopping-basket mr-2"></i>هم اکنون خرید کنید!</a>
        </div>
    </div>
</section>

    <!-- Footer-->
    <footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="mb-4">آدرس</h4>
                <p class="lead mb-0">تهــران - خیابان ایرانشهر - کوچه نوشهر <br /> پلاک 32 - واحد 4</p>
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="mb-4">ما را دنبال کنید</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="#">
                    <i class="fab fa-fw fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-linkedin-in"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-dribbble"></i></a>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="mb-4">با ما در تماس باشید</h4>
                <p class="lead mb-0">
                    021-88865330 <br>
                    <a href="mailto:asaksys@gmailcom">asaksys@gmailcom</a>
                </p>
            </div>
        </div>
    </div>
</footer>
    <!-- Copyright Section-->
    <section class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright © Asaksystem 2020</small></div>
    </section>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
    <div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>
    <!-- cartridge Modals--><!-- cartridge Modal 1-->
    @yield('modal')
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
<!-- Scripts -->

</html>
