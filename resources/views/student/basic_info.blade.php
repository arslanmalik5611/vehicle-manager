<!-- <form method="post" id="form-data"> -->
<div class="row mb-3">
    <div class="col-md-4">
        <label for="reg_number" class="form-label"><span class=""></span> Reg. Number </label>
        <input type="text" class="form-control" id="reg_number" name="reg_number" readonly placeholder="To Be Autofill">
    </div>
    <div class="col-md-4">
        <label for="roll_no" class="form-label"><span class=""></span> Roll Number </label>
        <input type="text" class="form-control" id="roll_no" name="roll_no" readonly placeholder="To Be Autofill">
    </div>
    <div class="col-md-4">
        <label for="admission_date" class="form-label"><span class=""></span> Admission Date </label>
        <input type="text" class="form-control datepicker" id="admission_date" name="admission_date" value="<?= date('d/m/Y') ?>">
    </div>
</div>


<hr>
<div class="row mb-3">
    <!-- <blockquote>Basic Information</blockquote> -->
    <figure class="">
        <blockquote class="blockquote">
            <p>Basic Information</p>
        </blockquote>
        <figcaption class="blockquote-footer">
            Please fill in <cite title="Source Title">details below</cite>
        </figcaption>
    </figure>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-6">
                <label for="first_name" class="form-label"><span class=""></span> First Name </label>
                <input type="text" class="form-control" id="user_id" name="user_id" hidden>
                <input type="text" class="form-control" id="student_id" name="student_id" hidden>
                <input type="text" class="form-control" id="first_name" name="first_name">
            </div>
            <div class="col-md-6">
                <label for="father_name" class="form-label"><span class=""></span> Father Name </label>
                <input type="text" class="form-control" id="student_father_id" name="student_father_id" hidden>
                <input type="text" class="form-control" id="father_name" name="father_name">
            </div>
            <div class="col-md-6">
                <label for="gender" class="form-label"><span class=""></span> Gender </label>
                <select type="text" class="form-control" id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="cnic" class="form-label"><span class=""></span> Cnic </label>
                <input type="text" class="form-control" id="cnic" name="cnic" placeholder="33100-1234567-0">
            </div>
            <div class="col-md-6">
                <label for="dob" class="form-label"><span class=""></span> DOB </label>
                <input type="text" class="form-control datepicker" id="dob" name="dob">
            </div>
            <div class="col-md-6">
                <label for="domicile" class="form-label"><span class=""></span> Domicile </label>
                <input type="text" class="form-control" id="domicile" name="domicile">
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="imgUploadDiv ">
            <br>
            <img class="img-preview" width="100%">
            <input type="file" name="image" id="image2" class="form-control imgUpload">
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <label for="student_name_urdu" class="form-label"><span class=""></span> Student Name In Urdu </label>
        <input type="text" class="form-control" id="student_name_urdu" name="student_name_urdu">
    </div>
    <div class="col-md-4">
        <label for="father_name_urdu" class="form-label"><span class=""></span> Father Name In Urdu </label>
        <input type="text" class="form-control" id="father_name_urdu" name="father_name_urdu">
    </div>
    <div class="col-md-4">
        <label for="identification_marks" class="form-label"><span class=""></span> Mark of identification </label>
        <input type="text" class="form-control" id="identification_marks" name="identification_marks">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="father_name_urdu" class="form-label"><span class=""></span>Religion </label>
        <select class="form-control" name="religion" id="religion">
            <option value="muslim">Muslim</option>
            <option value="non_muslim">Non-Muslim</option>
        </select>
    </div>
    <div class="col-md-6 ">
        <label><span class=""></span> Speciality </label><br><br>
        <!-- <div class="form-check"> -->
        <input class="form-check-input speciality" type="checkbox" id="blind" value="blind" />
        <label class="form-check-label" for="Blind">Blind</label>

        <input class="form-check-input speciality" type="checkbox" id="handicap" value="handicap" />
        <label class="form-check-label" for="handicap">Handicap</label>

        <input class="form-check-input speciality" type="checkbox" id="prisoner" value="prisoner" />
        <label class="form-check-label" for="prisoner">Prisoner</label>

        <input class="form-check-input speciality" type="checkbox" id="board_employee" value="board_employee" />
        <label class="form-check-label" for="board_employee">Board Employee</label>
        <!-- </div> -->
    </div>
</div>

<hr>

<div class="row mb-3">
    <!-- <blockquote>Contact Information</blockquote> -->
    <figure class="">
        <blockquote class="blockquote">
            <p>Contact Information</p>
        </blockquote>
        <figcaption class="blockquote-footer">
            Please fill in <cite title="Source Title">details below</cite>
        </figcaption>
    </figure>
    <div class="col-md-6">
        <label for="phone" class="form-label"><span class=""></span> Phone(Primary) </label>
        <input type="text" class="form-control" id="phone" name="phone">
    </div>
    <div class="col-md-6">
        <label for="phone_secondary" class="form-label"><span class=""></span> Phone(Secondary) </label>
        <input type="text" class="form-control" id="phone_secondary" name="phone_secondary">
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label"><span class=""></span> Email(Primary) </label>
        <input type="text" class="form-control" id="email" name="email">
    </div>
    <div class="col-md-6">
        <label for="email_secondary" class="form-label"><span class=""></span> Email(Secondary) </label>
        <input type="text" class="form-control" id="email_secondary" name="email_secondary">
    </div>
    <div class="col-md-6">
        <label for="address" class="form-label"> Address(Permanent) </label>
        <input type="text" class="form-control" id="address" name="address">
    </div>
    <div class="col-md-2">
        <label for="city_id" class="form-label">City </label>
        <select type="text" class="form-control city_id" id="city_id" name="city_id">
        </select>
    </div>
    <div class="col-md-2">
        <label for="district" class="form-label">District </label>
        <input type="text" class="form-control" id="district" name="district">
    </div>
    <div class="col-md-2">
        <label for="tehsil" class="form-label"> Tehsil </label>
        <input type="text" class="form-control" id="tehsil" name="tehsil">
    </div>

    <div class="col-md-6">
        <label for="address_temporary" class="form-label"> Address(Temporary) </label>
        <input type="text" class="form-control" id="address_temporary" name="address_temporary">
    </div>
    <div class="col-md-2">
        <label for="address_temporary_city" class="form-label"><span class=""> City</span> </label>
        <select type="text" class="form-control city_id" id="city_id_temporary" name="city_id_temporary">
        </select>
    </div>
    <div class="col-md-2">
        <label for="district_temporary" class="form-label"> District </label>
        <input type="text" class="form-control" id="district_temporary" name="district_temporary">
    </div>
    <div class="col-md-2">
        <label for="tehsil_temporary" class="form-label"> Tehsil </label>
        <input type="text" class="form-control" id="tehsil_temporary" name="tehsil_temporary">
    </div>

</div>
<hr>
<div class="row mb-3">
    <figure class="">
        <blockquote class="blockquote">
            <p>Guardian Information</p>
        </blockquote>
        <figcaption class="blockquote-footer">
            Please fill in <cite title="Source Title">details below</cite>
        </figcaption>
    </figure>

    <div class="col-md-4">
        <label for="occupation" class="form-label"> Father Occupation</label>
        <input type="text" class="form-control" id="student_guardian_id" name="student_guardian_id" hidden>
        <input type="text" class="form-control" id="occupation" name="occupation">
    </div>
    <div class="col-md-4">
        <label for="income" class="form-label"> Father Income(Monthly) </label>
        <input type="text" class="form-control" id="income" name="income">
    </div>
    <div class="col-md-4">
        <label for="father_phone" class="form-label"> Father Phone </label>
        <input type="text" class="form-control" id="father_phone" name="father_phone">
    </div>
    <div class="col-md-4">
        <label for="father_email" class="form-label"> Father Email</label>
        <input type="text" class="form-control" id="father_email" name="father_email">
    </div>
    <div class="col-md-4">
        <label for="father_cnic" class="form-label"> Father CNIC </label>
        <input type="text" class="form-control" id="father_cnic" name="father_cnic" placeholder="33100-1234567-0">
    </div>
</div>
<hr>