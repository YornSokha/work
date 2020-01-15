<?php
if($form_state == "create_employee"){
	?>
<form action="EmployeeController.php" method="post">
	<input type="hidden" name="form_state" value="create_employee">
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
	<button type="submit" name="btn_return" value="return">Return</button>
</form>
<?php }?>