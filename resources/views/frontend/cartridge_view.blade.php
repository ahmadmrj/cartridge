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
                <div id="carouselExampleCaptions" class="carousel slide carousel-thumbnails" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($cartridge->medias as $key => $media)
                        <div class="carousel-item @if($key==0) active @endif">
                            <img src="{{ URL::asset('uploads/'.$media->address) }}" class="d-block w-100" alt="{{$cartridge->slug}}_{{$key}}">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">قبلی</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">بعدی</span>
                    </a>
                    <ol class="carousel-indicators">
                        @foreach($cartridge->medias as $key => $media)
                            <li data-target="#carouselExampleCaptions" data-slide-to="{{$key}}"
                                @if($key==0) class="active" @endif
                            >
                                <img src="{{ URL::asset('uploads/'.$media->address) }}" width="80" class="img-fluid">
                            </li>
                        @endforeach
                    </ol>
                </div>
{{--                @if(file_exists($cartridge->picture))--}}
{{--                    <img class="img-fluid rounded img-thumbnail" width="100%" src="">--}}
{{--                @else--}}
{{--                    <img class="img-fluid  rounded img-thumbnail" width="100%" src="{{ URL::asset('/images/no_img.png') }}">--}}
{{--                @endif--}}
                @if($cartridge->buy_link)
                    <a target="_blank" href="{{ $cartridge->buy_link }}" class="btn btn-success w-100">
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
                <div class="top-brands">
                    <li><a href="{{ URL::to('/cartridges?brand='.$cartridge->printers[0]->family->brand->slug) }}" id="tb_{{$cartridge->printers[0]->family->brand->slug}}" class="mr-0"></a></li>
                </div>
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
