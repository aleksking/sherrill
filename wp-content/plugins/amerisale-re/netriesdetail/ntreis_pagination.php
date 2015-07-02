<?php
	require_once("../../../../wp-config.php");
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
	
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	
	 if($rets_area != null || $rets_area != ''){//if mls 
		$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND (rets_area = '".$rets_area."' OR rets_area = 'manual_".$agent_offcode."') "; 
	  }else{ //manual only
			$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND  rets_area = 'manual_".$agent_offcode."' "; 
	  }
	  
	   if(isset($_REQUEST['city']) && $_REQUEST['city'] != ''){
			$WHERE_0fficelist = " city = '".$_REQUEST['city']."' ";
		}
	
	$proptype = $_REQUEST['proptype'];
	if(!$proptype){
		$proptype_sql = "";
	}else if($proptype == 'all'){
		$proptype_sql = "";
	}else{
		$proptype_sql = "proptype = '".$proptype."' and ";
	}
	$strPage = $_REQUEST['pageid'];
		
		$order = 'desc';
		$min_price = $_REQUEST['minprc'];
		$min_price = str_replace (",",'',$min_price);
		$min_price = str_replace ("$",'',$min_price);
		if($min_price=='')
			$min_price ='0';
		
		$max_price = $_REQUEST['maxprc'];
		$max_price = str_replace (",",'',$max_price);
		$max_price = str_replace ("$",'',$max_price);
		if($max_price=='')
			$max_price ='100000000';
		//$max_price = number_format($max_price);
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
		//die('uuuuuuuuuuu'.$sql);

		//echo $sqls;
		$list = mysql_query($sqls); 
		
		
		$row = mysql_fetch_assoc($list);
		//print_r($row);
		$Num_Rows = $row['cnt'];
		$Per_Page = 50;   // Records Per Page
		 
		$Page = $strPage;
		if(!$strPage)
		{
			$Page=1;
		}
		 
		$Prev_Page = $Page-1;
		$Next_Page = $Page+1;


		$Page_Start = (($Per_Page*$Page)-$Per_Page);
		if($Num_Rows<=$Per_Page)
		{
			$Num_Pages =1;
		}
		else if(($Num_Rows % $Per_Page)==0)
		{
			$Num_Pages =($Num_Rows/$Per_Page) ;
		}
		else
		{
			$Num_Pages =($Num_Rows/$Per_Page)+1;
			$Num_Pages = (int)$Num_Pages;
		}
		
		$sql.=" limit $Page_Start , $Per_Page";
		// echo $sql;
		// $myrows = $wpdb->get_results($sql);
		// echo "<pre>";
		$sql = mysql_query($sql); 
		
			while($row = mysql_fetch_assoc($sql)){
				$myrows[] = $row;
			}
	//print_r($myrows);
	$cnt_prop = array();
	
	$cntsqls = "select count(proptype) as cntprop,proptype from ntreislist where ".$WHERE_0fficelist." and  group by proptype ";
	$cntsqls1 = mysql_query($cntsqls); 
	// while($resd = mysql_fetch_assoc($cntsqls1)){
		// echo "<pre>"; 
		// print_R($resd);
		// $avl_prop = $resd['proptype'];
		// $cnt_prop[$avl_prop] = $resd['cntprop'];
	// }
	// print_R($cnt_prop);
	// die;
	// $Num_Rows = $row['cnt'];
	
?>
		<div class="price_div_hr">
			<form action="#" onSubmit="return getprice()" >
				<label>Price: Min</label>
				<input id="min_price" type="text" >
				<label>to Max</label>
				<input id="max_price"type="text" >
				<input type="submit"  value="Search" >
			</form >
		
			<label>Type :</label>
			<select name="price" OnChange="gettype(this.value)" id="typeval">
				<?php
					echo '<option value="all">ALL</option>';
					while($resd = mysql_fetch_assoc($cntsqls1)){
						// echo "<pre>"; 
						// print_R($resd);
						// $avl_prop = $resd['proptype'];
						// $cnt_prop[$avl_prop] = $resd['cntprop'];
						echo '<option value="'.$resd['proptype'].'">'.$resd['proptype'].'</option>';
					}
				
					mysql_select_db(DB_NAME);
				?>
			</select>
		</div>	
		<br clear="all" />



	
	<div class="content">
		<div class="wpp_row_view wpp_property_view_result">
		<div class="count-properties"><?php echo $Num_Rows; ?> Listings</div><br clear="all" />
			
			<?php echo scrolling_header_html($proptype); ?>
			
			<br clear="all" /><br />
			<div class="all-properties">
		
	<?php				
		if($Num_Rows > 0){
			foreach($myrows as $key=>$values){
				$sqls = "select imagename from ntreisimages where n_id = ".$values['id']." order by recordListingID, id ASC limit 1";
				//$ress = $wpdb->get_results($sqls);
				$sqls = mysql_query($sqls); 
				$ress = mysql_fetch_assoc($sqls);
				// var_dump($ress);
				$ntr_images = $ress['imagename'];
				if(empty($ntr_images)){
					$ntr_images = get_bloginfo('url').'/wp-content/plugins/amerisale-re/images/imgres1.png';
				}
				// echo $urls = get_bloginfo('url');
	
		echo display_property_list_html($values,$proptype ='all',$ntr_images);
	?>			
			
			<?php
			}
		}else{
			echo "<br />";
			echo "<center><div style='float:left;color:#ffffff;font-size:16px;'>Sorry No Record Found</div></center>";
		}
			?>	
			
			</div>	
		</div>
		<?php if($Num_Rows > 0){ ?>
			<div class="paginations">
				<!--Total <?php //echo $Num_Rows;?> Record : -->
				<ul>
				<?
				
					
				
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
	<?php }
//mysql_close($con); 

// Reset DB Conn
mysql_select_db(DB_NAME);
	?>	
	<input type="hidden" value="<?php echo $order; ?>" id="orderval" />
	<input type="hidden" value="<?php echo $proptype; ?>" id="typeval" />