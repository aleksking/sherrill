<?php
	include_once("../../../../wp-config.php");
	global $wpdb;
	// echo "<pre>";print_r($_GET);die;
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);die;
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	
	$mlsid = $_REQUEST['mlsid'];
	$schldists = $_REQUEST['schldists'];
	$subdivsion = $_REQUEST['subdivsion'];
	if(!empty($schldists)){
		$scn_sql = "update ntreislist set schooldistrict = '".$schldists."' where MLS = '".$mlsid."'"; 
		//$res2 =  $wpdb->query($scn_sql);
		$agent = mysql_query($scn_sql); 
		echo "Updated School District..."; die;
	}else
	
	if(!empty($subdivsion)){
		$scn_sql = "update ntreislist set sub_division = '".$subdivsion."' where MLS = '".$mlsid."'"; 
		//$res2 =  $wpdb->query($scn_sql);
		$agent = mysql_query($scn_sql); 
		echo "Updated Sub Divisions..."; die;
	}
mysql_close($con); 			
?>