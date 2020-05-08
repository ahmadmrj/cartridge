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
                $('html, body').animate({
                    scrollTop: $("#cartridge").offset().top
                }, 2000);
            });
        });
    </script>
@endsection
