<div class="form-group col-md-12">
    <form method="post">
    <strong>{{ $field['label'] }}</strong> <br>
    <div class="dropzone sortable dz-clickable sortable">
        <div class="dz-message">
            Drop files here or click to upload.
        </div>
    </div>
    </form>
</div>

@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}

    @push('crud_fields_styles')
        <style>
            .sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; overflow: auto;}
            /*border: 1px SOLID #000;*/
            .sortable { margin: 3px 3px 3px 0; padding: 1px; float: left; /*width: 120px; height: 120px;*/ vertical-align:bottom; text-align: center; }
            .dropzone-thumbnail { width: 115px; cursor: move!important; }
            .dz-preview { cursor: move !important; }
        </style>
    @endpush

    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
        <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

        <script>
            Dropzone.autoDiscover = false;
            var uploaded = false;

            var dropzone = new Dropzone(".dropzone", {
                url: "{{ url($crud->route.'/'.$entry->id.'/'.$field['upload_route']) }}",
                paramName: '{{ $field['name'] }}',
                uploadMultiple: true,
                acceptedFiles: "{{ $field['mimes'] }}",
                // addRemoveLinks: true,
                // autoProcessQueue: false,
                maxFilesize: {{ $field['filesize'] }},
                parallelUploads: 10,
                // previewTemplate:
                sending: function(file, xhr, formData) {
                    formData.append("_token", $('[name=_token').val());
                    formData.append("id", {{ $entry->id }});
                },
                error: function(file, response) {
                    $(file.previewElement).find('.dz-error-message').remove();
                    $(file.previewElement).remove();
                },

                init: function() {
                    let myDropzone = this;

                    this.on("addedfile", function(file) {
                        var isChecked = file.isDefault == 1 ? 'checked' : '';
                        var removeButton = Dropzone.createElement('<a href="javascript:void(0);">حذف فایل</a>');
                        var defaultIndicator = Dropzone.createElement('<div class="mx-2"><input type="radio" name="default_img" value="" ' + isChecked + '><span> پیش فرض  </span><div>');

                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                            // Make sure the button click doesn't submit the form:
                            e.preventDefault();
                            e.stopPropagation();

                            // Remove the file preview.
                            _this.removeFile(file);
                            // If you want to the delete the file on the server as well,
                            $.ajax({
                                url: '{{ url($crud->route.'/'.$entry->id.'/'.$field['delete_route']) }}',
                                type: 'POST',
                                data: {
                                    image_id: file.path
                                },
                            });
                        });

                        defaultIndicator.addEventListener("click", function(e) {
                            $.ajax({
                                url: '{{ url($crud->route.'/'.$entry->id.'/'.$field['default_route']) }}',
                                type: 'POST',
                                data: {
                                    image_id: file.path
                                },
                            });
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                        file.previewElement.appendChild(defaultIndicator);
                    });

                    $.getJSON('/{{$field['display_route']}}/{{$entry->id}}', function(data) {
                        $.each(data, function(index, val){
                            console.log(val);
                            let mockFile = { name: val.id, path: val.pure_address, size: val.size, isDefault: val.is_default};
                            myDropzone.displayExistingFile(mockFile, val.address);
                        });
                    });
                }
            });

        </script>
    @endpush
@endif
