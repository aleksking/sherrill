<!DOCTYPE html>
<title>Real Estate- Map Page</title>
<style>
head,body{margin:0px;padding:0px;background-color: #000;}
.mapcontnt{margin: 0 auto;width:500px;}
.searchcon{margin:0px auto;width:10%;}
.searchcon span{ font-size: 30px;
    font-weight: bold;color:#fff;}
</style>
<div class="mappart" style="width:100%">

<div class="maptop_con">
  <div class="searchcon">
		<br clear="all" /><br />
		<span> MAP </span>
  </div>
</div>
<?php
session_start();
$mlsid = $_SESSION['mlsnum'];



global $wpdb;
	
	$mlsid = $_SESSION['mlsnum'];
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);
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
	$sql = "select * from  ntreislist where MLS= ".$mlsid." limit 1";
	// $results = $wpdb->get_results($sql);
	$results = mysql_query($sql); 
	$resvar = mysql_fetch_assoc($results);
	mysql_select_db(DB_NAME); 
	$area = $resvar['area'];
	// var_dump($area);
	if($resvar['is_manual_edit'] == 1){
		$address = $resvar['directions']." ".$resvar['city'].", TX, USA";
	}else if($resvar['is_manual_edit'] == 0 || $resvar['is_manual_edit'] == 2){
		$address = $resvar['street_num'].' '.$resvar['street_name'].', '.$resvar['city'].', '.$resvar['state'].' '.$resvar['zipcode'].' ,'.$resvar['county'];
	}else{
		$address = '';
	} 
		$add = urlencode($address);
		
		$jsondata=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add.'&sensor=false');

		$output= json_decode($jsondata);
		// echo "<pre>";
		// print_R($output);
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;

		// echo "Latitude : ".$latitude;
		// echo "Longitude : ".$longitude;
		
	?>
	<div class="map" style="float:left; width:100%">
	<div class="mapcontnt">
	  <table cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td>
				<!--<iframe src="http://www.map-generator.net/extmap.php?name=Spot&amp;address=<?php echo $address; ?>" width="500" height="450" marginwidth="0" marginheight="0" frameborder="0" scrolling="no"></iframe>-->
				<iframe width="500" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?q=<?php echo $add; ?>&amp;oe=utf-8&amp;client=firefox-a&amp;hnear=<?php echo $add; ?>&amp;gl=in&amp;t=m&amp;ie=UTF8&amp;hq=&amp;ll=<?php echo $latitude; ?>,<?php echo $longitude; ?>&amp;spn=0.011111,0.01929&amp;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.co.in/maps?q=<?php echo $add; ?>&amp;oe=utf-8&amp;client=firefox-a&amp;hnear=<?php echo $add; ?>&amp;gl=in&amp;t=m&amp;ie=UTF8&amp;hq=&amp;ll=30.181186,-96.928545&amp;spn=0.011111,0.01929&amp;z=14&amp;source=embed" style="color:#0000FF;text-align:left" target="_blank">View Larger Map</a></small>
			</td>
		</tr>
		<tr>
			<td align="right">
				<a style="font:8px Arial;text-decoration:none;cursor:default;color:#5C5C5C;" href="http://www.map-generator.net">map-generator.net</a>
			</td>
		</tr>
		</table><!-- Do not change code! -->
	</div>
	</div>
	
	
	
	<!--<iframe src="http://www.map-generator.net/extmap.php?name=Spot&amp;address=235%20Southeast%207th%20Street,%20Grants%20Pass,%20OR%2097526&amp;width=614&amp;height=244&amp;maptype=map&amp;zoom=14&amp;hl=en&amp;t=1298011905" width="614" height="244" scrolling="no"></iframe>
-->
	
	<!--<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=<?php echo $latitude; ?>,<?php echo $longitude; ?>&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=<?php echo $latitude; ?>,<?php echo $longitude; ?>&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>-->
</div>

</html>