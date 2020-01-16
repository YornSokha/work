<script type="text/javascript">
    function goto_modify_page_by_id(id, type, formId) {
        let form = document.getElementById(formId);
        console.log(form);
        switch (type) {
            case 1:
                form.action = "CompanyController.php?type=edit&company_id="+id;
            break;
            case 2:
                form.action = "EmployeeController.php?type=edit&employee_id="+id;
            break;
            case 3:
                form.action = "EmployeeController.php?type=create";
            break
        }
        form.submit(); // Form submission
    }
</script>
<style>
    table, tr, td{
        border: 1px solid black;
    }
</style>
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
	<form action="CompanyController.php" name="form_list_company" id="form_list_company" method="post">
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
                    <td><a href="#" onclick="goto_modify_page_by_id(<?php echo $company["id"] ?>, 1, 'form_list_company')">Edit</a></td>
                    <input type="hidden" name="company_id" value="<?php echo $company["id"] ?>">
                </tr>  
            <?php } ?>
            </tbody>
		</table>
	</form>
<?php } elseif ($form_state == "edit_company"){?>
	<form action="CompanyController.php" name="form_list_employee" id="form_list_employee" method="post">
		<input type="hidden" name="form_state" value="edit_company">
		<input type="hidden" name="company_id" value="<?php echo $company_id ?>">
        <button type="submit" name="btn_quit" value="quit">Quit</button>
        <h1>Edit company</h1>
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
        <div>
            <button type="submit" name="btn_register" value="register">Register</button>
            <button type="button" onclick="goto_modify_page_by_id(null, 3, 'form_list_employee')" name="btn_create_employee" value="create">Create employee</button>
        </div>
        <div>
            <h3><u>List employee</u></h3>
            <?php if (count($employees) == 0) {?>
                <p>The company does not has any employees.</p>
            <?php }else{ ?>
                <table>
                    <thead>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Telephone</th>
                    </thead>
                    <tbody>
                    <?php foreach ($employees as $employee){ ?>
                        <tr>
                            <td><?php echo $employee["name"] ?></td>
                            <td><?php echo $employee["surname"] ?></td>
                            <td><?php echo $employee["telephone"] ?></td>
                            <td><?php echo $employee["telephone"] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
	</form>
<?php }?>