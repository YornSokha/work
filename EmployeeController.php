<?php
include_once ("helper/validator.php");
include_once ("helper/db.php");
include_once ("helper/handler.php");

if ($_POST["form_state"] == "create_employee"){
	if (isset($_POST["btn_register"])){
        $company_id = $_POST["company_id"];
        $employee_name = $_POST["employee_name"];
        $employee_surname = $_POST["employee_surname"];
        $telephone = $_POST["employee_telephone"];
        $salary = $_POST["employee_salary"];
		$validate_datas = [
		                    "name" => ["Employee name", $_POST["employee_name"], true],
			                "salary" =>["Salary", $_POST["employee_salary"], true, null, null, true]
        ];
		$errors = validate($validate_datas);
		if($errors != ""){
            $form_state = "create_employee";
            $hidden_datas = [
			                    "company_id" => $company_id,
                                "employee_name" => $employee_name,
                                "employee_surname" => $employee_surname,
                                "employee_telephone" => $telephone,
                                "employee_salary" => $salary
            ];
			$action = "EmployeeController.php";
			include ("views/error.php");
			unset($hidden_datas);
			exit;
		}
		$sql = "insert into employees(company_id, name, surname, telephone, salary) values($1, $2, $3, $4, $5) returning id;";
		$result = pg_prepare($db_connection, "query_insert_employee", $sql);
		$result = pg_execute($db_connection, "query_insert_employee", [$company_id, $employee_name, $employee_surname, $telephone, $salary]);
		if(!$result){
            $form_state = "create_employee";
            $action = "EmployeeController.php";
            $hidden_datas = ["company_id" => $company_id,
                "employee_name" => $employee_name,
                "employee_surname" => $employee_surname,
                "employee_telephone" => $telephone,
                "employee_salary" => $salary];
		    include ("views/error.php");
		    $errors = 'Error select employee';
		    unset($hidden_datas);
		    exit;
        }
		$form_state = "edit_employee";
		$action = "EmployeeController.php";
		$employee = pg_fetch_assoc($result);
		$hidden_datas = [
		                    "company_id" => $company_id,
                            "id" => $employee["id"]
        ];
		$message = "Employee has been registered successfully";
		include ("views/information.php");
		unset($hidden_datas);
	}elseif (isset($_POST["btn_return"])){
        $form_state = "create_employee";
        $company_id = $_POST["company_id"];
        $employee_name = $_POST["employee_name"];
        $employee_surname = $_POST["employee_surname"];
        $telephone = $_POST["employee_telephone"];
        $salary = $_POST["employee_salary"];
        include ("views/employee.php");
    }
}elseif ($_POST["form_state"] == "edit_employee"){
    if (isset($_POST["btn_ok"])){
        $form_state = "edit_employee";
        $company_id = $_POST["company_id"];
        $id = $_POST["id"];
        $sql = "select e.name, e.surname, e.telephone, e.salary from employees e where e.id = $1";
        $result = pg_prepare($db_connection, "query_select_by_id", $sql);
        $result = pg_execute($db_connection, "query_select_by_id", [$id]);
        if (!$result){
            $action = "EmployeeController.php";
            $hidden_datas = [
                                "company_id" => $company_id,
                                "id" => $id
            ];
            $errors = 'Error select employee';
            include ("views/error.php");
            unset($hidden_datas);
            exit;
        }
        $employee = pg_fetch_assoc($result);
        $_POST["employee_name"] = $employee["name"];
        $_POST["employee_surname"] = $employee["surname"];
        $_POST["employee_telephone"] = $employee["telephone"];
        $_POST["employee_salary"] = $employee["salary"];
		$hidden_datas = [
		                    "company_id" => $company_id, "
                            id" => $id
        ];
		include ("views/employee.php");
		unset($hidden_datas);
    }elseif (isset($_POST["btn_register"])){
        $form_state = "edit_employee";
        $id = $_POST["id"];
        $company_id = $_POST["company_id"];
        $employee_name = $_POST["employee_name"];
        $employee_surname = $_POST["employee_surname"];
        $telephone = $_POST["employee_telephone"];
        $salary = $_POST["employee_salary"];
        $validate_datas = [
                            "name" => ["Employee name", $employee_name, true],
                            "salary" =>["Salary", $salary, true, null, null, true, true]
        ];
        $errors = validate($validate_datas);
        if($errors != ""){
            $hidden_datas = [
                                "id" => $id,
                                "company_id" => $company_id,
                                "employee_name" => $employee_name,
                                "employee_surname" => $employee_surname,
                                "employee_telephone" => $telephone,
                                "employee_salary" => $salary];
            $action = "EmployeeController.php";
            include ("views/error.php");
            unset($hidden_datas);
            exit;
        }
        $sql = "update employees set name = $1, surname = $2, telephone = $3, salary = $4 where id = $5;";
        $result = pg_prepare($db_connection, "query_update_employee", $sql);
        $result = pg_execute($db_connection, "query_update_employee", [$employee_name, $employee_surname, $telephone, $salary, $id]);
        if(!$result){
            $hidden_datas = [
                                "id" => $id,
                                "company_id" => $company_id,
                                "employee_name" => $employee_name,
                                "employee_surname" => $employee_surname,
                                "employee_telephone" => $telephone,
                                "employee_salary" => $salary
            ];
            $errors = 'Error select employee';
            $form_state = "edit_employee";
            $action = "EmployeeController.php";
			include ("views/error.php");
			unset($hidden_datas);
            exit;
        }
        $action = "EmployeeController.php";
        $hidden_datas = [
                            "company_id" => $company_id,
                            "id" => $id
        ];
        $message = "Employee has been updated successfully";
        include ("views/information.php");
        unset($hidden_datas);
    }elseif (isset($_POST["btn_return"])){
    	$form_state = "edit_employee";
    	$id = $_POST["id"];
    	$company_id = $_POST["company_id"];
    	include ("views/employee.php");
	}
} elseif (isset($_GET["type"]) && $_GET["type"] == "create"){
	$form_state = "create_employee";
	$company_id = $_REQUEST["company_id"];
	include ("views/employee.php");
}