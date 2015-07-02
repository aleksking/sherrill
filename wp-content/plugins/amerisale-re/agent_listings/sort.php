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
	
	
	if($_REQUEST['page'] > 0){
		$limit = "limit ".$_REQUEST['page'];
	}else{
		$limit = '';
	}
	
	if($_REQUEST['by'] == 'listprice'){
		$order = "replace(listprice, ',', '')+0";
	}else{
		$order = $_REQUEST['by'];
	}
	$sql = "SELECT * FROM ntreislist WHERE `agentlist` = '".$_REQUEST['data']."' and delete_status = '0'  order by ".$order." ".$_REQUEST['order']." $limit ";
	// $result = $wpdb->get_results($sql); 
	$ntreislist = mysql_query($sql);
	$result = array();
	while($ntreislists = mysql_fetch_assoc($ntreislist)){
		$result[] = $ntreislists;
	}
	// echo "<pre>";print_r($result);
	
?>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
<script>
		function cancel(){
			location.reload();
		}
		function sort(){
			var by = $('#by').val();
			var order = $('#order').val();
			var page = $('#page').val();
			var datas = 'by='+by+'&order='+order+'&page='+page+'&data=<?php echo $_REQUEST['data']; ?>';
				$('.loading').html('Loading........');
			$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/sort.php",
				  data: datas,
				}).done(function(res) {  
					$('.loading').html(res);
				});
		}
    </script>
<style>
table
{
border-collapse:collapse; width: 100%;
}
table,th, tr
{
border: 1px solid #C0C0C0;
text-align:center;

}
.odd{
	background-color: #C0C0C0;
}
.control{float:left;width:100%;background-color: #8AADFF; height: 30px;}
#cancel{float:right;}
</style>
<div class="loading">
<table border="1">
  <tr>
    <th class="odd">No</th>
    <th class="odd">List No.</th>
    <th class="odd">MLS#</th>
    <th class="odd">Photos</th>
    <th class="odd">Listing Address</th>
    <th class="odd">City</th>
    <th class="odd">Zip</th>
    <th class="odd">Map</th>
    <th class="odd">Acre</th>
    <th class="odd">Listing Price</th>
    <th class="odd">BR</th>
    <th class="odd">Bath F-H</th>
    <th class="odd">Type</th>
  </tr>
  <?php 
	foreach($result as $key=>$list){
		if($list['is_manual_edit'] == 1){
			$add = $list['directions'];
		}else{
			$add = $lis['street_num']." ".$list['street_name']." ".$list['city']." ".$list['state']." ".$lis['county'];
		}
		
		$sql = "select imagename from ntreisimages where mlsnum= '".$list['MLS']."' limit 1";
		// $images = $wpdb->get_results($sql);
		$image = mysql_query($sql);
		$images = mysql_fetch_assoc($image);
		// echo "<pre>";print_r($images);
		$link = strstr($images['imagename'],  "http://");
		// var_dump($link);
		if(!$link){
			$image = plugins_url().'/amreiasale-re/uploads/'.$images['imagename'];
		}else{
			$image = $images['imagename'];
		} 
		if ($key % 2 == 0)
		  {
			$class= "even";
		  }
		  else
		  {
			$class= "odd";
		  }
		if(!empty($list->acres)){
			$acres = $list->acres;
		}else{
			$acres = '-';
		}
		echo '<tr>';
		echo '<td class='.$class.'>'.($key+1).'</td>';
		echo '<td class='.$class.'>'.$list['agentlist'].'</td>';
		echo '<td class='.$class.'><a target="_blank" href="'.get_bloginfo('url').'/viewproperty.php?mls='. $list['MLS'].'">'.$list['MLS'].'</a></td>';
		echo '<td class='.$class.'><img src='.$image.' alt="No Image" width="100px;"/></td>';
		echo '<td class='.$class.'>'.$add.'</td>';
		echo '<td class='.$class.'>'.$list['city'].'</td>';
		echo '<td class='.$class.'>'.$list['zipcode'].'</td>';
		echo '<td class='.$class.'><a target="_blank" href="'.get_bloginfo('url').'/propertyview/map-page?mlsnum='.$list['MLS'].'">Map</a></td>';
		echo '<td class='.$class.'>'.$acres.'</td>';
		echo '<td class='.$class.'>$'.number_format($list['listprice']).'</td>';
		echo '<td class='.$class.'>'.$list['block'].'</td>';
		echo '<td class='.$class.'>'.$list['bath_full']."-".$list['bath_hal'].'</td>';
		echo '<td class='.$class.'>'.$list['proptype'].'</td>';
		echo '</tr>';
	}
  ?>  
</table>
</div>