<?php
include_once ("helper/validator.php");
include_once ("helper/db.php");
include_once ("helper/handler.php");
if(!isset($_POST["form_state"]) || $_POST["form_state"] == null){
	echo "NOT SET";
}else if($_POST["form_state"] == "index"){
	if(isset($_POST["btn_register"])){
		$form_state = "create_company";
		include("views/company.php");
		exit;
	}else{
		$form_state = "list_company";
		$sql = "SELECT c.id, c.name, c.address, c.license_no from companies c order by c.name";
		$result = pg_query($db_connection, $sql);
		if(!$result){
			$form_state = "index";
			$errors = '<p style="color: red; border: 1px solid red; font-size: 18px">Error select data</p>';
			$action = "CompanyController.php";
			include ("views/error.php");
			exit;
		}
		$companies = [];
		while($company = pg_fetch_assoc($result)){
			$companies[] = $company;
		}
//		echo  print_r($companies, true);
		include("views/company.php");
		exit;
	}
}else if($_POST["form_state"] == "create_company"){
	if(isset($_POST["btn_register"])) {
		$validate_datas = ["name" => ["Company name",$_POST["company_name"], true], "license" => ["License", $_POST["company_license"], false, 14, 14, true]];
		$errors = validate($validate_datas);
		if ($errors != ""){
			$form_state = "create_company";
			$hidden_datas = ["company_name" => $_POST["company_name"], "company_address" => $_POST["company_address"], "company_license" => $_POST["company_license"]];
			$action = "CompanyController.php";
			include ("views/error.php");
			unset($hidden_datas);
			exit;
		}
		$company_name = $_POST["company_name"];
		$company_license = $_POST["company_license"];
		$company_address = $_POST["company_address"];
		
		$sql = "INSERT INTO companies(name,address,license_no) VALUES($1,$2,$3) RETURNING id";
		$result = pg_prepare($db_connection, "query", $sql);
		$result = pg_execute($db_connection, "query", array($company_name,$company_address,$company_license));
		if(!$result){
			$form_state = "create_company";
			$errors = '<p style="color: red; border: 1px solid red; font-size: 18px">Error insert data</p>';
			$action = "CompanyController.php";
			include ("views/error.php");
			exit;
			
		}
		$form_state = "edit_company";
		$action = "CompanyController.php";
		$hidden_datas = ["company_id" => pg_fetch_assoc($result)['id']];
		$message = '<p>Company has been registered successfully.</p>';
		include ("views/information.php");
		exit;
	}elseif (isset($_POST["btn_return"])){
		$form_state = "create_company";
		include("views/company.php");
		exit;
	}
}else if($_POST["form_state"] == "edit_company") {
	if (isset($_POST["btn_ok"])) {
		$form_state = "edit_company";
		$company_id = $_POST["company_id"];
		$sql = "select c.name, c.address, c.license_no from companies c where id = $1";
		$result = pg_prepare($db_connection, "select_id_query", $sql);
		$result = pg_execute($db_connection, "select_id_query", [$company_id]);
		if (!$result) {
			$form_state = "edit_company";
			$errors = '<p style="color: red; border: 1px solid red; font-size: 18px">Error select data</p>';
			$action = "CompanyController.php";
			include("views/error.php");
			exit;
		}
		$company = pg_fetch_assoc($result);
		$_POST["company_name"] = $company['name'];
		$_POST["company_address"] = $company['address'];
		$_POST["company_license"] = $company['license_no'];
		
		$sql = "select e.id, e.name, e.surname, e.telephone, e.salary from employees e order by e.name";
		$result = pg_query($db_connection, $sql);
		$employees = [];
		while ($employee = pg_fetch_assoc($result)){
			$employees[] = $employee;
		}
		include("views/company.php");
	}
}elseif($_GET["type"] == "edit"){
	$form_state = "edit_company";
	$company_id = $_GET["company_id"];
	
	exit;
}else{
	echo "NOT OKAY";
}

?>