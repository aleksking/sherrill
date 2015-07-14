<?php
	require_once("../../../../wp-config.php");
	global $wpdb;
	
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);

	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$agent_offcode = $results[0]->agent_offcode;
	$rets_area = $results[0]->rets_area;
	
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($db_name, $con);
	
	if(!empty($rets_area)){//if mls 
		$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND (rets_area = '".$rets_area."' OR rets_area = 'manual_".$agent_offcode."') "; 
	}else{ //manual only
		$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND  rets_area = 'manual_".$agent_offcode."' "; 
	}
	  
	if(!empty($_REQUEST['city'])){
		$WHERE_0fficelist = " city = '".$_REQUEST['city']."' ";
	}
	
	$proptype = $_REQUEST['proptype'];
	$proptype_sql = (empty($proptype) || $proptype == 'all') ? "" : "proptype = '".$proptype."' and ";


	$strPage = $_REQUEST['pageid'];
		
	$order = 'desc';
	$min_price = $_REQUEST['minprc'];
	$min_price = str_replace (",",'',$min_price);
	$min_price = str_replace ("$",'',$min_price);

	if($min_price=='') $min_price ='0';
	
	$max_price = $_REQUEST['maxprc'];
	$max_price = str_replace (",",'',$max_price);
	$max_price = str_replace ("$",'',$max_price);

	if($max_price=='') $max_price ='100000000';

	if($min_price> $max_price){
		$temp_min = $min_price;
		$min_price = $max_price;
		$max_price= $temp_min;		
	}
	
	$btwn = " replace(listprice, ',', '')+0 >= '".$min_price."' AND replace(listprice, ',', '')+0 <='".$max_price."' AND ";

	//$orders = 'order by CAST(listprice as SIGNED) '.$order;
	$orders = "order by replace(listprice, ',', '')+0 ".$order;
	
	$sqls = "select count(id) as cnt from  ntreislist where ".$btwn." ".$proptype_sql." ".$WHERE_0fficelist." and (liststatus LIKE 'Active%' or liststatus LIKE 'Pending%')  and delete_status = '0'  ";
	$sql = "select * from ntreislist where ".$btwn." ".$proptype_sql." ".$WHERE_0fficelist." and (liststatus LIKE 'Active%' or liststatus LIKE 'Pending%') and delete_status = '0' ".$orders;

	$list = mysql_query($sqls); 
	$row = mysql_fetch_assoc($list);

	$Num_Rows = $row['cnt'];

	$Per_Page = 50;   // Records Per Page
	$Page = (empty($strPage)) ? 1 : $strPage;
	$Prev_Page = $Page-1;
	$Next_Page = $Page+1;
	$Page_Start = (($Per_Page*$Page)-$Per_Page);
	$Num_Pages = ceil($Num_Rows/$Per_Page);
	
	$sql.=" limit $Page_Start , $Per_Page";

	$sql = mysql_query($sql); 
	while(@$row = mysql_fetch_assoc($sql)) {
		$myrows[] = $row;
	}

	$cntsqls = "select count(proptype) as cntprop,proptype from ntreislist where ".$WHERE_0fficelist." and delete_status = '0' group by proptype ";
	$cntsqls1 = mysql_query($cntsqls); 

	$ths = listing_table_headers($proptype);
	
	if(empty($proptype) || in_array($proptype, array('Residential','Residential Lots','Commercial','all'))){
		$protopt = true;
		$rowspan = 7;
	}else{
		$rowspan = 6;
	}

	// listing rows
	$tds = (empty($myrows)) ? '<td rowspan="'.$rowspan.'"><span class="no_results">Sorry, No Record Found</span></td>' : '';

	if(!(empty($myrows))) {
		foreach($myrows as $key=>$values){
			$sqls = "select imagename from ntreisimages where n_id = ".$values['id']." order by recordListingID, id ASC limit 1";
			$sqls = mysql_query($sqls); 
			@$ress = mysql_fetch_assoc($sqls);
			$ntr_images = (empty($ress['imagename'])) ? get_bloginfo('url').'/wp-content/plugins/amerisale-re/images/imgres1.png' : $ress['imagename'];
			$beds = (!empty($values['bedrooms'])) ? 'beds : '.$values['bedrooms']. ' ' : '';
			$baths = (!empty($values['sqft_total'])) ? 'baths : '.$values['baths']. ' ' : '';
			$mlsid = (!empty($values['MLS'])) ? $values['MLS'] : '';
			$acres = (!empty($values['acres'])) ? $values['acres'] : '';
			$sqft_total = (!empty($values['sqft_total'])) ? $values['sqft_total'] : '';

			$values['listprice'] = str_replace('.00','',$values['listprice']);
			$result = substr_count( $values['listprice'], ",") +1; 
			$findme   = '.';
			$pattern = '/[^0-9]*/';
			$pos = strpos($values['listprice'], $findme);
			if($pos != false){
				$values['listprice'] = round($values['listprice']);
			}
			$listprice = preg_replace($pattern,'', $values['listprice']);


			// list price
			if($result > 1){
				if($values['listprice'] == ''){
					$listprice = '-';
				}else{
					$listprice = "$".number_format($listprice);//money_format('%(#10n', $values['listprice']);  
				}
			}else{
				setlocale(LC_MONETARY, 'en_US');								
				//$listprice =  preg_replace('/\.00/', '', money_format('%.2n', $values['listprice']));
				$listprice =  "$".number_format($listprice);
			}	

			if(isset($protopt)){
				$td_opt = '<td>'.$beds.$baths.'</td>
						<td>'.$mlsid.'</td>
						<td>'.$listprice.'</td>
						<td>'.$sqft_total.'</td>';
			}else{
				$td_opt = '<td>'.$acres.'</td>
						<td>'.$mlsid.'</td>
						<td>'.$listprice.'</td>';
			}

			// address
			if($values['is_manual_edit'] == 1){
				$address = $values['directions']."<br />".$values['city'].", TX ".$values['zipcode']."<br />".$values['county']." county";
			}else if($values['is_manual_edit'] == 0 || $values['is_manual_edit'] == 2){
				$address = $values['street_num'].' '.$values['street_name'].' '.$values['street_type'].'  <br />'.$values['city'].' '.$values['state'].' <br />'.$values['zipcode'].' '.$values['county'].' county';
			}else{
				$address = '';
			}

			$tds .= '<tr><td>
						<a  rel="properties" title="" href="'.get_bloginfo('url').'/viewproperty?mls='. $values['MLS'].$side_search.'">
							<img width="80"  alt="residential image" src="'.$ntr_images.'">
						</a><br>
						<a href="'.get_bloginfo('url').'/viewproperty?mls='. $values['MLS'].$side_search.'" class="property_title1" >View Details</a>
					</td>'.
					$td_opt.'
					<td>'.$values['proptype'].'</td>
					<td>'.$address.'</td></tr>';
		}
	}
	
?>



<div id="amerisale" class="content amerisale">

	<!-- Listing Search  Start -->
	<?php echo property_search_form($cntsqls1,$_REQUEST) ?>


	<div class="property-count"><strong><?php echo $Num_Rows?></strong> Listings</div>

	<table class="res-table propert-list-table">
		<thead>
		<tr>
			<?php echo $ths ?>
		</tr>
		</thead>
		<tbody>
			<?php echo $tds ?>
		</tbody>
	</table>

	<?php if($Num_Rows > $Per_Page): ?>
		<div class="paginations">
			<!--Total <?php //echo $Num_Rows;?> Record : -->
			<ul>
			<?php
			
				echo "<br clear='all' /> <br />";
				$firstlabel = "&laquo;&nbsp;";
				$prevlabel  = "&lsaquo;&nbsp;";
				$nextlabel  = "&nbsp;&rsaquo;";
				$lastlabel  = "&nbsp;&raquo;";
				
				$page   = intval($Page);
				$tpages = $Num_Pages; // 20 by default
				$adjacents  = intval($_GET['adjacents']);

				if($page<=0)  $page  = 1;
				if($adjacents<=0) $adjacents = 5;

				// $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages . "&amp;adjacents=" . $adjacents;
				
				$out = "<div class=\"pagin\">\n";
		
				// first
				if($page>($adjacents+1)) {
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','1','$min_price','$max_price')\" class='page_img'>" . $firstlabel . "</a>\n";
				}
				else {
					$out.= "<span>" . $firstlabel . "</span>\n";
				}
				
				// previous
				if($page==1) {
					$out.= "<span>" . $prevlabel . "</span>\n";
				}
				elseif($page==2) {
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$tpages','$min_price','$max_price')\" class='page_img'>" . $prevlabel . "</a>\n";
				}
				else {
					$decrpage = ($page-1);
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$decrpage','$min_price','$max_price'\" class='page_img'>" . $prevlabel . "</a>\n";
				}
				
				// 1 2 3 4 etc
				$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
				$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
				for($i=$pmin; $i<=$pmax; $i++) {
					if($i==$page) {
						$out.= "<span class=\"current\">" . $i . "</span>\n";
					}
					elseif($i==1) {
						$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$i','$min_price','$max_price')\" class='page_img'>" . $i . "</a>\n";
					}
					else {
						$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$i','$min_price','$max_price')\" class='page_img'>" . $i . "</a>\n";
					}
				}
				
				// next
				if($page<$tpages) {
					$incrpage = ($page+1);
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$incrpage','$min_price','$max_price')\" class='page_img'>" . $nextlabel . "</a>\n";
				}
				else {
					$out.= "<span>" . $nextlabel . "</span>\n";
				}
				
				// last
				if($page<($tpages-$adjacents)) {
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$tpages','$min_price','$max_price')\" class='page_img'>" . $lastlabel . "</a>\n";
				}
				else {
					$out.= "<span>" . $lastlabel . "</span>\n";
				}
				
				$out.= "</div>";
				
				echo $out;
				
			?>
			
			</ul>
		</div>
	</div>

	<?php 
	endif;
//mysql_close($con); 

// Reset DB Conn
mysql_select_db(DB_NAME);
	?>	
	<input type="hidden" value="<?php echo $order; ?>" id="orderval" />
	<input type="hidden" value="<?php echo $proptype; ?>" id="typeval" />