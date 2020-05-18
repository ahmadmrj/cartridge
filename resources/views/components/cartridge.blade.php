<div class="col-md-4 col-lg-3 mb-5">
    <a href="{{ URL::to('/cartridge/'.str_slug($cartData->title)) }}">
        <div class="card">
            <div class="cartridge-item">
                <div class="cartridge-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                    <div class="cartridge-item-caption-content text-center text-white">
                        <i class="fas fa-eye fa-3x"></i>
                    </div>
                </div>
                @if(file_exists($cartData->picture))
                    <img class="img-fluid" src="{{ URL::asset($cartData->picture) }}" alt="" />
                @else
                    <img class="img-fluid" src="{{ URL::asset('/images/no_img.png') }}" alt="" />
                @endif

                <h5 class="text-center">{{$cartData->title}}</h5>
            </div>
        </div>
    </a>
</div>
