
// if (token == '' || token == undefined) {
//     window.location = base_url + 'login';
// }

var token = localStorage.getItem('user_token');
if (token == '' || token == undefined) {
    window.location = base_url + 'login';
}


$(document).on('click', '.logout', function () {
    localStorage.removeItem("user_token");
    localStorage.removeItem("patient_token");
    window.location = base_url + 'login';
});

/*REFORMATE DB DATA FOR DATEPICKER*/
function reformatDatePickerDate(dateStr) {
    if (dateStr) {
        dArr = dateStr.split("-");  // ex input "2010-01-18"
        return dArr[2] + "/" + dArr[1] + "/" + dArr[0]; //ex out: "30/10/21"
    } else {
        return '';
    }
}

function reformatDatePickerDateTime(dateStr) {
    if (dateStr) {
        dArr = dateStr.split(" ")[0];  // ex input "2010-01-18"
        dArr = dArr.split("-");
        tArr = dateStr.split(" ")[1];  // ex input "22:10:00"
        tArr = tArr.split(":");
        return dArr[2] + "/" + dArr[1] + "/" + dArr[0] + ' ' + tArr[0] + ':' + tArr[1]; //ex out: "30/10/21 22:10"
    } else {
        return '';
    }
}

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

function ajax_setup() {
    $.ajaxSetup({
        headers: {
            'Authorization': 'Bearer ' + token,
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json'
    });
}

function select2_load() {
    $('.select2').select2();
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
}

function tinymce_initialize(height = 400, selector=".tinymce") {
    /*INITIALIZE TINYMCE*/
    tinymce.init({
        selector: selector,
        plugins: 'code fullpage textcolor textcolor colorpicker emoticons preview',
        toolbar: 'code fullpage textcolor forecolor backcolor emoticons preview fontsizeselect ',
        cleanup: false,
        height: height
    });
}

function datetimepicker_load() {
    $('.datepicker').datetimepicker({
        format: 'd/m/Y',
        timepicker: false,
        timepickerScrollbar: false,
        scrollInput: false,
    });

    $('.datetimepicker').datetimepicker({
        format: 'd/m/Y H:i',
        timepickerScrollbar: false,
        scrollInput: false,
    });
}

function references_load() {
    /*************************************
     * &REFERENCE LIST& *
     * ***********************************/
    var referencesOptions = '';
    $.ajax({
        url: api_url + 'reference',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (reference, id) {
                referencesOptions += `<option value="${reference.id}">${reference.name}</option>`;
            });
            $("#reference_id").html(referencesOptions);
        }
    });
}

function references_optional_load() {
    /*************************************
     * &REFERENCE LIST& *
     * ***********************************/
    var referencesOptions = `<option value=''></option>`;
    $.ajax({
        url: api_url + 'reference',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (reference, id) {
                referencesOptions += `<option value="${reference.id}">${reference.name}</option>`;
            });
            $("#reference_id").html(referencesOptions);
        }
    });
}

function collection_centers_load() {
    /*************************************
     * &COLLECTION CENTER LIST& *
     * ***********************************/
    var collectionCenterOptions = '';
    $.ajax({
        url: api_url + 'collection-center',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (collection_center, id) {
                collectionCenterOptions += `<option value="${collection_center.id}">${collection_center.name}</option>`;
            });
            $("#collection_center_id").html(collectionCenterOptions);
        }
    });
}

function collection_centers_optional_load() {
    /*************************************
     * &COLLECTION CENTER OPTIONAL LIST& *
     * ***********************************/
    var collectionCenterOptions = `<option value=''></option>`;
    $.ajax({
        url: api_url + 'collection-center',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (collection_center, id) {
                collectionCenterOptions += `<option value="${collection_center.id}">${collection_center.name}</option>`;
            });
            $("#collection_center_id").html(collectionCenterOptions);
        }
    });
}

function employees_load() {
    /*************************************
     * &EMPLOYEES LIST& *
     * ***********************************/
    var employeesOptions = '';
    $.ajax({
        url: api_url + 'user',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (employee, id) {
                employeesOptions += `<option value="${employee.id}">${employee.username} (${employee.email})</option>`;
            });
            $("#employee_id").html(employeesOptions);
        }
    });
}

function employees_optional_load() {
    /*************************************
     * &EMPLOYEES LIST& *
     * ***********************************/
    var employeesOptions = `<option value=''></option>`;
    $.ajax({
        url: api_url + 'user',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (employee, id) {
                employeesOptions += `<option value="${employee.id}">${employee.username} (${employee.email})</option>`;
            });
            $("#employee_id").html(employeesOptions);
        }
    });
}

function countries_load(excludeDefaultSelection = '') {
    /*************************************
     * &COUNTRIES LIST& *
     * ***********************************/
    var countriesOptions = '';
    $.ajax({
        url: api_url + 'countries',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (country, id) {
                var selected = '';
                if (excludeDefaultSelection == '') {
                    if (country.iso == 'GB')
                        selected = `selected="selected"`;
                    else
                        selected = '';
                }
                countriesOptions += `<option value="${country.id}" ${selected}>${country.name}</option>`;
            });
            $(".country_id").html(countriesOptions);
        }
    });
}

function labs_load() {
    /*************************************
     * &LABS LIST& *
     * ***********************************/
    var labsOptions = '';
    $.ajax({
        url: api_url + 'lab',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (lab, id) {
                labsOptions += `<option value="${lab.id}">${lab.name}</option>`;
            });
            $("#lab_id").html(labsOptions);
        }
    });
}

function archives_load() {
    /*************************************
     * &ARCHIVES LIST& *
     * ***********************************/
    var archivesOptions = '';
    $.ajax({
        url: api_url + 'archive',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (archive, id) {
                archivesOptions += `<option value="${archive.id}">${archive.title}</option>`;
            });
            $(".archive_id").html(archivesOptions);
        }
    });
}

function sample_types_load() {
    /*************************************
     * &SAMPLE TYPES LIST& *
     * ***********************************/
    var sampleTypesOptions = '';
    $.ajax({
        url: api_url + 'sample-type',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (sample_type, id) {
                sampleTypesOptions += `<option value="${sample_type.id}">${sample_type.name}</option>`;
            });
            $("#sample_type_id").html(sampleTypesOptions);
        }
    });
}

function test_categories_load() {
    /*************************************
     * &TEST CATEGORIES LIST& *
     * ***********************************/
    var testCategoryOptions = '';
    $.ajax({
        url: api_url + 'test-category',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (test_category, id) {
                testCategoryOptions += `<option value="${test_category.id}">${test_category.name}</option>`;
            });
            $("#test_category_id").html(testCategoryOptions);
        }
    });
}

function roles_load() {
    /*************************************
     * &SAMPLE TYPES LIST& *
     * ***********************************/
    var rolesOptions = '';
    $.ajax({
        url: api_url + 'role',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (role, id) {
                var selected = '';
                if (role.role_key == 'collection_center')
                    selected = "selected";
                rolesOptions += `<option value="${role.id}" ${selected}>${role.name}</option>`;
            });
            $("#role_id").html(rolesOptions);
        }
    });
}

function item_types_load() {
    /*************************************
     * &ITEM TYPE LIST& *
     * ***********************************/
    var itemTypesOptions = '';
    $.ajax({
        url: api_url + 'item-type',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (itemtype, id) {
                itemTypesOptions += `<option value="${itemtype.id}">${itemtype.name}</option>`;
            });
            $("#item_type_id").html(itemTypesOptions);
        }
    });
}

function item_units_load() {
    /*************************************
     * &ITEM UNIT LIST& *
     * ***********************************/
    var itemUnitsOptions = '';
    $.ajax({
        url: api_url + 'item-unit',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (unit, id) {
                itemUnitsOptions += `<option value="${unit.id}">${unit.name}</option>`;
            });
            $("#item_unit_id").html(itemUnitsOptions);
        }
    });
}

function suppliers_load() {
    /*************************************
     * &SUPPLIERS LIST& *
     * ***********************************/
    var suppliersOptions = '';
    $.ajax({
        url: api_url + 'supplier',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (supplier, id) {
                suppliersOptions += `<option value="${supplier.id}">${supplier.name}</option>`;
            });
            $("#supplier_id").html(suppliersOptions);
        }
    });
}

function suppliers_optional_load() {
    /*************************************
     * &REFERENCE LIST& *
     * ***********************************/
    var suppliersOptions = `<option value=''></option>`;
    $.ajax({
        url: api_url + 'supplier',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (supplier, id) {
                suppliersOptions += `<option value="${supplier.id}">${supplier.name}</option>`;
            });
            $("#supplier_id").html(suppliersOptions);
        }
    });
}

function document_type_load(selector = '#document_type_id') {
    /*************************************
     * &DOCUMENT TYPE LIST& *
     * ***********************************/
    var documentTypeOption = '';
    $.ajax({
        url: api_url + 'document-types',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (document_type, id) {
                documentTypeOption += `<option value="${document_type.id}">${document_type.name}</option>`;
            });
            $(selector).html(documentTypeOption);
        }
    });
}

function document_type_optional_load(selector = '#document_type_id') {
    /*************************************
     * &DOCUMENT TYPE LIST& *
     * ***********************************/
    var documentTypeOption = `<option value=''>Choose type</option>`;
    $.ajax({
        url: api_url + 'document-types',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (document_type, id) {
                documentTypeOption += `<option value="${document_type.id}">${document_type.name}</option>`;
            });
            $(selector).html(documentTypeOption);
        }
    });
}

function document_status_load(selector = '#document_status_id') {
    /*************************************
     * &DOCUMENT STATUS LIST& *
     * ***********************************/
    var documentStatusOption = '';
    $.ajax({
        url: api_url + 'document-statuses',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (document_status, id) {
                documentStatusOption += `<option value="${document_status.id}">${document_status.name}</option>`;
            });
            $(selector).html(documentStatusOption);
        }
    });
}

function block_page(selector = '.card-body') {
    $(selector).waitMe({
        effect: 'bounce',
        text: 'Processing',
        bg: 'rgba(255,255,255,0.7)',
        color: '#000',
        maxSize: '',
        waitTime: -1,
        textPos: 'vertical',
        fontSize: '',
        source: '',
    });
}

function unblock_page(selector = '.card-body') {
    $(selector).waitMe('hide');
}

$(document).ajaxStart(function () {
    block_page();
});

$(document).ajaxComplete(function () {
    unblock_page();
});

var can_delete = can_edit = can_view_timeline = false;

function user_menus_load() {
    /*************************************
     * &USER MENUS LOAD& *
     * ***********************************/
    $.ajax({
        url: api_url + 'user/menus',
        dataType: "JSON",
        type: "POST",
        success: function (response) {
            if (response.data != null) {
                response.data.forEach(function (menu, id) {
                    edit_view_name = view_name.split('.')[0] + `.edit`;
                    delete_view_name = view_name.split('.')[0] + `.delete`;
                    timeline_view_name = view_name.split('.')[0] + `.timeline`;
                    if (delete_view_name == menu) {
                        can_delete = true;
                    }
                    if (edit_view_name == menu) {
                        can_edit = true;
                    }
                    if (timeline_view_name == menu) {
                        can_view_timeline = true;
                    }
                    menu = menu.replace('.', `\\.`);
                    $(`.${menu}`).show().parents('.has-menu').show();
                });
            }
        }
    });
}

function menu_permission_check() {
    if (view_name == 'home.index') {
        return true;
    }
    /*************************************
     * &MENU PERMISSION CHECK& *
     * ***********************************/
    $.ajax({
        url: api_url + 'user/menu-permission',
        dataType: "JSON",
        type: "POST",
        data: {'menu_key': view_name},
        success: function (response) {
            if (!response.data) {
                Lobibox.notify('error', {
                    size: 'mini',
                    sound: false,
                    msg: 'You do not have permissions to open this file'
                });
                // window.location = base_web_url + 'home';
            }
        }
    });
}

$(document).on('change', '#title', function () {
    var males = ['Mr.'];
    var females = ['Mrs.', 'Miss.', 'Ms.'];
    if (males.includes($(this).val())) {
        $('#gender').val('male').change();
    } else if (females.includes($(this).val())) {
        $('#gender').val('female').change();
    }
});

function is_collection_center(selector = '#collection_center_div') {
    /*************************************
     * &IS COLLECTION CENTER CHECK& *
     * ***********************************/
    $.ajax({
        url: api_url + 'auth/is_collection_center',
        dataType: "JSON",
        method: 'POST',
        success: function (response) {
            if (!response.isCollectionCenter) {
                $(selector).show();
            }
        }
    });
}

function me() {
    $.ajax({
        url: api_url + "user/me",
        type: "GET",
        dataType: "JSON",
        success: function (response) {
            if (response.status) {
                $('#first_name').val(response.data.first_name);
                $('#last_name').val(response.data.last_name);
                $('#phone').val(response.data.phone);
                $('#phone_no').val(response.data.phone);
                $('#email').val(response.data.email);
                $('#address').val(response.data.address);
                $('#dob').val(reformatDatePickerDate(response.data.dob));
            }
        }
    });
}

function success_notify(message) {
    Lobibox.notify('success', {
        size: 'mini',
        sound: false,
        msg: message
    });
}

function error_notify(message) {
    Lobibox.notify('error', {
        size: 'mini',
        sound: false,
        msg: message
    });
}
var campusOptions = '';
function campus_load(selector = "#campus_id") {
    /*************************************
     * &CAMPUS LOAD LIST& *
     * ***********************************/
    $.ajax({
        url: api_url + 'campus',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (campus, id) {
                campusOptions += `<option value="${campus.id}">${campus.name}</option>`;
            });
            $(selector).html(campusOptions);
        }
    });
}

var campusTypeOptions = '';

function campus_type_load(selector = "#campus_type_id") {
    /*************************************
     * &CAMPUS TYPE LOAD LIST& *
     * ***********************************/
    var testCategoryOptions = '';
    $.ajax({
        url: api_url + 'campus-types',
        dataType: "JSON",
        success: function (response) {
            response.data.forEach(function (campus_type, id) {
                campusTypeOptions += `<option value="${campus_type.id}">${campus_type.name}</option>`;
            });
            $(selector).html(campusTypeOptions);
        }
    });
}

function tinymce_initialize_new() {
    /*INITIALIZE TINYMCE*/
    tinymce.init({
        selector: '.tinymce',
        plugins: 'code fullpage textcolor textcolor colorpicker emoticons preview',
        toolbar: 'code fullpage textcolor forecolor backcolor emoticons preview fontsizeselect ',
        cleanup: false,
        height: '100',
    });
}
