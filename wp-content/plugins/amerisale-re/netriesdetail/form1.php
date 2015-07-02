<div class="load_net">
<?php 
	// echo "<pre>";print_r($_REQUEST);die;
	
	include_once("../../../../wp-config.php");
	global $wpdb;
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$agent_offcode = $results[0]->agent_offcode;
	$office = $results[0]->agent_username;
	$rets_area = $results[0]->rets_area;
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  mysql_select_db($db_name, $con); 
	  $proptype = 'all';
	  
	  if($rets_area != null || $rets_area != ''){//if mls 
		$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND (rets_area = '".$rets_area."' OR rets_area = 'manual_".$agent_offcode."') "; 
	  }else{ //manual only
			$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND  rets_area = 'manual_".$agent_offcode."' "; 
	  }
	  
	?>
	<link rel="stylesheet" href="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/css/datepicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/css/layout.css" />
	
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>	 
	<script type="text/javascript" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/js/datepicker.js"></script>
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/js/eye.js"></script>
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/js/utils.js"></script>
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/js/layout.js?ver=1.0.2"></script>
	<script type='text/javascript' src='<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/js/jquery.autocomplete.js'></script>
	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/css/jquery.autocomplete.css" />
    
    <script>
	
	
	
	function update_insert_listing(){
	var form_change = false;
	$('.button-primary').attr('disabled', 'disabled');
	  var  mlsid = $("#MISD").val();
	
					if(mlsid == '' || mlsid == 0){
						alert('Your MLS num is empty or equal to zero . Please fill MLS number field in the first form ');
						$('.button-primary').removeAttr('disabled');
						$('#frame').contents().find('#file').prop("disabled", false);
						return false;
					}
					
				
				
					var datas = $("#standardform").serialize();
					var expired_date = $("#expired_date").val();
					var today_date = $("#today_date").val();
					
					var property = $("#property").val();
					var schldist = $("#schldist").val();
					var subdivsion = $("#subdivsion").val();
					
					var sq_feet = $("#sq_feet").val();
					var stories = $("#stories").val();
					var lot_size = $("#lot_size").val();
					var app_acres = $("#app_acres").val();
					var year_built = $("#year_built").val();
					
					var restrictions = $("#restrictions").prop('checked');
					var garage_spaces = $("#garage_spaces").val();					
					var car_space = $("#car_space").val();					
					var fire_places = $("#fire_places").val();
					var pool = $("#pool").prop('checked');
					var handc_equpd = $("#handc_equpd").prop('checked');
					
					//Garage Spaces 
					//Carport Spaces 
					//Fire Places 
					//pool
					//Handicapped Equipment 
					//Restrictions
					
					// end - start returns difference in milliseconds 
					var diff = new Date(expired_date - today_date); 
					$('.submit-spin').show();
					
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
					  data: datas+"&proptype="+property+"&schldist="+schldist+"&subdivsion="+subdivsion+"&sq_feet="+sq_feet+"&stories="+stories+"&lot_size="+lot_size+"&app_acres="+app_acres+"&year_built="+year_built+"&restrictions="+restrictions+"&garage_spaces="+garage_spaces+"&car_space="+car_space+"&fire_places="+fire_places+"&pool="+pool+"&handc_equpd="+handc_equpd
					}).done(function(res) {
						if(res != 'duplicate_mls'){
								/*alert(res);*/
								var mlsid = $("#MISD").val();
								//alert(mlsid);
								$('#new_list').val('');
								var datas = $("#additionalform").serialize();
								var property = $("#property").val();
								$.ajax({
								  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
								   data: datas+"&mlsid="+mlsid+"&proptype="+property
								}).done(function(res) {  
									//alert(res);
									// $('.list-wrap').html(res);
								});
								
								var datas = $("#financials").serialize();
								var mlsid = $("#MISD").val();
								/*if(mlsid == ''){
									alert('Your MLS num is empty . Please fill MLS number field in the first from ');
									return false;
								}*/
								$.ajax({
								  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
								  data: datas+"&mlsid="+mlsid
								}).done(function(res) {  
									alert(res);
									$('.button-primary').removeAttr('disabled');
									$('.submit-spin').hide();
									
									$('#frame').contents().find('#file').prop("disabled", false);
									jQuery(document).ready(function($) {
										if(res=='updated' || res=='inserted'){
											window.form_change = false;
										}
									});
								});
							}else{
								alert('You are already using this MLS number for an active listing please use a different MLS number!')
								$('.button-primary').removeAttr('disabled');
								$('.submit-spin').hide();
								$('#frame').contents().find('#file').prop("disabled", false);								
							}							
						
					});
					
				
			}/*end update_insert_listing()*/		
			
			
			
			$.noConflict();
		jQuery(document).ready(function($) {
			mlsid = $("#MISD").val();
			
			$('#frame').load(function() {
				var innerWindow = document.getElementById('frame').contentWindow;
				innerWindow.publish_listing = publish_listing;
			
			});
			
			function publish_listing() {
				if(window.form_change == true || $("#MISD").val() =='' || $("#MISD").val() ==0){
					$('#frame').contents().find('#file').prop("disabled", true);
					var r= confirm("You must publish this listing before you upload! Click OK to publish. After listing is published please click upload again to upload");
					if (r==true){
							update_insert_listing();
						}else{
							$('#frame').contents().find('#file').prop("disabled", false);
						}					
						return false;
				}
			}
				
			
			
				$('.current').click(function() {
				  $('.list-wrap').html('Loading..........');
				   $('#example-two').show();
				   location.reload();
				  $('.list-wrap').load('<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/loading.php');
				});
			
			$("form :input").change(function() {
					
				form_change = true;
				
			});
			$("form :input").keydown(function() {
				form_change = true;
			});
			$("#inputDate").click(function(){			
					form_change = true;
								 
				});
			$("#standardform").submit(function(){
			
					
					update_insert_listing();
					
					
				  return false;
				});
				
				$("#photoform").submit(function(){
				
					var datas = $("#photoform").serialize();
					alert(datas);
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/uploadfile.php",
					  data: datas
					}).done(function(res) {  
						alert(res);
					});
				  return false;
				});
				
				$("#additionalform").submit(function(){
				
						
					update_insert_listing();
					
					
				  return false;
				});
				
				
				$("#financials").submit(function(){
				
						
					update_insert_listing();
					
					
				  return false;
					});
					
				
				
				$('#photoimg').live('change', function()	
				{ 
					$("#preview").html('');
					$("#preview").html('Uploading..........');
					$("#imageform").ajaxForm(
					{
						target: '#preview'
					}).submit();
					
					return false;
				});
				
				$('#inputDate').DatePicker({
					format:'m-d-Y',
					date: $('#inputDate').val(),
					current: $('#inputDate').val(),
					starts: 1,
					position: 'r',
					onBeforeShow: function(){
						$('#inputDate').DatePickerSetDate($('#inputDate').val(), true);
					},
					onChange: function(formated, dates){
						$('#inputDate').val(formated);
						$('#inputDate').DatePickerHide();
					}
				});
				
			
				$("#schldist").autocomplete("<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/schldist.php", {
					width: 260,
					selectFirst: false
				});
				$("#schldist").result(function(event, data, formatted) {
					if (data)
						$(this).parent().next().find("input").val(data[1]);
						$('#schldist').val(data[1]);
				});
				
				$("#subdivsion").autocomplete("<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/subdivsion.php", {
					width: 260,
					selectFirst: false
				});
				$("#subdivsion").result(function(event, data, formatted) {
					if (data)
						$(this).parent().next().find("input").val(data[1]);
						$('#subdivsion').val(data[1]);
				});
				$("#update_schools").click(function() {
						var mlsid = $("#MISD").val();
					var schldists = $("#schldist").val();
					if(schldists == ''){
						alert('Please Enter any school district..');
						return false;
					}else if(mlsid == ''){
						alert('Your MLS num is empty . Please fill MLS number field in the first from ');
						return false;
					}
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/update_school.php",
					  	   data: {mlsid : mlsid,schldists:schldists},
					}).done(function(res) {  
						alert(res);
						// $('.list-wrap').html(res);
					});
				});	
				
				$("#update_division").click(function() {
					var mlsid = $("#MISD").val();
					var subdivsion = $("#subdivsion").val();
					// alert(subdivsion);
					if(subdivsion == ''){
						alert('Please Enter any sub divsion..');
						return false;
					}else if(mlsid == ''){
						alert('Your MLS num is empty . Please fill MLS number field in the first from ');
						return false;
					}
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/update_school.php",
					  data: {mlsid : mlsid,subdivsion:subdivsion},
					}).done(function(res) {  
						alert(res);
						// $('.list-wrap').html(res);
					});
				});
				$("#photo_upload").click(function() {
					var formaction = 'imageuploads';
					var mlsid = $("#MISD").val();
					var caption = $("#caption").val();
					var photoname = $("#image_computer").val();
					if(mlsid == ''){
						alert('Your MLS num is empty . Please fill MLS number field in the first from ');
						return false;
					}else if(photoname == ''){
						alert('Please Upload Any Image...');
						return false;
					}
					
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
					  data: "mlsid="+mlsid+"&formaction="+formaction+"&caption="+caption+"&photoname="+photoname
					}).done(function(res) {  
						// alert(res);
						$('.photos').html(res);
						// $('.list-wrap').html(res);
					});
				});
			});
			
			function deleteimg(id){
				if (confirm("Are you sure you want to delete")) {					
				var loadimg= "<img src='<?php echo plugins_url(); ?>/<?php echo $plugin_dir."/images/indicator.gif";?>' alt='loading...'>";
				$('#'+id).html(loadimg);
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/delete_image.php",
					  data: "id="+id,
					}).done(function(res) {  
					
						$('#'+id).hide('slow');
						// $('.list-wrap').html(res);
					});
				}
			}
			
			function Edit_photos(id){
				$('#edit_images_'+id).toggle('fast');
			}
			
			function update_photo(id){
					var caption = $("#caption_"+id).val();
					var photoname = $("#image_computer_"+id).val();
					if(photoname == ''){
						alert('Please Upload Any Image...');
						return false;
					}
					var loadimg= "<img src='<?php echo plugins_url(); ?>/<?php echo $plugin_dir."/images/indicator.gif";?>' alt='loading...'>";
				$('#'+id).html(loadimg);
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/update_photo.php",
					  data: "id="+id+"&caption="+caption+"&photoname="+photoname
					}).done(function(res) {  
						// alert(res);
						$('#'+id).replaceWith(res);
						// $('.list-wrap').html(res);
					});
			}
			
			function searchMLS(){
				var M_id = $('#MISD').val();
				var agent_id = $('#agent_id').val();
				var type = "<?php echo $_REQUEST['type']; ?>";
				//alert(agent_id);
				//alert(agent_id);
				if(M_id == ''){
					alert('please Enter the MLS ID ');return false;
				}
				$.ajax({
				  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/search_mls.php",
				  data: 'mls_id='+M_id,
				}).done(function(res) {  
					if(res == 1){
						$('.load_net').html('Progressing...........');
						$('.load_net').load("<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/form.php?agent="+agent_id+"~"+M_id+"&type="+type);
					}else{
						alert('No Data found for this MLS...');
					}
				});
			}
			
			function hide_the_other(name){
				if(name == 'city_sewer'){
					if($("input[name=city_sewer]").prop("checked") == true){
						$("input[name=septic_tank]").attr('disabled',true);
					}else{
						$("input[name=septic_tank]").removeAttr("disabled");

					}
				}else{
					if($("input[name=septic_tank]").prop("checked") == true){
						$("input[name=city_sewer]").attr('disabled',true);
					}else{
						$("input[name=city_sewer]").removeAttr("disabled");
					}
				}				
			}
			
		
	</script>		
	<style>
		.heading{font-size: 18px; font-weight: bold; text-transform: capitalize;}
		.cont_tab1{width: 100px;}
		.cont_tab2{width: 200px;}
		.form-table th {
			padding: 10px;
			text-align: left;
			vertical-align: top;
			width: 150px;
		}
		label {
    cursor: pointer;
	  font-family: arial;
    font-weight: bold;
		}
		.photos{
			float:left;
			width:600px;
		}
		.phot{
			float:left;
		}.caption{
			float:left;
		}
		.edit_images{
			display:none;
		}
	
		#example-two ,#example-three, #example-foure { background: none repeat scroll 0 0 #EEEEEE; box-shadow: 0 0 5px #666666; margin: 0 0 20px; padding: 10px;float:left; }
	 </style>
	<?php 
	$splits = $_REQUEST['agent']; 
	
	$districtres = $divisionres = array();
	$agent_l = $agent_ls = $adds_res = array();
	//die($_REQUEST['agent']);
	if($_REQUEST['agent']!=null){
		$splits = split('~',$_REQUEST['agent']);
		if(count($splits) > 1){
			$sql = "select * from ntreislist where MLS = '".$splits[1]."' AND ".$WHERE_0fficelist." AND delete_status = '0' ";
			$agent = mysql_query($sql); 
			$agent_l = mysql_fetch_assoc($agent);
			//echo $sql;
			//NEW CODE
			$addsql = "select * from additionalinfo where n_id = '".$agent_l['id']."'";
			
			
			$agent = mysql_query($addsql); 
			$additional_forms = mysql_fetch_assoc($agent);
			
			//NEW CODE
			$financesql = "select * from financial where n_id = '".$agent_l['id']."'";
			
			
			
			$financesql = mysql_query($financesql); 
			$finance_forms = mysql_fetch_assoc($financesql);
		}else{
			$splits = split('-',$_REQUEST['agent']);
		
		}
	 }
	
	if(!empty($agent_l)){
		
		$acres = $agent_l['acres'];
		$acre_price = $agent_l['acre_price'];
		$agentlist = $agent_l['agentlist'];
		$agent_name = $agent_l['agent_name'];
		$area = $agent_l['area'];
		$bath_full = $agent_l['bath_full'];
		$bath_half = $agent_l['bath_half'];
		$baths = $agent_l['baths'];
		$bedrooms = $agent_l['bedrooms'];
		$city = $agent_l['city'];
		$county = $agent_l['county'];
		$directions = $agent_l['directions'];
		$floors = $agent_l['floors'];
		$garage_cap = $agent_l['garage_cap'];
		$listprice = $agent_l['listprice'];
		$liststatus = $agent_l['liststatus'];
		$MLS = $agent_l['MLS'];
		$modified = $agent_l['modified'];
		$photocount = $agent_l['photocount'];
		$remarks = $agent_l['remarks'];
		$sqft_price = $agent_l['sqft_price'];
		$sqft_source = $agent_l['sqft_source'];
		$sqft_total = $agent_l['sqft_total'];
		$sqft_total_price = $agent_l['sqft_total_price'];
		$state = $agent_l['state'];
		$street_name = $agent_l['street_name'];
		$street_num = $agent_l['street_num'];
		$street_type = $agent_l['street_type'];
		$sub_division = $agent_l['sub_division'];
		$utility = $agent_l['utility'];
		$yearbuilt = $agent_l['yearbuilt'];
		$num_dining_areas = $agent_l['num_dining_areas'];
		$num_living_areas = $agent_l['num_living_areas'];
		if(!isset($agent_l['proptype'])|| $agent_l['proptype'] ==''){
			$agent_l['proptype']='Residential';
		}
		
		$proptype = $agent_l['proptype'];
		$schooldistrict = $agent_l['schooldistrict'];
		$zipcode = $agent_l['zipcode'];
		
		$lotsize = $agent_l['lotsize'];
		$stories = $agent_l['stories'];
		$carport_space = $agent_l['carport_space'];
		$fire_place = $agent_l['fire_place'];
		$pool = $agent_l['pool'];
		$handicapt = $agent_l['handicapt'];
		$restriction = $agent_l['restriction'];
		$virtual_tour = $agent_l['virtual_tour'];
		$expired_date = $agent_l['expired_date'];
		$restrictions = $agent_l['restriction'];
		$premium_listing = $agent_l['premium'];
		$sales_pending = $agent_l['sales_pending'];
		$sold = $agent_l['sold'];
		$locale = $agent_l['locale'];
		$date1 = $agent_l['date1'];
		$date2 = $agent_l['date2'];
		$start1 = $agent_l['start1'];
		$end1 = $agent_l['end1'];
		$start2 = $agent_l['start2'];
		$end2 = $agent_l['end2'];
		$open_house = $agent_l['open_house'];
		$is_manual_edit = $agent_l['is_manual_edit'];
		$is_update_rets = $agent_l['is_update_rets'];
		
		$offices = $agent_l['offices'];
		$restrooms = $agent_l['restrooms'];
		$meeting_spaces = $agent_l['meeting_spaces'];
		$parking_spaces = $agent_l['parking_spaces'];
		$barns = $agent_l['barns'];
		$sheds = $agent_l['sheds'];
		$shops = $agent_l['shops'];
		$ponds = $agent_l['ponds'];
		$stock_tanks = $agent_l['stock_tanks'];
		$corrals = $agent_l['corrals'];
		$pens = $agent_l['pens'];
		$units = $agent_l['units'];
		$expired_date = date("m-d-Y",strtotime($expired_date));
		$new='not_new';
	}else{
		$new = 'new';
		$acres = '';
		$acre_price = '';
		$agentlist = $splits[0];
		$agent_name = '';
		$area = '';
		$bath_full = '';
		$bath_half = '';
		$baths = '';
		$bedrooms = '';
		$block = '';
		$city = $_REQUEST['city'];
		$county = $_REQUEST['county'];;
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
		$proptype = $_REQUEST['property'];
		$schooldistrict = '';
		$zipcode = '';
		$featured_listings = '';
		$is_manual_edit = '';
		$virtual_tour = '';
		$expired_date = date("m-d-Y");
		$is_update_rets = '';
		$offices = '';
		$restrooms = '';
		$meeting_spaces = '';
		$parking_spaces = '';
		$citylimit = '';
		$etj = '';
		$road_access = '';
		$flood_plain = '';
		$minreals_convey = '';
		$address = '';
		$additional_forms['showmap'] =1;
		
	}
	if($is_manual_edit == '1'){
		$address = $directions;
	}else if($is_manual_edit == '0' || $is_manual_edit == '2'){
		$address = $street_num.' '.$street_name.' '.$street_type;
	}else{
		$address = '';
	}	
	
	if($is_update_rets == 1){
		$chk = 'checked';
	}else{
		$chk = '';
	}
		
	if($pool == 'Y'){
		$newchk = 'checked';
	}else{
		$newchk = '';
	}
	if($handicapt == 'Y'){
		$newchks = 'checked';
	}else{
		$newchks = '';
	}
	
	
	if($premium_listing == 1){
		$Listing = 'checked';
	}else{
		$Listing = '';
	}
	if($sales_pending == 1){
		$sales_pending = 'checked';
	}else{
		$sales_pending = '';
	}
	if($sold == 1){
		$sold = 'checked';
	}else{
		$sold = '';
	}
	if($open_house == 1){
		$open_house = 'checked';
	}else{
		$open_house = '';
	}
	// echo "zip".$baths;
?>

	
	
	<div id="example-one_new" >	
        	<ul class="nav">
                <li class="nav-one"><div class="current"><input type="button" value="Go Back" /> </div></li>
            </ul>

	<div class="list-wrap">
		
		<ul id="addnetres1">

			<?php echo $proptype; ?>  Listing <br clear ="all" />
			Standard From
			<form method="post" id="standardform" action="javascript:void(0);">

			<div class="fm_right" style="float:left; border-right: 1px solid #000000;width: 690px;">	

				<table class="form-table">
				<tr valign="top">
					<th ><label>Allow MLS Overwrite</label></th>
					<td><label><input type="checkbox" name="update_plugin" <?php echo $chk; ?> /></label> </td>
					
				</tr>
				<tr valign="top">
						<th ><label>Type </label></th>
						<!--<td><?php //echo $_REQUEST['type']; ?> </td>-->
						<td>
							<?php
								$prop_array = array("Residential"=>"Residential", "Commercial"=>"Commercial", 
									"Acreage"=>"Acreage",  "Multi-Family"=>"Multi-Family",  "Residential Leasing"=>"Residential Leasing",  "Commercial Leasing"=>"Commercial Leasing",
									"Residential Lots"=>"Residential Lots", "Commercial Lots"=>"Commercial Lots",  "Farm/Ranch"=>"Farm/Ranch",  "WaterFront"=>"WaterFront",  "WaterView"=>"WaterView");
								$type_val = $proptype;
								
							echo '<select name="type" id="property">';
								foreach($prop_array as $key=>$propval){
									echo '<option '.($type_val == $propval ? ' selected ' : '').' value="'.$propval.'" >'.$propval.'</option>';
								}
							echo '</select>';
							?>
						</td>
						<th scope="row" ><label>MLS Number</label></th>
						<td><input type="text" name="mlsnum" id="MISD" value= "<?php echo $MLS; ?>" /> <button type="button" onclick="searchMLS();">Search</button> </td><br clear="all" />
				</tr>
				<tr valign="top">
						<th ><label>Sales pending</label></th>
						<td><input type="checkbox" name="sales_pending"/> </td>
						<th ><label>Sold</label></th>
						<td><input type="checkbox" name="sold"/> </td>
				</tr>
				<tr valign="top">
						<th scope="row"><label>Price</label></th>
						<td><input type="text" name="price" value= "<?php echo $listprice; ?>" /> </td>
						<th scope="row"><label>Expires Date:</label></th>
						<td><input type="text" name="expires_date" id="inputDate" class ="inputDate" value= "<?php echo $expired_date; ?>" /><label> MM/DD/YYYY </label></td>
						<input type="hidden" value="<?php echo date("Y-m-d"); ?>" id="today_date" />
				</tr>
				<tr valign="top">
						<th scope="row"><label>Address</label></th>
						<td><input type="text" name="address" value= "<?php echo $address; ?>" /></td>
				</tr>
				<tr valign="top">
					 
					<th scope="row"><label>City</label></th>
					<td><input type="text" name="city" value= "<?php echo $city; ?>" /> </td>
				</tr>
				<tr valign="top">
					 
					<th scope="row"><label>County</label></th>
					<td><input type="text" name="county" value= "<?php echo $county; ?>" /> </td>
				
				</tr>
				<tr valign="top">	
					<th scope="row"><label>Zip</label></th>
					<td><input type="text" name="zip" value= "<?php echo $zipcode; ?>" /> </td>				
				</tr>
				<tr valign="top">
				<!--	<th ><label style="color:#9D1D1E;">Open House</label></th>
					<td style="color:#9D1D1E;"><input type="checkbox" name="open_house" /> on/off</td> -->
					<th ><label>Premium Listing</label></th>
					<td><input type="checkbox" name="premium_listing" /></td>
				</tr>
				<!--<tr valign="top">
				
					<th scope="row"><label>Date 1 </label></th>
					<td><input type="text" name="date1" value= "" /> </td>
				</tr>
				<tr valign="top">	
						<th scope="row"><label>Start</label></th>
						<td><select name="start1">
								   <option value="8:00 am">8:00 am</option>
								  <option value="9:00 am">9:00 am</option>
								  <option value="10:00 am">10:00 am</option>
						</select> </td>
						
						<th scope="row"><label>End</label></th>
						<td><select name="end1">
								   <option value="8:00 am">8:00 am</option>
								  <option value="9:00 am">9:00 am</option>
								  <option value="10:00 am">10:00 am</option>
						</select> </td>
				
				</tr>
				<tr valign="top">
						
						<th scope="row"><label>Date 2 </label></th>
						<td><input type="text" name="date2" value= "" /></td>
				</tr>
				<tr valign="top">	
						<th scope="row"><label>Start</label></th>
						<td><select name="start2">
								  <option value="8:00 am">8:00 am</option>
								  <option value="9:00 am">9:00 am</option>
								  <option value="10:00 am">10:00 am</option>
						</select></td>
						
						<th scope="row"><label>End</label></th>
						<td><select name="end2">
								  <option value="8:00 am">8:00 am</option>
								  <option value="9:00 am">9:00 am</option>
								  <option value="10:00 am">10:00 am</option>
						</select></td>
					
				</tr> -->
				<tr valign="top">
				
					<th scope="row"><label>Virtual Tour</label></th>
					<td><input type="text" name="virtual_tour" value= "<?php echo $virtual_tour; ?>" /> </td>
				
				</tr>
				<tr valign="top">
					<th scope="row"><label>Description</label></th>
					<td><label><textarea cols="40" rows="10" name="description" value= "<?php echo $remarks; ?>" ><?php echo $remarks; ?></textarea></label> </td>
				</tr>
				</table>
			</div>	
			
			
				<div class="fm_left" style="float:left; margin: 0px 0px 0px 20px;">
				<?php if($proptype == 'Residential' || $proptype == 'Residential Leasing' || $proptype == 'Farm/Ranch' || $proptype == 'WaterFront' || $proptype == 'WaterView'){ ?>
					<table class="form-table">
						<tr valign="top"></tr>
						<tr valign="top"></tr>
						<tr valign="top">
							<th scope="row"><label>Bedrooms</label></th>
							<td><label><input type="text" name="bedrooms" value= "<?php echo $bedrooms; ?>" /></label> </td>
						</tr>
						<th scope="row"><label>Bedroom Location</label></th>
						<td><select name="locale">
								  <option value="">N/A</option>
								  <option value="downstairs">DownStairs</option>
								  <option value="upstairs">Upstairs</option>
						</select> </td>
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
							<td><label><input type="text" id="garage_spaces" name="garage_spaces" value= "<?php echo $garage_cap; ?>" /><label></td>
						</tr>
					</table>
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Carport Spaces</label></th>
							<td><label><input type="text" id="car_space" name="car_space" value= "<?php echo $carport_space; ?>" /></label> </td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Fire Places</label></th>
							<td><label><input type="text" id="fire_places" name="fire_places" value= "<?php echo $fire_place; ?>" /></label> </td>
						</tr>
					</table>
					<br />
				<?php }
					if($proptype == 'Commercial' || $proptype == 'Commercial Leasing'){  ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Offices</label></th>
							<td><label><input type="text" name="offices" value= "<?php echo $offices; ?>" /><label></td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>RestRooms</label></th>
							<td><label><input type="text" name="restrooms" value= "<?php echo $restrooms; ?>" /><label></td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Meeting Spaces</label></th>
							<td><label><input type="text" name="meeting_spaces" value= "<?php echo $meeting_spaces; ?>" /><label></td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Parking Spaces</label></th>
							<td><label><input type="text" name="parking_spaces" value= "<?php echo $parking_spaces; ?>" /><label></td>
						</tr>
					</table>
					<br />
				<?php
				 }
				 if($proptype == 'Commercial Lots' || $proptype == 'Residential Lots' || $proptype == 'Farm/Ranch'  || $proptype == 'Acreage'){  ?>		
				 <table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Barns</label></th>
							<td><label><input type="text" name="barns" value= "<?php echo $barns; ?>" /><label></td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Sheds</label></th>
							<td><label><input type="text" name="sheds" value= "<?php echo $sheds; ?>" /><label></td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Shops</label></th>
							<td><label><input type="text" name="shops" value= "<?php echo $shops; ?>" /><label></td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Ponds</label></th>
							<td><label><input type="text" name="ponds" value= "<?php echo $ponds; ?>" /><label></td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Stock Tanks</label></th>
							<td><label><input type="text" name="stock_tanks" value= "<?php echo $stock_tanks; ?>" /><label></td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Corrals</label></th>
							<td><label><input type="text" name="corrals" value= "<?php echo $corrals; ?>" /><label></td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Pens</label></th>
							<td><label><input type="text" name="pens" value= "<?php echo $pens; ?>" /><label></td>
						</tr>
					</table>
					<br />
				<?php 
				} 
				if($proptype == 'Multi-Family'){  ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Units</label></th>
							<td><label><input type="text" name="units" value= "<?php echo $units; ?>" /><label></td>
						</tr>
					</table>
					<br />
					<table class="form-table">
						<tr valign="top">
							<th scope="row"><label>Parking Spaces</label></th>
							<td><label><input type="text" name="parking_spaces" value= "<?php echo $parking_spaces; ?>" /><label></td>
						</tr>
					</table>
				<?php
				}
				?>
			</div>	
				<!--<input type="hidden" name="proptype" value="<?php echo $proptype; ?>" />-->
				<input type="hidden" name="agent_id" id="agent_id" value="<?php echo $agentlist; ?>" />
				<input type="hidden" name="formaction" value="standard" />
				<input type="hidden" id="new_list" name="new" value="<?php echo $new ?>" />
			
				<br clear="all" /><br /><br />
				<div >
				<input type="submit" value="Publish" name="save" class="button-primary" style="float:left" />
				<img src="<?php echo home_url(); ?>/wp-content/plugins/amerisale-re/upload/ajax-loader.gif" class="submit-spin"style="float:left; display:none" />
				</div >
			</form>

		</ul>

	</div>

	</div>

		<br clear="all" />
	<br /><br />
	
	<div id="example-three" style="margin-top:100px; width: 100%;">
	<h2> Additional Information </h2>
			<div class="list-wrap">
			
				<ul id="additioninfo">
					<ul id="additioninfo">
					<form method="post" id="additionalform" action="">
						<div class="info_left" style="float:left;border-right: 1px solid #000000;">
						<!--<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Move_In Date</label></th>
								<td><label><input type="text" name="movedate" value= "<?php echo $additional_forms['moveindate']; ?>" /></label> </td>
							</tr>
						</table>
						<br />-->
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>School District</label></th>
								<td>
								<input type="text" name="schldist" id="schldist" value= "<?php echo $schooldistrict; ?>" /><br />
								<button type="button" id="update_schools">update</button> <br />
								<span style="float: left; width: 200px; font-weight: bold; color: #7C130D;">Type to get suggestions for School Districts, if you do not get a suggestion we can save your value</span>
								
								</td>
								<!--<td><label>
								<?php
									// echo "<pre>";
									echo $scldstr = $schooldistrict;
									echo '<select name="schldist">';
										foreach($districtres as $key=>$vals){
											$sch_disct = $vals->schooldistrict;
											echo '<option '.($scldstr == $sch_disct ? ' selected ' : '').' value="'.$sch_disct.'" >'.$sch_disct.'</option>';
											// echo '<option value="'.$sch_disct.'" >'.$sch_disct.'</option>';
										}
									echo '</select>'; 	
								?>
								</label> </td>-->
							</tr>
						</table>
						<br />
						
						<!--
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Add New School District</label></th>
								<td><label><input type="text" name="nw_schol_dist" value= "<?php echo $sub_division; ?>" /></label> </td>
							</tr>
						</table>
						<br />-->
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Sub-Division</label></th>
								<td><input type="text" name="subdivsion" id="subdivsion" value= "<?php echo $sub_division; ?>" /><br />
									<button type="button" id="update_division">update</button> <br />
									<span style="float: left; width: 200px; font-weight: bold; color: #7C130D;">Type to get suggestions for Sub Division, if you do not get a suggestion we can save your value</span>
								</td>
								<!--<td><label>
									<?php
										echo $subdsn = $sub_division;
										echo '<select name="subdivsion">';
											foreach($divisionres as $key=>$divvals){
												$divisn = $divvals->sub_division;
												echo '<option '.($subdsn == $divisn ? ' selected ' : '').' value="'.$divisn.'" >'.$divisn.'</option>';
												// echo '<option value="'.$divisn.'" >'.$divisn.'</option>';
											}
										echo '</select>'; 	
									?>
								</label> </td>-->
							</tr>
						</table>
						<br />
						<!--
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Add new Sub-Division</label></th>
								<td><label><input type="text" name="new_sub_div" value= "" /></label> </td>
							</tr>
						</table>
						-->
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Approx Size(SqFt)*</label></th>
								<td><label><input type="text" name="sq_feet" id="sq_feet" value= "<?php echo $sqft_total; ?>" /></label> </td>
							</tr>
						</table>
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Stories</label></th>
								<td><label><input type="text" name="stories" id="stories" value= "<?php echo $stories; ?>" /></label> </td>
							</tr>
						</table>
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Approx Lot Size*</label></th>
								<td><label><input type="text" id="lot_size" name="lot_size" value= "<?php echo $lotsize; ?>" /></label> </td>
							</tr>
						</table>
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Approx Acres*</label></th>
								<td><label><input type="text" id="app_acres"  name="app_acres" value= "<?php echo $acres; ?>" /></label> </td>
							</tr>
						</table>
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Year Built</label></th>
								<td><label><input type="text" id="year_built" name="year_built" value= "<?php echo $yearbuilt; ?>" /></label> </td>
							</tr>
						</table>
					<?php if($proptype == 'Farm/Ranch'){ ?>	
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Will Divide</label></th>
								<td><label><input type="checkbox" name="will_divide" value= "1" <?php echo ($additional_forms['will_divide'] == 1 ? ' checked ' : ''); ?> /></label> </td>
							</tr>
						</table>
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>% Fenced</label></th>
								<td><label><input type="text" name="fenced" value= "<?php echo $additional_forms['fenced']; ?>" /></label> </td>
							</tr>
						</table>
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Soil</label></th>
								<td><label><input type="text" name="soil" value= "<?php echo $additional_forms['soil']; ?>" /></label> </td>
							</tr>
						</table>
					<?php } ?>	
						
						<?php
							$mastr_bd = array('n/a'=>'N/A', 'downstairs'=>'DownStairs', 'upstairs'=>'Upstairs', );
							$new_mstr_bd = $additional_forms['masterbadroom'];
						?>
						<!--<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Master Bedroom</label></th>
								<td><label>
								<select name="masterbeds">
								<?php
									foreach($mastr_bd as $key=>$mstr){
										echo '<option '.($new_mstr_bd == $key ? ' selected ' : '').' value="'.$mstr.'" >'.$mstr.'</option>';
									}
								?>	
								</select>
								
								</label> </td>
							</tr>
						</table>-->

						<br />
						</div>
						
						<div class="addinf_rigt" style="float: left; margin-left: 100px;">
							<?php if($proptype == 'Residential' || $proptype == 'Farm/Ranch' || $proptype == 'Acreage' || $proptype == 'Residential Lots' || $proptype == 'Residential Leasing'  || $proptype == 'WaterView'  || $proptype == 'WaterFront'){  ?>
									
									
									
									<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Pool</label></th>
											<td><label><input type="checkbox" id="pool" name="pool" value= "Y" <?php echo $newchk; ?> /></label> </td>
										</tr>
									</table>
									<br />
									
									<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Hot Tub</label></th>
											<td><label><input type="checkbox" name="hot_tub" value= "1" <?php echo ($additional_forms['hottubs'] == 1 ? ' checked ' : ''); ?> /></label> </td>
										</tr>
									</table>
									<br />
									
									<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Golf Course</label></th>
											<td><label><input type="checkbox" name="golf_course" value= "1" <?php echo ($additional_forms['golf'] == 1 ? ' checked ' : ''); ?> /></label> </td>
										</tr>
									</table>
									<br />
									
									<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Handicapped Equipped</label></th>
											<td><label><input type="checkbox" id="handc_equpd" name="handc_equpd" value= "Y" <?php echo $newchks; ?> /></label> </td>
										</tr>
									</table>
									<br />
								<?php } if($proptype == 'Commercial' || $proptype == 'Commercial Lots' || $proptype == 'Multi-Family'  || $proptype == 'Commercial Leasing'){  ?>
								<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Within City Limits</label></th>
											<td><input type="checkbox" name="citylimit" value= "1" <?php echo ($additional_forms['citylimit'] == 1 ? ' checked ' : ''); ?> /></td>
										</tr>
									</table>
									<br />
									
									<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Within ETJ</label></th>
											<td><label><input type="checkbox" name="etj" value= "1" <?php echo ($additional_forms['etj'] == 1 ? ' checked ' : ''); ?> /></label> </td>
										</tr>
									</table>
									<br />
									<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Public Road Access</label></th>
											<td><label><input type="checkbox" name="road_access" value= "1" <?php echo ($additional_forms['road_access'] == 1 ? ' checked ' : ''); ?> /></label> </td>
										</tr>
									</table>
									<br />
									<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Flood Plain</label></th>
											<td><label><input type="checkbox" name="flood_plain" value= "1"  <?php echo ($additional_forms['flood_plain'] == 1 ? ' checked ' : ''); ?> /></label> </td>
										</tr>
									</table>
									<br />
									<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Minerals Convey</label></th>
											<td><label><input type="checkbox" name="minreals_convey" value= "1" <?php echo ($additional_forms['minreals_convey'] == 1 ? ' checked ' : ''); ?> /></label> </td>
										</tr>
									</table>
									<br />
							<?php } ?>							
							
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Resort Property</label></th>
									<td><label><input type="checkbox" name="resort_prop" value= "1"  <?php echo ($additional_forms['resort_property'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Waterfront</label></th>
									<td><label><input type="checkbox" name="waterfront" value= "1" <?php echo ($additional_forms['waterfront'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							
							
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Waterview</label></th>
									<td><label><input type="checkbox" name="waterview" value= "1" <?php echo ($additional_forms['waterview'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>New Home</label></th>
									<td><label><input type="checkbox" name="new_home" value= "1" <?php echo ($additional_forms['newhome'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Restrictions</label></th>
									<td><label><input type="checkbox" id="restrictions" name="restrictions" value= "1" <?php echo ($restrictions == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
						
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>City Water</label></th>
									<td><label><input type="checkbox" name="city_water" value= "1" <?php echo ($additional_forms['city_water'] == 1? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							 
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>City Sewer</label></th>
									<td><label><input type="checkbox" onclick="hide_the_other('city_sewer')" name="city_sewer" value= "1" <?php echo ($additional_forms['city_sweer'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							 
								<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Septic Tank</label></th>
									<td><label><input type="checkbox" onclick="hide_the_other(septic_tank)" name="septic_tank" value= "1" <?php  echo ($additional_forms['septic_tank'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							
								<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Electricity</label></th>
									<td><label><input type="checkbox" name="electricty" value= "1"  <?php echo ($additional_forms['electricity'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							
								<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Well</label></th>
									<td><label><input type="checkbox" name="well" value= "1" <?php echo ($additional_forms['well'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							
								<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Water Co-Op</label></th>
									<td><label><input type="checkbox" name="water_coop" value= "1" <?php echo ($additional_forms['water_coop'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							<?php	if($proptype == 'Farm/Ranch'){ ?>			
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Flood Plain</label></th>
									<td><label><input type="checkbox" name="flood_plain" value= "1" <?php  echo ($additional_forms['flood_plain'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Minerals Convey</label></th>
									<td><label><input type="checkbox" name="minreals_convey" value= "1" <?php  echo ($additional_forms['minreals_convey'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>AG Exemption</label></th>
									<td><label><input type="checkbox" name="ag_exemption" value= "1" <?php  echo ($additional_forms['ag_exemption'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Cross fenced</label></th>
									<td><label><input type="checkbox" name="cross_fenced" value= "1" <?php  echo ($additional_forms['cross_fenced'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />
						<?php } ?>
							
							<table class="form-table">
								<tr valign="top">
									<th scope="row"><label>Show Map Link? </label></th>
									<td><label><input type="checkbox" name="show_map" value= "1" <?php  echo ($additional_forms['showmap'] == 1 ? ' checked ' : ''); ?> /></label> </td>
								</tr>
							</table>
							<br />

						</div>
						<br clear="all" />
						<br />
						<input type="hidden" name="agent_id" value="<?php echo $agentlist; ?>" />
						<!--<input type="hidden" name="proptype" value="<?php echo $proptype; ?>" />-->
						<input type="hidden" name="formaction" value="additional" />
						
						<div >
				<input type="submit" value="Publish" name="save" class="button-primary" style="float:left" />
				<img src="<?php echo home_url(); ?>/wp-content/plugins/amerisale-re/upload/ajax-loader.gif" class="submit-spin"style="float:left; display:none" />
				</div >
					
					</form>
				</ul>
			</div>
	</div>
	
	
	
	<div id="example-three" style="margin-top:100px; width: 100%;">
		<h2> Financing Features </h2>
		<div class="list-wrap">
			<form method="post" id="financials" action="">
				<ul id="financing_new">
					
					<div class="fincancing" style="float:left;width:500px">
						<h4> Check the options applicable to this listing: </h4>
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Conventional</label></th>
								<td><label><input type="checkbox" name="conventional" value= "1"  <?php  echo ($finance_forms['conventinal'] == 1 ? ' checked ' : ''); ?> /></label> </td>
							</tr>
						</table>
						<br />
						
							<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>VA Loan</label></th>
								<td><label><input type="checkbox" name="va_loan" value= "1" <?php  echo ($finance_forms['va_loan'] == 1 ? ' checked ' : ''); ?> /></label> </td>
							</tr>
						</table>
						<br />
						
							<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>FHA Loan</label></th>
								<td><label><input type="checkbox" name="fha_loan" value= "1" <?php  echo ($finance_forms['fha_loan'] == 1 ? ' checked ' : ''); ?> /></label> </td>
							</tr>
						</table>
						<br />
						
							<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Owner Financed</label></th>
								<td><label><input type="checkbox" name="owner_financed" value= "1" <?php  echo ($finance_forms['owner_financed'] == 1 ? ' checked ' : ''); ?> /></label> </td>
							</tr>
						</table>
						<br />
						
							<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Texas Vet</label></th>
								<td><label><input type="checkbox" name="texas_vet" value= "1"  <?php  echo ($finance_forms['texas_vet'] == 1 ? ' checked ' : ''); ?> /></label> </td>
							</tr>
						</table>
						</div>
						<div class="financ" style="float:left;">
							<h3> Highlights </h3><br />
							<h4> Enter important highlights you wish to emphasize.</h4>
							
							<label> 1. <input type="text" name="high1" value= "<?php  echo $finance_forms['highlight_1'];?>" /></label><br clear="all" />
							<label> 2. <input type="text" name="high2" value= "<?php  echo $finance_forms['highlight_2'];?>" /></label><br clear="all" />
							<label> 3. <input type="text" name="high3" value= "<?php  echo $finance_forms['highlight_3'];?>" /></label><br clear="all" />
							<label> 4. <input type="text" name="high4" value= "<?php  echo $finance_forms['highlight_4'];?>" /></label><br clear="all" />
						</div>
						<br clear="all" /><br />
						<input type="hidden" name="formaction" value="financial" />
						
						<div >
				<input type="submit" value="Publish" name="save" class="button-primary" style="float:left" />
				<img src="<?php echo home_url(); ?>/wp-content/plugins/amerisale-re/upload/ajax-loader.gif" class="submit-spin"style="float:left; display:none" />
				</div >
				</ul>
			</form>		
		</div>
	</div>	
	
		<div id="example-three" style="margin-top:100px; width: 100%;">
		<h2> Photographs List </h2>
			<div class="photos">
			<h3>Uploaded Images</h3>
				<?php 
				if($mls=='')
					$mls = -1;
				$sql = "select * from ntreislist where MLS = ".$MLS." AND ".$WHERE_0fficelist;
				$office = mysql_query($sql); 
				$rowcount = mysql_num_rows($office);
				if($rowcount > 0){
					$n_id_row=mysql_fetch_array($office);
					$n_id=$n_id_row['id'];
				}else{
					$n_id= -1;
				}
				
				$img = "select * from ntreisimages where n_id = '".$n_id."' order by recordListingID,id ASC";
				$list = mysql_query($img); 
				while($row = mysql_fetch_assoc($list)){
					$images[] = $row;
				}
				if(!empty($images)){
					foreach($images as $img){
						if(empty($img['caption_text'])){
							$caption_text = '&nbsp;';
						}else{
							$caption_text = $img['caption_text'];
						}
						echo '<div id="'.$img['id'].'">';
							echo '<img src="'.$img['imagename'].'" id="show_url_'.$img['id'].'" alt="No Image" width="300px;"/>';
							echo "<br clear='all' /><br />";
							echo "<div class='caption'>Captions Text:-".$caption_text."</div>";
							echo "<br clear='all' /><br />";
								echo '<div class="edit_images" id="edit_images_'.$img['id'].'">';
									echo '<iframe scrolling="no" height="57px" frameborder="0" vspace="0" hspace="0" src="'.plugins_url().'/'.$plugin_dir.'/netriesdetail/upload.php?edit='.$img['id'].'" name="frame" id="frame2" class="image_iframe"></iframe>';
									echo '<br clear="all" />';
									echo '<label>Captions Text:</label><input type="text" value="" id="caption_'.$img['id'].'" value="'.$caption_text.'" name="caption">';
									echo '<input type="hidden" value="'.$img['imagename'].'" id="image_computer_'.$img['id'].'" name="image_computer" />';
									echo '<br clear="all" />';
									echo '<button onclick="update_photo('.$img['id'].')" >Update</button>';
									echo '<br clear="all" /><br />';
								echo '</div>';
							echo '<button onclick="Edit_photos('.$img['id'].')" >Edit Photo</button>';
							echo '<button onclick="deleteimg('.$img['id'].')" >Remove Photo</button>';
							echo "<br clear='all' /><br />";
						echo '</div>';
					}
				}else{
					echo "Yet Not Upload Any Image"; 
				}
				?>
			</div>
				<div class="phot" style="">
					<h2>Add photo</h2>
					
						1. <b>To Add a photo: </b> click Browse to select your image.
							<label for="file">Filename:</label>
							<div>
							<iframe scrolling="no" height="57px" frameborder="0" vspace="0" hspace="0" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/upload.php" name="frame" id="frame" class="image_iframe"></iframe>
							<br clear="all" />
							<img src="" id="show_url" class="image_f">
							<input type="hidden" value="" id="image_computer" name="image_computer" />
							</div>  
							<br clear="all" />
						2. <b>Caption </b>(Required): Type a short description of the photo.<br clear="all" />
							<input type="text" name="caption" id="caption" value="" />
							<br clear="all" /><br />
						3. <b>Finish:</b> Click <b> Add Photo </b> to finish.
						<br clear="all" />
						<label>Your Photo will appear in the list on the left.</label>
						<br clear="all" /><br />
					<button id="photo_upload" >Add Photo</button>
					
				</div>
			</div>	
		</div>