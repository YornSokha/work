<?php
include_once ("helper/validator.php");
include_once ("helper/db.php");
include_once ("helper/handler.php");

if ($_POST["form_state"] == "create_employee"){
	if (isset($_POST["btn_register"])){
		$validate_datas = ["name" => ["Employee name", $_POST["employee_name"], true],
			"surname" => ["Surname", $_POST["employee_surname"], true],
			"salary" =>["Salary", $_POST["employee_salary"], true, null, null, true]];
		$errors = validate($validate_datas);
		$employee_name = $_POST["employee_name"];
		$employee_surname = $_POST["employee_surname"];
		$telephone = $_POST["employee_telephone"];
		$salary = $_POST["employee_salary"];
		if($errors != ""){
			$form_state = "create_employee";
			$hidden_datas = ["employee_name" => $employee_name, "employee_surname" => $employee_surname, "employee_telephone" => $telephone, "employee_salary" => $salary];
			$action = "EmployeeController.php";
			include ("views/error.php");
		}
		$sql = "insert into employees(company_id, name, surname, telephone, salary) value ";
	}
}elseif (isset($_GET["type"]) && $_GET["type"] == "create"){
	$form_state = "create_employee";
	$company_id = $_REQUEST["company_id"];
	include ("views/employee.php");
	exit;
}elseif (isset($_GET["type"])){

}