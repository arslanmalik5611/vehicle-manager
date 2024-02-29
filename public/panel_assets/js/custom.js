var paymentMethodOptions = "";
var paymentMethodOptionsLoad = "";
var paymentMethodResponse = "";
classOptions = "";
campusOptions = "";
subjectOptions = "";
sessionOptions = "";
capmusesOptions = "";
groupOptions = "";
subjectTr = "";
cityOptions = "";
qualificationOptions = "";
qualificationIdOptions = "";
qualificationAppendOptions = "";
fee_head_body = "";
classOptionsLoad = `<option value="all">Select Class</option>`;
var cloneEducation = "";
var cloneSibling = "";
/*************************************
 * &CLASS LIST& *
 * ***********************************/
function clone_education() {
    cloneEducation = `<tr class="new_education">
            <td><select name="student_degree" id="qualification_id" class="form-control qualification_append_id student_degree">

                </select></td>
            <td><input type="text" class="form-control subject" id="subject" name="subject"></td>
            <td>
                <input type="text" class="form-control university" id="university" name="university">
            </td>
            <td>
                <input type="number" class="form-control passing_year" id="passing_year" name="passing_year" placeholder="2022">
            </td>
            <td>
                <input type="number" class="form-control total_marks" id="total_marks" name="total_marks" placeholder="1100">
            </td>
            <td>
                <input type="number" class="form-control obtained_marks" id="obtained_marks" name="obtained_marks" placeholder="960">
            </td>
            <td>
                <input type="number"   step="0.01" class="form-control percentage" id="percentage" name="percentage" placeholder="90.00">
            </td>
            <td>
                <input type="text" class="form-control division" id="division" name="division" placeholder="A+">
            </td>
            <td>
                <span class="fa fa-times-circle fa-2x text-danger btnRemoveEducation" data-bs-toggle="tooltip" data-bs-placement="bottom"
                title="Delete This Record"></span>
            </td>

        </tr>`;
    $(".education_body").append(cloneEducation);
}
function clone_sibling() {
    cloneSibling = `<tr id="" class="new_sibling">

        <td><input type="text" class="form-control sibling_name" id="sibling_name" name="sibling_name"></td>
        <td>
            <select type="text" class="form-control sibling_relation" id="sibling_relation" name="sibling_relation">
                <option value="brother">Brother</option>
                <option value="sister">Sister</option>
            </select>
        </td>
        <td>
            <input type="number" class="form-control sibling_age" id="sibling_age" name="sibling_age">

        </td>
        <td>
            <select type="text" class="form-control qualification_append_id sibling_qualification" id="qualification_id" name="sibling_qualification">
            </select>
        </td>
        <td><input type="text" class="form-control sibling_remarks" id="remarks" name="sibling_remarks"></td>
        <td><span class="fa fa-times-circle fa-2x text-danger btnRemoveSibling" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete This Record" aria-hidden="true" data-sibling='0'></span></td>

    </tr>`;
    $(".sibling_body").append(cloneSibling);
}

function payment_method_load(selector = ".payment_method") {
    $.ajax({
        url: api_url + `payment-method`,
        dataType: "JSON",
        success: function (response) {
            paymentMethodResponse = response.data;
            return paymentMethodResponse;
            response.data.forEach(function (data, i) {
                paymentMethodOptions += `<option class="payment_method_${data.id}" value="${data.id}">${data.name}</option>`;
            });
            return paymentMethodOptions;
            $(selector).append(add_fee_head_body);
            // $(selector).html(paymentMethodOptions);
        },
    });
}
// function payment_method_option_load(row2) {
//     // payment_method_load();
//     // console.log('arslan');
//     // console.log(paymentMethodResponse);
//     // paymentMethodOptionsLoad = paymentMethodOptions;
//     paymentMethodResponse.forEach(function (i, data, row, meta) {
//         paymentMethodOptions += `<option class="payment_method payroll_id_${row2.payroll.id}" value="${row.id}">${row.name}</option>`;
//     });
//     return paymentMethodOptions;
// }

function class_load(selector = "#class_id") {
    $.ajax({
        url: api_url + `classes`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                classOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(classOptions);
        },
    });
}

function class_option_load(selector = "#class_id") {
    $.ajax({
        url: api_url + `classes`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                classOptionsLoad += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(classOptionsLoad);
        },
    });
}

/*************************************
 * &GROUP LIST& *
 * ***********************************/
function group_load(selector = "#group_id") {
    $.ajax({
        url: api_url + `groups`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                groupOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(groupOptions);
        },
    });
}

/*************************************
 * &Subject checkbox& *
 * ***********************************/
function subject_load(selector = "#subjectIdBody") {
    $.ajax({
        url: api_url + `subjects`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                subjectTr += `
                <tr>
                <td><input type="checkbox" name="subject" class="subject_id" value="${data.id}"></td>
                <td><p>${data.name}</p></td>
</tr>`;
            });
            $(selector).html(subjectTr);
        },
    });
}

/*************************************
 * &CAMPUSTYPE DROPDOWN& *
 * ***********************************/
function campus_type(selector = "#campus_type_id") {
    $.ajax({
        url: api_url + `campus-types/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                campusOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(campusOptions);
        },
    });
}

function capmuses_load(selector = "#campus_id") {
    $.ajax({
        url: api_url + `campus/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                capmusesOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(capmusesOptions);
        },
    });
}

/*************************************
 * &SUBJECTDROPDOWN LIST& *
 * ***********************************/
function subjects_dropdown(selector = "#subject_id") {
    $.ajax({
        url: api_url + `subjects/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                subjectOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(subjectOptions);
        },
    });
}

/*************************************
 * &SESSION LOAD LIST& *
 * ***********************************/
function session_load(selector = "#session_id") {
    $.ajax({
        url: api_url + `session/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                sessionOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(sessionOptions);
        },
    });
}

/*************************************
 * &City LOAD LIST& *
 * ***********************************/
function city_load(selector = ".city_id") {
    $.ajax({
        url: api_url + `city/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                cityOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(cityOptions);
        },
    });
}

function qualification_load(selector = ".qualification_id") {
    $.ajax({
        url: api_url + `qualifications/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                qualificationOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(qualificationOptions);
        },
    });
}

function qualification_edit_load(selector = ".qualification_id") {
    $.ajax({
        url: api_url + `qualifications/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                qualificationIdOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            return qualificationIdOptions;
        },
    });
}

function qualification_append_load(selector = ".qualification_append_id") {
    qualificationAppendOptions = "";

    $.ajax({
        url: api_url + `qualifications/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                qualificationAppendOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html("");
            $(selector).html(qualificationAppendOptions);
        },
    });
}

function get_multiple_values(selector) {
    var data = [];
    $("." + selector).each(function () {
        var values = $(this).val();
        data.push(values);
    });
    return data;
}

function get_multiple_checkboxes(selector) {
    var data = [];
    $("." + selector).each(function () {
        var values = $("input[type='checkbox']").val();
        data.push(values);
    });
    // data[selector] = data;
    return data;
}

function groups_load(selector = "#group_id") {
    $.ajax({
        url: api_url + `groups/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                groupOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(groupOptions);
        },
    });
}

function class_load(selector = "#class_id") {
    $.ajax({
        url: api_url + `classes/`,
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (data, i) {
                classOptions += `<option value="${data.id}">${data.name}</option>`;
            });
            $(selector).html(classOptions);
        },
    });
}

function fee_structure_head_load(selector, id) {
    $.ajax({
        url: api_url + `fee-structures/` + id + "/show",
        dataType: "JSON",
        success: function (response) {
            // fee_head_append
            if (response.status == true) {
                fee_head_body = "";
                $("tbody.fee_head_body").empty();
                var data = response.data;
                // console.log(data.fee);
                data.fee_structure_detail.forEach(function (data, i) {
                    fee_head_body += `<tr>

                    <td>${data.fee_head.name}</td>
                    <td style="display: none"><input class="form-control fee_head_id" type="text" name="fee_head_id" id="fee_head_id" value="${data.fee_head.id}" hidden/></td>
                    <td><input class="form-control amount" type="text" name="amount" id="amount" value="${data.amount}"/></td>
                    <td>
                        <span class="fa fa-times-circle fa-2x text-danger btnRemoveFeeHeadStructure" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete This Record" aria-hidden="true" data-sibling="0"></span></td>
                    </tr>`;
                });
                $("tbody.fee_head_body").html(fee_head_body);
            } else {
                fee_head_body = "";
                $("tbody.fee_head_body").html(fee_head_body);
            }
        },
    });
}

function add_fee_structure_head() {
    $.ajax({
        url: api_url + `fee-heads/`,
        dataType: "JSON",
        success: function (response) {
            // fee_head_append
            if (response.status == true) {
                var data = response.data;
                var fee_head_options = "";
                data.forEach(function (data, i) {
                    fee_head_options += `
                        <option value="${data.id}">${data.name}</option>
                    `;
                });
                add_fee_head_body = `<tr>

                    <td><select class="form-control fee_head_id">${fee_head_options}</select></td>

                    <td><input class="form-control amount" type="text" name="amount" id="amount" /></td>
                    <td><span class="fa fa-times-circle fa-2x text-danger btnRemoveFeeHeadStructure" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete This Record" aria-hidden="true" data-sibling="0"></span></td>
                    </tr>`;

                $("tbody.fee_head_body").append(add_fee_head_body);
            }
        },
    });
}

function next_slide() {
    // var events_wrapper = $(".events-wrapper a.selected").attr("data-date");
    var event_content = $(".events-content .selected").attr("data-date");
    if (event_content < 05) {
        $(".events-wrapper")
            .find(`a[data-date=${event_content}]`)
            .removeClass("selected")
            .addClass("older-event");

        $(".events-content")
            .find(`li[data-date=${event_content}]`)
            .removeClass("selected");

        var event_content2 = ("0" + (Number(event_content) + Number(01))).slice(
            -2
        );

        $(".events-wrapper ")
            .find(`a[data-date=${event_content2}]`)
            .addClass("selected");

        $(".events-content ")
            .find(`li[data-date=${event_content2}]`)
            .addClass("selected");
    } else {
        return event_content;
    }
}

function next_sec_slide(sec) {
    // var events_wrapper = $(".events-wrapper a.selected").attr("data-date");
    if (sec < 06) {
        $(".events-wrapper")
            .find("a")
            .removeClass("selected")
            .addClass("older-event");

        $(".events-content").find(`li`).removeClass("selected");

        $(".events-wrapper ")
            .find(`a[data-date=${sec}]`)
            .addClass("selected")
            .removeClass("older-event");

        $(".events-content ").find(`li[data-date=${sec}]`).addClass("selected");
    } else {
        return sec;
    }
}

function get_selected_slide() {
    // var events_wrapper = $(".events-wrapper a.selected").attr("data-date");

    // event.preventDefault();
    var selected_slide = $(".events-content .selected").attr("data-date");
    return selected_slide;
    if (event_content < 04) {
        $(".events-wrapper")
            .find(`a[data-date=${event_content}]`)
            .removeClass("selected")
            .addClass("older-event");

        $(".events-content")
            .find(`li[data-date=${event_content}]`)
            .removeClass("selected");

        var event_content2 = ("0" + (Number(event_content) + Number(01))).slice(
            -2
        );

        $(".events-wrapper ")
            .find(`a[data-date=${event_content2}]`)
            .addClass("selected");

        $(".events-content ")
            .find(`li[data-date=${event_content2}]`)
            .addClass("selected");
    } else {
        return event_content;
    }
}

function getBase64(file) {
    var reader = new FileReader();
    var r2 = reader.readAsDataURL(file);
    reader.onload = function () {
        //   console.log(reader.result);
    };
    reader.onerror = function (error) {
        console.log("Error: ", error);
    };
    console.log(reader.result);
    // return reader.result;
}

function studentDataTableLoad(class_id = "") {
    if (class_id) {
        $("#datatable").DataTable().destroy();
        if (class_id == "all") var class_id = "";
    }
    var count = 0;
    var cols = [
        {
            title: "SN",
            render: function (data, type) {
                return ++count;
            },
        },

        {
            title: "Image",
            render: function (data, type, row, meta) {
                return `<span><img src="${row.user.picture_url??base_url+'panel_assets/images/student.jpg'}" style="width: 100px"/></span>`;
            },
        },

        {
            title: "Name",
            render: function (data, type, row, meta) {
                return `<a href="${base_url}student/${row.id}/detail" text-white" target="_blank" title="Student Detail"
                > ${row.user.first_name} </a> `;
            },
        },

        {
            title: "Father Name",
            render: function (data, type, row, meta) {
                return row.user.father_name;
            },
        },

        {
            title: "Email",
            render: function (data, type, row, meta) {
                return row.user.email;
            },
        },

        {
            title: "Phone",
            render: function (data, type, row, meta) {
                return row.user.phone;
            },
        },

        {
            title: "Class",
            render: function (data, type, row, meta) {
                return row.enrollment.student_class.name;
            },
        },

        {
            title: "Section",
            render: function (data, type, row, meta) {
                return row.enrollment.section.name;
            },
        },

        {
            title: "Admission At",
            render: function (data, type, row, meta) {
                return row.admission_at_formatted;
            },
        },

        {
            title: "Action",
            data: "id",
            render: function (data, type, row, meta) {
                var actionBtns = "";
                actionBtns += `<a target="_blank" href="${base_url}student/${row.id}/detail" class="btn btn-info btn-sm btn-clean btn-icon text-white mb-1" title="Student Detail"
                            > <i class="fa fa-eye"></i> </a> `;
                actionBtns += `<a href="${base_url}student/${row.id}/edit?section=basic_information" class="btn btn-info btn-sm btn-clean btn-icon text-white mb-1" title="Edit Record"
                            > <i class="fa fa-edit"></i> </a> `;

                actionBtns += `<a href="${base_url}student/summary?id=${row.id}&key=summary" data-id="${row.id}" data-method='' class="studentGenerateBtn btn-info btn btn-sm btn-clean text-white btn-icon" target="_blank" title="Generate Student Summary">
                                <i class="fa fa-print"></i>
                            </a>`;
                actionBtns += `<a href="javascript:;" data-id="${row.id}" data-method='' class="cardGenerateBtn btn-success btn btn-sm btn-clean btn-icon ms-2" title="Generate Card">
                               <i class="fa fa-id-card"></i>
                            </a>`;
                return actionBtns;
            },
        },
    ];

    $.ajax({
        url: api_url + "student",
        data: {
            class_id: class_id ?? "",
        },
        dataType: "JSON",
        success: function (dataSet) {
            $("#datatable").DataTable({
                dom: "Bflrtip",
                buttons: ["copy", "csv", "pdf", "print"],
                data: dataSet.data,
                columns: cols,
            });
        },
    });
}

function calculate_salary() {
    var salary = $(this).parents("tr").find(".salary").attr("data-salary");
    var arrears = $(this).val();
    var deduction = $(this).parents("tr").find(".deduction").val();
    var net_payable = Number(salary) + Number(arrears) - Number(deduction);
    $(this).parents("tr").find(".net_payable").val(net_payable);
}

function copyTd(e) {
    var clickedCell = $(e.target).closest("td");
    navigator.clipboard.writeText(clickedCell.text());
    success_notify("Copied!");
}
