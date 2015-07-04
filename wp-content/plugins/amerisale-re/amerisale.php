<?php
/*
Plugin Name: Ameriasale REAL
Description: To display three colomn content [content_display]
Author: Sadik Ameen
Author URI: http://www.facebook.com/sadikameen
Version: 2.01
*/

session_start();
// Enable internationalisation
$plugin_dir = basename(dirname(__FILE__));



add_action('admin_menu', 'menus');

add_shortcode( 'content_display', 'content_display');
add_shortcode( 'headers_display', 'headers_display');

$url = admin_url();

//Load functions.php
include_once("functions.php");

if(!is_admin()){
	add_action('wp_head', 'load_scripts');
}

function load_scripts(){
	
	$loc = get_template_directory()."/amerisale-re.css";
	 
	?>  <link rel="stylesheet" href="<?php echo plugins_url().$plugin_dir."/amerisale-re/css/amerisale-re-images.css"; ?>">
	
	<?php if(file_exists($loc)) {
		?><link rel="stylesheet" href="<?php echo bloginfo('template_directory')."/amerisale-re.css"; ?>">	
	<?php }else{ ?>
		<link rel="stylesheet" href="<?php echo plugins_url().$plugin_dir."/amerisale-re/css/amerisale-re.css"; ?>">	
	<?php }
	
	echo $css_script;
	
/*** jslidernews1 scripts (propertyview) ***/
		//die(plugins_url().$plugin_dir);
	echo '
		<script language="javascript" type="text/javascript" src="'.plugins_url().$plugin_dir.'/amerisale-re/js/jquery.js"></script>
		<script language="javascript" type="text/javascript" src="'.plugins_url().$plugin_dir.'/amerisale-re/js/jquery.easing.js"></script>
		<script language="javascript" type="text/javascript" src="'.plugins_url().$plugin_dir.'/amerisale-re/js/script.js"></script>	
	';
	
/*** end jslidernews1 scripts (propertyview) ***/
	
}	

// echo $url;
function content_display(){ 
	global $plugin_dir;
	include_once("header.php");
	include_once("display.php");
}

function content_display1(){
	include_once("ameen.php");
}
function account(){
	global $plugin_dir,$wpdb,$url;
	include_once("header.php");
	include_once("account.php");
}

function agent(){
	global $plugin_dir,$wpdb,$url;
	include_once("header.php");
	include_once("agent.php");
}

function netriesdetails(){
	global $plugin_dir,$wpdb,$url;
	include_once("header.php");
	include_once("netriesdetail.php");
}

function featured(){
	global $plugin_dir,$wpdb,$url;
	include_once("header.php");
	include_once("featured.php");
}

function headers_display(){
	global $plugin_dir,$wpdb,$url;
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql); 
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$agent_offcode = $results[0]->agent_offcode;
	$address = nl2br($results[0]->address);
	echo "<div id=\"title_bottom\">$address</div>";
}
function headers(){
	global $plugin_dir,$wpdb,$url;
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$agent_offcode = $results[0]->agent_offcode;
	$address = $results[0]->address;
	include_once("headers.php");	
}

function menus() {  
  $allowed_group = 'manage_options';
   add_menu_page(__('Account Settings','settings'), __('Amerisale RE','settings'), $allowed_group, 'settings', 'content_display'); 
   add_submenu_page('settings', __('Manage Settings','account'), __('Manage Settings','account'), 'manage_options', 'account', 'account');
   add_submenu_page('settings', __('Manage Agents','account'), __('Manage Agents','agent'), 'manage_options', 'agent', 'agent');
   add_submenu_page('settings', __('Manage Listings','netriesdetails'), __('Manage Listings','netriesdetails'), 'manage_options', 'netriesdetails', 'netriesdetails');
   add_submenu_page('settings', __('Manage Featured Listings','featured'), __('Manage Featured','featured'), 'manage_options', 'featured', 'featured');
   add_submenu_page('settings', __('Manage Headers','headers'), __('Manage headers','headers'), 'manage_options', 'headers', 'headers');
   // add_submenu_page(__FILE__, 'Account Edit', 'Account Edit', 1, __FILE__.'/account-edit.php', 'accountedit');
}

function install(){
	global $wpdb;
	
	$sql = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'agentaccount (
			  `agent_id` int(11) NOT NULL AUTO_INCREMENT,
			  `agent_username` varchar(255) NOT NULL,
			  `agent_password` varchar(255) NOT NULL,
			  `agent_loginurl` text NOT NULL,
			  `agent_offcode` text NOT NULL,
			  `db` varchar(100) NOT NULL,
			  `db_user` varchar(100) NOT NULL,
			  `password` varchar(100) NOT NULL,
			  `rets_area` varchar(100) NOT NULL,
			  `host` varchar(100) NOT NULL,
			  PRIMARY KEY (`agent_id`)
			)';
	mysql_query($sql);
	$sql = 'ALTER TABLE '.$wpdb->prefix.'agentaccount ADD `address` TEXT NOT NULL AFTER `host`';
	mysql_query($sql);
	
}

function uninstall(){
}

register_activation_hook( __FILE__, 'install' );
register_deactivation_hook( __FILE__, 'uninstall' );

// ntreis rets plugin 


function getimage($mln = null){
	include_once("header.php");
	global $wpdb;
	$sql = "select imagename from ntreisimages where mlsnum = ".$mln." order by recordListingID ASC limit 1";
	// $ress = $wpdb->get_results($sqls);
	$sqls = mysql_query($sql); 
	$ress = mysql_fetch_assoc($sqls);
	return $ress['imagename'];
}

function scrolling_header_html($proptype='all'){


	$html .='	<div class="all-titles">
				<p class="property_title1">&nbsp;</p>';

	if( $proptype == 'Residential'  || 
		$proptype == 'Residential Lots'  || 
		$proptype == 'Commercial' || 
		$proptype == 'all'){ 

		$html .= '
				<p class="property_title2">Beds &amp; Baths</p>
				<p class="property_titlenew">MLS#</p>
				<p class="property_titleprce">Price</p>
				<p class="property_titlesqft">SQ ft</p>
				<p class="property_title1">Property Type</p>
				<p class="property_titleaddr">Address</p>';
	}else{ 
			 
		$html .= '<p class="property_title3">Acres</p>
					<p class="property_titlenew">MLS#</p>
					<p class="property_titleprce1">Price</p>
					<p class="property_title1">Property Type</p>
					<p class="property_titleaddr">Address</p>';	
	}

	$html .='</div>';

	return $html;
}	


//Properties Available
function wp_ntreis_list(){

	// include_once("header.php");
	global $wpdb ,$plugin_dir;
			
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$agent_offcode = $results[0]->agent_offcode;
	$office = $results[0]->agent_username;
	$rets_area = $results[0]->rets_area;
	$con = mysql_connect($db_ip,$db_user,$db_pass);

	if(!$con){
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($db_name, $con); 
	$proptype = 'all';

	if(!empty($rets_area)){//if mls 
		$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND (rets_area = '".$rets_area."' OR rets_area = 'manual_".$agent_offcode."') "; 
	}else{ //manual only
		$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND  rets_area = 'manual_".$agent_offcode."' "; 
	}

	if(!empty($_GET['city'])){
		$WHERE_0fficelist = " city = '".$_GET['city']."' ";
	}
  
	$sql = "select * from ntreislist where ".$WHERE_0fficelist." and (liststatus LIKE 'Active%' or liststatus LIKE 'Pending%') and delete_status = '0' order by replace(listprice, ',', '')+0 desc";
	$tkeqry = $wpdb->get_results($sql);


	$Num_Rows = count($tkeqry); // Number of Records
	$Per_Page = 1;   // Records Per Page
	$Page = (empty($_REQUEST['pageid']))? 1 : $_REQUEST['pageid'];
	$Prev_Page = $Page-1;
	$Next_Page = $Page+1;
	$Page_Start = (($Per_Page*$Page)-$Per_Page);
	$Num_Pages = ceil($Num_Rows/$Per_Page);

	$sql.=" limit $Page_Start , $Per_Page";
	$myrows = array();
	$sql = mysql_query($sql); 
	while($row = mysql_fetch_assoc($sql)){
		$myrows[] = $row;
	}
	
	$cntsqls = "select count(proptype) as cntprop,proptype from ntreislist where ".$WHERE_0fficelist." and delete_status = '0' group by proptype ";
	$cntsqls1 = mysql_query($cntsqls); 
	$propsels = '';
	while($row = mysql_fetch_assoc($cntsqls1))
		$propsels .= '<option value="'.$row['proptype'].'">'.$row['proptype'].'</option>';	
?>

<div id="imge_load"></div>
	<div id="ajax_rep_div" class="primary content">
	
		<div class="price_div_hr">
			<form action="#" onSubmit="return getprice()" >
				<label>Price: Min </label>
				<input id="min_price" type="text" >
				<label>to Max </label>
				<input id="max_price"type="text" >
				<input type="submit" id="top_button_search" value="Search" >
				<label>Type </label>
				<select name="price" OnChange="gettype(this.value)" id="typeval">		
					<option value="all">ALL</option>
					<?php echo $propsels ?>
				</select>
			</form >
		</div>

		<br clear="all" />
	
		<div class="content">
			
			<div id="scrolling"  class="wpp_row_view wpp_property_view_result">
				
				<div class="count-properties"><?php echo $Num_Rows ?> Listings</div>

				<br clear="all" />

				<?php echo scrolling_header_html(); ?>
			
				<br clear="all" />

				<?php
				
				if($Num_Rows > 0){
					foreach($myrows as $key=>$values){
						//$sql = "select imagename from ntreisimages where mlsnum = ".$values['MLS']." order by recordListingID ASC limit 1";
						$sql = "select imagename from ntreisimages where n_id = ".$values['id']." order by recordListingID, id ASC limit 1";
						$sqls = mysql_query($sql); 
						@$ress = mysql_fetch_assoc($sqls);
						
						$ntr_images = (empty($ress['imagename'])) ? get_bloginfo('url').'/wp-content/plugins/amerisale-re/images/imgres1.png' : $ress['imagename'];

						$side_search = (!empty($_GET['city'])) ? '&side=y' : '';
				
						echo display_property_list_html($values,$proptype ='all',$ntr_images, $side_search);
					}
				}else{
					echo "<br />";
					echo "<center><div class='centerings'>Sorry No Record Found</div></center>";
				}
				?>		
			</div>	
		</div>
	
		<?php if($Num_Rows > 0): ?>

		<div class="paginations">
			<ul>
				<br clear='all' />

				<?php				
				$firstlabel = "&laquo;&nbsp;";
				$prevlabel  = "&lsaquo;&nbsp;";
				$nextlabel  = "&nbsp;&rsaquo;";
				$lastlabel  = "&nbsp;&raquo;";
				
				$page   = ($Page <= 0) ? 1 : $Page;
				$tpages = $Num_Pages; // 50 by default
				$adjacents  = ($_GET['adjacents'] <= 0) ? 5 : $_GET['adjacents'];
				
				$out = "<div class=\"pagin\">\n";
				
				// first
				if($page > ($adjacents+1)) {
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','1','','')\" class='page_img'>" . $firstlabel . "</a>\n";
				}
				else {
					$out.= "<span>" . $firstlabel . "</span>\n";
				}
				
				// previous
				if($page==1) {
					$out.= "<span>" . $prevlabel . "</span>\n";
				}
				elseif($page==2) {
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$tpages','','')\" class='page_img'>" . $prevlabel . "</a>\n";
				}
				else {
					$decrpage = ($page-1);
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$decrpage','','')\" class='page_img'>" . $prevlabel . "</a>\n";
				}
				
				// 1 2 3 4 etc
				$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
				$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;

				for($i=$pmin; $i<=$pmax; $i++) {
					if($i==$page) {
						$out.= "<span class=\"current\">" . $i . "</span>\n";
					}
					elseif($i==1) {
						$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$i','','')\" class='page_img'>" . $i . "</a>\n";
					}
					else {
						$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$i','','')\" class='page_img'>" . $i . "</a>\n";
					}
				}
				
				// next
				if($page<$tpages) {
					$incrpage = ($page+1);
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$incrpage','','')\" class='page_img'>" . $nextlabel . "</a>\n";
				}
				else {
					$out.= "<span>" . $nextlabel . "</span>\n";
				}
				
				// last
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$tpages','','')\" class='page_img'>" . $lastlabel . "</a>\n";
				if($page<($tpages-$adjacents)) {
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
	//mysql_close($commcon);
	
	// Reset DB Conn
	mysql_select_db(DB_NAME);
}

add_shortcode( 'property_lists', 'wp_ntreis_list' );
function display_property_list_html($values,$proptype ='all',$ntr_images,$side_search=''  ){

$html ='
	<div class="property_div property clearfix">
		<div class="wpp_overview_left_column">
			<div class="property_image">
			<a  rel="properties" class="property_overview_thumb property_overview_thumb_tiny_thumb" title="" href="'.get_bloginfo('url').'/viewproperty?mls='. $values['MLS'].$side_search.'">
					<img width="80"  alt="residential image" src="'.$ntr_images.'">
				</a>
			
			<a href="'.get_bloginfo('url').'/viewproperty?mls='. $values['MLS'].$side_search.'" class="property_title1" >View Details</a>
			</div>
		</div>
		<div class="wpp_overview_right_column">
			<ul class="wpp_overview_data">';
				if($proptype == 'Residential' || $proptype == 'Residential Lots' || $proptype == 'Commercial' || $proptype == 'all'){
					$html.= '<div class="bed_baths">
							';
							if($values['bedrooms'] != 0 && $values['bedrooms'] != ''){ 
							$html .='<li class="property_bed_rooms">beds : '.$values['bedrooms'].'</li> ';
							 } 
							if($values['baths'] != 0 && $values['baths'] != ''){ 
							$html .='	<li class="property_bath_rooms">baths : '.$values['baths'].'</li>';
							 } 
						$html.='	&nbsp;&nbsp;
						</div> ';
									
					}else{ 
						$html .= '<li class="property_sq_ft"> '.$values['acres'].'</li>	
						<li class="property_sq_ft" style="width:40px">&nbsp;</li>	';
					
					}
				 $mlsid = $values['MLS'];
				if($values['is_manual_edit'] == 1){
					$address = $values['directions']."<br />".$values['city'].", TX ".$values['zipcode']."<br />".$values['county']." county";
				}else if($values['is_manual_edit'] == 0 || $values['is_manual_edit'] == 2){
					$address = $values['street_num'].' '.$values['street_name'].' '.$values['street_type'].'  <br />'.$values['city'].' '.$values['state'].' <br />'.$values['zipcode'].' '.$values['county'].' county';
				}else{
				$address = '';
			}
					
				$values['listprice'] = str_replace('.00','',$values['listprice']);
				$result = substr_count( $values['listprice'], ",") +1; 
				$findme   = '.';
				$pattern = '/[^0-9]*/';
				$pos = strpos($values['listprice'], $findme);
				if($pos != false){
					$values['listprice'] = round($values['listprice']);
				}
				$listprice = preg_replace($pattern,'', $values['listprice']);
				
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
				
			$html .=' <li class="property_mls">'.$mlsid.'</li>
				<li class="property_price">'.$listprice.'</li>';
				if($values['sqft_total'] != 0 && $values['sqft_total'] != ''){ 
					$html .='<li class="property_sq_ft">'.$values['sqft_total'].'</li> ';
					 }else{ 
					$html .='<li class="property_sq_ft">&nbsp;</li> ';
					 } 
					 
					 if(strlen($values['proptype'])>16 )
						$values['proptype'] = substr($values['proptype'],0,16);
			$html .='	<li class="property_type">'.$values['proptype'].'</li>
				<li class="property_address">'.$address.'</li><br /><br />							
			</ul>
		</div>
	</div> ';
			
			
		//}else{
			/* $html .='<br />
				<center><div style="float:left;color:#ffffff;font-size:16px;">Sorry No Record Found</div></center>
					
			</div>	
		</div> '; */
		
		 if($Num_Rows > 0){ 
			$html .='<div class="paginations">
				<ul>				
				
					<br clear="all" /> <br />';
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
					
					$html .= $out;
				
 			$html .='
				</ul>
			</div>
			'; 
		}
	
return $html; 


}

function wp_view_details(){
	
	//die(">>>>>>>>>>>>>>>>>".$_SESSION['mlsnum']);
	global $wpdb,$plugin_dir;
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$agent_offcode = $results[0]->agent_offcode;
	$rets_area = $results[0]->rets_area;
	
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  mysql_select_db($db_name, $con);
	  if($rets_area != null || $rets_area != ''){//if mls 
		$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND (rets_area = '".$rets_area."' OR rets_area = 'manual_".$agent_offcode."') "; 
	  }else{ //manual only
			$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND  rets_area = 'manual_".$agent_offcode."' "; 
	  }
	  
	  if(isset($_SESSION['side']))
		$WHERE_0fficelist = "id > 0";
	/* echo "session=> ".$_SESSION['mlsnum']; */
	$mlsid = $_SESSION['mlsnum'];
	$sql = "select * from ntreislist where  MLS = '".$mlsid."' AND ".$WHERE_0fficelist." AND delete_status = '0'  limit 1";
	//die($sql.$_SESSION['side']);
	$mls = mysql_query($sql); 
	$resvar = mysql_fetch_assoc($mls);	
	//print_r($resvar);
	//$additionalinfo = "select * from  additionalinfo where nid= ".$mlsid." limit 1";
	$additionalinfo = "select * from  additionalinfo where 	n_id= ".$resvar['id']." limit 1";
	$sql = mysql_query($additionalinfo); 
	$additionalinfos = mysql_fetch_assoc($sql);	
	 //print_r($resvar);

	// $sql = "select * from financial where mlsid= '".$mlsid."' limit 1";
	
	$sql = "select * from financial where n_id= '".$resvar['id']."' limit 1";
	$financial = mysql_query($sql); 
	$financials = mysql_fetch_assoc($financial);	
	 
	 
	//$sqls = "select imagename from ntreisimages where mlsnum = ".$mlsid." order by recordListingID ASC ";
	$sqls = "select imagename from ntreisimages where n_id = ".$resvar['id']." order by recordListingID,id ASC ";
	$sqls = mysql_query($sqls); 
	while($row = mysql_fetch_assoc($sqls)){
		$ress[] = $row;
	}
	if($resvar['is_manual_edit'] == 1){
		// $address = $resvar['directions'];." ".$values['county']." county";
		$address = $resvar['directions']."<br />".$resvar['city'].", Tx ".$resvar['zipcode']."<br />".$resvar['county']." county";
	}else if($resvar['is_manual_edit'] == 0 || $resvar['is_manual_edit'] == 2){
		$address = $resvar['street_num'].' '.$resvar['street_name'].' '.$resvar['street_type'].'  <br />'.$resvar['city'].' '.$resvar['state'].', '.$resvar['zipcode'].' <br />'.$resvar['county'].' county';
	}else{
		$address = '';
	}
	
	$result = substr_count( $resvar['listprice'], ",") +1; 
	if($result > 1){
		$listprice = "$ ".$resvar['listprice'];
	}else{
		setlocale(LC_MONETARY, 'en_US');								
		// $listprice = money_format('%(#10n', $resvar['listprice']);
		
		$listprice =  preg_replace('/\.00/', '', money_format('%.2n', $resvar['listprice']));
		//$listprice =  $resvar['listprice'];
		//die($listprice.'----------------------------------------');
	}
	$sqft_price = "$". $resvar['sqft_price']; 
	
	$photocount = $resvar['photocount'];
	$sales_pending = $resvar['sales_pending'];
	$sold = $resvar['sold'];
	?>
		<div class="content">
			<div class="wpp_row_view wpp_property_view_result">
				<?php if($sales_pending == 1){ ?>
					<div class="sales_pending">sales pending</div><br clear="all" >
				<?php } ?>
				<?php if($sold == 1){ ?>
					<div class="sales_pending">sold</div><br clear="all" >
				<?php } ?>
				<br clear="all" />
				<div class="all-properties">
				<?php if($resvar['virtual_tour']){?>
					<a target="TREOsub_VT" href="<?php echo $resvar['virtual_tour']; ?>"><img width="60" border="0" align="middle" alt="Virtual Tour Camera Image" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/images/cam.png"> Click Here for a Virtual Tour of this Listing!!!</a>
					<br clear="all" /><br />
				<?php } ?>
				<div class="prop_view_links">
					<span class="">HOVER TO STOP</span>
					<span class="">CLICK TO ENLARGE</span>					
					<a href="mailto:?subject=Texas Real Estate Information&body=You have been sent this property information by a real estate professional using TexasRealEstateOnline.com or TexasProperties.com. <?php echo get_bloginfo('url').'/propertyview?mls='. $resvar['MLS']; ?>"><span class="">EMAIL TO FRIEND</span></a>
					<a target="_blank" href="<?php echo get_bloginfo('url'); ?>/print-view"><span class="">PRINT VIEW</span></a>
				</div>
						<div id="jslidernews1" class="lof-slidecontent">
						<div class="preload"><div></div></div>
								 <!-- MAIN CONTENT --> 
								  <div class="main-slider-content">
									<ul class="sliders-wrap-inner">
										 <?php 
											if(!empty($ress)){
												foreach($ress as $res_images){
													$img = $res_images['imagename'];
													//$img = get_bloginfo('url').'/wp-content/uploads/amerisale-re/'.basename($img);
													echo '<li><a href="'.$img.'" target="_blank">';
														echo '<img src="'.$img.'" title="'.$img.'" >';
													echo '</a></li>';
												}
											}
										 ?>
									  </ul>  	
								</div>
							   <!-- END MAIN CONTENT --> 
							   <!-- NAVIGATOR -->
								<div class="navigator-content">
									  <div class="button-previous">Next</div>
									  <div class="navigator-wrapper">
											<ul class="navigator-wrap-inner">
											<?php 
											if(!empty($ress)){
												foreach($ress as $res_images){
													$img = $res_images['imagename'];
													//$img = get_bloginfo('url').'/wp-content/uploads/amerisale-re/'.basename($img);
													echo '<li>';
														echo '<img src="'.$img.'" >';
													echo '</li>';
													//print_r (explode("/",$img));
												}
											}
										 ?>											</ul>
									  </div>
									  <div class="button-next">Previous</div>
								 </div> 
							  <!----------------- END OF NAVIGATOR --------------------->
							  <!-- BUTTON PLAY-STOP -->
							  <div class="button-control"><span></span></div>
							   <!-- END OF BUTTON PLAY-STOP -->
							  
					 </div>
					<div class="img_rgt">
					 <?php
					 
					     $agentlist = $resvar['agentlist'];
							$sql = "select id, Name, email_address, phone_number, agent_id, photo, Agent_link from agents where agent_license_no='$agentlist' and  agent_offcode='".$agent_offcode."'";
							$sqls = mysql_query($sql); 
							while($row = mysql_fetch_assoc($sqls)){
								$agents[] = $row;
							}
							// echo "<pre>";print_r($agents[0]);
							// $agents = mysql_fetch_assoc($sqls);
							echo "<table>";
							foreach($agents as $result)
							{
								echo "<tr class='content'>";
									$id = $result['id'];  
									if($result['photo'] && basename($result['photo']) != "imgres.png")
										$img = get_bloginfo('url').'/wp-content/uploads/amerisale-re/'.basename($result['photo']);
									else
										$img = get_bloginfo('url').'/wp-content/plugins/amerisale-re/images/imgres.png';
						?>
									<a target='_blank' href="<?php echo get_bloginfo('url'); ?>/agents/agtview/?agtvwid=<?php echo $id;?>" ><img border="0" src="<?php echo $img; ?>" alt="image" width="100" height="100" /></a>
									<?php 
									echo "<br />";echo "<br />";
									echo "<tr class='cont'>".$result['Name']. "</tr>";
									echo "<br />";echo "<br />";
									echo "<tr class='cont'><a href='mailto:".$result['email_address']."'>".$result['email_address']. "</a></tr>";		
									echo "<br />";echo "<br />";
									if($result['Agent_link'] != '') echo "<tr class='cont'><a href='".$result['Agent_link']."' target='_blank'>".$result['Agent_link']. "</a></tr>";	echo "<br />";
									
									echo "<tr class='cont'><a class='readmorelink' target='_blank' href='".get_bloginfo('url')."/agents/agtview/?agtvwid=".$id."'>More</a></tr>";		
									echo "</td>";
								echo "<tr>";
							}
							echo "</table>";
							?>
					</div>
					
					<br clear="all" /> <br /><br />
					<div class="prop_detls">
						<ul class="addr">
							<li><span class="boldspan">Address :</span><span class="normalspan"><?php echo $address; ?></span></li><br clear="all" />
							<?php if(!empty($resvar['listprice'])){ ?>
								<li><span class="boldspan">Price :</span><span class="normalspan"><?php echo $listprice; ?></span></li><br clear="all" />
							<?php } ?>
							<?php if($resvar['proptype'] != 'Lots & Acreage' && $resvar['proptype'] != 'Commercial'){ ?>
								<?php if(!empty($resvar['sqft_total'])){ ?>
									<li><span class="boldspan">Sq.Feet :</span><span class="normalspan"><?php echo $resvar['sqft_total']; ?> sq.feet</span></li><br clear="all" />
								<?php } ?>
								<?php if (!empty($resvar['sqft_price'])) { ?>
									<li><span class="boldspan">price/Sq.foot :</span><span class="normalspan"><?php echo $sqft_price; ?></span></li><br clear="all" />
								<?php }	?>
								<?php if($resvar['stories']){?>
								<li><span class="boldspan">Stories :</span><span class="normalspan"><?php echo $resvar['stories']; ?></span></li><br />
							<?php } ?>
								<?php if(!empty($resvar['sub_division'])){ ?>
									<li><span class="boldspan">Sub Division :</span><span class="normalspan"><?php echo $resvar['sub_division']; ?></span></li><br clear="all" />
								<?php }?>
								<?php if(!empty($resvar['garage_cap'])){ ?>
									<li><span class="boldspan">Garage Space :</span><span class="normalspan"><?php echo $resvar['garage_cap']; ?></span></li><br clear="all" />
								<?php }?>
								<?php if(!empty($resvar['carport_space'])){ ?>
									<li><span class="boldspan">Carport Space :</span><span class="normalspan"><?php echo $resvar['carport_space']; ?></span></li><br clear="all" />
								<?php }?>
							<?php }else{ ?>	
								
								<!--<?php if(!empty($resvar['sub_division'])){ ?>
									<li><span class="boldspan">Sub Division :</span><span class="normalspan"><?php echo $resvar['sub_division']; ?></span></li><br clear="all" />
								<?php }?>-->
								<?php if(!empty($resvar['sqft_source'])){ ?>
									<li><span class="boldspan">Sq.Source:</span><span class="normalspan"><?php echo $resvar['sqft_source']; ?></span></li><br clear="all" />
								<?php }?>
							<?php } ?>
						</ul>
						<ul class="bullet_points">
							
							<?php if(!empty($financials)){
								// echo "<pre>"; print_r($financials['highlight_1']);
							?>
							<h1 class="hig">Highlights</h1>
								<?php if(!empty($financials['highlight_1'])){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_1']; ?></span></li><br clear="all" />
								<?php } ?>
								
								<?php if(!empty($financials['highlight_2'])){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_2']; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if(!empty($financials['highlight_3'])){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_3']; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if(!empty($financials['highlight_4'])){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_4']; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($financials['conventinal'] == 1 || $financials['va_loan'] == 1 || $financials['fha_loan'] == 1 || $financials['owner_financed'] == 1 || $financials['texas_vet'] == 1){ ?>
								<br clear="all" ><br /><h1 class="hig">Financing Options</h1>
								<?php } ?>
								<?php if($financials['conventinal'] == 1){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo 'Conventional'; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($financials['va_loan'] == 1){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo 'VA Loan'; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($financials['fha_loan'] == 1){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo 'FHA Loan'; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($financials['owner_financed'] == 1){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo 'Owner Financed'; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($financials['texas_vet'] == 1){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo 'Texas Vet'; ?></span></li><br clear="all" />
								<?php } ?>
								
							<?php } ?>
						</ul> 
						
						<ul class="addr">
							<li><span class="boldspan">MLS# :</span><span class="normalspan"><?php echo $resvar['MLS']; ?></span></li><br />
							<?php  //print_r($resvar); die('---------------');
							if(!empty($resvar['agent_name'])){ ?>
								<li><span class="boldspan">Agent name :</span><span class="normalspan"><?php echo $resvar['agent_name']; ?></span></li><br />
							<?php } ?>
							<?php if(!empty($resvar['legal'])){ ?>
								<li><span class="boldspan">Legal :</span><span class="normalspan"><?php echo $resvar['legal']; ?></span></li><br />
							<?php } ?>
							<li><span class="boldspan">Property type :</span><span class="normalspan"><?php echo $resvar['proptype']; ?></span></li><br />
							
							<?php if(!empty($resvar['housing_type'])){ ?>
								<li><span class="boldspan">Housing type :</span><span class="normalspan"><?php echo $resvar['housing_type']; ?> </span></li><br />
							<?php } ?>
							<?php if($resvar['proptype'] != 'Acreage'){ ?>
								<?php if(!empty($resvar['bedrooms'])){ ?>
									<li><span class="boldspan">Bedrooms :</span><span class="normalspan"><?php echo $resvar['bedrooms']; ?></span></li><br />
								<?php } ?>
								<?php if(!empty($resvar['baths'])){ ?>
									<li><span class="boldspan">Baths :</span><span class="normalspan"><?php echo $resvar['baths']; ?></span></li><br />
								<?php } ?>
								<?php if($resvar['num_dining_areas']){ ?>
								<li><span class="boldspan">Dining Areas  :</span><span class="normalspan"><?php echo $resvar['num_dining_areas']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['num_living_areas']){ ?>
								<li><span class="boldspan">Living Areas  :</span><span class="normalspan"><?php echo $resvar['num_living_areas']; ?></span></li><br />
							<?php if($resvar['fire_place']){?>
								<li><span class="boldspan">Fire Places :</span><span class="normalspan"><?php echo $resvar['fire_place']; ?></span></li><br />
							<?php } ?>
							<?php } ?>
								<?php if(!empty($resvar['lotsize'])){ ?>
								<li><span class="boldspan">LotSize :</span><span class="normalspan"><?php echo $resvar['lotsize']; ?></span></li><br />
							<?php } ?>
							<?php if(!empty($resvar['acres'])){ ?>
								<li><span class="boldspan">Acres :</span><span class="normalspan"><?php echo $resvar['acres']; ?></span></li><br />
								<?php } ?>
							<?php if(!empty($resvar['yearbuilt'])){ ?>
								<li><span class="boldspan">Year built :</span><span class="normalspan"><?php echo $resvar['yearbuilt']; ?></span></li><br />
							<?php } ?>
							
							<?php }else{ ?>
							<?php if(!empty($resvar['bedrooms'])){ ?>
								<li><span class="boldspan">Acres :</span><span class="normalspan"><?php echo $resvar['acres']; ?></span></li><br />
								<?php } ?>
							<?php if(!empty($resvar['lotsize'])){ ?>
								<li><span class="boldspan">LotSize :</span><span class="normalspan"><?php echo $resvar['lotsize']; ?></span></li><br />
							<?php } ?>	
							<?php if(!empty($resvar['yearbuilt'])){ ?>
								<li><span class="boldspan">Year built :</span><span class="normalspan"><?php echo $resvar['yearbuilt']; ?></span></li><br />
							<?php } ?>
							<?php if(!empty($resvar['utility'])){ ?>
								<li><span class="boldspan">Utility :</span><span class="normalspan"><?php echo $resvar['utility']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['schooldistrict']){ ?> 	
									<li><span class="boldspan">School District :</span><span class="normalspan"><?php echo $resvar['schooldistrict']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['sub_division']){ ?>
									<li><span class="boldspan">Sub Division :</span><span class="normalspan"><?php echo $resvar['sub_division']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['num_dining_areas']){ ?>
								<li><span class="boldspan">Dining Areas  :</span><span class="normalspan"><?php echo $resvar['num_dining_areas']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['num_living_areas']){ ?>
								<li><span class="boldspan">Living Areas  :</span><span class="normalspan"><?php echo $resvar['num_living_areas']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['lotsize']){?>
								<li><span class="boldspan">Lot Size :</span><span class="normalspan"><?php echo $resvar['lotsize']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['stories']){?>
								<li><span class="boldspan">Stories :</span><span class="normalspan"><?php echo $resvar['stories']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['carport_space']){?>
								<li><span class="boldspan">Carport Space :</span><span class="normalspan"><?php echo $resvar['carport_space']; ?></span></li><br />
							<?php }
							
							}
							
							if($resvar['offices']){?>
								<li><span class="boldspan">Offices :</span><span class="normalspan"><?php echo $resvar['offices']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['restrooms']){?>
								<li><span class="boldspan">Restrooms :</span><span class="normalspan"><?php echo $resvar['restrooms']; ?></span></li><br />
							<?php } ?><?php if($resvar['meeting_spaces']){?>
								<li><span class="boldspan">Meeting Spaces :</span><span class="normalspan"><?php echo $resvar['meeting_spaces']; ?></span></li><br />
							<?php } ?><?php if($resvar['parking_spaces']){?>
								<li><span class="boldspan">Parking Spaces :</span><span class="normalspan"><?php echo $resvar['parking_spaces']; ?></span></li><br />
							<?php } ?><?php if($resvar['barns']){?>
								<li><span class="boldspan">Barns :</span><span class="normalspan"><?php echo $resvar['barns']; ?></span></li><br />
							<?php } ?><?php if($resvar['sheds']){?>
								<li><span class="boldspan">Sheds :</span><span class="normalspan"><?php echo $resvar['sheds']; ?></span></li><br />
							<?php } ?><?php if($resvar['shops']){?>
								<li><span class="boldspan">Shops :</span><span class="normalspan"><?php echo $resvar['shops']; ?></span></li><br />
							<?php }
							?><?php if($resvar['ponds']){?>
								<li><span class="boldspan">Ponds :</span><span class="normalspan"><?php echo $resvar['ponds']; ?></span></li><br />
							<?php }
							?><?php if($resvar['stock_tanks']){?>
								<li><span class="boldspan">Stock Tanks :</span><span class="normalspan"><?php echo $resvar['stock_tanks']; ?></span></li><br />
							<?php }
							?><?php if($resvar['corrals']){?>
								<li><span class="boldspan">Corrals :</span><span class="normalspan"><?php echo $resvar['corrals']; ?></span></li><br />
							<?php }
							?><?php if($resvar['pens']){?>
								<li><span class="boldspan">Pens :</span><span class="normalspan"><?php echo $resvar['pens']; ?></span></li><br />
							<?php }
							?><?php if($resvar['units']){?>
								<li><span class="boldspan">Units :</span><span class="normalspan"><?php echo $resvar['units']; ?></span></li><br />
							<?php }
							?>
						</ul>
						<br clear="all" />
						<div class="remrks">
							<span class="boldspan">General Description :</span>
							<br />
							<p>
							<?php
								echo stripslashes($resvar['remarks']);
							?>
							</p>
						</div>
						<br clear="all" /> <br />
						<?php if($additionalinfos['showmap'] == 1){ ?>
							<div class="viewmap_new">
							
									<a href ="<?php echo get_bloginfo('url'); ?>/propertyview/map-page?mlsid=<?php echo $mlsid ?>" class="map-page" target="_blank"> Map it </a>
						
							</div>
						<?php } ?>
						<br clear="all" />
						<br /><br />
						<?php if($resvar['proptype'] != 'Lots & Acreage' && $resvar['proptype'] != 'Commercial'){ ?>
							<ul class="addr_des">
							<?php if($resvar['schooldistrict'] != '' || $resvar['schoolname1'] != ''){ ?>
								<span class="boldspan">Schools :</span><br clear="all" />
								<?php if($resvar['schooldistrict'] != ''){ ?>
								<li><span class="boldspan">School District :</span><span class="normalspans"><?php echo $resvar['schooldistrict']; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($resvar['schoolname1'] != ''){ ?>
									<li><span class="boldspan">School names :</span><span class="normalspans" ><?php echo ucfirst(strtolower($resvar['schoolname1'])).', '.ucfirst(strtolower($resvar['schoolname2'])).', '.ucfirst(strtolower($resvar['schoolname3'])); ?></span></li><br clear="all" />
								<?php } ?>
							<?php } ?>
							</ul>
						<?php } ?>	
							<ul class="addr_des">
								<?php 
								
								if(!isset($resvar['offcname1']) || $resvar['offcname1']=='')
									$office_name = get_bloginfo('description');
								else
									$office_name = $resvar['offcname1'];
								
								
								?>
								<li><span class="boldspan">Officename :</span><span class="normalspans"><?php echo $office_name; ?></span></li><br clear="all" />
						
							</ul>
						<?php ?>
						
						<ul class="bullet_points-y"> 
						
						<?php if($resvar['pool'] == 'Y'){ ?>
							<li id="lists" ><span class="normalspans"><?php  echo 'Pool'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($resvar['handicapt'] == 'Y'){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Handicapt'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['hottubs'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Hot Tubs'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['golf'] == 1){ ?>
						<li id="lists" ><span class="normalspans"><?php echo 'Golf'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['resort_property'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Resort Property'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['waterview'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Water View'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['waterfront'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Water Front'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['newhome'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'New Home'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['city_water'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'City Water'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['city_sweer'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'City Sewer'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['electricity'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Electricity'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['well'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Well'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['water_coop'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Water Co-Op'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['septic_tank'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Septic Tank'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['citylimit'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Within City Limits'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['etj'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Within ETJ'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['road_access'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Public Road Access'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['flood_plain'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Flood Plain'; ?></span></li><br clear="all" />
						<?php } ?>
						<?php if($resvar['restriction'] == 'Yes'){ ?>
							<li id="lists" ><span class="normalspans"><?php  echo 'Restriction'; ?></span></li><br clear="all" />
						<?php } ?>
						<?php if($additionalinfos['minreals_convey'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Minerals Convey'; ?></span></li><br clear="all" />
						<?php } ?>	
						</ul>
					</div>
				</div>
			</div>
			<br clear="all" /> <br />
			<div class="des_con">
			 
			<p class="modified">
				<?php if(!empty($resvar['modified'])){
						$modified = date("j/m/Y H:i:s A");
					}else{
						$modified = '5/25/2012 4:41:43 AM';
					}
				?>
				 *All sizes are estimated and approximate (refer to a professional survey for exact figures)
					Disclaimer: All information provided is deemed reliable, true and correct to the best of our knowledge, but is not guaranteed and should be independently verified. The brokers, agents, nor the administrators of this site do not assume responsibility for the correctness of these offerings. The sale of offerings are made subject to errors, omission, change of price, prior sale or withdrawal without notice in accordance with the law; the properties herein are offered without regard to race, color, creed, or national origin. Use of this information is only for viewers of this web site. Reproduction or redistribution of this information is prohibited.
				
			</p><br />

			<span class="boldspan_m">MLS ID #</span><span class="normalspan1" ><?php echo $resvar['MLS'] ?></span>
			<span class="boldspan"></span><span class="normalspan1"><?php echo $resvar['agent_name']; ?></span></li><br />
			
				<?php 
					if($resvar['is_manual_edit'] == '1'){?>
			<!--	<p class="disclaimer">
						Disclaimer: All information provided is deemed reliable, true and correct to the best of our knowledge, but is not guaranteed and should be independently verified. The brokers, agents, nor the administrators of this site do not assume responsibility for the correctness of these offerings. The sale of offerings are made subject to errors, omission, change of price, prior sale or withdrawal without notice in accordance with the law; the properties herein are offered without regard to race, color, creed, or national origin. Use of this information is only for viewers of this web site. Reproduction or redistribution of this information is prohibited. 
					-->
					<?php
					}else if(empty($resvar['sysid']) && $resvar['is_manual_edit'] != '1'){ ?>
				<p class="listing_information">
						Listing information obtained from the North Texas Real Estate Information Systems, Inc. Last updated <?php echo $modified; ?>. Listing information copyright North Texas Real Estate Information Systems, Inc.
			
				<?php
					}else if(!empty($resvar['sysid']) && $resvar['is_manual_edit'] != '1'){
					 ?>
				<p class="listing_information" >
						Listing information obtained from the Austin Board of REALTORS MLS. Last updated <?php echo $modified; ?>. Listing information copyright Austin Board of REALTORS MLS.</p>
			
		<?php } ?>	
				
					<?php if(empty($resvar['sysid']) && $resvar['is_manual_edit'] != '1'){ ?>
					<div class="imagee">
						<img src="<?php echo content_url(); ?>/plugins/amerisale-re/images/ntreis.png" />
					<?php }else if(!empty($resvar['sysid'])){ ?>
						<img src="<?php echo content_url(); ?>/plugins/amerisale-re/images/abor_img.gif" />
						</div>
					<?php }	?>
				
			</div>
			
		</div>	
	<?php
	//mysql_close($commcon);
	
	// Reset DB Conn
	mysql_select_db(DB_NAME);
}

function wp_view_details_print(){
	global $wpdb,$plugin_dir;
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$agent_offcode = $results[0]->agent_offcode;
	$rets_area = $results[0]->rets_area;
	
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  mysql_select_db($db_name, $con);
	  if($rets_area != null || $rets_area != ''){//if mls 
		$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND (rets_area = '".$rets_area."' OR rets_area = 'manual_".$agent_offcode."') "; 
	  }else{ //manual only
			$WHERE_0fficelist = " officelist = '".$agent_offcode."' AND  rets_area = 'manual_".$agent_offcode."' "; 
	  }
	$mlsid = $_SESSION['mlsnum'];
	$sql = "select * from ntreislist where ".$WHERE_0fficelist." AND MLS = '".$mlsid."' AND delete_status = '0' limit 1";
	$mls = mysql_query($sql); 
	$resvar = mysql_fetch_assoc($mls);
	$n_id=$resvar['id'];
	
	
	$additionalinfo = "select * from  additionalinfo where n_id=".$n_id." limit 1";
	$sql = mysql_query($additionalinfo); 
	$additionalinfos = mysql_fetch_assoc($sql);	
	 

	 $sql = "select * from financial where n_id=".$n_id." limit 1";
	$financial = mysql_query($sql); 
	$financials = mysql_fetch_assoc($financial);	
	 
	 
	$sqls = "select imagename from ntreisimages where n_id=".$n_id." order by recordListingID, id ASC ";
	$sqls = mysql_query($sqls); 
	while($row = mysql_fetch_assoc($sqls)){
		$ress[] = $row;
	}
	if($resvar['is_manual_edit'] == 1){
		// $address = $resvar['directions'];." ".$values['county']." county";
		$address = $resvar['directions']."<br />".$resvar['city'].", Tx ".$resvar['zipcode']."<br />".$resvar['county']." county";
	}else if($resvar['is_manual_edit'] == 0 || $resvar['is_manual_edit'] == 2){
		$address = $resvar['street_num'].' '.$resvar['street_name'].' '.$resvar['street_type'].'  <br />'.$resvar['city'].' '.$resvar['state'].' <br />'.$resvar['zipcode'].' '.$resvar['county'].' county';
	}else{
		$address = '';
	}
	
	$result = substr_count( $resvar['listprice'], ",") +1; 
	if($result > 1){
		$listprice = "$ ".$resvar['listprice'];
	}else{
		setlocale(LC_MONETARY, 'en_US');								
		$listprice =  $resvar['listprice'];
	}
	$sqft_price = "$". $resvar['sqft_price']; 
	
	$photocount = $resvar['photocount'];
	$sales_pending = $resvar['sales_pending'];
	$sold = $resvar['sold'];
	?>
		<div class="printview">

			<div class="wpp_row_view wpp_property_view_result">
			
				
				<?php if($sales_pending == 1){ ?>
					<div class="sales_pending">sales pending</div><br clear="all" >
				<?php } ?>
				<?php if($sold == 1){ ?>
					<div class="sales_pending">sold</div><br clear="all" >
				<?php } ?>
				<br clear="all" />
				<div class="all-properties">
				<?php if($resvar['virtual_tour']){?>
					<a target="TREOsub_VT" href="<?php echo $resvar['virtual_tour']; ?>"><img width="60" border="0" align="middle" alt="Virtual Tour Camera Image" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/images/cam.png"> Click Here for a Virtual Tour of this Listing!!!</a>
					<br clear="all" /><br />
				<?php } ?>
				<div class="img_rgt">
					 <?php
					 
					     $agentlist = $resvar['agentlist'];
							$sql = "select id, Name, email_address, phone_number, agent_id, photo, Agent_link from agents where agent_license_no='$agentlist' ";
							$sqls = mysql_query($sql); 
							while($row = mysql_fetch_assoc($sqls)){
								$agents[] = $row;
							}
							
							echo "<table>";
							foreach($agents as $result)
							{
								echo "<tr class='content'>";
									$id = $result['id'];  
									if($result['photo'] && basename($result['photo']) != "imgres.png")
										$img = get_bloginfo('url').'/wp-content/uploads/amerisale-re/'.basename($result['photo']);
									else
										$img = get_bloginfo('url').'/wp-content/plugins/amerisale-re/images/imgres.png';
						?>
									<a target='_blank' href="<?php echo get_bloginfo('url'); ?>/agents/agtview/<?php echo $id;?>" ><img border="0" src="<?php echo $img; ?>" alt="image" width="100" height="100" /></a>
									<?php 
									echo "<br />";echo "<br />";
									echo "<tr class='cont'>".$result['Name']. "</tr>";
									echo "<br />";echo "<br />";
									echo "<tr class='cont'><a href='mailto:".$result['email_address']."'>".$result['email_address']. "</a></tr>";		
									echo "<br />";echo "<br />";
									if($result['Agent_link'] != '') echo "<tr class='cont'><a href='".$result['Agent_link']."' target='_blank'>".$result['Agent_link']. "</a></tr>";	
									echo "</td>";
								echo "<tr>";
							}
							echo "</table>";
							?>
			</div>
					<div class="prop_detls">
										 
						<ul class="addr">
							<li><span class="boldspan">Address :</span><span class="normalspan"><?php echo $address; ?></span></li><br clear="all" />
							<?php if(!empty($resvar['listprice'])){ ?>
								<li><span class="boldspan">Price :</span><span class="normalspan"><?php echo $listprice; ?></span></li><br clear="all" />
							<?php } ?>
							<?php if($resvar['proptype'] != 'Lots & Acreage' && $resvar['proptype'] != 'Commercial'){ ?>
								<?php if(!empty($resvar['sqft_total'])){ ?>
									<li><span class="boldspan">Sq.Feet :</span><span class="normalspan"><?php echo $resvar['sqft_total']; ?> sq.feet</span></li><br clear="all" />
								<?php } ?>
								<?php if (!empty($resvar['sqft_price'])) { ?>
									<li><span class="boldspan">price/Sq.foot :</span><span class="normalspan"><?php echo $sqft_price; ?></span></li><br clear="all" />
								<?php }	?>
							<?php }else{ ?>	
								<?php if(!empty($resvar['garage_cap'])){ ?>
									<li><span class="boldspan">Garage :</span><span class="normalspan"><?php echo $resvar['garage_cap']; ?></span></li><br clear="all" />
								<?php }?>
								<?php if(!empty($resvar['carport_space'])){ ?>
									<li><span class="boldspan">Carport Space :</span><span class="normalspan"><?php echo $resvar['carport_space']; ?></span></li><br clear="all" />
								<?php }?>
								<!--<?php if(!empty($resvar['sub_division'])){ ?>
									<li><span class="boldspan">Sub Division :</span><span class="normalspan"><?php echo $resvar['sub_division']; ?></span></li><br clear="all" />
								<?php }?>-->
								<?php if(!empty($resvar['sqft_source'])){ ?>
									<li><span class="boldspan">Sq.Source:</span><span class="normalspan"><?php echo $resvar['sqft_source']; ?></span></li><br clear="all" />
								<?php }?>
							<?php } ?>
						</ul>
						<ul class="bullet_points">
							
							<?php if(!empty($financials)){
								// echo "<pre>"; print_r($financials['highlight_1']);
							?>
							<h1 class="hig">Highlights</h1>
								<?php if(!empty($financials['highlight_1'])){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_1']; ?></span></li><br clear="all" />
								<?php } ?>
								
								<?php if(!empty($financials['highlight_2'])){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_2']; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if(!empty($financials['highlight_3'])){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_3']; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if(!empty($financials['highlight_4'])){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_4']; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($financials['conventinal'] == 1 || $financials['va_loan'] == 1 || $financials['fha_loan'] == 1 || $financials['owner_financed'] == 1 || $financials['texas_vet'] == 1){ ?>
								<br clear="all" ><br /><h1 class="hig">Financing Options</h1>
								<?php } ?>
								<?php if($financials['conventinal'] == 1){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo 'Conventional'; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($financials['va_loan'] == 1){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo 'VA Loan'; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($financials['fha_loan'] == 1){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo 'FHA Loan'; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($financials['owner_financed'] == 1){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo 'Owner Financed'; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($financials['texas_vet'] == 1){ ?>
									<li id="lists" ><span class="normalspans"><?php  echo 'Texas Vet'; ?></span></li><br clear="all" />
								<?php } ?>
								
							<?php } ?>
						</ul> 
						<ul class="addr">
							<li><span class="boldspan">MLS# :</span><span class="normalspan"><?php echo $resvar['MLS']; ?></span></li><br />
							<?php if(!empty($resvar['agent_name'])){ ?>
								<li><span class="boldspan">Agent name :</span><span class="normalspan"><?php echo $resvar['agent_name']; ?></span></li><br />
							<?php } ?>
							<?php if(!empty($resvar['legal'])){ ?>
								<li><span class="boldspan">Legal :</span><span class="normalspan"><?php echo $resvar['legal']; ?></span></li><br />
							<?php } ?>
							<li><span class="boldspan">Property type :</span><span class="normalspan"><?php echo $resvar['proptype']; ?></span></li><br />
							
							<?php if(!empty($resvar['housing_type'])){ ?>
								<li><span class="boldspan">Housing type :</span><span class="normalspan"><?php echo $resvar['housing_type']; ?> </span></li><br />
							<?php } ?>
							<?php if($resvar['proptype'] != 'Lots & Acreage' && $resvar['proptype'] != 'Commercial'){ ?>
								<?php if(!empty($resvar['bedrooms'])){ ?>
									<li><span class="boldspan">Bedrooms :</span><span class="normalspan"><?php echo $resvar['bedrooms']; ?></span></li><br />
								<?php } ?>
								<?php if(!empty($resvar['baths'])){ ?>
									<li><span class="boldspan">Baths :</span><span class="normalspan"><?php echo $resvar['baths']; ?></span></li><br />
								<?php } ?>
							<?php }else{ ?>
							<?php if(!empty($resvar['bedrooms'])){ ?>
								<li><span class="boldspan">Acres :</span><span class="normalspan"><?php echo $resvar['acres']; ?></span></li><br />
								<?php } ?>
							<?php if(!empty($resvar['lotsize'])){ ?>
								<li><span class="boldspan">LotSize :</span><span class="normalspan"><?php echo $resvar['lotsize']; ?></span></li><br />
							<?php } ?>	
							<?php if(!empty($resvar['yearbuilt'])){ ?>
								<li><span class="boldspan">Year built :</span><span class="normalspan"><?php echo $resvar['yearbuilt']; ?></span></li><br />
							<?php } ?>
							<?php if(!empty($resvar['utility'])){ ?>
								<li><span class="boldspan">Utility :</span><span class="normalspan"><?php echo $resvar['utility']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['schooldistrict']){ ?> 	
									<li><span class="boldspan">School District :</span><span class="normalspan"><?php echo $resvar['schooldistrict']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['sub_division']){ ?>
									<li><span class="boldspan">Sub Division :</span><span class="normalspan"><?php echo $resvar['sub_division']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['num_dining_areas']){ ?>
								<li><span class="boldspan">Dining Areas  :</span><span class="normalspan"><?php echo $resvar['num_dining_areas']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['num_living_areas']){ ?>
								<li><span class="boldspan">Living Areas  :</span><span class="normalspan"><?php echo $resvar['num_living_areas']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['lotsize']){?>
								<li><span class="boldspan">Lot Size :</span><span class="normalspan"><?php echo $resvar['lotsize']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['stories']){?>
								<li><span class="boldspan">Stories :</span><span class="normalspan"><?php echo $resvar['stories']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['carport_space']){?>
								<li><span class="boldspan">Carport Space :</span><span class="normalspan"><?php echo $resvar['carport_space']; ?></span></li><br />
							<?php }
							
							}
							
							if($resvar['offices']){?>
								<li><span class="boldspan">Offices :</span><span class="normalspan"><?php echo $resvar['offices']; ?></span></li><br />
							<?php } ?>
							<?php if($resvar['restrooms']){?>
								<li><span class="boldspan">Restrooms :</span><span class="normalspan"><?php echo $resvar['restrooms']; ?></span></li><br />
							<?php } ?><?php if($resvar['meeting_spaces']){?>
								<li><span class="boldspan">Meeting Spaces :</span><span class="normalspan"><?php echo $resvar['meeting_spaces']; ?></span></li><br />
							<?php } ?><?php if($resvar['parking_spaces']){?>
								<li><span class="boldspan">Parking Spaces :</span><span class="normalspan"><?php echo $resvar['parking_spaces']; ?></span></li><br />
							<?php } ?><?php if($resvar['barns']){?>
								<li><span class="boldspan">Barns :</span><span class="normalspan"><?php echo $resvar['barns']; ?></span></li><br />
							<?php } ?><?php if($resvar['sheds']){?>
								<li><span class="boldspan">Sheds :</span><span class="normalspan"><?php echo $resvar['sheds']; ?></span></li><br />
							<?php } ?><?php if($resvar['shops']){?>
								<li><span class="boldspan">Shops :</span><span class="normalspan"><?php echo $resvar['shops']; ?></span></li><br />
							<?php }
							?><?php if($resvar['ponds']){?>
								<li><span class="boldspan">Ponds :</span><span class="normalspan"><?php echo $resvar['ponds']; ?></span></li><br />
							<?php }
							?><?php if($resvar['stock_tanks']){?>
								<li><span class="boldspan">Stock Tanks :</span><span class="normalspan"><?php echo $resvar['stock_tanks']; ?></span></li><br />
							<?php }
							?><?php if($resvar['corrals']){?>
								<li><span class="boldspan">Corrals :</span><span class="normalspan"><?php echo $resvar['corrals']; ?></span></li><br />
							<?php }
							?><?php if($resvar['pens']){?>
								<li><span class="boldspan">Pens :</span><span class="normalspan"><?php echo $resvar['pens']; ?></span></li><br />
							<?php }
							?><?php if($resvar['units']){?>
								<li><span class="boldspan">Units :</span><span class="normalspan"><?php echo $resvar['units']; ?></span></li><br />
							<?php }
							?>
						</ul>
						
						<br clear="all" />
						<div class="remrks">
							<span class="boldspans">General Description :</span>
							<?php
								echo $resvar['remarks'];
							?>
						</div>
						<br clear="all" /> <br />
						<?php if($additionalinfos['showmap'] == 1){ ?>
							<div class="viewmap_new">
							
								<a href ="<?php echo get_bloginfo('url'); ?>/propertyview/map-page" class="map-page" target="_blank"> Map it </a>
						
							</div>
						<?php } ?>
						<br clear="all" />
						<br /><br />
						<?php if($resvar['proptype'] != 'Lots & Acreage' && $resvar['proptype'] != 'Commercial'){ ?>
							<ul class="addr_des">
							<?php if($resvar['schooldistrict'] != '' || $resvar['schoolname1'] != ''){ ?>
								<span class="boldspan">Schools :</span><br clear="all" />
								<?php if($resvar['schooldistrict'] != ''){ ?>
								<li><span class="boldspan">School District :</span><span class="normalspans"><?php echo $resvar['schooldistrict']; ?></span></li><br clear="all" />
								<?php } ?>
								<?php if($resvar['schoolname1'] != ''){ ?>
									<li><span class="boldspan">School names :</span><span class="normalspans" ><?php echo ucfirst(strtolower($resvar['schoolname1'])).', '.ucfirst(strtolower($resvar['schoolname2'])).', '.ucfirst(strtolower($resvar['schoolname3'])); ?></span></li><br clear="all" />
								<?php } ?>
							<?php } ?>
							</ul>
						<?php }else{ ?>	
							<ul class="addr_des">
								<span class="boldspan">Office :</span><br clear="all" />
								<li><span class="boldspan">Officename :</span><span class="normalspans"><?php echo $resvar['schooldistrict']; ?></span></li><br clear="all" />
						
							</ul>
						<?php } ?>
						
						<ul class="bullet_points-y"> 
						<?php if($resvar['pool'] == 'Y'){ ?>
							<li id="lists" ><span class="normalspans"><?php  echo 'Pool'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($resvar['handicapt'] == 'Y'){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Handicapt'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['hottubs'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Hot Tubs'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['golf'] == 1){ ?>
						<li id="lists" ><span class="normalspans"><?php echo 'Golf'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['resort_property'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Resort Property'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['waterview'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Water View'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['newhome'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Water Front'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['newhome'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'New Home'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['city_water'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'City Water'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['city_sweer'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'City Sewer'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['electricity'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Electricity'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['well'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Well'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['water_coop'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Water Co-Op'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['septic_tank'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Septic Tank'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['citylimit'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Within City Limits'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['etj'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Within ETJ'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['road_access'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Public Road Access'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['flood_plain'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Flood Plain'; ?></span></li><br clear="all" />
						<?php } ?>	
						<?php if($additionalinfos['minreals_convey'] == 1){ ?>
							<li id="lists" ><span class="normalspans"><?php echo 'Minerals Convey'; ?></span></li><br clear="all" />
						<?php } ?>	
						</ul>
					</div>
				</div>
			</div>
			<br clear="all" /> <br />
			<div class="des_con">
			 
			<p class="modified">
				<?php if(!empty($resvar['modified'])){
						$modified = date("j/m/Y H:i:s A");
					}else{
						$modified = '5/25/2012 4:41:43 AM';
					}
				?>
				 *All sizes are estimated and approximate (refer to a professional survey for exact figures)
					Disclaimer: All information provided is deemed reliable, true and correct to the best of our knowledge, but is not guaranteed and should be independently verified. The brokers, agents, nor the administrators of this site do not assume responsibility for the correctness of these offerings. The sale of offerings are made subject to errors, omission, change of price, prior sale or withdrawal without notice in accordance with the law; the properties herein are offered without regard to race, color, creed, or national origin. Use of this information is only for viewers of this web site. Reproduction or redistribution of this information is prohibited.
				
			</p><br />

			<span class="boldspan_m">MLS ID #</span><span class="normalspan1" ><?php echo $resvar['MLS'] ?></span>
			<span class="boldspan"></span><span class="normalspan1"><?php echo $resvar['agent_name']; ?></span></li><br />
			
				<?php 
					if($resvar['is_manual_edit'] == '1'){?>
			<!--	<p class="disclaimer">
						Disclaimer: All information provided is deemed reliable, true and correct to the best of our knowledge, but is not guaranteed and should be independently verified. The brokers, agents, nor the administrators of this site do not assume responsibility for the correctness of these offerings. The sale of offerings are made subject to errors, omission, change of price, prior sale or withdrawal without notice in accordance with the law; the properties herein are offered without regard to race, color, creed, or national origin. Use of this information is only for viewers of this web site. Reproduction or redistribution of this information is prohibited. 
				-->	<?php
					}else if(empty($resvar['sysid']) && $resvar['is_manual_edit'] != '1'){ ?>
				<p class="listing_information">
						Listing information obtained from the North Texas Real Estate Information Systems, Inc. Last updated 4/25/2012 4:32:36 AM. Listing information copyright North Texas Real Estate Information Systems, Inc.
					<?php
					}else if(!empty($resvar['sysid']) && $resvar['is_manual_edit'] != '1'){
					 ?>
				<p class="listing_information" >
						Listing information obtained from the Austin Board of REALTORS MLS. Last updated <?php echo $modified; ?>. Listing information copyright Austin Board of REALTORS MLS.</p>
					<?php } ?>	
				
					<?php if(empty($resvar['sysid']) && $resvar['is_manual_edit'] != '1'){ ?>
					<div class="imagee">
						<img src="<?php echo content_url(); ?>/themes/realestatenew/images/ntreis.png" />
					<?php }else if(!empty($resvar['sysid'])){ ?>
						<img src="<?php echo content_url(); ?>/themes/realestatenew/images/abor_img.gif" />
						</div>
					<?php }	?>
				
			</div>
		</div>
		<br clear="all" />
		<div class="print">
			 <?php
				if(!empty($ress)){
					foreach($ress as $res_images){
						//$img = get_bloginfo('url').'/wp-content/uploads/amerisale-re/'.basename($res_images['imagename']);
						$img = $res_images['imagename'];
						echo '<img src="'.$img.'" title="'.$img.'" >';
					}
				}
			 ?>
		</div>
	<?php
	//mysql_close($commcon);
	
	// Reset DB Conn
	mysql_select_db(DB_NAME);
}



function arrayToObject($d) {
	if (is_array($d)) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return (object) array_map(__FUNCTION__, $d);
	}
	else {
		// Return object
		return $d;
	}
}
 // mysql_close($con);

?>