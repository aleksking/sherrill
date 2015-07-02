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
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	
$q = strtolower($_GET["q"]);
if (!$q) return;
$divisionsql = "select schooldistrict from ntreislist where schooldistrict LIKE  '".$q."%' group by schooldistrict order by schooldistrict asc";
// $divisionres = $wpdb->get_results($divisionsql); 
// echo "<pre>"; print_r($divisionres);
	$divisionsql = mysql_query($divisionsql); 
	while($row = mysql_fetch_assoc($divisionsql)){
		$divisionres[] = $row;
	}
$items =array();
foreach($divisionres as $divisions){
	// echo "<pre>";print_r($divisions->sub_division);
	$items[$divisions['schooldistrict']] = $divisions['schooldistrict'];
}

foreach ($items as $key=>$value) {
	if (strpos(strtolower($key), $q) !== false) {
		echo "$key|$value\n";
	}
}
mysql_close($con); 
// echo "<pre>"; print_r($items);
die;

?>