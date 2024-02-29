@extends('layout.master')
@section('page_title','Subject Edit')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-edit fa-icon"></i> Edit </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'subjects'}}" class="btn btn-outline-success btn-sm">Subject
                        List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label"><span class="required">*</span> Name </label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Enter Name" required>
                    </div>
                </div><!--End of row-->

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="code" class="form-label"> Subject Code </label>
                        <input type="text" class="form-control" id="code" name="code"
                               placeholder="Enter Subject Code">
                    </div>
                </div><!--End of row-->

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="short_name" class="form-label">Short Name </label>
                        <input type="text" class="form-control" id="short_name" name="short_name"
                               placeholder="Enter Short Name">
                    </div>
                </div><!--End of row-->

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Notes </label>
                        <textarea name="notes" id="notes" class="tinymce"></textarea>
                    </div>
                </div><!--End of row-->


                <div class="card-footer text-end">
                    <input type="hidden" value="{{ request()->id }}" name="id" id="id">
                    <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i
                            class="fas fa-chevron-right ms-3 go-icon"></i> <i
                            class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        var id = "{{ request()->id }}";

            $(document).ready(function () {
                $.ajax({
                    url: api_url + `subjects/${id}/show`,
                    dataType: "JSON",
                    success: function (response) {
                        $('#name').val(response.data.name);
                        $('#code').val(response.data.code);
                        $('#short_name').val(response.data.short_name);
                        // $('#notes').val(response.data.notes);
                        tinymce.get('notes').setContent(response.data.notes);
                    }
                });
            });

        $("#form-data").on('submit', function (e) {
            e.preventDefault();
            name = $("#name").val();
            short_name = $("#short_name").val();
            code = $("#code").val();
            notes = tinymce.get('notes').getContent();
            id = $('#id').val();
            $.ajax({
                url: api_url + "subjects/update",
                type: "POST",
                data: {'id': id, 'name' : name, 'short_name' : short_name, 'notes' : notes,  'code' : code },
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        success_notify(data.message)
                    } else {
                        error_notify(data.message);
                    }
                }
            });
        });

    </script>
@endsection

