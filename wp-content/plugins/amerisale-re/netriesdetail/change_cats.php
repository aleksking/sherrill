<?php 
// echo "<pre>";print_r($_REQUEST);
include_once("../../../../wp-config.php");
	global $wpdb;
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
	
$sql1 = "update ntreislist set proptype='".$_REQUEST['type']."' where MLS = '".$_REQUEST['mls']."' "; 
$agent = mysql_query($sql1);
mysql_close($con); 		
echo "Successfully Updated the records";
?>