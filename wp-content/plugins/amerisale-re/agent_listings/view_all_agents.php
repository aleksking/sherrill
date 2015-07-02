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
	
/* 	$sql = "select agent_license_no,Name,email_address,officephone,pager from ".$wpdb->prefix."agents order by Name desc limit 25 ";
	$results = $wpdb->get_results($sql); */
	
	$sql = "SELECT DISTINCT agent_license_no,Name,email_address,officephone,pager from agents where agent_offcode = '".$agent_offcode."' order by Name desc limit 25";
	$agent = mysql_query($sql); 
	while($agentsql = mysql_fetch_assoc($agent)){
		$resulting[] = $agentsql;
	}
	// echo "<pre>";print_r($resulting);die;
	/* 	$sql1 = "select agentlist from ".$wpdb->prefix."ntreislist where agentlist= '0577911'";
		$counts = $wpdb->get_results($sql1); */
		// vat_dump(count($counts));
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
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/sort_listing.php",
				  data: datas,
				}).done(function(res) {  
					$('.loading').html(res);
				});
		}
		function view_ifos(ids){
			$('#addagent').html("Loading................");
			$('#addagent').load("<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/view_listing.php?data="+ids);
			
		}
	function view_list_ifo(ids,c){	
		if(c > 0){
			$('#addagent').html("Loading................");
			$('#addagent').load("<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/agent_listings/view_all_listing.php?data="+ids);
		}else{
			alert('No Listing in this Agent...');return false;
		}
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
	  <option value="Name">Name</option>
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
    <th class="odd">ID</th>
    <th class="odd">Name</th>
    <th class="odd">Listings</th>
    <th class="odd">Email</th>
    <th class="odd">Office</th>
    <th class="odd">Pager</th>
  </tr>
  <?php 

	foreach($resulting as $key=>$list){
		$sql1 = "select agentlist from ntreislist where agentlist= '".$list['agent_license_no']."'";
		$agents = mysql_query($sql1);
		$row = mysql_num_rows($agents);
		/* while($row = mysql_fetch_assoc($agents)){
			$counts[] = $row;
		} */
			
		// var_dump($row);
		/* $counts = $wpdb->get_results($sql1); */
		// $count = count($counts);
		if ($key % 2 == 0)
		  {
			$class= "even";
		  }
		  else
		  {
			$class= "odd";
		  }
		echo '<tr>';
		echo '<td class='.$class.'>'.$list['agent_license_no'].'</td>';
		echo '<td class='.$class.'><a href="javascript://" onclick="javascript:view_ifos(\''.$list['agent_license_no'].'\');">'.$list['Name'].'</a></td>';
		echo '<td class='.$class.'><a href="javascript://" onclick="javascript:view_list_ifo(\''.$list['agent_license_no'].'\','.$row.');">'.$row.'</a></td>';
		echo '<td class='.$class.'><a href="mailto:'.$list['email_address'].'">'.$list['email_address'].'</a></td>';
		echo '<td class='.$class.'>'.$list['officephone'].'</td>';
		echo '<td class='.$class.'>'.$list['pager'].'</td>';
		echo '</tr>';
	}
	mysql_close($con);
  ?>  
</table>
</div>