<?php 
	include_once("../../../../wp-config.php");
	global $wpdb;
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);die;
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$agent_offcode = $results[0]->agent_offcode;
	
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	
	
	$mls_id = $_REQUEST['mls_id'];
	$sql = "select MLS from ntreislist where MLS = '".$mls_id."'";
	// $Mlsid = $wpdb->get_results($sql);
	$sql1 = mysql_query($sql); 
	$Mlsid = mysql_fetch_assoc($sql1);
	
	// var_dump($Mlsid);
	if(!empty($Mlsid)){
		echo "1";
	}else{
		echo "0"; 
	}
?>