<?php 	include_once("../../../../wp-config.php");	global $wpdb;	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";	$results = $wpdb->get_results($sql);	// echo "<pre>"; print_r($results);die;	$db_ip = $results[0]->host;	$db_user = $results[0]->db_user;	$db_pass = $results[0]->password;	$db_name = $results[0]->db;	$con = mysql_connect($db_ip,$db_user,$db_pass);	if (!$con){		die('Could not connect: ' . mysql_error());	}	mysql_select_db($db_name, $con);		$id = $_REQUEST['id'];	// echo $url = plugin_dir_path( __FILE__ );	// echo $img = "select imagename from ".$wpdb->prefix."ntreisimages where id = '".$id."'";	// var_dump(file_exists(plugin_dir_path( __FILE__ )));	// echo "<pre>"; print_r($images[0]->imagename);die;		$sql = "DELETE FROM ntreisimages WHERE `id` = '".$id."'";	$list = mysql_query($sql); 	mysql_close($con);	?>