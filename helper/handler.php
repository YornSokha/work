<?php

function createHiddenInputs($hidden_datas = []){
	$inputs = "";
	foreach ($hidden_datas as $hidden_data => $data){
		$inputs .= '<input type="hidden" name="'.$hidden_data.'" value="'.$data.'" />';
	}
	return $inputs;
}