﻿<script>
var loadimg="<img src='<?php echo get_bloginfo('url'); ?>/images/loading16.gif' alt='loading...' width='100px'>";
	var $js = jQuery.noConflict();
	function getdetails(url,id)
	{
		$js.post( url,{ id : id},
		  function(data) {
		  
		  }
		);
	}
	
	function get_agent_pages(proptype,pageid){
		$js("#imge_load").html(loadimg);
		$js("#ajax_rep_div").fadeOut("slow");
		//var url = "<?php echo get_bloginfo('template_url').'/agent_pagination.php'; ?>";
		var url = "<?php echo content_url().'plugins/amerisale-re/agent_listings/agent_pagination.php'; ?>";
		$js.post( url,{proptype : proptype, pageid : pageid},
		  function( data ) {
			 // alert(data);
			  $js("#ajax_rep_div").html(data);
			  $js("#imge_load").html('');
			  $js("#ajax_rep_div").fadeIn("slow");
		  }
		);
	}
	
</script>

<style>
.image_agent{ 
	border: 1px solid rgba(54, 25, 25, 0.2);
    float: left;
    height: 120px;
    margin-right: 50px;
    padding: 3px;
    width: 130px;
}
.wpp_row_view ul.wpp_overview_data .property_address .detalcon li{
	margin-left: 0;
}
.image_agent img{ height:122px !important; width: 128px;}	
.stylings{text-transform: capitalize; margin-top: 12px;}
.detalcon{float: left; text-align: left; width: 300px;}
.fullcon{float: left; width: 550px;}	
</style>


			<div class="wpp_row_view wpp_property_view_result">
			<div class="all-properties agent-list">
				<h2>OUR AGENTS</h2>
			<?php
				error_reporting(E_ALL ^ E_DEPRECATED);
			
				global $wpdb;
				$strPage = isset($_REQUEST['pageid']) ? $_REQUEST['pageid'] : '';
				/*    
				$sql = "select id, Name, email_address, phone_number, photo from ".$wpdb->prefix."agents ORDER BY Name";
				$tkeqry = $wpdb->get_results($sql);
				*/
				$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
				$results = $wpdb->get_results($sql);
				// echo "<pre>"; print_r($results);
				$db_ip = $results[0]->host;
				$db_user = $results[0]->db_user;
				$db_pass = $results[0]->password;
				$db_name = $results[0]->db;
				$agent_offcode = $results[0]->agent_offcode;
				
				$commcon = mysql_connect($db_ip,$db_user,$db_pass);
				if (!$commcon)
			  	{
			  		die('Could not connect: ' . mysql_error());
			  	}
			  	mysql_select_db($db_name, $commcon);
			  	$agent = "select id, Name, email_address, phone_number, photo from agents where agent_offcode = '".$agent_offcode."' ORDER BY Name ";

				
				$agent_data = mysql_query($agent, $commcon);
				$tkeqry = array();
				while($row = mysql_fetch_assoc($agent_data)){
					$tkeqry[] = $row;
				}
				// echo "<pre>"; print_r($tkeqry);die;
				// $tkeqry = $wpdb->get_results($agent);
				//mysql_close($commcon);
				
				// Reset DB Conn
				mysql_select_db(DB_NAME);				
			
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
				//$myrows1 = $wpdb->get_results($sql);
				$myrows = $tkeqry;
				


				foreach($myrows as $key){
				
			?>			
					<div class="property_div property clearfix">
						
						<div class="wpp_overview_right_column  fullcon">
							<ul class="wpp_overview_data">
							<?php   $ag_id = $key['id'];  ?>
							<?php //session_start();  $_SESSION['aid'] = $ag_id; ?>
							
								   <?php global $wpdb ?>
								   <?php  
									if(isset($key['photo']) && basename($key['photo']) != "imgres.png")
										$img = $key['photo'];
									else
										$img = get_bloginfo('url').'/wp-content/plugins/amerisale-re/images/imgres.png';
								   ?>
								   
								   <?php 
								   
								   //$img = get_bloginfo('url').'/wp-content/plugins/amerisale-re/upload/'.basename($values['photo']); 
								   
								   ?>
									<div class="image_agent">
										<a href="<?php echo get_site_url(); ?>/agtview?id=<?php echo $ag_id ?>"><?php echo $key['photo'] ;?><img border="0" src="<?php echo $img; ?>" alt="No Image" width="100" height="100" /></a>
									</div>
									
									<div class="detalcon">
									<li class="property_address stylings"><?php echo $key['Name']; ?></li> <br />
									<li class="property_address stylings"><a href="mailto:<?php echo $key['email_address'] ; ?>"><?php echo $key['email_address'] ; ?></a></li><br />
									<li class="property_address stylings"><a href="tel:<?php echo $key['phone_number'] ; ?>"><?php echo $key['phone_number'] ; ?></a></li><br clear="all" /><br />
	
									<?php
									// session_start();
									
									?>
									</div>
							
							</ul>
						</div>
					</div>
					<?php
					}
				?>

		<?php if(count($tkeqry) > $Per_Page ): ?>	

		<div class="paginations">
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
			
			$out = "<div class=\"pagin\">\n";
	
			// first
			if($page>($adjacents+1)) {
				$out.= "<a href=\"JavaScript:get_agent_pages('Residential','1')\" class='page_img'>" . $firstlabel . "</a>\n";
			}
			else {
				$out.= "<span>" . $firstlabel . "</span>\n";
			}
			
			// previous
			if($page==1) {
				$out.= "<span>" . $prevlabel . "</span>\n";
			}
			elseif($page==2) {
				$out.= "<a href=\"JavaScript:get_agent_pages('Residential','$tpages')\" class='page_img'>" . $prevlabel . "</a>\n";
			}
			else {
				$decrpage = ($page-1);
				$out.= "<a href=\"JavaScript:get_agent_pages('Residential','$decrpage')\" class='page_img'>" . $prevlabel . "</a>\n";
			}
			
			// 1 2 3 4 etc
			$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
			$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;

			for($i=$pmin; $i<=$pmax; $i++) {
				if($i==$page) {
					$out.= "<span class=\"current\">" . $i . "</span>\n";
				}
				elseif($i==1) 
				{
					$out.= "<a href=\"JavaScript:get_agent_pages('Residential','$i')\" class='page_img'>" . $i . "</a>\n";
				}
				else 
				{
					$out.= "<a href=\"JavaScript:get_agent_pages('Residential','$i')\" class='page_img'>" . $i . "</a>\n";
				}
			}
			
			// next
			if($page<$tpages) {
				$incrpage = ($page+1);
				$out.= "<a href=\"JavaScript:get_agent_pages('Residential','$incrpage')\" class='page_img'>" . $nextlabel . "</a>\n";
			}
			else {
				$out.= "<span>" . $nextlabel . "</span>\n";
			}
			
			// last
			if($page<($tpages-$adjacents)) {
				$out.= "<a href=\"JavaScript:get_agent_pages('Residential','$tpages')\" class='page_img'>" . $lastlabel . "</a>\n";
			}
			else {
				$out.= "<span>" . $lastlabel . "</span>\n";
			}
			
			$out.= "</div>";
			
			echo $out;
			?>
			</ul>
		</div>

	<?php endif; ?>
	
	</div>
</div>
