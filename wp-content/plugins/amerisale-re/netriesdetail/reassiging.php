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
	$off_code = $results[0]->agent_offcode;
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);	
	$splits = split('~',$_REQUEST['transfer']);
	 // $sql1 = "update ntreislist set agentlist='".$splits[0]."' , agent_name='".$splits[1]."' where agentlist = '".$_REQUEST['agent']."' "; 
	 $sql1 = "update ntreislist set agentlist='".$splits[1]."' , agent_name='".$splits[2]."' where MLS = '".$splits['0']."' AND officelist ='".$off_code."' "; 
$agent = mysql_query($sql1);
mysql_close($con); 		

echo "Successfully Updated the records";
?>