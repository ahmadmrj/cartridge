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
            <a class="navbar-brand js-scroll-trigger" href="#page-top">کارتریج یاب</a>
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
    <header class="masthead bg-primary text-white text-center rtl">
        <div class="container d-flex align-items-center flex-column">
            @yield('master-head')
        </div>
    </header>
    <!-- cartridge Section-->
    <section class="page-section cartridge" id="cartridge">
    <div class="container">
        <!-- cartridge Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">کارتریج ها</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- cartridge Grid Items-->
        <div class="row">
            <!-- cartridge Item 1-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="cartridge-item mx-auto" data-toggle="modal" data-target="#cartridgeModal1">
                    <div class="cartridge-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="cartridge-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/cartridge/cabin.png" alt="" />
                </div>
            </div>
            <!-- cartridge Item 2-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="cartridge-item mx-auto" data-toggle="modal" data-target="#cartridgeModal2">
                    <div class="cartridge-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="cartridge-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/cartridge/cake.png" alt="" />
                </div>
            </div>
            <!-- cartridge Item 3-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="cartridge-item mx-auto" data-toggle="modal" data-target="#cartridgeModal3">
                    <div class="cartridge-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="cartridge-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/cartridge/circus.png" alt="" />
                </div>
            </div>
            <!-- cartridge Item 4-->
            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="cartridge-item mx-auto" data-toggle="modal" data-target="#cartridgeModal4">
                    <div class="cartridge-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="cartridge-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/cartridge/game.png" alt="" />
                </div>
            </div>
            <!-- cartridge Item 5-->
            <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                <div class="cartridge-item mx-auto" data-toggle="modal" data-target="#cartridgeModal5">
                    <div class="cartridge-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="cartridge-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/cartridge/safe.png" alt="" />
                </div>
            </div>
            <!-- cartridge Item 6-->
            <div class="col-md-6 col-lg-4">
                <div class="cartridge-item mx-auto" data-toggle="modal" data-target="#cartridgeModal6">
                    <div class="cartridge-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="cartridge-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/cartridge/submarine.png" alt="" />
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- About Section-->
    <section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">
        <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white">About</h2>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- About Section Content-->
        <div class="row">
            <div class="col-lg-4 ml-auto"><p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional SASS stylesheets for easy customization.</p></div>
            <div class="col-lg-4 mr-auto"><p class="lead">You can create your own custom avatar for the masthead, change the icon in the dividers, and add your email address to the contact form to make it fully functional!</p></div>
        </div>
        <!-- About Section Button-->
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-outline-light" href="https://startbootstrap.com/themes/freelancer/"><i class="fas fa-download mr-2"></i>Free Download!</a>
        </div>
    </div>
</section>

    <!-- Footer-->
    <footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Location</h4>
                <p class="lead mb-0">2215 John Daniel Drive<br />Clark, MO 65243</p>
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Around the Web</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-facebook-f"></i></a><a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-twitter"></i></a><a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-linkedin-in"></i></a><a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-dribbble"></i></a>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">About Freelancer</h4>
                <p class="lead mb-0">Freelance is a free to use, MIT licensed Bootstrap theme created by <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
            </div>
        </div>
    </div>
</footer>
    <!-- Copyright Section-->
    <section class="copyright py-4 text-center text-white">
    <div class="container"><small>Copyright © Your Website 2020</small></div>
</section>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
    <div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>
    <!-- cartridge Modals--><!-- cartridge Modal 1-->
    <div class="cartridge-modal modal fade" id="cartridgeModal1" tabindex="-1" role="dialog" aria-labelledby="cartridgeModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- cartridge Modal - Title-->
                            <h2 class="cartridge-modal-title text-secondary text-uppercase mb-0">Log Cabin</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- cartridge Modal - Image--><img class="img-fluid rounded mb-5" src="assets/img/cartridge/cabin.png" alt="" /><!-- cartridge Modal - Text-->
                            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            <button class="btn btn-primary" href="#" data-dismiss="modal"><i class="fas fa-times fa-fw"></i>Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- cartridge Modal 2-->
    <div class="cartridge-modal modal fade" id="cartridgeModal2" tabindex="-1" role="dialog" aria-labelledby="cartridgeModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- cartridge Modal - Title-->
                            <h2 class="cartridge-modal-title text-secondary text-uppercase mb-0">Tasty Cake</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- cartridge Modal - Image--><img class="img-fluid rounded mb-5" src="assets/img/cartridge/cake.png" alt="" /><!-- cartridge Modal - Text-->
                            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            <button class="btn btn-primary" href="#" data-dismiss="modal"><i class="fas fa-times fa-fw"></i>Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- cartridge Modal 3-->
    <div class="cartridge-modal modal fade" id="cartridgeModal3" tabindex="-1" role="dialog" aria-labelledby="cartridgeModal3Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- cartridge Modal - Title-->
                            <h2 class="cartridge-modal-title text-secondary text-uppercase mb-0">Circus Tent</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- cartridge Modal - Image--><img class="img-fluid rounded mb-5" src="assets/img/cartridge/circus.png" alt="" /><!-- cartridge Modal - Text-->
                            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            <button class="btn btn-primary" href="#" data-dismiss="modal"><i class="fas fa-times fa-fw"></i>Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- cartridge Modal 4-->
    <div class="cartridge-modal modal fade" id="cartridgeModal4" tabindex="-1" role="dialog" aria-labelledby="cartridgeModal4Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- cartridge Modal - Title-->
                            <h2 class="cartridge-modal-title text-secondary text-uppercase mb-0">Controller</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- cartridge Modal - Image--><img class="img-fluid rounded mb-5" src="assets/img/cartridge/game.png" alt="" /><!-- cartridge Modal - Text-->
                            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            <button class="btn btn-primary" href="#" data-dismiss="modal"><i class="fas fa-times fa-fw"></i>Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- cartridge Modal 5-->
    <div class="cartridge-modal modal fade" id="cartridgeModal5" tabindex="-1" role="dialog" aria-labelledby="cartridgeModal5Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- cartridge Modal - Title-->
                            <h2 class="cartridge-modal-title text-secondary text-uppercase mb-0">Locked Safe</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- cartridge Modal - Image--><img class="img-fluid rounded mb-5" src="assets/img/cartridge/safe.png" alt="" /><!-- cartridge Modal - Text-->
                            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            <button class="btn btn-primary" href="#" data-dismiss="modal"><i class="fas fa-times fa-fw"></i>Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- cartridge Modal 6-->
    <div class="cartridge-modal modal fade" id="cartridgeModal6" tabindex="-1" role="dialog" aria-labelledby="cartridgeModal6Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- cartridge Modal - Title-->
                            <h2 class="cartridge-modal-title text-secondary text-uppercase mb-0">Submarine</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- cartridge Modal - Image--><img class="img-fluid rounded mb-5" src="assets/img/cartridge/submarine.png" alt="" /><!-- cartridge Modal - Text-->
                            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            <button class="btn btn-primary" href="#" data-dismiss="modal"><i class="fas fa-times fa-fw"></i>Close Window</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
<!-- Scripts -->

</html>
