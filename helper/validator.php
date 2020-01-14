<?php

function validateInput($name, $value, $required = false, $maxLength = null, $minLength = null, $positive = false){
	$error = "";
	if ($required){
		if (!isset($value) || $value == "")
			$error .= " is required";
	}
	if ($maxLength){
		if (strlen((string)$value) > $maxLength){
			$error .= " max length". $maxLength;
		}
	}
	if ($minLength){
		if (strlen((string)$value) < $minLength){
			$error .= " min length ". $minLength;
		}
	}
	if (is_numeric($value) && $positive){
		if($value < 0){
			$error .= " must be a positive number";
		}
	}
	if($error != ""){
		$error = '<p style="color: red; border: 1px solid red; font-size: 18px">'.$name . $error.'</p>';
	}
	return $error;
}

function validate($validate_datas = []){
	$errors = "";
	foreach ($validate_datas as $validate_data){
		print_r($validate_data, true);
		$errors .= validateInput(...$validate_data);
	}
	return $errors;
}