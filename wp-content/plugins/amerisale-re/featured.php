<div class="icon32" id="icon-options-general"><br/></div>
<h2>Amerisale RE</h2><br clear="all" />
<div class="wrap">
<h2>Manage Featured List </h2><br clear="all" />
<a class="menus" href="<?php echo $url ;?>admin.php?page=featured">Featured List</a>
<a class="menus" href="<?php echo $url ;?>admin.php?page=featured&option=1">Feature More Listings</a>
<br clear="all" /><br />

<?php
if($rets_area != null || $rets_area != ''){//if mls 
		$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND (rets_area = '".$rets_area."' OR rets_area = 'manual_".$agent_offcode."') "; 
	  }else{ //manual only
			$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND  rets_area = 'manual_".$agent_offcode."' "; 
	  }
$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	//echo "<pre>"; print_r($results[0]);die;
	$codentrs = $results[0]->agent_offcode;
// $codentrs = "LYNC00FW";
// var_dump(get_option('rps_total_posts'));

echo "<div style='font-weight: bold;'>Featured Post Slider Limit is now <span style='color:#AA462A; font-size: 18px;'>".get_option('rps_total_posts')."</span> If you want to increase or Decrease the No of posts to show in a slider you can set it over <a href='".$url."options-general.php?page=recent-posts-slider'>Click Here</a></div><br clear='all' />";
	global $wpdb;
	if(!isset($_REQUEST['option'])){
		$optvals1 = $_REQUEST['optval1'];
		if(!empty($optvals1))
		{
			foreach($optvals1 as $MLS ) 
			{
				$sql = "UPDATE ntreislist SET featured_listings ='0' WHERE MLS = $MLS";
				mysql_query($sql); 
			}
		}
		//$codentrs = trim($_REQUEST['ofcode']);
		
		$sql = "SELECT is_manual_edit,MLS, agent_name,street_num,street_name,street_type,city,state, directions, officelist,zipcode,county, officelist, featured_listings FROM ntreislist where $WHERE_0fficelist AND featured_listings ='1' AND agentlist !='' AND agent_name !=''";
		// $results = $wpdb->get_results($sql);
		$sql = mysql_query($sql); 
		while($row = mysql_fetch_assoc($sql)){
			$featured[] =  $row;
		}
		// echo "<pre>"; print_r($featured);
		
	?>
	<?php if(!empty($featured)){
	
	?>
	<form method="post" id="retrive">
	<table id="mytable">

	<tbody>
		<tr class="heading">
			<th class="cont_tab2">MLS</th>
			<!--<th class="cont_tab2">Password</th>-->
			<th class="cont_tab2">Agent Name</th>
			<th class="cont_tab1">Address</th>
			<th class="cont_tab1">Feature Listings</th>
		</tr>
	<?php
	foreach($featured as $result){
		// NTREIS
		//$address = $result['street_num'].' '.$result['street_name'].' '.$result['street_type'].'<br />'.$result['city'].','.$result['state'].' '.$result['zipcode'].'<br />'.$result['county'].' county';
		
		// Manual
		if($result['is_manual_edit'] == 1){
			$address = $result['directions'].'<br />'.$result['city'].', TX '.$result['state'].' '.$result['zipcode'].'<br />'.$result['county'].' county';
		}else if($result['is_manual_edit'] == 0 || $result['is_manual_edit'] == 2){
			$address = $result['street_num'].' '.$result['street_name'].' '.$result['street_type'].' '.$result['city'].' '.$result['state'].' '.$result['zipcode'].' '.$result['county'];
		}else{
			$address = '';
		}
	?>
			<tr class="heading">
				<td class="cont_tab2"><?php echo $result['MLS']; ?></td>
				<td class="cont_tab2"><?php echo $result['agent_name']; ?></td>
				<td class="cont_tab3"><a target="_blank" href="<?php echo get_bloginfo('url')."/viewproperty.php?mls=".$result['MLS']; ?>"><?php echo $address; ?></td>
				<td class="cont_tab3"><input type="checkbox" name="optval1[]" id="optval1" value=<?php echo $result['MLS']; ?> ></td>
			</tr>
		

	<?php }
	?>
		</tbody>
		
		
		</table>
		<p class="submit">
			<input type="submit" value="Remove from Features Listings" name="save" class="button-primary" />
		</p>
		
		</form>	
	<?php 
	}else{ ?>
		No Result
	<?php 
		
	}
	}else{
		$optvals = $_REQUEST['optval'];
		if(!empty($optvals))
		{
			foreach($optvals as $MLS ) 
			{
				$sql = "UPDATE ntreislist SET featured_listings ='1' WHERE MLS = $MLS";
				 mysql_query($sql); 
			}
		}
		$sql = "SELECT is_manual_edit,MLS, agent_name,street_num,street_name,street_type,city,state, directions, officelist,zipcode,county, featured_listings FROM ntreislist where $WHERE_0fficelist AND featured_listings ='0' AND agentlist !='' AND agent_name !='' ";
		$sql = mysql_query($sql); 
		while($row = mysql_fetch_assoc($sql)){
			$featured_list[] =  $row;
		}
		// echo "<pre>"; print_r($featured);
		
	?>
	<?php if(!empty($featured_list)){

	?>
	<form method="post" id="retrive" onsubmit="return submitform();">
	
	<label>Search MLS # </label><input type="text" size="30" id="Smls">
		<p class="submit">
			<input type="button" value="Search MLS" onclick="seach_MLS();" name="save" class="button-primary" />
		</p>
	<label>Sort Listings:</label>
	<a href="Javascript://" onclick="searching('ASC');" >MLS Ascending</a>|
	<a href="Javascript://" onclick="searching('DESC');" >MLS Descending</a>
	<br clear="all" /><br />
	<div class="searching_data">
	
	<table id="mytable">

	<tbody>
		<tr class="heading">
			<th class="cont_tab2">MLS</th>
			<!--<th class="cont_tab2">Password</th>-->
			<th class="cont_tab2">Agent Name</th>
			<th class="cont_tab1">Address</th>
			<th class="cont_tab1">Feature Listings</th>
		</tr>
	<?php
	// echo count($featured_list);
	foreach($featured_list as $listings){
			// NTREIS
			//$address = $result['street_num'].' '.$result['street_name'].' '.$result['street_type'].'<br />'.$result['city'].','.$result['state'].' '.$result['zipcode'].'<br />'.$result['county'].' county';

			// Manual
			if($listings['is_manual_edit'] == 1){
				$address = $listings['directions'].'<br />'.$listings['city'].', TX '.$listings['state'].' '.$listings['zipcode'].'<br />'.$listings['county'].' county';
			}else if($listings['is_manual_edit'] == 0 || $listings['is_manual_edit'] == 2){
				$address = $listings['street_num'].' '.$result['street_name'].' '.$listings['street_type'].' '.$listings['city'].' '.$listings['state'].' '.$listings['zipcode'].' '.$listings['county'];
			}else{
				$address = '';
			}
			// $address = $result['directions'].'<br />'.$result['city'].','.$result['state'].' '.$result['zipcode'].'<br />'.$result['county'].' county';
	?>
			<tr class="heading">
				<td class="cont_tab2"><?php echo $listings['MLS']; ?></td>
				<td class="cont_tab2"><?php echo $listings['agent_name']; ?></td>
				<td class="cont_tab3"><a target="_blank" href="<?php echo get_bloginfo('url')."/viewproperty.php?mls=".$listings['MLS']; ?>"><?php echo $address; ?></td>
				<td class="cont_tab3"><input type="checkbox" name="optval[]" id="optval" value=<?php echo $listings['MLS']; ?> ></td>
			</tr>
		

	<?php }
	?>
		</tbody>
		
		
		</table>
		<p class="submit">
			<input type="submit" value="Add to Featured Listings" name="save" class="button-primary" />
		</p>
		
		</form>	
	<?php 
	}else{ ?>
		No Result
	<?php 
		
	}
	?>
	</div>
	<?php
}?>
</div>
<?php 
	$sql = "SELECT count(*) AS Feat FROM ntreislist where officelist = '".$codentrs."' && featured_listings ='1' ";
	// $counts = $wpdb->get_results($sql);
	// var_dump($counts[0]->Feat);
	$sql = mysql_query($sql); 
	$counts = mysql_fetch_assoc($sql);
	// var_dump($counts);
	//mysql_close($con); 
	mysql_select_db(DB_NAME);
?>
<script>
function submitform(){	
	var limit = "<?php echo get_option('rps_total_posts'); ?>";
	var fea = "<?php echo $counts['Feat']; ?>";
	// alert(limit);
	// alert(fea);
	if(limit <= fea){
		alert('You can change the No of posts to show in a slider plugin....');
		return false;
	}
	// return false;
}
function seach_MLS(){
	var Smls = $("#Smls").val();
	if(Smls == ''){
		alert('Please Enter any MLS ID# and search it......');return false;
	}else{
		$('.searching_data').html('Loading........');
		$.ajax({
			url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/featured/search.php",
		  data: "mls="+Smls,
		}).done(function(res) {  
			// alert(res);
			$('.searching_data').html(res);
		});
	}
}

function searching(type){
	$('.searching_data').html('Loading........');
	$.ajax({
		url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/featured/search.php",
	  data: "type="+type,
	}).done(function(res) {  
		// alert(res);
		$('.searching_data').html(res);
	});
}
</script>