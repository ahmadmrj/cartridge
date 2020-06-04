<div class="w-100">
    <div class="form-row">
        <div class="form-group col-md-4 text-left">
            <label for="step_1" class="
                @if($label=='landing')
                    text-bold text-light
                @else
                    text-dark
                @endif">@if($label=='landing')۱.@endif برند</label>
            <select class="form-control" id="brand-select">
                <option value="" selected disabled>لطفا انتخاب کنید...</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" @if($brand->slug == $selected) selected @endif>{{ $brand->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4 text-left">
            <label for="step_2" class="
            @if($label=='landing')
                text-inactive
            @else
                text-dark
            @endif" id="family-label">@if($label=='landing')۲.@endif خانواده پرینتر</label>
            <select class="form-control" id="printer-family" name="printer_family">
                @if($families)
                    @foreach($families as $family)
                        <option value="{{ $family->id }}" @if($family->id == $selectedFamily) selected @endif>{{ $family->title }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group col-md-4 text-left">
            <label for="step_3" class="
            @if($label=='landing')
                text-inactive
            @else
                text-dark
            @endif" id="model-label">@if($label=='landing')۳.@endif مدل پرینتر</label>
            <select class="form-control" id="printer-model" name="printer_model">
                @if($printers)
                    @foreach($printers as $printer)
                        <option value="{{ $printer->id }}" @if($printer->slug == $selectedPrinter) selected @endif>{{ $printer->title }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#brand-select, #printer-family, #printer-model').select2();
            @if(is_null($selectedFamily))
                $('#printer-model').prop('disabled', true);
            @endif
            @if(is_null($selected))
                $('#printer-family').prop('disabled', true);
            @endif
            $('#brand-select').change(function () {
                $.get('family-list/' + $(this).val(), function (data) {
                    let familySelect = $('select[name="printer_family"]');
                    let familyLabel = $('#family-label');
                    familySelect.empty();
                    familySelect.append('<option value="" selected> لطفا انتخاب کنید... </option>');
                    $.each(data, function (key, value) {
                        familySelect.append('<option value="' + value.id + '">' + value.title + '</option>');
                    });
                    familySelect.prop('disabled', false);
                    familyLabel.addClass('text-bold');
                    familyLabel.removeClass('text-inactive');
                }, 'json')
            });

            $('#printer-family').change(function () {
                $.get('model-list/' + $(this).val(), function (data) {
                    let modelSelect = $('select[name="printer_model"]');
                    let modelLabel = $('#model-label');
                    modelSelect.empty();
                    modelSelect.append('<option value="" selected> لطفا انتخاب کنید... </option>');
                    $.each(data, function (key, value) {
                        modelSelect.append('<option value="' + value.id + '">' + value.title + '</option>');
                    });
                    modelSelect.prop('disabled', false);
                    modelLabel.addClass('text-bold');
                    modelLabel.removeClass('text-inactive');
                }, 'json')
            });
        });
    </script>
@endsection
