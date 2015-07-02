<?php 
	// echo "<pre>";print_r($_REQUEST);
	
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

	?>
<link rel="stylesheet" href="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/css/datepicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/css/layout.css" />
	
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>	
	<script type="text/javascript" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/js/datepicker.js"></script>
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/js/eye.js"></script>
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/js/utils.js"></script> 
	<script type='text/javascript' src='<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/js/jquery.autocomplete.js'></script>
	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/css/jquery.autocomplete.css" />
    
    <script>
			$.noConflict();
		jQuery(document).ready(function($) {
				$('.current').click(function() {
				  $('.list-wrap').html('Loading..........');
				   $('#example-two').show();
				   location.reload();
				  $('.list-wrap').load('<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/loading.php');
				});
				
			$("#standardform").submit(function(){
			
					//alert("Standard form");
					var mlsid = $("#MISD").val();
					if(mlsid == '' || mlsid == 0){
						alert('Your MLS num is empty or equal to zero . Please fill MLS number field in the first form ');
						return false;
					}
				
				
				
					var datas = $("#standardform").serialize();
					var expired_date = $("#expired_date").val();
					var today_date = $("#today_date").val();
					
					var property = $("#property").val();
					
					// end - start returns difference in milliseconds 
					var diff = new Date(expired_date - today_date); 
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
					  data: datas+"&proptype="+property
					}).done(function(res) {  
						//alert(res);
						// $('.list-wrap').html(res);
					});
					
					
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
						// $('.list-wrap').html(res);
					});
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
				
					//alert("Additional form");
					var mlsid = $("#MISD").val();
					if(mlsid == '' || mlsid == 0){
					alert('Your MLS num is empty or equal to zero . Please fill MLS number field in the first form ');
						return false;
					}
				
					var datas = $("#standardform").serialize();
					var expired_date = $("#expired_date").val();
					var today_date = $("#today_date").val();
					
					var property = $("#property").val();
					
					// end - start returns difference in milliseconds 
					var diff = new Date(expired_date - today_date); 
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
					  data: datas+"&proptype="+property
					}).done(function(res) {  
						//alert(res);
						// $('.list-wrap').html(res);
					});
					
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
					/*var mlsid = $("#MISD").val();
					if(mlsid == ''){
						alert('Your MLS num is empty . Please fill MLS number field in the first from ');
						return false;
					}*/
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
					  data: datas+"&mlsid="+mlsid
					}).done(function(res) {  
						alert(res);
						// $('.list-wrap').html(res);
					});
					
					
				  return false;
				});
				
				
				$("#financials").submit(function(){
				
					//alert("financials");
					var mlsid = $("#MISD").val();
					if(mlsid == '' || mlsid == 0){
						alert('Your MLS num is empty or equal to zero . Please fill MLS number field in the first form ');
						return false;
					}
				
				
					var datas = $("#standardform").serialize();
					var expired_date = $("#expired_date").val();
					var today_date = $("#today_date").val();
					
					var property = $("#property").val();
					
					// end - start returns difference in milliseconds 
					var diff = new Date(expired_date - today_date); 
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
					  data: datas+"&proptype="+property
					}).done(function(res) {  
						//alert(res);
						// $('.list-wrap').html(res);
					});
					
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
					/*var mlsid = $("#MISD").val();
					if(mlsid == ''){
						alert('Your MLS num is empty . Please fill MLS number field in the first from ');
						return false;
					}*/
					$.ajax({
					  url: "<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/netriesdetail/standard_info.php",
					  data: datas+"&mlsid="+mlsid
					}).done(function(res) {  
						alert(res);
						// $('.list-wrap').html(res);
					});
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
		#example-two ,#example-three, #example-foure
		{
			background: none repeat scroll 0 0 #EEEEEE;
			box-shadow: 0 0 5px #666666;
			margin: 0 0 20px;
			padding: 10px;
			float:left;
		}
		label {
			cursor: pointer;
			  font-family: arial;
			font-weight: bold;
		}
		.form-table th {
			padding: 10px;
			text-align: left;
			vertical-align: top;
			width: 150px;
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
		.form-table2 th {
			padding: 10px;
			text-align: left;
			vertical-align: top;
			width: 150px;
		}
		.form-table3 th {
			padding: 10px;
			text-align: left;
			vertical-align: top;
			width: 150px;
		}
		.form-table2 td{
			padding-left: 6px;
			line-height: 35px;
		}
		.form-table3 td{
			padding-left: 6px;
			line-height: 35px;
		}
	 </style>
	<?php
		// echo "<pre>"; print_r($_REQUEST);
	$agent_ls = $adds_res = array();
	
	$splits = split('~',$_REQUEST['agent']);
	//$sql = "select * from ".$wpdb->prefix."ntreislist where MLS = '".$splits[1]."'";
	

	$sql = "select * from ntreislist where MLS = '".$splits[1]."' AND rets_area NOT LIKE '%abor%'";
	
	$agent = mysql_query($sql); 
	$agent_l = mysql_fetch_assoc($agent);
	// echo "<pre>"; print_r($agent_ls);die;
	/* $addsql = "select * from ".$wpdb->prefix."additionalinfo where nid = '".$splits[1]."'";
	$adds_res = $wpdb->get_results($addsql); */
	
	//$addsql = "select * from additionalinfo where nid = '".$splits[1]."'";
	//NEW CODE
	$addsql = "select * from additionalinfo where n_id = '".$agent_l['id']."'";
	
	
	$agent = mysql_query($addsql); 
	$additional_forms = mysql_fetch_assoc($agent);
	/* 
	$financesql = "select * from ".$wpdb->prefix."financial where mlsid = '".$splits[1]."'";
	$finance_res = $wpdb->get_results($financesql); */
	
	
	//$financesql = "select * from financial where mlsid = '".$splits[1]."'";
	//NEW CODE
	$financesql = "select * from financial where n_id = '".$agent_l['id']."'";
	
	
	
	$financesql = mysql_query($financesql); 
	$finance_forms = mysql_fetch_assoc($financesql);
	// echo "<pre>";
	// $additional_forms = $adds_res[0];
	// $finance_forms = $finance_res[0];
	// echo "<pre>";print_r($finance_forms);
	// die;
	 
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
		$lotsize =  '';
		$stories =  '';
		$carport_space =  '';
		$fire_place =  '';
		$pool =  '';
		$handicapt =  '';
		$restriction =  '';
		$virtual_tour =  '';
		$restrictions = '';
		$premium_listing = '';
		$is_manual_edit = '';
		$virtual_tour = '';
		$expired_date = '';
		$is_update_rets = '';
		$sales_pending = '';
		$sold = '';
		$open_house = '';

		$offices = '';
		$restrooms = '';
		$meeting_spaces = '';
		$parking_spaces = '';
		$barns = '';
		$sheds = '';
		$shops = '';
		$ponds = '';
		$stock_tanks = '';
		$corrals = '';
		$pens = '';
		$units = '';
	}
	if($is_manual_edit == 1){
		$address = $directions;
	}else if($is_manual_edit == 0 || $is_manual_edit == 2){
		$address = $street_num.' '.$street_name.' '.$street_type.' '.$city.' '.$state.' '.$zipcode.' '.$county;
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
	$today = getdate();
	$dates = $today['year']."-".$today['mon']."-".$today['mday'];
	$dates = date('m-d-Y',strtotime($dates));
	if(!empty($expired_date)){
		if($dates > $expired_date){ 
			$date = date('m-d-Y', strtotime('+45 days'));
		}else{
			$date = date("m-d-Y",strtotime($expired_date));
		}
	}else{
		$date = date("m-d-Y");
		// $date = date('Y-m-d', strtotime('+45 days'));
	}
	
	// echo $expired_date."<hr />".$date; die;
	if($locale == 'downstairs'){
		$downstairs = 'selected="selected"';
	}else{
		$upstairs = 'selected="selected"';
	}
	
	// echo "zip".$baths;
?>

	<style>
		#example-two, #example-three, #example-foure {
			padding: 0px !important;
			}
	</style>
	
	<div id="example-one_new" >	
        	<ul class="nav">
                <li class="nav-one"><div class="current"><input type="button" value="Go Back" /> </div></li>
            </ul>

	<div class="list-wrap">
		
		<ul id="addnetres1">

			<?php echo $proptype; ?>  Listing <br clear ="all" />
			Standard From
			<form method="post" id="standardform" action="javascript:void(0);">
				Type <?php echo $proptype; ?>
				<br clear ="all" />
				
			<div class="fm_right" style="float:left; border-right: 1px solid #000000;width: 690px;">		
				
				<table class="form-table">

					<tr valign="top">
						<th scope="row"><label>Allow MLS Overwrite</label></th>
						<td><label><input type="checkbox" name="update_plugin" <?php echo $chk; ?> /></label> </td>
					</tr>
					<tr valign="top">
						<th ><label>Type </label></th>
						<!--<td><?php echo $proptype; ?> </td>-->
						<td>
							<?php
								$prop_array = array("Residential"=>"Residential", "Commercial"=>"Commercial", 
									"Acreage"=>"Acreage",  "Multi-Family"=>"Multi-Family",  "Residential Leasing"=>"Residential Leasing",  "Commercial Leasing"=>"Commercial Leasing",
									"Residential Lots"=>"Residential Lots", "Commercial Lots"=>"Commercial Lots",  "Farm/Ranch"=>"Farm/Ranch",  "WaterFront"=>"WaterFront",  "WaterView"=>"WaterView");
								
							echo '<select name="type" id="property" class="property">';
								foreach($prop_array as $key=>$propval){
									echo '<option '.($proptype == $propval ? ' selected ' : '').' value="'.$propval.'" >'.$propval.'</option>';
								}
							echo '</select>';
							?>
							<input type="hidden" name="ptype" id="ptype" value= "<?php echo $proptype; ?>" /> 
						</td>
						<th scope="row"><label>MLS Number</label></th>
						<td><input type="text" name="mlsnum" id="MISD" value= "<?php echo $splits[1]; ?>" /> </td>
					</tr>
					<tr valign="top">
						<th ><label>Sales pending</label></th>
						<td><input type="checkbox" <?php echo $sales_pending; ?> name="sales_pending"/> </td>
						<th ><label>Sold</label></th>
						<td><input type="checkbox" <?php echo $sold; ?> name="sold"/> </td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>Price</label></th>
						<td><label><input type="text" name="price" value= "<?php echo $listprice; ?>" /></label> </td>
						<th scope="row"><label>Expires Date:</label></th>
						<td><input type="text" name="expires_date" id="inputDate" class ="inputDate" value= "<?php echo $date; ?>" /><label>  MM/DD/YYYY </label></td>
						<input type="hidden" value="<?php echo $date; ?>" id="today_date" />
					</tr>
					<tr valign="top">
						<th scope="row"><label>Address</label></th>
						<td><input type="text" name="address" value= "<?php echo $address; ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>City</label></th>
						<td><label><input type="text" name="city" value= "<?php echo $city; ?>" /></label> </td>
					</tr>	
					<tr valign="top">
					
						<th scope="row"><label>County</label></th>
						<td><label><input type="text" name="county" value= "<?php echo $county; ?>" /></label> </td>	
					</tr>
					
					<tr valign="top">
						<th scope="row"><label>Zip</label></th>
						<td><label><input type="text" name="zip" value= "<?php echo $zipcode; ?>" /></label> </td>
						
					</tr>
					
					
				<tr valign="top">
					<th ><label>Open House</label></th>
					<td style="color:#9D1D1E;"><input type="checkbox" <?php echo $open_house; ?> name="open_house" /> on/off</td>
					<th ><label>Premium Listing</label></th>
					<td><input type="checkbox" <?php echo $Listing; ?> name="premium_listing" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Date 1 </label></th>
					<td><input type="text" name="date1" value= "<?php echo $date1; ?>" /> </td>
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
						<td><input type="text" name="date2" value= "<?php echo $date2; ?>" /></td>
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
					
				</tr>
				<tr valign="top">
					<th scope="row"><label>Virtual Tour</label></th>
					<td><label><input type="text" name="virtual_tour" value= "<?php echo $virtual_tour; ?>" /></label> </td>
				</tr>
				
				<tr valign="top">
					<th scope="row"><label>Description</label></th>
					<td><label><textarea cols="40" rows="10" name="description" value= "<?php echo stripslashes($remarks); ?>" ><?php echo stripslashes($remarks); ?></textarea></label> </td>
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
							  <option <?php echo $downstairs; ?> value="downstairs">DownStairs</option>
							  <option <?php echo $upstairs; ?> value="upstairs">Upstairs</option>
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
							<td><label><input type="text" name="garage_spaces" value= "<?php echo $garage_cap; ?>" /><label></td>
						</tr>
					</table>
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
			
				<input type="hidden" name="agent_id" value="<?php echo $splits[0]; ?>" />
				<!--<input type="hidden" name="proptype" value="<?php echo $proptype; ?>" />-->
				<input type="hidden" name="formaction" value="standard" />
			
				<br clear="all" /><br /><br />
				<input type="submit" value="Publish" name="save" class="button-primary" />
				
			</form>

		</ul>

	</div>

	</div>

		<br clear="all" />
	<br /><br clear="all" />
	
	<div id="example-three" style="margin-top:100px; width: 100%;">
	<h2> Additional Information </h2>
			<div class="list-wrap">
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
								<td><label><input type="text" name="sq_feet" value= "<?php echo $sqft_total; ?>" /></label> </td>
							</tr>
						</table>
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Stories</label></th>
								<td><label><input type="text" name="stories" value= "<?php echo $stories; ?>" /></label> </td>
							</tr>
						</table>
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Approx Lot Size*</label></th>
								<td><label><input type="text" name="lot_size" value= "<?php echo $lotsize; ?>" /></label> </td>
							</tr>
						</table>
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Approx Acres*</label></th>
								<td><label><input type="text" name="app_acres" value= "<?php echo $acres; ?>" /></label> </td>
							</tr>
						</table>
						
						<table class="form-table">
							<tr valign="top">
								<th scope="row"><label>Year Built</label></th>
								<td><label><input type="text" name="year_built" value= "<?php echo $yearbuilt; ?>" /></label> </td>
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
											<th scope="row"><label>Carport Spaces</label></th>
											<td><label><input type="text" name="car_space" value= "<?php echo $carport_space; ?>" /></label> </td>
										</tr>
									</table>
									<br />
									<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Fire Places</label></th>
											<td><label><input type="text" name="fire_places" value= "<?php echo $fire_place; ?>" /></label> </td>
										</tr>
									</table>
									<br />
									
									
									<table class="form-table">
										<tr valign="top">
											<th scope="row"><label>Pool</label></th>
											<td><label><input type="checkbox" name="pool" value= "Y" <?php echo $newchk; ?> /></label> </td>
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
											<td><label><input type="checkbox" name="handc_equpd" value= "Y" <?php echo $newchks; ?> /></label> </td>
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
									<td><label><input type="checkbox" name="restrictions" value= "1" <?php echo ($restrictions == 1 ? ' checked ' : ''); ?> /></label> </td>
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
						<input type="hidden" name="agent_id" value="<?php echo $splits[0]; ?>" />
						<!--<input type="hidden" name="proptype" value="<?php echo $proptype; ?>" />-->
						<input type="hidden" name="formaction" value="additional" />
						
						<input type="submit" value="Publish" name="save" class="button-primary" />
					
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
						
						<input type="submit" value="Publish" name="save" class="button-primary" />
				</ul>
			</form>	
		</div>
	</div>	
	
		<div id="example-three" style="margin-top:100px; width: 100%;">
		<h2> Photographs List </h2>
		<br clear='all' />
		<button onclick="ordering()">Image order</button>
		<br clear='all' />
			<div class="photos">
			<h3>Uploaded Images</h3>
				<?php 
				$sql = "select * from ntreislist where MLS = ".$splits[1]." AND rets_area = 'manual_".$agent_offcode."'";
				$office = mysql_query($sql); 
				$rowcount = mysql_num_rows($office);
				if($rowcount > 0){
					$n_id_row=mysql_fetch_array($office);
					$n_id=$n_id_row['id'];
				}
				
				$img = "select * from ntreisimages where n_id = '".$n_id."' order by id desc";
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
									echo '<iframe scrolling="no" height="57px" frameborder="0" vspace="0" hspace="0" src="'.plugins_url().'/'.$plugin_dir.'/netriesdetail/upload.php?edit='.$img['id'].'" name="frame" id="frame" class="image_iframe"></iframe>';
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
		
	<?php mysql_close($con); ?>