@extends('layouts.frontend')

@section('master-head')
    <!-- Masthead Avatar Image-->
    <img class="masthead-avatar mb-3" src="assets/img/tools-and-utensils.svg" alt="" />
    <!-- Masthead Heading-->
    <h4 class="masthead-heading mb-2">برای شروع، مدل پرینتر خودتون رو جستجو کنید...</h4>
    <!-- Icon Divider-->
    <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    <form class="w-100">
        <div class="form-row">
            <div class="form-group col-md-4 text-left">
                <label for="step_1" class="text-bold text-light">۱. برند</label>
                <select class="form-control" id="brand-select">
                    <option value="" selected disabled>لطفا انتخاب کنید...</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4 text-left">
                <label for="step_2" class="text-inactive" id="family-label">۲. خانواده پرینتر</label>
                <select class="form-control" id="printer-family" name="printer_family">
                </select>
            </div>
            <div class="form-group col-md-4 text-left">
                <label for="step_3" class="text-inactive" id="model-label">۳. مدل پرینتر</label>
                <select class="form-control" id="printer-model" name="printer_model">
                </select>
            </div>
        </div>
    </form>
@endsection

@section('cartridge-items')
    @foreach($cartridges as $cartridge)
        <div class="col-md-4 col-lg-3 mb-5">
            <div class="card h-100">
                <div class="cartridge-item" data-toggle="modal" data-target="#cartridgeModal"
                     data-label="{{$cartridge->title}}"
                     data-color="{{$cartridge->color}}"
                     data-page="{{$cartridge->page_yield}}"
                     data-picture="{{$cartridge->picture}}"
                >
                    <div class="cartridge-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="cartridge-item-caption-content text-center text-white">
                            <i class="fas fa-eye fa-3x"></i>
                        </div>
                    </div>
                    @if(file_exists($cartridge->picture))
                        <img class="img-fluid" src="{{ URL::asset($cartridge->picture) }}" alt="" />
                    @else
                        <img class="img-fluid" src="{{ URL::asset('/images/no_img.png') }}" alt="" />
                    @endif

                    <h5>{{$cartridge->title}}</h5>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('modal')
    <div class="cartridge-modal modal fade rtl" id="cartridgeModal" tabindex="-1" role="dialog" aria-labelledby="cartridgeModal1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- cartridge Modal - Title-->
                                <h5 class="cartridge-modal-title text-secondary mb-0">
                                </h5>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- cartridge Modal - Image-->
                                <img class="img-fluid rounded mb-1" src="" alt="" /><!-- cartridge Modal - Text-->
                                <p class="text-left">
                                    <strong>رنگ: </strong> <span id="modal-cartridge-color"></span><br>
                                    <strong>تعداد صفحه: </strong> <span id="modal-cartridge-page"></span>
                                </p>
                                <button class="btn btn-primary" href="#" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i> بستن
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#brand-select, #printer-family, #printer-model').select2();
            $('#printer-family, #printer-model').prop('disabled', true);
            $('#brand-select').change(function () {
                $.get('family-list/'+$(this).val(),function (data) {
                    let familySelect = $('select[name="printer_family"]');
                    let familyLabel = $('#family-label');
                    familySelect.empty();
                    familySelect.append('<option value="" selected> لطفا انتخاب کنید... </option>');
                    $.each(data, function(key, value) {
                        familySelect.append('<option value="'+ value.id +'">'+ value.title +'</option>');
                    });
                    familySelect.prop('disabled', false);
                    familyLabel.addClass('text-bold');
                    familyLabel.removeClass('text-inactive');
                },'json')
            });

            $('#printer-family').change(function () {
                $.get('model-list/'+$(this).val(),function (data) {
                    let modelSelect = $('select[name="printer_model"]');
                    let modelLabel = $('#model-label');
                    modelSelect.empty();
                    modelSelect.append('<option value="" selected> لطفا انتخاب کنید... </option>');
                    $.each(data, function(key, value) {
                        modelSelect.append('<option value="'+ value.id +'">'+ value.title +'</option>');
                    });
                    modelSelect.prop('disabled', false);
                    modelLabel.addClass('text-bold');
                    modelLabel.removeClass('text-inactive');
                },'json')
            });

            $('#printer-model').change(function () {
                $.get('cartridge-list/'+$(this).val(), function (data) {
                    let hbody = '';
                    $.each(data, function (key, value) {
                        hbody += '<div class="col-md-4 col-lg-3 mb-5">' +
                            '            <div class="card h-100">' +
                            '                <div class="cartridge-item" data-toggle="modal" data-target="#cartridgeModal1">' +
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

            $('#cartridgeModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget); // Button that triggered the modal
                let label = button.data('label'); // Extract info from data-* attributes
                let picture = button.data('picture');
                let color = button.data('color');
                let page = button.data('page');
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('.cartridge-modal-title').text(label);
                modal.find('#modal-cartridge-color').text(color);
                modal.find('#modal-cartridge-page').text(page);
                modal.find('.img-fluid').attr('src',picture);
            })
        });
    </script>
@endsection
