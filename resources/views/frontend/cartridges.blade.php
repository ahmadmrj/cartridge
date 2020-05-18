@extends('layouts.frontend')

@section('cartridge-items')
    <div class="cart-view rtl">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">خانه</a></li>
            <li class="breadcrumb-item"> کارتریج ها </li>
        </ol>
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
