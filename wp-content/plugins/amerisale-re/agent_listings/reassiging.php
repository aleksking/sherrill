<?php 
// echo "<pre>";print_r($_REQUEST);
include_once("../../../../wp-config.php");
	global $wpdb;
		$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	
	$splits = split('~',$_REQUEST['transfer']);
	$splits = $_REQUEST['transfer'];
	
		$agent = "SELECT Name,agent_license_no FROM agents WHERE agent_license_no = ".$_REQUEST['agent'] .""; 
		$agent = mysql_query($agent);
		$agent_ls = mysql_fetch_assoc($agent);
	 // $sql1 = "update ntreislist set agentlist='".$splits[0]."' , agent_name='".$splits[1]."' where agentlist = '".$_REQUEST['agent']."' "; 
	 // $sql1 = "update ntreislist set agentlist='".$splits[1]."' , agent_name='".$splits[2]."' where agentlist = '".$agent_ls['agent_license_no']."' and agent_name = '".$agent_ls['Name']."' "; 
		$sql1 = "update ntreislist set agentlist='".$agent_ls['agent_license_no']."' , agent_name='".$agent_ls['Name']."' where MLS IN(".$splits.") "; 
		$agent = mysql_query($sql1);
		// var_dump($agent);
		$count = "SELECT agentlist FROM ntreislist WHERE agentlist = '".$_REQUEST['agent_id'] ."'"; 
		$count = mysql_query($count);
		$count = mysql_num_rows($count);
		if($count <= 0){
			$sql = "DELETE FROM agents WHERE agent_license_no = '".$_REQUEST['agent_id']."'";
			$res2 = mysql_query($sql); 	
			
			$sql = "DELETE FROM ntreislist WHERE agentlist = '".$_REQUEST['agent_id']."'";
			$res2 = mysql_query($sql); 	
		}
	mysql_close($con); 
echo $count;
?>