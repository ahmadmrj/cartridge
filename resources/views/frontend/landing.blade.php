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
    <form>
        <div class="form-row">
            <div class="form-group col-md-4 text-left">
                <label for="step_1" class="text-dark">۱. برند</label>
                <select class="form-control" id="brand-select">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4 text-left">
                <label for="step_2">۲. خانواده پرینتر</label>
                <input type="password" class="form-control" id="inputPassword4">
            </div>
            <div class="form-group col-md-4 text-left">
                <label for="step_3">۳. مدل پرینتر</label>
                <input type="password" class="form-control" id="inputPassword4">
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#brand-select').change(function () {
                $.get('family-list/'+$(this).val(),function (res) {
                    console.log(res);
                })
            })
        });
    </script>
@endsection
