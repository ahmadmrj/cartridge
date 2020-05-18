@extends('layouts.frontend')

@section('cartridge-items')
    <div class="cart-view rtl">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">خانه</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to('/cartridges') }}">کارتریج ها</a></li>
            <li class="breadcrumb-item active">{{$cartridge->title}}</li>
        </ol>
        </nav>
        <div class="row">
            <div class="col-md-5">
                @if(file_exists($cartridge->picture))
                    <img class="img-fluid rounded img-thumbnail" width="100%" src="{{ URL::asset($cartridge->picture) }}">
                @else
                    <img class="img-fluid  rounded img-thumbnail" width="100%" src="{{ URL::asset('/images/no_img.png') }}">
                @endif
                @if($cartridge->buy_link)
                    <a target="_blank" href="{{ $cartridge->buy_link }}" class="btn btn-success mt-2 w-100">
                        <i class="fa fa-shopping-cart"></i>
                        خرید
                    </a>
                @else
                    <a target="_blank" href="#" class="btn btn-secondary mt-2 w-100">
                        ناموجود
                    </a>
                @endif
            </div>
            <div class="col-md-7" style="line-height: 35px">
                <img class="" src="{{ URL::asset($cartridge->printers[0]->family->brand->picture) }}">
                <h4>{{ $cartridge->title }}</h4>
                <div class="text-bold"> رنگ: {{ $cartridge->color }}</div>
                <div class="text-bold"> تعداد صفحه: {{ $cartridge->page_yield }}</div>
                <div class="text-bold"> پرینترهای سازگار: </div>
                <ul>
                    @foreach($cartridge->printers as $printer)
                        <li><a href="{{ URL::to('/cartridges?printer='.str_slug($printer->title)) }}"> {{ $printer->title }} </a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
