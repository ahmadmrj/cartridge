@extends('layouts.frontend')

@section('master-head')
    <header class="masthead bg-primary text-white text-center rtl">
        <div class="container d-flex align-items-center flex-column">

        <!-- Masthead Heading-->
        @include('frontend.brands')

        <x-printer-select :brands="$brands" />

        </div>
    </header>
@endsection

@section('cartridge-items')
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
            <div class="row rtl" id="cartridge-grid-items">
            @foreach($cartridgeList as $cartridge)
                <x-cartridge :cartData="$cartridge" />
            @endforeach
            </div>
        </div>
    </section>
@endsection

@section('next-scripts')
    <script>
        $(document).ready(function () {
            $('#printer-model').change(function () {
                $.get('cartridge-list/'+$(this).val(), function (data) {
                    let hbody = '';
                    $.each(data, function (key, value) {
                        hbody += '<div class="col-md-4 col-lg-3 mb-5">' +
                            '            <div class="card h-100">' +
                            '               <a href="/cartridge/' + value.slug + '">' +
                            '                <div class="cartridge-item">' +
                            '                    <div class="cartridge-item-caption d-flex align-items-center justify-content-center h-100 w-100">' +
                            '                        <div class="cartridge-item-caption-content text-center text-white">' +
                            '                            <i class="fas fa-eye fa-3x"></i>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <img class="img-fluid" src="'+value.picture+'" alt="" />' +
                            '                    <h5>'+value.title+'</h5>' +
                            '                </div>' +
                            '            </div>' +
                            '        </div>'
                    });
                    $("#cartridge-grid-items").html(hbody);
                }, 'json');
                $('html, body').animate({
                    scrollTop: $("#cartridge").offset().top
                }, 2000);
            });
        });
    </script>
@endsection
