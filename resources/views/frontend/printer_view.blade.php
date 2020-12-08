@extends('layouts.frontend')

@section('cartridge-items')
    <div class="cart-view rtl">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">خانه</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::to('/cartridges') }}">پرینتر ها</a></li>
            <li class="breadcrumb-item active">{{$printer->title}}</li>
        </ol>
        </nav>
        <div class="row">
            <div class="col-md-5">
                @if(file_exists($printer->_picture) or isset($printer->medias[0]))
                <div id="carouselExampleCaptions" class="carousel slide carousel-thumbnails" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($printer->medias as $key => $media)
                        <div class="carousel-item @if($key==0) active @endif">
                            <img src="{{ URL::asset('uploads/'.$media->address) }}" class="d-block w-100" alt="{{$printer->slug}}_{{$key}}">
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
                        @foreach($printer->medias as $key => $media)
                            <li data-target="#carouselExampleCaptions" data-slide-to="{{$key}}"
                                @if($key==0) class="active" @endif
                            >
                                <img src="{{ URL::asset('uploads/'.$media->address) }}" width="80" class="img-fluid">
                            </li>
                        @endforeach
                    </ol>
                </div>
{{--                    <img class="img-fluid rounded img-thumbnail" width="100%" src="">--}}
                @else
                    <img class="img-fluid  rounded img-thumbnail" width="100%" src="{{ URL::asset('/images/no_img.png') }}">
                @endif
                @if($printer->buy_link)
                    <a target="_blank" href="{{ $printer->buy_link }}" class="btn btn-success w-100">
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
                    <ul class="pr-0">
                        <li><a href="{{ URL::to('/cartridges?brand='.$printer->family->brand->slug) }}" id="tb_{{$printer->family->brand->slug}}" class="mr-0"></a></li>
                    </ul>
                </div>
                <h4>{{ $printer->title }}</h4>
                <div class="text-bold"> عنوان فنی: {{ $printer->technical_title }}</div>
                <div class="text-bold"> کارتریج ها: </div>
                <div class="mt-3 row">
                    @foreach($printer->cartridges as $cartridge)
                        <div class="col-sm-12 col-md-6 mt-1">
                            @if(isset($cartridge->medias[0]))
                                @if(file_exists('uploads/'.$cartridge->medias[0]->address))
                                    <img src="{{ URL::asset('uploads/'.$cartridge->medias[0]->address) }}" alt="" width="45"/>
                                @else
                                    <img class="img-fluid" src="{{ URL::asset('/images/no_cart.png') }}" alt="" width="45" />
                                @endif
                            @else
{{--                                <i class="fas fa-paint-roller"></i>--}}
                                <img class="img-fluid" src="{{ URL::asset('/images/no_cart.png') }}" alt="" width="45" />
                            @endif
                            <a href="{{ URL::to('/cartridge/'.$cartridge->slug) }}"> {{ $cartridge->title }} </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
