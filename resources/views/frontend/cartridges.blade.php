@extends('layouts.frontend')

@section('cartridge-items')
    <div class="cart-view rtl">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">خانه</a></li>
            <li class="breadcrumb-item"> کارتریج ها </li>
        </ol>
        </nav>
        <nav class="breadcrumb">
            <form action="{{ URL::to('/cartridges') }}" method="get" class="w-100">
                <x-printer-select
                    :brands="$brands"
                    :selected="$sel_brand"
                    :selected-family="$sel_family"
                    :selected-printer="$printer_slug"
                    label="filter"
                />
                <button class="btn btn-info">
                    <i class="fa fa-search"></i>
                    جستجو
                </button>
            </form>
        </nav>
        <div class="row">
            @foreach($carts as $cartridge)
                <x-cartridge :cartData="$cartridge" />
            @endforeach
        </div>
        <div class="row">
            {{ $carts->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#brand-select').select2();
        });
    </script>
@endsection
