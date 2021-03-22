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
    <section class="page-section cartridge pb-2" id="cartridge">
        <div class="container">
            <!-- cartridge Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">کارتریج ها</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
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
    <section class="page-section cartridge pt-0" id="cartridge">
        <div class="container">
            <!-- cartridge Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">پرینترها</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
            </div>
            <!-- cartridge Grid Items-->
            <div class="row rtl" id="cartridge-grid-items">
            @foreach($printerList as $printer)
                <x-printer :printerData="$printer" />
            @endforeach
            </div>
        </div>
    </section>
@endsection

@section('next-scripts')
    <script>
        $(document).ready(function () {
            $('#printer-model').change(function () {
                window.location.replace("/cartridges?printer=" + $(this).val());
            });
        });
    </script>
@endsection
