<!-- <form method="post" id="sibling_data"> -->
<table class="table">
    <thead>
        <th>Degree</th>
        <th>Subject</th>
        <th>Board/Uni</th>
        <th>Passing Year</th>
        <th>Total Marks</th>
        <th>Obt.Marks</th>
        <th>%age</th>
        <th>Division</th>
    </thead>
    <tbody class="education_body">
        <!-- {{ request()->id }} -->
        <tr class="clone_education new_education">
            <td><select name="student_degree" id="qualification_id" class="form-control qualification_id student_degree">

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
                <input type="number" step="0.01" class="form-control percentage" id="percentage" name="percentage" placeholder="90.00">
            </td>
            <td>
                <input type="text" class="form-control division" id="division" name="division" placeholder="A+">
            </td>
            <td>
                <span class="fa fa-times-circle fa-2x text-danger btnRemoveEducation" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete This Record" aria-hidden="true" data-sibling='0'></span>
            </td>

        </tr>
    </tbody>
</table>
<span id="add_more_education_button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" class="fa fa-plus-circle fa-2x text-primary add_more_fee_heads text-end" data-bs-original-title="Add More Education">
</span>
<!-- <button type="button" id="add_more_education_button" class="btn btn-primary">Add More Education</button> -->
<!-- </form> -->