<!-- <form method="post" id="sibling_data"> -->
<div class="row mb-3">
    <div class="col-md-6">
        <input type="text" id="enrollment_id" name="enrollment_id" hidden>
        <label for="campus_id" class="form-label"><span class=""></span> Campus</label>
        <select class="form-control" name="campus_id" id="campus_id"></select>


        <label for="session_id" class="form-label"><span class=""></span> Session </label>
        <select class="form-control" name="session_id" id="session_id"></select>


        <label for="section_id" class="form-label"><span class=""></span>Section </label>
        <select class="form-control" name="section_id" id="section_id"></select>


        <label for="group_id" class="form-label"><span class=""></span> Groups </label>
        <select class="form-control" name="group_id" id="group_id"></select>


        <label for="subject_combination_id" class="form-label"><span class=""></span> Subjects Combination </label>
        <select class="form-control" name="subject_combination_id" id="subject_combination_id"></select>


        <label for="class_id" class="form-label"><span class=""></span>Class</label>
        <select class="form-control" name="class_id" id="class_id"></select>



    </div>
    <div class="col-md-6 fee_head_append">
        <label for="fee_structure_id" class="form-label"><span class=""></span> Fee Structure <br><i class="fas fa-info-circle"></i><b>Hint: </b>Please enter only those fee heads that are recursive</label>
        <select class="form-control" name="fee_structure_id" id="fee_structure_id">
        </select>
        <table class="table table-hover">
            <thead>
                <th><strong  class="text-primary" style="font-size: 20px;">Fee Head</strong></th>
                <th ><strong class="text-primary" style="font-size: 20px;">Amount</strong></th>
                <th></th>
            </thead>
            <tbody class="fee_head_body">

            </tbody>
        </table>
        <!-- <button type="button" class="btn btn-primary add_more_fee_heads text-end">Add</button> -->
        <span id="addMoreBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add More Fee Head" class="fa fa-plus-circle fa-2x text-primary add_more_fee_heads text-end">
        </span>

    </div>
</div>