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
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		  mysql_select_db($db_name, $con);

	
	$sql = "DELETE FROM agents WHERE agent_license_no = '".$_REQUEST['agent']."'";
	$res2 = mysql_query($sql); 
	
	$sql = "DELETE FROM ntreislist WHERE agentlist = '".$_REQUEST['agent']."'";
	$res2 = mysql_query($sql); 	
	mysql_close($con);
	
	// Reset DB Conn
	mysql_select_db(DB_NAME);
?>