<?php
/* $dbhost = "localhost";
$dbuser = "joker";
$dbpass = "12345";
$dbname = "joker"; */

	include_once("../../../../wp-config.php");
	global $wpdb;
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);die;
	$dbhost = $results[0]->host;
	$dbuser = $results[0]->db_user;
	$dbpass = $results[0]->password;
	$dbname = $results[0]->db;
	$agent_offcode = $results[0]->agent_offcode;
	
	
	
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);
?>