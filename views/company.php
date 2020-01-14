<script type="text/javascript">
    function goto_modify_page_by_id(id) {
        let form = document.getElementById('form_list');
        form.action = "CompanyController.php?type=edit&company_id="+id;
        form.submit(); // Form submission
    }
</script>
<?php
	
if($form_state == "create_company"){
	?>
	<form action="CompanyController.php" method="post">
		<input type="hidden" name="form_state" value="create_company">
		<h1>Create company</h1>
		<table>
			<tbody>
				<tr>
					<td>Company Name:</td>
					<td><input type="text" name="company_name" value="<?php echo isset($_POST["company_name"]) ? $_POST['company_name'] : '' ?>"></td>
				</tr><tr>
					<td>License:</td>
					<td><input type="text" name="company_license" value="<?php echo isset($_POST["company_license"]) ? $_POST['company_license'] : '' ?>"></td>
				</tr><tr>
					<td>Address:</td>
					<td><input type="text" name="company_address" value="<?php echo isset($_POST["company_address"]) ? $_POST['company_address'] : '' ?>"></td>
				</tr>
			</tbody>
		</table>
			<button type="submit" name="btn_register" value="register">Register</button>
	</form>
<?php
} elseif ($form_state == "list_company"){?>
    <style>
    table, tr, td{
        border: 1px solid black;
    }
</style>
	<form action="CompanyController.php" name="form_list" id="form_list" method="post">
		<h1>List Company</h1>
		<input type="hidden" name="form_state" value="list_company">
		<table>
			<thead>
				<th>Company name</th>
				<th>Address</th>
				<th>License</th>
				<th>Modify</th>
			</thead>
			<tbody>
            <?php foreach ($companies as $company){ ?>
                <tr>
                    <td><?php echo $company["name"] ?></td>
                    <td><?php echo $company["address"] ?></td>
                    <td><?php echo $company["license_no"]?></td>
                    <td><a href="#" onclick="goto_modify_page_by_id(<?php echo $company["id"] ?>)">Edit</a></td>
                    <input type="hidden" name="company_id" value="<?php echo $company["id"] ?>">
                </tr>  
            <?php } ?>
            </tbody>
		</table>
	</form>
<?php } elseif ($form_state == "edit_company"){?>
	<form action="CompanyController.php" method="post">
		<input type="hidden" name="form_state" value="edit_company">
		<h1>Create company</h1>
		<table>
			<tbody>
				<tr>
					<td>Company Name:</td>
					<td><input type="text" name="company_name" value="<?php echo isset($_POST["company_name"]) ? $_POST['company_name'] : '' ?>"></td>
				</tr><tr>
					<td>License:</td>
					<td><input type="text" name="company_license" value="<?php echo isset($_POST["company_license"]) ? $_POST['company_license'] : '' ?>"></td>
				</tr><tr>
					<td>Address:</td>
					<td><input type="text" name="company_address" value="<?php echo isset($_POST["company_address"]) ? $_POST['company_address'] : '' ?>"></td>
				</tr>
			</tbody>
		</table>
			<button type="submit" name="btn_register" value="register">Register</button>
			<button type="submit" name="btn_create_employee" value="create">Create employee</button>
	</form>
<?php }?>