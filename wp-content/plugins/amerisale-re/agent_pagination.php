<?php
//print_r($_REQUEST);die;
	require_once("../../../../wp-config.php");
	global $wpdb;
?>	
<style>
		.wpp_row_view div.property_div{
			width: 104% !important;
		}	

.image_agent{ border: 5px solid #FFFFFF;
    float: left;
    height: 120px;
    margin-right: 50px;
    padding: 5px;
    width: 130px;}
	
.image_agent img{ height: 122px !important; width: 128px !important;}	

.stylings{text-transform: capitalize; margin-top: 12px; }
.detalcon{float: left;
    text-align: left;
    width: 300px;}
.fullcon{float: left;
    width: 550px;}
</style>
	

		<div class="wpp_row_view wpp_property_view_result">
			<div class="all-properties">
				<p class="property_title1"style="position: relative; left: 0px;">OUR AGENTS</p>
				<br clear="all" />
	<?php
		$strPage = $_REQUEST['pageid'];
		
		// $sql = "select uid,MLS,baths,bedrooms,directions,sqft_total,listprice,id from  ".$wpdb->prefix."ntreislist where proptype = '".$proptype."' order by modified desc";
		//$sql = "select MLS,officelist,agent_name,agentlist,offcname1,offcname2 from  ".$wpdb->prefix."ntreislist where proptype = '".$proptype."' and officelist='LYNC00FW' group by agent_name order by modified desc";
		/*
		$sql = "select id, Name, email_address, phone_number, photo from ".$wpdb->prefix."agents ORDER BY Name";
		$tkeqry = $wpdb->get_results($sql);
		*/
		$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  mysql_select_db($db_name, $con);
	  $agent = "select id, Name, email_address, phone_number, photo from agents where agent_offcode = '".$agent_offcode."' ORDER BY Name ";
	
	$agent_data = mysql_query($agent);
	$tkeqry = array();
	while($row = mysql_fetch_assoc($agent_data)){
		$tkeqry[] = $row;
	}
	mysql_close($con);
	
		$Num_Rows = count($tkeqry);
		$Per_Page = 10;   // Records Per Page
		 
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
		//$myrows = $wpdb->get_results($sql);
		$myrows = $tkeqry;
		// echo "<pre>";
		
		foreach($myrows as $key=>$values){
			$ntr_images = getimage($values->MLS);
			if(empty($ntr_images)){
				$ntr_images = 'imgres.png';
			}
			// echo $urls = get_bloginfo('url');
?>			
				<div class="property_div property clearfix">
					<div class="wpp_overview_left_column">
						
					</div>
					<div class="property_div property clearfix">
					
						<div class="wpp_overview_right_column fullcon">
							<ul class="wpp_overview_data">
							<?php   $ag_id = $values->id;  ?>
							   <?php 
							    global $wpdb;
								?>
								<div class="image_agent">
									<a href="agtview/<?php echo $ag_id ?>"><img border="0" src="<?php echo plugins_url(); ?>/amreiasale-re/upload/<?php echo $values->photo; ?>" alt="No Image" width="128" height="118" /></a>
								</div>
								<div class="detalcon">
								<li class="property_address stylings"><?php echo $values->Name; ?></li> <br />
								<li class="property_address stylings"><?php echo $values->email_address; ?> </li><br />
								<li class="property_address stylings"><?php echo $values->phone_number; ?> </li><br clear="all" /><br />
								<?php  //$ag_id = $values->id;  ?>
									<?php //session_start();
									//$_SESSION['aid'] = $ag_id; ?>
									
								</div>
							</ul>
						</div>
					</div>
				</div>
			<?php
				}
			?>	
			
			</div>	
		</div>
		<!--
		<div class="paginations">
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
				$out.= "<a href=\"JavaScript:get_agent_pages('$proptype','1')\" class='page_img'>" . $firstlabel . "</a>\n";
			}
			else {
				$out.= "<span>" . $firstlabel . "</span>\n";
			}
			
			// previous
			if($page==1) {
				$out.= "<span>" . $prevlabel . "</span>\n";
			}
			elseif($page==2) {
				$out.= "<a href=\"JavaScript:get_agent_pages('$proptype','$tpages')\" class='page_img'>" . $prevlabel . "</a>\n";
			}
			else {
				$decrpage = ($page-1);
				$out.= "<a href=\"JavaScript:get_agent_pages('$proptype','$decrpage')\" class='page_img'>" . $prevlabel . "</a>\n";
			}
			
			// 1 2 3 4 etc
			$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
			$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
			for($i=$pmin; $i<=$pmax; $i++) {
				if($i==$page) {
					$out.= "<span class=\"current\">" . $i . "</span>\n";
				}
				elseif($i==1) {
					$out.= "<a href=\"JavaScript:get_agent_pages('$proptype','$i')\" class='page_img'>" . $i . "</a>\n";
				}
				else {
					$out.= "<a href=\"JavaScript:get_agent_pages('$proptype','$i')\" class='page_img'>" . $i . "</a>\n";
				}
			}
			
			// next
			if($page<$tpages) {
				$incrpage = ($page+1);
				$out.= "<a href=\"JavaScript:get_agent_pages('$proptype','$incrpage')\" class='page_img'>" . $nextlabel . "</a>\n";
			}
			else {
				$out.= "<span>" . $nextlabel . "</span>\n";
			}
			
			// last
			if($page<($tpages-$adjacents)) {
				$out.= "<a href=\"JavaScript:get_agent_pages('$proptype','$tpages')\" class='page_img'>" . $lastlabel . "</a>\n";
			}
			else {
				$out.= "<span>" . $lastlabel . "</span>\n";
			}
			
			$out.= "</div>";
			
			echo $out;
			?>
			</ul>
	-->
	