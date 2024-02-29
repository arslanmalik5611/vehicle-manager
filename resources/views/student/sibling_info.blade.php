<!-- <form method="post" id="sibling_data"> -->
<table class="table">
    <thead>
        <th>Name</th>
        <th>Relation</th>
        <th>Age</th>
        <th>Qualification</th>
        <th>Remarks</th>
    </thead>
    <tbody class="sibling_body">
        <tr id="" class="clone_siblings new_sibling">
            <td><input type="text" class="form-control sibling_name" id="sibling_name" name="sibling_name" autocomplete="off"></td>
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
                <select type="text" class="form-control qualification_id sibling_qualification" id="qualification_id" name="sibling_qualification">
                </select>
            </td>
            <td><input type="text" class="form-control sibling_remarks" id="remarks" name="sibling_remarks"></td>
            <td><span class="fa fa-times-circle fa-2x text-danger btnRemoveSibling" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete This Record" aria-hidden="true" data-sibling='0'></span></td>

        </tr>
    </tbody>
</table>
<span id="add_more_sibling_button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" class="fa fa-plus-circle fa-2x text-primary add_more_fee_heads text-end" data-bs-original-title="Add More Siblings">
        </span>