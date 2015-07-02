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
	
	$sql = "select agent_license_no from agents where agent_offcode = '".$agent_offcode."'";
	$agent = mysql_query($sql); 
	while($row = mysql_fetch_assoc($agent)){
		$agent_ls[] =  $row;
	}
	
	$ids = array();
	foreach($agent_ls as $agent_idlist){
		$ids[] = $agent_idlist['agent_license_no'];
	}
	$ids = implode(',',$ids);
	
	$sql1 = "select * from ntreislist where agentlist IN(".$ids.") order by replace(listprice, ',', '')+0 desc limit 25";
	// $mlslist = $wpdb->get_results($sql1);
	$sql1 = mysql_query($sql1); 
	while($row = mysql_fetch_assoc($sql1)){
		$mlslist[] =  $row;
	}
	// echo "<pre>"; print_r($ids);
?>
<link rel="stylesheet" href="<?php echo plugins_url(); ?>/netriesdetail/css/style.css">
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    <script>
		function cancel(){
			location.reload();
		}
		function sort(){
			var by = $('#by').val();
			var order = $('#order').val();
			var page = $('#page').val();
			var datas = 'by='+by+'&order='+order+'&page='+page;
				$('.loading').html('Loading........');
			$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/sort.php",
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
<div class="control">
	<button type="button" onclick="sort();">Sort</button>
	<label>by:</label>
	<select name="by" id="by">
	  <option value="listprice">Price</option>
	  <option value="MLS">Mls</option>
	  <option value="agentlist">agent</option>
	  <option value="city">city</option>
	  <option value="zipcode">zip</option>
	  <option value="proptype">type</option>
	</select>
	
	<label>Order:</label>
	<select name="order" id="order">
	  <option value='desc'>Descending</option>
	  <option value='asc'>Asending</option>
	</select>
	
	
	<label>Listings Per page:</label>
	<select name="page" id="page">
	  <option value='25'>25</option>
		<option value='50'>50</option>
	  <option value='75'>75</option>
	  <option value='0'>all</option>
	</select>
	
	<button type="button" id="cancel" onclick="cancel();">Back to our Homepage</button>
</div>
<br clear="all" />
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
	foreach($mlslist as $key=>$list){
		if($list['is_manual_edit'] == 1){
			$add = $list['directions'];
		}else{
			$add = $list['street_num']." ".$list['street_name']." ".$list['city']." ".$list['state']." ".$list['county'];
		}
		
		$sql = "select imagename from ntreisimages where mlsnum= '".$list['MLS']."' limit 1";
		// $images = $wpdb->get_results($sql);
		$agent = mysql_query($sql); 
		$images = mysql_fetch_assoc($agent);	
	
		// echo "<pre>";print_r($images[0]->imagename);
		$link = strstr($images['imagename'],  "http://");
		// var_dump($link);
		if(!$link){
			$image = plugins_url().'/wp-ntreis/ntreis_images/'.$images[0]->imagename;
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
		$result = substr_count( $list['listprice'], ",") +1; 
			if($result > 1){
				//$listprice = "$ ".$values['listprice'];
				if($list['listprice'] == ''){
					$listprice = '-';
				}else{
					$listprice = "$".$list['listprice'];//money_format('%(#10n', $values['listprice']);  
				}
			}else{
				setlocale(LC_MONETARY, 'en_US');								
				// $listprice = money_format('%(#10n', $values['listprice']);
				$listprice =  preg_replace('/\.00/', '', money_format('%.2n', $list['listprice']));
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
		echo '<td class='.$class.'>'.$listprice.'</td>';
		echo '<td class='.$class.'>0</td>';
		echo '<td class='.$class.'>'.$list['bath_full']."-".$list['bath_half'].'</td>';
		echo '<td class='.$class.'>'.$list['proptype'].'</td>';
		echo '</tr>';
	}
	mysql_close($con); 
  ?>  
</table>
</div>