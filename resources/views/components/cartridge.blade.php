<div class="col-md-4 col-lg-3 mb-5">
    <a href="{{ URL::to('/cartridge/'.$cartData->slug) }}">
        <div class="card">
            <div class="cartridge-item">
                <div class="cartridge-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                    <div class="cartridge-item-caption-content text-center text-white">
                        <i class="fas fa-eye fa-3x"></i>
                    </div>
                </div>
{{--                {{$cartData->medias[0]->address}}--}}
                @if(isset($cartData->medias[0]))
                    @if(file_exists('uploads/'.$cartData->medias[0]->address))
                        <img class="img-fluid" src="{{ URL::asset('uploads/'.$cartData->medias[0]->address) }}" alt="" />
                    @else
                        <img class="img-fluid" src="{{ URL::asset('/images/no_img.png') }}" alt="" />
                    @endif
                @else
                    <img class="img-fluid" src="{{ URL::asset('/images/no_img.png') }}" alt="" />
                @endif
                <h5 class="text-center">{{$cartData->title}}</h5>
            </div>
        </div>
    </a>
</div>
