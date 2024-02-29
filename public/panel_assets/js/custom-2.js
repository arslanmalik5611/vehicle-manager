FeeHeadOptions = '';
sectionOptions = '';
subjectCombinationOptions = '';
feeStructureOptions = '';
campusOptions = '';
sectionOptions = '';
exenseHeadCustomOptions = '';
userCustomOptions = '';
exenseHeadOptions = '';
incomeHeadOptions = '';
incomeHeadCustomOptions = '';
FeeHeadCustomOptions = '';
exenseHeadOptionalOptions = '<option value="">Select Expense Head</option>';
incomeHeadOptionalOptions = '<option value="">Select Income Head</option>';
userOptionalOptions = '<option value="">Select Employee</option>';
userOptions = '';
campusOptionalOptions = '<option value="">Select Campus</option>';
roleOptionals = `<option value="">Select User</option>
                    <option value="all">All</option>`;
sectionOptionalOptions = '<option value="">Select Section</option>';
classOptionalOptions = '<option value="">Select Class</option>';
sessionOptionalOptions = '<option value="">Select Session</option>';
feeStructureOptionalOptions = '<option value="">Select Session</option>';
attendanceTypes = '';
roleOptions = '';
templateOptionals = '<option value="">Select Template</option>';
count = 0;

/*************************************
 * &SESSION OPTIONAL LOAD LIST& *
 * ***********************************/
function sessions_optional_load(selector = '#session_id') {
    $.ajax({
        url: api_url + `session/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                sessionOptionalOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(sessionOptionalOptions);
        }
    });
}


/*************************************
 * &CLASS OPTIONAL LIST& *
 * ***********************************/

function classes_optional_load(selector = '#class_id') {
    $.ajax({
        url: api_url + `classes`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                classOptionalOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(classOptionalOptions);
        }
    });
}

/*************************************
 * &FEE HEAD LIST& *
 * ***********************************/

function fee_heads_load(selector = '#fee_head_id') {
    $.ajax({
        url: api_url + `fee-heads`,
        dataType: "JSON",
        success: function (response) {
            FeeHeadOptions = '';
            response.data.forEach(function (data, i) {
                FeeHeadOptions += `<option value="${data.id}" data-id="${data.id}" data-name="${data.name}">${data.name}</option>`;
            });
            FeeHeadCustomOptions = FeeHeadOptions;
            $(selector).html(FeeHeadOptions);
        }
    });
}


/*************************************
 * &SECTION LIST& *
 * ***********************************/

function sections_load(selector = '#section_id') {
    $.ajax({
        url: api_url + `sections`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                sectionOptions += `<option value="${data.id}" data-id="${data.id}" data-name="${data.name}">${data.name}</option>`;
            });
            $(selector).html(sectionOptions);
        }
    });
}

/*************************************
 * &SECTION OPTIONAL LIST& *
 * ***********************************/

function sections_optional_load(selector = '#section_id') {
    $.ajax({
        url: api_url + `sections`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                sectionOptionalOptions += `<option value="${data.id}" data-id="${data.id}" data-name="${data.name}">${data.name}</option>`;
            });
            $(selector).html(sectionOptionalOptions);
        }
    });
}

/*************************************
 * &CAMPUS LIST& *
 * ***********************************/

function campuses_load(selector = '#campus_id') {
    $.ajax({
        url: api_url + `campus`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                campusOptions += `<option value="${data.id}" data-id="${data.id}" data-name="${data.name}">${data.name}</option>`;
            });
            $(selector).html(campusOptions);
        }
    });
}

/*************************************
 * &CAMPUS OPTIONAL LIST& *
 * ***********************************/

function campuses_optional_load(selector = '#campus_id') {
    $.ajax({
        url: api_url + `campus`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                campusOptionalOptions += `<option value="${data.id}" >${data.name}</option>`;
            });
            $(selector).html(campusOptionalOptions);
        }
    });
}

/*************************************
 * &SUBJECT COMBINATION LIST& *
 * ***********************************/

function subject_combinations_load(selector = '#subject_combination_id') {
    $.ajax({
        url: api_url + `subject-combinations`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                subjectCombinationOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(subjectCombinationOptions);
        }
    });
}

/*************************************
 * &FEE STRUCTURE LIST& *
 * ***********************************/

function fee_structures_load(selector = '#fee_structure_id') {
    $.ajax({
        url: api_url + `fee-structures`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                feeStructureOptions += `<option value="${data.id}">(${data.total_amount})${data.name}</option>`;
            });
            $(selector).html(feeStructureOptions);
        }
    });
}

function fee_structures_optional_load(selector = '#fee_structure_id') {
    $.ajax({
        url: api_url + `fee-structures`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                feeStructureOptionalOptions += `<option value="${data.id}">(${data.total_amount})${data.name}</option>`;
            });
            $(selector).html(feeStructureOptionalOptions);
        }
    });
}


/*************************************
 * &FEE STRUCTURE FUNCTIONS START& *
 * ***********************************/
function calaulate_total() {
    var totalAmount = 0;

    $('.amount').each(function () {
        totalAmount += parseFloat($(this).val());
    });
    return totalAmount;
}

function fee_structure_manage() {
    $(document).on('click', '#addMoreBtn', function (e) {
        e.preventDefault();
        var amount = $(this).parents('tr').find('.total-amount').val();
        var fee_head_name = $(this).parents('tr').find('.fee_head_id').select2().find(":selected").data("name");
        var fee_head_id = $(this).parents('tr').find('.fee_head_id').select2().find(":selected").data("id");
        // totalAmount += parseFloat(amount);
        // console.log(totalAmount)
        mainTr = `<tr>
                        <td> <input type="hidden" name="fee_head_id_input" class="fee_head_id_input" value="${fee_head_id}" data-id="${fee_head_id}"> ${fee_head_name}</td>
                        <td> <input type="number" name="amount" class="amount form-control" value="${amount}" data-amount="${amount}"></td>
                         <td><span class="removeBtn fa fa-times-circle fa-2x text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                         title="Delete This Row"></span></td>
</tr>
               `;
        $('.mainBody').append(mainTr);


        $('#totalShow').val(calaulate_total());
    });

    $(document).on('click', '.removeBtn', function (e) {
        e.preventDefault();
        $(this).parents('tr').remove();
        $('#totalShow').val(calaulate_total());
    });
}

/*************************************
 * &FEE STRUCTURE FUNCTIONS END& *
 * ***********************************/


function nav_bar_hide() {
    $("#nav-bar").addClass('show');
    $("#main-pd").addClass('main-pd');
}


/*************************************
 * &GENERATE PDF FUNCTION& *
 * ***********************************/
function generate_voucher_batch_no_pdf(value) {
    $.ajax({
        url: api_url + 'fee-vouchers/generate-voucher-pdf',
        data: {'batch_number': value},
        dataType: "JSON",
        success: function (response) {
            window.open(`${response.pdf_link}`, '_blank');
        }
    });
}

function generate_voucher_no_pdf(value) {
    $.ajax({
        url: api_url + 'fee-vouchers/generate-voucher-pdf',
        data: {'voucher_number': value},
        dataType: "JSON",
        success: function (response) {
            window.open(`${response.pdf_link}`, '_blank');
        }
    });
}


/*************************************
 * &GET ATTENDANCE TYPE LOAD FUNCTION& *
 * ***********************************/

function attendance_type_load() {
    count++;
    $.ajax({
        url: api_url + 'attendance-types',
        dataType: "JSON",
        success: function (response) {
            attendanceTypes = response.data;
            // $(response.data).each(function (i, data) {
            //     attendanceTypes += `
            //     <input type="radio" class="attendance_type_id btn btn-warning ${data.code}" value="${data.id}" name="attendance${count}">
            //             <span>${data.name}</span>
            //     `;
            // });
        }
    });
    return attendanceTypes;
}

/*************************************
 * &GET IMAGE PREVIEW FUNCTION& *
 * ***********************************/

function show_img(image = '#image', selector = '#picture') {
    $(document).on('change', selector, function () {

        var file = $(selector).get(0).files[0];
        if (file) {
            var reader = new FileReader();

            reader.onload = function () {
                $(image).attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    });
}

/****************************
 * &GET ROLE FUNCTION& *
 * *************************/
function role_load(selector = '#role_id', param = 'teacher,accountant,admin,campus_manager,staff') {
    $.ajax({
        url: api_url + `roles/get`,
        data: {'role': param},
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                roleOptions += `<option value="${data.id}" >${data.name}</option>`;
            });
            $(selector).html(roleOptions);
        }
    });
}

function optional_role_load(selector = '#role_id', param = 'student,teacher,accountant,admin,campus_manager,staff') {
    $.ajax({
        url: api_url + `roles/get`,
        data: {'role' : param},
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                roleOptionals += `<option value="${data.id}" >${data.name}</option>`;
            });
            $(selector).html(roleOptionals);
        }
    });
}
function email_template_load(selector = '#email_template_id') {
    $.ajax({
        url: api_url + `email-template`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                templateOptionals += `<option value="${data.id}" >${data.title}</option>`;
            });
            $(selector).html(templateOptionals);
        }
    });
}


/****************************
 * &GET EXPENSE HEAD FUNCTION& *
 * *************************/
function expense_head_load(selector = '.expense_head_id') {
    $.ajax({
        url: api_url + `expense-heads`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                exenseHeadOptions += `<option value="${data.id}" >${data.name}</option>`;
            });
            exenseHeadCustomOptions = exenseHeadOptions;
            $(selector).html(exenseHeadOptions);
        }
    });
}

/****************************
 * &GET USER SESSION FUNCTION& *
 * *************************/
function user_load(selector = '.user_session_id') {
    $.ajax({
        url: api_url + `users`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                userOptions += `<option value="${data.id}" >${data.user.first_name}</option>`;
            });
            userCustomOptions = userOptions;
            $(selector).html(userOptions);
        }
    });
}

/****************************************
 * &GET EXPENSE HEAD OPTIONAL FUNCTION& *
 * **************************************/
function expense_head_optional_load(selector = '.expense_head_id') {
    $.ajax({
        url: api_url + `expense-heads`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                exenseHeadOptionalOptions += `<option value="${data.id}" >${data.name}</option>`;
            });
            $(selector).html(exenseHeadOptionalOptions);
        }
    });
}

/****************************************
 * &GET USER SESSION OPTIONAL FUNCTION& *
 * **************************************/
function user_optional_load(selector = '.user_session_id') {
    $.ajax({
        url: api_url + `users`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                userOptionalOptions += `<option value="${data.id}" >${data.user.first_name}</option>`;
            });
            $(selector).html(userOptionalOptions);
        }
    });
}

/****************************
 * &GET INCOME HEAD FUNCTION& *
 * *************************/
function income_head_load(selector = '.income_head_id') {
    $.ajax({
        url: api_url + `income-heads`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                incomeHeadOptions += `<option value="${data.id}" >${data.name}</option>`;
            });
            incomeHeadCustomOptions = incomeHeadOptions;
            $(selector).html(incomeHeadOptions);
        }
    });
}


/****************************************
 * &GET INCOME HEAD OPTIONAL FUNCTION& *
 * **************************************/
function income_head_optional_load(selector = '.income_head_id') {
    $.ajax({
        url: api_url + `income-heads`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                incomeHeadOptionalOptions += `<option value="${data.id}" >${data.name}</option>`;
            });
            $(selector).html(incomeHeadOptionalOptions);
        }
    });
}
