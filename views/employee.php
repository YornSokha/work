<script type="text/javascript">
    function goto_modify_page_by_id(id, type, formId) {
        let form = document.getElementById(formId);
        console.log(form);
        switch (type) {
            case 1:
                form.action = "CompanyController.php?type=edit&company_id="+id;
                break;
        }
        form.submit(); // Form submission
    }
</script>
<?php
if($form_state == "create_employee"){
	?>
<form action="EmployeeController.php" name="form_create" id="form_create" method="post">
	<input type="hidden" name="form_state" value="create_employee">
    <input type="hidden" name="company_id" value="<?php echo $company_id ?>">
	<h1>Create new employee</h1>
	<table>
		<tbody>
		<tr>
			<td>Employee Name:</td>
			<td><input type="text" name="employee_name" value="<?php echo isset($_POST["employee_name"]) ? $_POST['employee_name'] : '' ?>"></td>
		</tr><tr>
			<td>Surname:</td>
			<td><input type="text" name="employee_surname" value="<?php echo isset($_POST["employee_surname"]) ? $_POST['employee_surname'] : '' ?>"></td>
		</tr><tr>
			<td>Telephone:</td>
			<td><input type="text" name="employee_telephone" value="<?php echo isset($_POST["employee_telephone"]) ? $_POST['employee_telephone'] : '' ?>"></td>
		</tr>
		</tr><tr>
			<td>Salary:</td>
			<td><input type="text" name="employee_salary" value="<?php echo isset($_POST["employee_salary"]) ? $_POST['employee_salary'] : '' ?>"></td>
		</tr>
		</tbody>
	</table>
	<button type="submit" name="btn_register" value="register">Register</button>
<!--	<button type="submit" name="btn_return" value="return">Return</button>-->
	<button type="submit" onclick="goto_modify_page_by_id(<?php echo $company_id ?>, 1, 'form_create')" name="btn_return" value="return">Return</button>
</form>
<?php }elseif ($form_state = "edit_employee"){ ?>
    <form action="EmployeeController.php" name="form_edit" id="form_edit" method="post">
        <input type="hidden" name="form_state" value="edit_employee">
        <input type="hidden" name="company_id" value="<?php echo $company_id ?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <h1>Edit employee's profile</h1>
        <table>
            <tbody>
            <tr>
                <td>Employee Name:</td>
                <td><input type="text" name="employee_name" value="<?php echo isset($_POST["employee_name"]) ? $_POST['employee_name'] : '' ?>"></td>
            </tr><tr>
                <td>Surname:</td>
                <td><input type="text" name="employee_surname" value="<?php echo isset($_POST["employee_surname"]) ? $_POST['employee_surname'] : '' ?>"></td>
            </tr><tr>
                <td>Telephone:</td>
                <td><input type="text" name="employee_telephone" value="<?php echo isset($_POST["employee_telephone"]) ? $_POST['employee_telephone'] : '' ?>"></td>
            </tr>
            </tr><tr>
                <td>Salary:</td>
                <td><input type="text" name="employee_salary" value="<?php echo isset($_POST["employee_salary"]) ? $_POST['employee_salary'] : '' ?>"></td>
            </tr>
            </tbody>
        </table>
        <button type="submit" name="btn_register" value="register">Register</button>
        <!--	<button type="submit" name="btn_return" value="return">Return</button>-->
        <button type="submit" onclick="goto_modify_page_by_id(<?php echo $company_id ?>, 1, 'form_edit')" name="btn_return" value="return">Return</button>
    </form>
<?php } ?>
