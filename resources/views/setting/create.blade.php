@extends('layout.master')
@section('page_title','Setting')

<style>
    img {
        height: 400px;
    }
</style>
@section('content')
<div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
    <!-- <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create </h2>
            </div>
            <div>
                <a href="{{env('BASE_URL').'setting'}}" class="btn btn-outline-success btn-sm">Setting
                    List</a>
            </div>
        </div>
    </div> -->
    <div class="card-body">
        <form method="post" id="form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="imgUploadDiv ">
                        <label for="home_image" class="form-label"><span class="required"></span> Home Image </label>
                        <input type="file" name="home_image" id="image2" class="form-control imgUpload">
                        <img class="img-preview" width="100%" src="{{$Setting->home_image}}">
                    </div>
                </div>
            </div>
            <div class="row mb-3">

                <div class="col-md-6">
                    <label for="home_title" class="form-label"><span class="required"></span> Home Title </label>
                    <input type="text" class="form-control" id="home_title" name="home_title" placeholder="" value="{{$Setting->home_title}}">
                </div>
            </div>
            <div class="row mb-3">


                <div class="col-md-6">
                    <label for="name" class="form-label">Home Description </label>
                    <textarea name="home_description" id="home_description" class="tinymce">{{$Setting->home_description}}</textarea>
                </div>
            </div>


            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i class="fas fa-chevron-right ms-3 go-icon"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page_level_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#form-data").on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: api_url + "setting/update",
                type: "POST",
                data: formData,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        success_notify(data.message);

                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });
        $(document).on('change', '.imgUpload', function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewId = $(input).siblings('.img-preview');
                    $(previewId).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
@endsection