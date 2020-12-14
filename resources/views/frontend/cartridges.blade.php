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
                <div class="form-check float-left">
                    <input type="checkbox" class="form-check-input" id="available-check" name="available-check"
                        @if($available) checked="checked" @endif
                    >
                    <label for="available-check">موجود در فروشگاه</label>
                </div>
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
            <div class="col">
                {{ $carts->links() }} 
            </div>
            <div class="col d-flex text-muted align-items-center">
                تعداد کل: 
                {{ $carts->total() }} 
                رکورد
            </div>
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
