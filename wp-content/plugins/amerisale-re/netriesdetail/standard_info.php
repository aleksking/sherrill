<?php
	//print_r($_REQUEST);
	// die;
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
	$rets_area = $results[0]->rets_area;
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
	
	if($_REQUEST['formaction'] == 'standard'){
		// echo "<pre>";print_r($_REQUEST);die;
		$mlsnum = $_REQUEST['mlsnum'];
		$price = $_REQUEST['price'];
		$expires_date = $_REQUEST['expires_date'];
		$address = $_REQUEST['address'];
		$city = $_REQUEST['city'];
		$county = $_REQUEST['county'];
		$zip = $_REQUEST['zip'];
		$virtual_tour = $_REQUEST['virtual_tour'];
		$description = $_REQUEST['description'];
		$bedrooms = $_REQUEST['bedrooms'];
		$full_baths = $_REQUEST['full_baths'];
		$half_baths = $_REQUEST['half_baths'];
		$living_rooms = $_REQUEST['living_rooms'];
		$dining_rooms = $_REQUEST['dining_rooms'];
		// $proptype = $_REQUEST['proptype'];
		$proptype = $_REQUEST['type'];
		$agent_id = $_REQUEST['agent_id'];
		$premium_listing = $_REQUEST['premium_listing'];
		$sales_pending = $_REQUEST['sales_pending'];
		$sold = $_REQUEST['sold'];
		$locale = $_REQUEST['locale'];
		$date1 = $_REQUEST['date1'];
		$date2 = $_REQUEST['date2'];
		$start1 = $_REQUEST['start1'];
		$end1 = $_REQUEST['end1'];
		$start2 = $_REQUEST['start2'];
		$open_house = $_REQUEST['open_house'];
		$end2 = $_REQUEST['end2'];
		
		$offices = $_REQUEST['offices'];
		$restrooms = $_REQUEST['restrooms'];
		$meeting_spaces = $_REQUEST['meeting_spaces'];
		$parking_spaces = $_REQUEST['parking_spaces'];
		
		$barns = $_REQUEST['barns'];
		$sheds = $_REQUEST['sheds'];
		$shops = $_REQUEST['shops'];
		$ponds = $_REQUEST['ponds'];
		$stock_tanks = $_REQUEST['stock_tanks'];
		$corrals = $_REQUEST['corrals'];
		$pens = $_REQUEST['pens'];
		$units = $_REQUEST['units'];
		$new = $_REQUEST['new'];
		
		$schldist = $_REQUEST['schldist'];
		$nw_schol_dist = $_REQUEST['nw_schol_dist'];
		$sq_feet = $_REQUEST['sq_feet'];
		$stories = $_REQUEST['stories'];
		$lot_size = $_REQUEST['lot_size'];
		$app_acres = $_REQUEST['app_acres'];
		
		$subdivsion = $_REQUEST['subdivsion'];
		$year_built = $_REQUEST['year_built'];
		
		
		$car_space = $_REQUEST['car_space'];
		$fire_places = $_REQUEST['fire_places'];
		//echo $_REQUEST['pool'];
		if ($_REQUEST['restrictions']=='true')
			$restrictions ='Yes';
		else
			$restrictions = 'No';
			
		if ($_REQUEST['pool']=='true')
			$pool ='Y';
		else
			$pool = 'N';
			echo $_REQUEST['handc_equpd'];
		if ($_REQUEST['handc_equpd']=='true')
			$handc_equpd  ='Y';
		else
			$handc_equpd  = 'N';
		if ($_REQUEST['pool']=='true')
			$pool ='Y';
		else
			$pool = 'N';
		
		$garage_spaces = $_REQUEST['garage_spaces'];
		// var_dump($_REQUEST['premium_listing']);die;
		// echo date('Y-m-d H:i:s');die;
		if($premium_listing == 'on'){
			$premium = 1;
		}else{
			$premium = 0;
		}
		
		if($sales_pending == 'on'){
			$sales_pending = 1;
		}else{
			$sales_pending = 0;
		}
		if($sold == 'on'){
			$sold = 1;
		}else{
			$sold = 0;
		}
		if($open_house == 'on'){
			$open_house = 1;
		}else{
			$open_house = 0;
		}
		// die;
		$bathtotal = ($half_baths+$full_baths);
		if(isset($_REQUEST['update_plugin'])){
			$update_plugin = 1;
		}else{
			$update_plugin = 0;
		}
		if($expires_date == '00-00-0000'){
			$expires_date = '0000-00-00';
		}else{
			$explods = split('-',$expires_date);
			$expires_date = $explods[2].'-'.$explods[0].'-'.$explods[1];
		}
		//die($expires_date);
	
		$addsql = "select Name from agents where agent_license_no = ".$agent_id;
		$agent = mysql_query($addsql); 
		$agentsql = mysql_fetch_assoc($agent);
		$agent_name = $agentsql['Name'];
		
		$office = "select MLS from ntreislist where MLS = ".$mlsnum . " AND ".$WHERE_0fficelist." AND delete_status = '0'";
		$sql = mysql_query($office); 
		//die($office);
		while($row = mysql_fetch_assoc($sql)){
			$chck_mlssql[] = $row;
		}
		// echo "<pre>";print_r($chck_mlssql);die;
		$rowcount = count($chck_mlssql);
		if($rowcount > 0 && $new == 'new'){
			echo 'duplicate_mls';
			exit;
		}
					
		
		if($rowcount > 0){
		$sql1 = "update ntreislist set restriction = '".$restrictions."', carport_space = '".$car_space."',fire_place = '".$fire_places."',handicapt = '".$handc_equpd."', pool = '".$pool."', sqft_total = '".$sq_feet."',stories = '".$stories."',lotsize = '".$lot_size."',acres = '".$app_acres."',yearbuilt = '".$year_built."',
				schooldistrict = '".$schldist."', sub_division = '".$subdivsion."', agentlist = '".$agent_id."', agent_name = '".$agent_name."', baths='".$bathtotal."', bedrooms='".$bedrooms."', city='".$city."',county='".$county."', directions='".mysql_real_escape_string($address)."', garage_cap= '".$garage_spaces."', listprice='".$price."',
				liststatus = 'Active', remarks='".mysql_real_escape_string($description)."', expired_date = '".$expires_date."', num_dining_areas='".$dining_rooms."',num_living_areas='".$living_rooms."', proptype='".$proptype."', 
				zipcode='".$zip."', bath_half = '".$half_baths."', bath_full = '".$full_baths."',is_manual_edit = '1',  modified = '".date('Y-m-d H:i:s')."',virtual_tour = '".$virtual_tour."',is_update_rets='".$update_plugin."',premium='".$premium."',
				sales_pending='".$sales_pending."',sold='".$sold."',locale='".$locale."',date1='".$date1."',date1start_time='".$start1."',date1end_time='".$end1."',date2='".$date2."',date2start_time='".$start2."',date2end_time='".$end2."',open_house='".$open_house."',officelist='".$agent_offcode."', delete_status = '0' , 
				offices = '".$offices."', restrooms = '".$restrooms."', meeting_spaces = '".$meeting_spaces."', parking_spaces = '".$parking_spaces."', barns = '".$barns."',sheds = '".$sheds."',shops = '".$shops."',ponds = '".$ponds."',stock_tanks = '".$stock_tanks."',corrals = '".$corrals."',pens = '".$pens."',units = '".$units."'
				where MLS = '".$mlsnum."' AND ".$WHERE_0fficelist." AND delete_status = '0'"; 
				// $res2 =  $wpdb->query($sql1);
				$res2 = mysql_query($sql1); 
			echo "updated";	
			echo $sql1;
		}else{
			// $office =  $wpdb->get_results("select agent_offcode from  ".$wpdb->prefix."agentaccount");
			$sql = "select agent_offcode from agent_offcode where nid = '".$splits[1]."'";
		$agent = mysql_query($sql); 
		$office = mysql_fetch_assoc($agent);
// $financesql = mysql_query($financesql); 			
		// print_r($agentsql[0]->Name);die;
			$sql = "insert into ntreislist ( restriction, carport_space, fire_place, handicapt, pool, sqft_total, stories, lotsize, acres, yearbuilt, 
						schooldistrict, sub_division, rets_area, agentlist, agent_name, baths, bedrooms, city, county, directions, garage_cap, listprice, 
						liststatus, MLS, modified, remarks, num_dining_areas, num_living_areas, proptype, zipcode, bath_half, bath_full, expired_date,is_manual_edit,virtual_tour,
						is_update_rets,premium,sales_pending,sold,locale,date1,date1start_time,date1end_time,date2,date2start_time,date2end_time,open_house,officelist,
						offices,restrooms,meeting_spaces,parking_spaces,barns,sheds,shops,ponds,stock_tanks,corrals,pens,units)
						values ( '".$restrictions."','".$car_space."','".$fire_places."','".$handc_equpd."','".$pool."','".$sq_feet."','".$stories."','".$lot_size."','".$app_acres."','".$year_built."',
						'".$schldist."', '".$subdivsion."', 'manual_".$agent_offcode."','".$agent_id."','".$agent_name."','".$bathtotal."', '".$bedrooms."', '".$city."', '".$county."', '".mysql_real_escape_string($address)."', '".$garage_spaces."', '".$price."', 'Active', '".$mlsnum."',  'NOW()','".mysql_real_escape_string($description)."', '".$dining_rooms."',
						'".$living_rooms."', '".$proptype."', '".$zip."', '".$half_baths."', '".$full_baths."', '".$expires_date."','1','".$virtual_tour."','".$update_plugin."','".$premium."','".$sales_pending."','".$sold."','".$locale."','".$date1."','".$start1."','".$end1."',
						'".$date2."','".$start2."','".$end2."','".$open_house."','".$agent_offcode."','".$offices."','".$restrooms."','".$meeting_spaces."','".$parking_spaces."',
						'".$barns."','".$sheds."','".$shops."','".$ponds."','".$stock_tanks."','".$corrals."','".$pens."','".$units."') ";
			// die;
			//$resl = mysql_query($sql);
			$res1 = mysql_query($sql); 
			// $resl =  $wpdb->query($sql);
			
			// $sqls = "insert into  ".$wpdb->prefix."map_agent (mlsid, agent_id)values (".$mlsnum.", ".$agent_id.")";
			// $res2 =  $wpdb->query($sqls);
			echo "inserted";
		}	
	}else if($_REQUEST['formaction'] == 'additional'){
	// echo "<pre>";print_r($_REQUEST);die;
		$mlsnum = $_REQUEST['mlsid'];
		$movedate = $_REQUEST['movedate'];
		$schldist = $_REQUEST['schldist'];
		
		$nw_schol_dist = $_REQUEST['nw_schol_dist'];
		$subdivsion = $_REQUEST['subdivsion'];
		
		//$new_sub_div = $_REQUEST['new_sub_div'];
		/* $sq_feet = $_REQUEST['sq_feet'];
		$stories = $_REQUEST['stories'];
		$lot_size = $_REQUEST['lot_size'];
		$app_acres = $_REQUEST['app_acres']; */
		//$year_built = date('Y-m-d' ,strtotime($_REQUEST['year_built']));
		/* $year_built = $_REQUEST['year_built']; */
		
		$hot_tub = isset($_REQUEST['hot_tub'])?$_REQUEST['hot_tub']:0;
		$golf_course = isset($_REQUEST['golf_course'])?$_REQUEST['golf_course']:0;
		
		$resort_prop = isset($_REQUEST['resort_prop'])?$_REQUEST['resort_prop']:0;
		$waterfront = isset($_REQUEST['waterfront'])?$_REQUEST['waterfront']:0;
		$waterview = isset($_REQUEST['waterview'])?$_REQUEST['waterview']:0;
		$new_home = isset($_REQUEST['new_home'])?$_REQUEST['new_home']:0;
		
		$city_water = isset($_REQUEST['city_water'])?$_REQUEST['city_water']:0;
		$city_sewer = isset($_REQUEST['city_sewer'])?$_REQUEST['city_sewer']:0;
		$electricty = isset($_REQUEST['electricty'])?$_REQUEST['electricty']:0;
		$well = isset($_REQUEST['well'])?$_REQUEST['well']:0;
		$water_coop = isset($_REQUEST['water_coop'])?$_REQUEST['water_coop']:0;
		$septic_tank = isset($_REQUEST['septic_tank'])?$_REQUEST['septic_tank']:0;
		$show_map = isset($_REQUEST['show_map'])?$_REQUEST['show_map']:0;
		
		$citylimit = isset($_REQUEST['citylimit'])?$_REQUEST['citylimit']:0;
		$etj = isset($_REQUEST['etj'])?$_REQUEST['etj']:0;
		$road_access = isset($_REQUEST['road_access'])?$_REQUEST['road_access']:0;
		$flood_plain = isset($_REQUEST['flood_plain'])?$_REQUEST['flood_plain']:0;
		$minreals_convey = isset($_REQUEST['minreals_convey'])?$_REQUEST['minreals_convey']:0;
		
		$will_divide = isset($_REQUEST['will_divide'])?$_REQUEST['will_divide']:0;
		$soil = $_REQUEST['soil'];
		$fenced = $_REQUEST['fenced'];
		$ag_exemption = isset($_REQUEST['ag_exemption'])?$_REQUEST['ag_exemption']:0;
		$cross_fenced = isset($_REQUEST['cross_fenced'])?$_REQUEST['cross_fenced']:0;
		
		$proptype = $_REQUEST['proptype'];
		$masterbeds = $_REQUEST['masterbeds'];
		$agent_id = $_REQUEST['agent_id'];
		
		if($nw_schol_dist){
			//echo "sfsf";
			//die;
			$schl_dt = $nw_schol_dist;
		}else{
			$schl_dt = $schldist;
		}
		
		if($new_sub_div){
			$subdivsn = $new_sub_div;
		}else{
			$subdivsn = $subdivsion;
		}
		
		//NEW CODE
		$sql = "SELECT id FROM ntreislist WHERE MLS  ="  . $mlsnum ." AND ".$WHERE_0fficelist." AND delete_status = '0'";
		$result = mysql_fetch_assoc(mysql_query($sql));
		
		// echo ($sql);
		
		//NEW CODE
		$mlssql = "select nid from additionalinfo where n_id = ".$result['id'];
		$list = mysql_query($mlssql); 
		while($row = mysql_fetch_assoc($list)){
			$chck_mlssql[] = $row;
		}
		
		$agentsql = "select Name from agents where agent_id = ".$_REQUEST['agent_id'];
		$agentsql = mysql_query($agentsql); 
		$row = mysql_fetch_assoc($agentsql);
		$agent_name = $row['Name'];
					
		$rowcount = count($chck_mlssql);
		if($rowcount > 0){			
			
					
		
		//NEW CODE
		$scn_sql = "update additionalinfo set moveindate = '".$movedate."',  masterbadroom = '".$masterbeds."', 
				hottubs = '".$hot_tub."', golf = '".$golf_course."', resort_property = '".$resort_prop."', waterview = '".$waterview."', 
				waterfront = '".$waterfront."', newhome = '".$new_home."', city_water = '".$city_water."',  city_sweer = '".$city_sewer."',  electricity = '".$electricty."', 
				well = '".$well."',  water_coop = '".$water_coop."', showmap =  '".$show_map."', septic_tank = '".$septic_tank."', citylimit = '".$citylimit."' , etj = '".$etj."' , road_access = '".$road_access."' , flood_plain = '".$flood_plain."' , minreals_convey = '".$minreals_convey."',
				will_divide = '".$will_divide."',soil = '".$soil."',fenced = '".$fenced."' , ag_exemption = '".$ag_exemption."',cross_fenced = '".$cross_fenced."'  
				where n_id = '".$result['id']."'"; 	
			
			$res1 = mysql_query($scn_sql); 
			echo "updated";			
		}else{
	
			$scn_sql = "insert into additionalinfo (nid, moveindate, masterbadroom, hottubs, golf, resort_property, waterview,
				waterfront, newhome, city_water, city_sweer, electricity, well, water_coop, showmap, septic_tank, citylimit, etj, road_access, flood_plain, minreals_convey, will_divide, soil, fenced, ag_exemption, cross_fenced,n_id) 
				values ('".$mlsnum."', '".$movedate."', '".$masterbeds."', '".$hot_tub."', '".$golf_course."', '".$resort_prop."', 
				'".$waterview."', '".$waterfront."', '".$new_home."', '".$city_water."','".$city_sewer."','".$electricty."','".$well."','".$water_coop."', '".$show_map."', '".$septic_tank."', '".$citylimit."', '".$etj."', '".$road_access."', '".$flood_plain."', '".$minreals_convey."', '".$will_divide."', '".$soil."', '".$fenced."', '".$ag_exemption."', '".$cross_fenced."','".$result['id']. "'  ) ";
			//die($scn_sql);
			// $res2 =  $wpdb->query($scn_sql);
			$res1 = mysql_query($scn_sql); 
			// print_r($result);
			echo "inserted";
			// echo $scn_sql;
			
			
			
		}	
	}else if($_REQUEST['formaction'] == 'financial'){
		// print_r($_REQUEST);
		// die;
		$mlsnum = $_REQUEST['mlsid'];
		$conventional = isset($_REQUEST['conventional'])?$_REQUEST['conventional']:0;
		$fha_loan = isset($_REQUEST['fha_loan'])?$_REQUEST['fha_loan']:0;
		$owner_financed = isset($_REQUEST['owner_financed'])?$_REQUEST['owner_financed']:0;
		$texas_vet = isset($_REQUEST['texas_vet'])?$_REQUEST['texas_vet']:0;
		$va_loan = isset($_REQUEST['va_loan'])?$_REQUEST['va_loan']:0;
		$high1 = $_REQUEST['high1'];
		$high2 = $_REQUEST['high2'];
		$high3 = $_REQUEST['high3'];
		$high4 = $_REQUEST['high4'];
		/* 
		$chck_mlssql =  $wpdb->get_results("select mlsid from  ".$wpdb->prefix."financial where mlsid = ".$mlsnum);
		$rowcount = count($chck_mlssql); */
		
		//NEW CODE
		$sql = "SELECT id FROM ntreislist WHERE MLS  ="  . $mlsnum . " AND ".$WHERE_0fficelist." AND delete_status = '0'";
		$result = mysql_fetch_assoc(mysql_query($sql));
		
		//$mlssql = "select mlsid from financial where mlsid = ".$mlsnum;
		//NEW CODE
		$mlssql = "select mlsid from financial where n_id = ".$result['id'];
		
		$list = mysql_query($mlssql); 
		while($row = mysql_fetch_assoc($list)){
			$chck_mlssql[] = $row;
		}
		
		$rowcount = count($chck_mlssql);
		
		if($rowcount > 0){
						//NEW CODE
			$updt_sql = "update financial set conventinal = '".$conventional."', va_loan = '".$va_loan."', fha_loan = '".$fha_loan."', 
			owner_financed = '".$owner_financed."', texas_vet = '".$texas_vet."', highlight_1 = '".$high1."', highlight_2 = '".$high2."', highlight_3 = '".$high3."', highlight_4 = '".$high4."' where n_id = ".$result['id'] ;
			
			$res2 = mysql_query($updt_sql); 
			// $res2 =  $wpdb->query($updt_sql);
			if($res2){
				echo "updated";
				die;
			}else{
				echo "update failed";
				die;
			}
		}else{
		
			$ins_sql = "insert into financial (mlsid, conventinal, va_loan, fha_loan, owner_financed, texas_vet, highlight_1, highlight_2, highlight_3, highlight_4,n_id) 
				values 
			('".$mlsnum."', '".$conventional."', '".$va_loan."', '".$fha_loan."', '".$owner_financed."',  '".$texas_vet."', '".$high1."', '".$high2."', '".$high3."', '".$high4."','" .$result['id']. "' ) ";
			
			$res2 = mysql_query($ins_sql); 
			
			if($res2){
				echo "inserted";
				die;
			}else{
				echo "insert failed";
				die;
			}
		}
	}else if($_REQUEST['formaction'] == 'imageuploads'){
		// print_R($_REQUEST);
		// die;
		$mlsnum = $_REQUEST['mlsid'];
		$photoname = $_REQUEST['photoname'];
		$caption = $_REQUEST['caption'];
		
		//NEW CODE
		$sql = "SELECT id FROM ntreislist WHERE MLS  ="  . $mlsnum . " AND ".$WHERE_0fficelist;
		$result = mysql_fetch_assoc(mysql_query($sql));
		
		$ins_sql = "insert into ntreisimages (mlsnum, imagename, caption_text,n_id) values ('".$mlsnum."', '".$photoname."', '".$caption."','" . $result['id'] ."') ";
		$res2 = mysql_query($ins_sql); 
		
		if($res2){
			// echo "inserted";
			?>
			<h3>Uploaded Images</h3>
			<?php 
			//$img = "select * from ntreisimages where mlsnum = '".$mlsnum."' order by id desc";
			$img = "select * from ntreisimages where n_id = '".$result['id']."' order by id desc";
			$list = mysql_query($img); 
			while($row = mysql_fetch_assoc($list)){
				$images[] = $row;
			}
		
			if(!empty($images)){
				foreach($images as $img){
					if(empty($img['caption_text'])){
						$caption_text = $img['caption_text'];
					}else{
						$caption_text = '&nbsp;';
					}
					echo '<div id="'.$img['id'].'">';
						echo '<img src="'.$img['imagename'].'" alt="No Image" width="300px;"/>';
						echo "<br clear='all' /><br />";
						echo "<div class='caption'>".$caption_text."</div>";
						echo "<br clear='all' /><br />";
						echo '<button onclick="deleteimg('.$img['id'].')" >Remove Photo</button>';
						echo "<br clear='all' /><br />";
					echo '</div>';
				}
			}else{
				echo "Yet Not Upload Any Image"; 
			}
			?>
			<?php
			// die;
		}else{
			echo "insert failed";
			die;
		} 
	}
?>
<?php mysql_close($con); ?>