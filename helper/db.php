<?php
//	database
$host = "localhost";
$dbname = "work";
$user = "postgres";
$password = "allweb17";
$db_connection = pg_connect("host={$host} dbname={$dbname} user={$user} password={$password}");

// base form

//	function check page origin
function is_orogin($url){
	return isset($_REQUEST['url_origin'])&&$_REQUEST['url_origin']===$url;
}
?>