<?php 
	// echo "<pre>";print_r($_REQUEST);
	
	include_once("../../../../wp-config.php");
	global $wpdb;
	
	?>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    <script>
			$(function() {
				$('.current').click(function() {
				  $('.list-wraps').html('Loading..........');
				   // $('#example-two').show();
				   location.reload();

				  // $('.list-wraps').load('<?php echo plugins_url(); ?>/netriesdetail/loading.php');
				});
				
				$("#standardform").submit(function(){
					var datas = $("#standardform").serialize();
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
					  data: datas
					}).done(function(res) {  
						alert(res);
						// $('.list-wrap').html(res);
					});
				  return false;
				});
				
				$("#additionalform").submit(function(){
					var datas = $("#additionalform").serialize();
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
					  data: datas
					}).done(function(res) {  
						alert(res);
						// $('.list-wrap').html(res);
					});
				  return false;
				});
			});
			
	</script>		
	<style>
		.heading{font-size: 18px; font-weight: bold; text-transform: capitalize;}
		.cont_tab1{width: 100px;}
		.cont_tab2{width: 200px;}
		#example-two ,#example-three, #example-foure
		{
			background: none repeat scroll 0 0 #EEEEEE;
			box-shadow: 0 0 5px #666666;
			margin: 0 0 20px;
			padding: 10px;
			float:left;
		}
	 </style>
	<?php
	$sql = "select * from ".$wpdb->prefix."ntreislist where MLS = '".$_REQUEST['data']."'";

	$agent_ls = $wpdb->get_results($sql);
	   // print_r($agent_ls);
	 if(empty($agent_ls)){
		echo '<div class="current"><input type="button" value="Go Back" /> </div>';
		echo 'There is no records in this Agent.';die;
	 }
	$divisionsql = "select sub_division from ".$wpdb->prefix."ntreislist where sub_division != '' group by sub_division order by sub_division asc";
	$divisionres = $wpdb->get_results($divisionsql);   
	
	$districtsql = "select schooldistrict from ".$wpdb->prefix."ntreislist where schooldistrict != '' group by schooldistrict order by schooldistrict asc";
	$districtres = $wpdb->get_results($districtsql);   
	
	// echo "<pre>";
	// print_r($districtres);
	// die;
	 
	if(!empty($agent_ls)){
		$agent_l = $agent_ls[0];
		$acres = $agent_l->acres;
		$acre_price = $agent_l->acre_price;
		$agentlist = $agent_l->agentlist;
		$agent_name = $agent_l->agent_name;
		$area = $agent_l->area;
		$bath_full = $agent_l->bath_full;
		$bath_half = $agent_l->bath_half;
		$baths = $agent_l->baths;
		$bedrooms = $agent_l->bedrooms;
		$city = $agent_l->city;
		$county = $agent_l->county;
		$directions = $agent_l->directions;
		$floors = $agent_l->floors;
		$garage_cap = $agent_l->garage_cap;
		$listprice = $agent_l->listprice;
		$listprice_low = $agent_l->listprice_low;
		$listprice_orig = $agent_l->listprice_orig;
		$listprice_range = $agent_l->listprice_range;
		$liststatus = $agent_l->liststatus;
		$MLS = $agent_l->MLS;
		$modified = $agent_l->modified;
		$photocount = $agent_l->photocount;
		$remarks = $agent_l->remarks;
		$sqft_price = $agent_l->sqft_price;
		$sqft_source = $agent_l->sqft_source;
		$sqft_total = $agent_l->sqft_total;
		$sqft_total_price = $agent_l->sqft_total_price;
		$state = $agent_l->state;
		$street_name = $agent_l->street_name;
		$street_num = $agent_l->street_num;
		$street_type = $agent_l->street_type;
		$sub_division = $agent_l->sub_division;
		$utility = $agent_l->utility;
		$yearbuilt = $agent_l->yearbuilt;
		$num_dining_areas = $agent_l->num_dining_areas;
		$num_living_areas = $agent_l->num_living_areas;
		$proptype = $agent_l->proptype;
		$schooldistrict = $agent_l->schooldistrict;
		$zipcode = $agent_l->zipcode;
		$featured_listings = $agent_l->featured_listings;
		$is_manual_edit = $agent_l->is_manual_edit;
		$virtual_tour = $agent_l->virtual_tour;
		$expired_date = $agent_l->expired_date;
		$is_update_rets = $agent_l->is_update_rets;
	}else{
		$acres = '';
		$acre_price = '';
		$agentlist = '';
		$agent_name = '';
		$area = '';
		$bath_full = '';
		$bath_half = '';
		$baths = '';
		$bedrooms = '';
		$block = '';
		$city = '';
		$county = '';
		$directions = '';
		$garage_cap = '';
		$listprice = '';
		$liststatus = '';
		$MLS = '';
		$modified = '';
		$remarks = '';
		$sqft_price = '';
		$sqft_source = '';
		$sqft_total = '';
		$state = '';
		$street_name = '';
		$street_num = '';
		$street_type = '';
		$sub_division = '';
		$utility = '';
		$yearbuilt = '';
		$num_dining_areas = '';
		$num_living_areas = '';
		$proptype = '';
		$schooldistrict = '';
		$zipcode = '';
		$featured_listings = '';
		$is_manual_edit = '';
		$virtual_tour = '';
		$expired_date = '';
		$is_update_rets = '';
	}
	if($is_manual_edit == 1){
		$address = $directions;
	}else if($is_manual_edit == 0){
		$address = $street_num.' '.$street_name.' '.$street_type.','.$city.','.$state.','.$zipcode.','.$county;
	}else{
		$address = '';
	}	
	
	if($is_update_rets == 1){
		$chk = 'checked';
	}else{
		$chk = '';
	}
	// echo "zip".$baths;
?>

	
	
	<div id="example-one_new" >	
        	<ul class="nav">
                <li class="nav-one"><div class="current"><input type="button" value="Go Back" /> </div></li>
            </ul>

	<div class="list-wrap">
		
		<ul id="addnetres1">

				
			<div class="fm_right" style="float:left;">	
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Update the netrets plugin</label></th>
						<td><label><input type="checkbox" name="update_plugin" <?php echo $chk; ?> /></label> </td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>MLS Number</label></th>
						<td><label><input type="text" name="mlsid" value= "<?php echo $_REQUEST['data']; ?>" /></label> </td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Price</label></th>
						<td><label><input type="text" name="price" value= "<?php echo $listprice; ?>" /></label> </td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Expires Date:</label></th>
						<td><label><input type="text" name="expires_date" value= "<?php echo $expired_date; ?>" /></label> </td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Address</label></th>
						<td><label><input type="text" name="address" value= "<?php echo $address; ?>" /></label> </td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>City</label></th>
						<td><label><input type="text" name="city" value= "<?php echo $city; ?>" /></label> </td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>County</label></th>
						<td><label><input type="text" name="county" value= "<?php echo $county; ?>" /></label> </td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Zip</label></th>
						<td><label><input type="text" name="zip" value= "<?php echo $zipcode; ?>" /></label> </td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Virtual Tour</label></th>
						<td><label><input type="text" name="virtual_tour" value= "<?php echo $virtual_tour; ?>" /></label> </td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Description</label></th>
						<td><label><textarea name="description" value= "<?php echo $remarks; ?>" ><?php echo $remarks; ?></textarea></label> </td>
					</tr>
				</table>
			</div>	
			<div class="fm_left" style="float:right;">	
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Bedrooms</label></th>
						<td><label><input type="text" name="bedrooms" value= "<?php echo $bedrooms; ?>" /></label> </td>
					</tr>
				</table>	
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Full Baths</label></th>
						<td><label><input type="text" name="full_baths" value= "<?php echo $bath_full; ?>" /></label> </td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Half Baths</label></th>
						<td><label><input type="text" name="half_baths" value= "<?php echo $bath_half; ?>" /><label></td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Living Rooms</label></th>
						<td><label><input type="text" name="living_rooms" value= "<?php echo $num_living_areas; ?>" /><label></td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Dining Rooms</label></th>
						<td><label><input type="text" name="dining_rooms" value= "<?php echo $num_dining_areas; ?>" /><label></td>
					</tr>
				</table>
				<br />
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label>Garage Spaces</label></th>
						<td><label><input type="text" name="garage_spaces" value= "<?php echo $garage_cap; ?>" /><label></td>
					</tr>
				</table>
			</div>	
				<input type="hidden" name="mlsnum" value="<?php echo $splits[1]; ?>" />
				<input type="hidden" name="proptype" value="<?php echo $_REQUEST['type']; ?>" />
				<input type="hidden" name="formaction" value="standard" />
			
				<br clear="all" /><br /><br />
				<input type="submit" value="submit" name="save" class="button-primary" />
				
			</form>

		</ul>

	</div>
