<div class="form-group col-md-12">
    <strong>{{ $field['label'] }}</strong> <br>
    <div class="dropzone sortable dz-clickable sortable">
        <div class="dz-message">
            Drop files here or click to upload.
        </div>
    </div>
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
                success : function(file, status) {

                    // clear the images in the dropzone
                    // $('.dropzone').empty();
                    // console.log(status);
                    // repopulate the dropzone with all images (new and old)
                    $.each(status.images, function(key, image_path) {
                        $('.dropzone').append('<div class="dz-preview" data-id="'+key+'" data-path="'+image_path+'"><img class="dropzone-thumbnail" src="{{ url('') }}/'+image_path+'" /><a class="dz-remove" href="javascript:void(0);" data-remove="'+key+'" data-path="'+image_path+'">Remove file</a></div>');
                    });

                    var notification_type;

                },
                init: function() {
                    let myDropzone = this;

                    this.on("addedfile", function(file) {

                        var removeButton = Dropzone.createElement('<a href="javascript:void(0);">حذف فایل</a>');

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
                                    image_id: file.name,
                                    image_path: file.path
                                },
                            });
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });

                    $.getJSON('/cartridge-media-list/{{$entry->id}}', function(data) {
                        $.each(data, function(index, val){
                            let mockFile = { name: val.id, size: val.size };
                            myDropzone.displayExistingFile(mockFile, val.address);
                        });
                    });
                }
            });

            {{--// Delete image--}}
            {{--$('.dz-remove').click(function () {--}}
            {{--    alert('asdf');--}}
            {{--    var image_id = $(this).data('remove');--}}
            {{--    var image_path = $(this).data('path');--}}

            {{--    $.ajax({--}}
            {{--        url: '{{ url($crud->route.'/'.$entry->id.'/'.$field['delete_route']) }}',--}}
            {{--        type: 'POST',--}}
            {{--        data: {--}}
            {{--            entry_id: {{ $entry->id }},--}}
            {{--            image_id: image_id,--}}
            {{--            image_path: image_path--}}
            {{--        },--}}
            {{--    })--}}
            {{--        .done(function(status) {--}}
            {{--            let notification_type;--}}

            {{--            if (status.success) {--}}
            {{--                notification_type = 'success';--}}
            {{--                $('div.dz-preview[data-id="'+image_id+'"]').remove();--}}
            {{--            } else {--}}
            {{--                notification_type = 'error';--}}
            {{--            }--}}

            {{--        });--}}

            {{--});--}}

        </script>

    @endpush
@endif
