@extends('layout.master')
@section('page_title','Expense')

@section('content')
    <div class="card text-dark shadow-2 mb-3" style="max-width: 18rem;">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="text-info"><i class="fas fa-plus-circle fa-icon"></i> Create </h2>
                </div>
                <div>
                    <a href="{{env('BASE_URL').'expenses'}}" class="btn btn-outline-success btn-sm">Expense
                        List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" id="form-data">
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="date" class="form-label"><span class="required">*</span> Date </label>
                        <input type="text" class="form-control datepicker" id="date" name="date"
                               placeholder="dd\mm\YY" autocomplete="off">
                    </div>
                </div><!--End of row-->

                <div class="row mb-3">
                    <div class="col-12">
                        <table class="table table-striped table-bordered table-hover" id="">

                            <thead>
                            <tr>
                                <th>Add</th>
                                <th width="200">Expense</th>
                                <th>Additional Information</th>
                                <th>Amount</th>
                                <th>Employee</th>
                                <th width="200">Attachment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="expenseTableBody">
                            <tr class="expenseRow">
                                <td class="text-center">
                                    <span id="addMoreBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                          class="fa fa-plus-circle fa-2x text-primary"
                                          data-bs-original-title="Add More Row">
                                                    </span>
                                </td>
                                <td>
                                    <select name="expense_head_id[]" class="form-control expense_head_id"></select>
                                </td>
                                <td>
                                    <input type="text" name="notes[]" class="form-control notes"
                                           placeholder="Additional Information....">
                                </td>
                                <td>
                                    <input type="number" name="amount[]" class="form-control amount"
                                           placeholder="E.g. 50,100, 200">
                                </td>
                                <td>
                                    <select name="user_session_id[]" class="form-control user_session_id">


                                    </select>
                                </td>
                                <td>
                                    <input type="file" class="form-control attachment" name="attachment[]">
                                </td>
                                <td class="text-center">
                                    <span id="addMoreBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                          class="fa fa-plus-circle fa-2x text-primary"
                                          data-bs-original-title="Add More Row">
                                                    </span>
                                </td>

                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success mb-4 submit-btn">Save <i
                            class="fas fa-chevron-right ms-3 go-icon"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page_level_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            expense_head_load();
            user_load();
            nav_bar_hide();

            $("#form-data").on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: api_url + "expenses/store",
                    type: "POST",
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status) {
                            success_notify(data.message);

                        } else {
                            error_notify(data.message);
                        }
                    }
                });
            });

        });

        $(document).on('click', '#addMoreBtn', function (e) {
            e.preventDefault();
            var mainTr = `<tr class="expenseRow">
                                <td class="text-center">
                                    <span id="addMoreBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                          class="fa fa-plus-circle fa-2x text-primary"
                                          data-bs-original-title="Add More Row">
                                                    </span>
                                </td>
                                <td>
                                    <select name="expense_head_id[]" class="form-control expense_head_id">
                                    ${exenseHeadCustomOptions}
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="notes[]" class="form-control notes"
                                           placeholder="Additional Information....">
                                </td>
                                <td>
                                    <input type="number" name="amount[]" class="form-control amount"
                                           placeholder="E.g. 50,100, 200">
                                </td>
                                <td>
                                    <select name="user_session_id[]" class="form-control user_session_id">
                                    ${userCustomOptions}
                                    </select>
                                </td>
                                 <td>
                                    <input type="file" class="form-control attachment" name="attachment[]">
                                </td>
                                <td class="text-center">
                                    <span class="fa fa-times-circle fa-2x text-danger btnRemove" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete This Record"></span>
                                </td>
                            </tr>`;
            $('#expenseTableBody').append(mainTr);
        });

        $(document).on('click', '.btnRemove', function (e) {
            e.preventDefault();
            $(this).parents('tr').remove();
        });

        // GET FORM DATA
        // function getFormData() {
        //     var data = {
        //         'date' : $('#date').val(),
        //         'expenses': []
        //     }
        //
        //     $('.expenseRow').each(function () {
        //         expense = {
        //             'expense_head_id': $(this).find('.expense_head_id').val(),
        //             'notes': $(this).find('.notes').val(),
        //             'amount': $(this).find('.amount').val(),
        //             'user_session_id': $(this).find('.user_session_id').val(),
        //             'attachment': $(this).find('.attachment').val(),
        //         }
        //         data.expenses.push(expense);
        //     });
        //     return data;
        // }
    </script>
@endsection

