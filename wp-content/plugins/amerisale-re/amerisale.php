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
	?>  

	<link rel="stylesheet" href="<?php echo plugins_url().$plugin_dir."/amerisale-re/css/amerisale-re-images.css"; ?>">
	<link rel="stylesheet" href="<?php echo plugins_url().$plugin_dir."/amerisale-re/css/amerisale-re.css"; ?>">	
	<?php 

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

// listing  table headers
function listing_table_headers($proptype='all'){

	if(in_array($proptype, array('Residential','Residential Lots','Commercial','all'))){
		$ths = '<th></th>
				<th>Beds & Baths</th>
				<th>MLS#</th>
				<th>Price</th>
				<th>SQ ft</th>
				<th>Property Type</th>
				<th>Address</th>';
	}else{
		$ths = '<th></th>
				<th>Acres</th>
				<th>MLS#</th>
				<th>Price</th>
				<th>Property Type</th>
				<th>Address</th>';
	}

	return $ths;
}

// get property search form
function property_search_form($cntsqls1, $params=array()){
	$propsels = '';
	$search_form = '
	<style type="text/css">
		#imge_load {
			position: relative;
			z-index: 999;
			text-align: center;
		}
		.amerisale .listing-search{
			width: 100%;
		}

		.amerisale .listing-search tr td{
			text-align:center; 
	    	vertical-align:middle;
	    	padding: 5px 0;
		}

		.amerisale .listing-search tr td input[type=text]{
			width: 100px;
		}
		.pagin {
			text-align: center;
		}
	</style>';

	while(@$row = mysql_fetch_assoc($cntsqls1))
		$propsels .= '<option value="'.$row['proptype'].'">'.$row['proptype'].'</option>';

	$search_form .= '
		<form action="#" onSubmit="return getprice()" >
			<table class="listing-search">
				<tbody
				<tr>
					<td>Price: Min</td>
					<td>
						<input id="min_price" type="text"  value="'.$params['minprc'].'" maxlength="20">
					</td>
					<td>to Max</td>
					<td>
						<input id="max_price" type="text"  value="'.$params['maxprc'].'" maxlength="20">
					</td>
					<td>
						<input type="submit"  value="Search" >
					</td>
					<td>Type</td>
					<td>
						<select name="price" OnChange="gettype(this.value)"  id="typeval">
							<option value="all">ALL</option>'.
							$propsels.'
						</select>
					</td>
				</tr>
				</tbody
			</table>
		</form >';

	return $search_form;
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
	$Per_Page = 3;   // Records Per Page
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

	$ths = listing_table_headers($proptype);

	if(empty($proptype) || in_array($proptype, array('Residential','Residential Lots','Commercial','all'))){
		$rowspan = 7;
	}else{
		$rowspan = 6;
	}
?>

	<div id="imge_load"></div>

	<div id="ajax_rep_div" class="primary content amerisale">
	
		<!-- Listing Search  Start -->
		<?php echo property_search_form($cntsqls1) ?>

		<div class="property-count"><strong><?php echo $Num_Rows?></strong> Listings</div>

		<table>
			<thead>
			<tr>
				<?php echo $ths ?>
			</tr>
			</thead>
			<tbody>
				<?php
				if($Num_Rows > 0){
					foreach($myrows as $key=>$values){
						//$sql = "select imagename from ntreisimages where mlsnum = ".$values['MLS']." order by recordListingID ASC limit 1";
						$sql = "select imagename from ntreisimages where n_id = ".$values['id']." order by recordListingID, id ASC limit 1";
						$sqls = mysql_query($sql); 
						@$ress = mysql_fetch_assoc($sqls);
						$ntr_images = (empty($ress['imagename'])) ? get_bloginfo('url').'/wp-content/plugins/amerisale-re/images/imgres1.png' : $ress['imagename'];
						$side_search = (!empty($_GET['city'])) ? '&side=y' : '';
						echo display_property_list_table($values,$proptype ='all',$ntr_images, $side_search);
					}
				}else{
					echo '<td rowspan="'.$rowspan.'"><span class="no_results">Sorry, No Record Found</span></td>';
				}
				?>
			</tbody>
		</table>

	
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
				if($page<($tpages-$adjacents)) {
					$out.= "<a href=\"JavaScript:get_ntreis_pages('$proptype','$tpages','','')\" class='page_img'>" . $lastlabel . "</a>\n";
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


function display_property_list_table($values, $proptype ='all', $ntr_images, $side_search=''  ){

	$beds = (!empty($values['bedrooms'])) ? 'beds : '.$values['bedrooms']. ' ' : '';
	$baths = (!empty($values['sqft_total'])) ? 'baths : '.$values['baths']. ' ' : '';
	$mlsid = (!empty($values['MLS'])) ? $values['MLS'] : '';
	$acres = (!empty($values['acres'])) ? $values['acres'] : '';
	$sqft_total = (!empty($values['sqft_total'])) ? $values['sqft_total'] : '';

	// list price
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

	if(in_array($proptype, array('Residential','Residential Lots','Commercial','all'))){
		$td_opt = 
		   '<td>'.$beds.$baths.'</td>
			<td>'.$mlsid.'</td>
			<td>'.$listprice.'</td>
			<td>'.$sqft_total.'</td>';
	}else{
		$td_opt = 
		   '<td>'.$acres.'</td>
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


	$tds = 
	   '<tr><td>
			<a  rel="properties" title="" href="'.get_bloginfo('url').'/viewproperty?mls='. $values['MLS'].$side_search.'">
				<img width="80"  alt="residential image" src="'.$ntr_images.'">
			</a><br>
			<a href="'.get_bloginfo('url').'/viewproperty?mls='. $values['MLS'].$side_search.'" class="property_title1" >View Details</a>
		</td>'.
		$td_opt.'
		<td>'.$values['proptype'].'</td>
		<td>'.$address.'</td></tr>';
	
	return $tds; 
}

function wp_view_details(){
	
	global $wpdb,$plugin_dir;
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
	  
	if(isset($_SESSION['side'])) $WHERE_0fficelist = "id > 0";

	$mlsid = $_SESSION['mlsnum'];
	$sql = "select * from ntreislist where  MLS = '".$mlsid."' AND ".$WHERE_0fficelist." AND delete_status = '0'  limit 1";
	$mls = mysql_query($sql); 
	$resvar = mysql_fetch_assoc($mls);	

	$additionalinfo = "select * from  additionalinfo where 	n_id= ".$resvar['id']." limit 1";
	$sql = mysql_query($additionalinfo); 
	$additionalinfos = mysql_fetch_assoc($sql);	
	
	$sql = "select * from financial where n_id= '".$resvar['id']."' limit 1";
	$financial = mysql_query($sql); 
	$financials = mysql_fetch_assoc($financial);	
	 
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
		// orig format $listprice =  preg_replace('/\.00/', '', money_format('%.2n', $resvar['listprice']));
		$listprice =  "$".number_format($resvar['listprice']); 
	}

	$sqft_price = "$". $resvar['sqft_price']; 
	
	$photocount = $resvar['photocount'];
	$sales_pending = $resvar['sales_pending'];
	$sold = $resvar['sold'];
?>
	<div class="content">
		<div class="wpp_row_view wpp_property_view_result">
			<?php if($sales_pending == 1): ?>
				<div class="sales_pending">sales pending</div><br clear="all" >
			<?php endif; ?>

			<?php if($sold == 1): ?>
			<div class="sales_pending">sold</div><br clear="all" >
			<?php endif; ?>

			<div class="all-properties">
				<?php if($resvar['virtual_tour']): ?>
				<a target="TREOsub_VT" href="<?php echo $resvar['virtual_tour']; ?>">
					<img width="60" border="0" align="middle" alt="Virtual Tour Camera Image" src="<?php echo plugins_url(); ?>/<?php echo $plugin_dir; ?>/images/cam.png"> 
					Click Here for a Virtual Tour of this Listing!!!
				</a>
				<br clear="all" />
				<?php endif; ?>

				<div class="prop_view_links">
					<span class="">HOVER TO STOP</span>
					<span class="">CLICK TO ENLARGE</span>					
					<a href="mailto:?subject=Texas Real Estate Information&body=You have been sent this property information by a real estate professional using TexasRealEstateOnline.com or TexasProperties.com. <?php echo get_bloginfo('url').'/propertyview?mls='. $resvar['MLS']; ?>">
						<span class="">EMAIL TO FRIEND</span>
					</a>
					<a target="_blank" href="<?php echo get_bloginfo('url'); ?>/print-view">
						<span class="">PRINT VIEW</span>
					</a>
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
									echo '
									<li>
										<a href="'.$img.'" target="_blank">
											<img src="'.$img.'" title="'.$img.'" >
										</a>
									</li>';
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
										echo '<li><img src="'.$img.'" ></li>';
									}
								}
							?>											
							</ul>
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
					while(@$row = mysql_fetch_assoc($sqls)) $agents[] = $row;

					foreach($agents as $result)
					{
						$id = $result['id'];  
						if($result['photo'] && basename($result['photo']) != "imgres.png")
							$img = get_bloginfo('url').'/wp-content/uploads/amerisale-re/'.basename($result['photo']);
						else
							$img = get_bloginfo('url').'/wp-content/plugins/amerisale-re/images/imgres.png';
				
						echo '
						<table>
							<tbody>
								<tr class="content"><td>
									<a target="_blank" href="'.get_bloginfo('url').'/agents/agtview/?agtvwid='.$id.'" >
										<img border="0" src="'.$img.'" alt="image" width="100" height="100" />
									</a></td>
								</tr>
								<tr class="cont"><td>'.$result['Name'].'</td></tr>
								<tr class="cont"><td><a href="mailto:'.$result['email_address'].'">'.$result['email_address'].'</a></td></tr>
								<tr class="cont"><td><a class="readmorelink" target="_blank" href="'.get_bloginfo('url').'/agents/agtview/?agtvwid='.$id.'">More</a></td></tr>
							</tbody>
						</table>';
					}

				?>
				</div>
					
				<br clear="all" />

				<div class="prop_detls">
					<table>
						<tr>
							<td width="50%">
								<table class="addr">
									<tr>
										<th>Address :</th>
										<td><?php echo $address; ?></td>
									</tr>

									<?php if(!empty($resvar['listprice'])): ?>
									<tr>
										<th>Price :</th>
										<td><?php echo $listprice; ?></td>
									</tr>
									<?php endif; ?>

									<?php if($resvar['proptype'] != 'Lots & Acreage' && $resvar['proptype'] != 'Commercial'): ?>

										<?php if(!empty($resvar['sqft_total'])): ?>
										<tr>
											<th>Sq.Feet :</th>
											<td><?php echo $resvar['sqft_total']; ?> sq.feet</td>
										</tr>
										<?php endif; ?>

										<?php if(!empty($resvar['sqft_price'])): ?>
										<tr>
											<th>price/Sq.foot :</th>
											<td><?php echo $sqft_price; ?></td>
										</tr>
										<?php endif; ?>

										<?php if($resvar['stories']): ?>
										<tr>
											<th>Stories :</th>
											<td><?php echo $resvar['stories']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if(!empty($resvar['sub_division'])): ?>
										<tr>
											<th>Sub Division :</th>
											<td><?php echo $resvar['sub_division']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if(!empty($resvar['garage_cap'])): ?>
										<tr>
											<th>Garage Space :</th>
											<td><?php echo $resvar['garage_cap']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if(!empty($resvar['carport_space'])): ?>
										<tr>
											<th>Carport Space :</th>
											<td><?php echo $resvar['carport_space']; ?></td>
										</tr>
										<?php endif; ?>

									<?php else: ?>

										<?php if(!empty($resvar['sqft_source'])): ?>
										<tr>
											<th>Sq.Source:</th>
											<td><?php echo $resvar['sqft_source']; ?></td>
										</tr>
										<?php endif; ?>

									<?php endif; ?>
								</table>
							</td>
							<td>
								<ul class="bullet_points">
							
									<?php if(!empty($financials)): ?>
										<h3 class="hig">Highlights</h3>

										<?php if(!empty($financials['highlight_1'])): ?>
											<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_1']; ?></span></li><br clear="all" />
										<?php endif; ?>
										
										<?php if(!empty($financials['highlight_2'])): ?>
											<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_2']; ?></span></li><br clear="all" />
										<?php endif; ?>

										<?php if(!empty($financials['highlight_3'])): ?>
											<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_3']; ?></span></li><br clear="all" />
										<?php endif; ?>

										<?php if(!empty($financials['highlight_4'])): ?>
											<li id="lists" ><span class="normalspans"><?php  echo $financials['highlight_4']; ?></span></li><br clear="all" />
										<?php endif; ?>

										<?php if($financials['conventinal'] == 1 || $financials['va_loan'] == 1 || $financials['fha_loan'] == 1 || $financials['owner_financed'] == 1 || $financials['texas_vet'] == 1): ?>
										<br clear="all" ><br />
										<h3 class="hig">Financing Options</h3>
										<?php endif; ?>

										<?php if($financials['conventinal'] == 1): ?>
											<li id="lists" ><span class="normalspans"><?php  echo 'Conventional'; ?></span></li><br clear="all" />
										<?php endif; ?>

										<?php if($financials['va_loan'] == 1): ?>
											<li id="lists" ><span class="normalspans"><?php  echo 'VA Loan'; ?></span></li><br clear="all" />
										<?php endif; ?>

										<?php if($financials['fha_loan'] == 1): ?>
											<li id="lists" ><span class="normalspans"><?php  echo 'FHA Loan'; ?></span></li><br clear="all" />
										<?php endif; ?>

										<?php if($financials['owner_financed'] == 1): ?>
											<li id="lists" ><span class="normalspans"><?php  echo 'Owner Financed'; ?></span></li><br clear="all" />
										<?php endif; ?>

										<?php if($financials['texas_vet'] == 1): ?>
											<li id="lists" ><span class="normalspans"><?php  echo 'Texas Vet'; ?></span></li><br clear="all" />
										<?php endif; ?>
										
									<?php endif; ?>
								</ul> 
							</td>
						</tr>
					</table>


					<table>
						<tr>
							<td width="50%">
								<table class="addr">
									<tr>
										<th>MLS# :</th>
										<td><?php echo $resvar['MLS']; ?></td>
									</tr>

									<?php if(!empty($resvar['agent_name'])): ?>
										<tr>
											<th>Agent name :</th>
											<td><?php echo $resvar['agent_name']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if(!empty($resvar['legal'])): ?>
										<tr>
											<th>Legal :</th>
											<td><?php echo $resvar['legal']; ?></td>
										</tr>
									<?php endif; ?>

									<tr>
										<th>Property type :</th>
										<td><?php echo $resvar['proptype']; ?></td>
									</tr>

									<?php if(!empty($resvar['housing_type'])): ?>
										<tr>
											<th>Housing type :</th>
											<td><?php echo $resvar['housing_type']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['proptype'] != 'Acreage'): ?>

										<?php if(!empty($resvar['bedrooms'])): ?>
										<tr>
											<th>Bedrooms :</th>
											<td><?php echo $resvar['bedrooms']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if(!empty($resvar['baths'])): ?>
										<tr>
											<th>Baths :</th>
											<td><?php echo $resvar['baths']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if($resvar['num_dining_areas']): ?>
										<tr>
											<th>Dining Areas :</th>
											<td><?php echo $resvar['num_dining_areas']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if($resvar['num_living_areas']): ?>
											<tr>
												<th>Living Areas  :</th>
												<td><?php echo $resvar['num_living_areas']; ?></td>
											</tr>

											<?php if($resvar['fire_place']): ?>
											<tr>
												<th>Fire Places :</th>
												<td><?php echo $resvar['fire_place']; ?></td>
											</tr>
											<?php endif; ?>
										<?php endif; ?>

										<?php if(!empty($resvar['lotsize'])): ?>
										<tr>
											<th>LotSize :</th>
											<td><?php echo $resvar['lotsize']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if(!empty($resvar['acres'])): ?>
										<tr>
											<th>Acres :</th>
											<td><?php echo $resvar['acres']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if(!empty($resvar['yearbuilt'])): ?>
										<tr>
											<th>Year built :</th>
											<td><?php echo $resvar['yearbuilt']; ?></td>
										</tr>
										<?php endif; ?>


									<?php else: ?>

										<?php if(!empty($resvar['bedrooms'])): ?>
										<tr>
											<th>Acres :</th>
											<td><?php echo $resvar['acres']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if(!empty($resvar['lotsize'])): ?>
										<tr>
											<th>LotSize :</th>
											<td><?php echo $resvar['lotsize']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if(!empty($resvar['yearbuilt'])): ?>
										<tr>
											<th>Year built :</th>
											<td><?php echo $resvar['yearbuilt']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if(!empty($resvar['utility'])): ?>
										<tr>
											<th>Utility :</th>
											<td><?php echo $resvar['utility']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if($resvar['schooldistrict']): ?>
										<tr>
											<th>School District :</th>
											<td><?php echo $resvar['schooldistrict']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if($resvar['sub_division']): ?>
										<tr>
											<th>Sub Division :</th>
											<td><?php echo $resvar['sub_division']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if($resvar['num_dining_areas']): ?>
										<tr>
											<th>Dining Areas  :</th>
											<td><?php echo $resvar['num_dining_areas']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if($resvar['num_living_areas']): ?>
										<tr>
											<th>Living Areas  :</th>
											<td><?php echo $resvar['num_living_areas']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if($resvar['lotsize']): ?>
										<tr>
											<th>Lot Size :</th>
											<td><?php echo $resvar['lotsize']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if($resvar['stories']): ?>
										<tr>
											<th>Stories :</th>
											<td><?php echo $resvar['stories']; ?></td>
										</tr>
										<?php endif; ?>

										<?php if($resvar['carport_space']): ?>
										<tr>
											<th>Carport Space :</th>
											<td><?php echo $resvar['carport_space']; ?></td>
										</tr>
										<?php endif; ?>

									<?php endif; ?>

									<?php if($resvar['offices']): ?>
										<tr>
											<th>Offices :</th>
											<td><?php echo $resvar['offices']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['restrooms']): ?>
										<tr>
											<th>Restrooms :</th>
											<td><?php echo $resvar['restrooms']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['meeting_spaces']): ?>
										<tr>
											<th>Meeting Spaces :</th>
											<td><?php echo $resvar['meeting_spaces']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['parking_spaces']): ?>
										<tr>
											<th>Parking Spaces :</th>
											<td><?php echo $resvar['parking_spaces']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['barns']): ?>
										<tr>
											<th>Barns :</th>
											<td><?php echo $resvar['barns']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['sheds']): ?>
										<tr>
											<th>Sheds :</th>
											<td><?php echo $resvar['sheds']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['shops']): ?>
										<tr>
											<th>Shops :</th>
											<td><?php echo $resvar['shops']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['ponds']): ?>
										<tr>
											<th>Ponds :</th>
											<td><?php echo $resvar['ponds']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['stock_tanks']): ?>
										<tr>
											<th>Stock Tanks :</th>
											<td><?php echo $resvar['stock_tanks']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['corrals']): ?>
										<tr>
											<th>Corrals :</th>
											<td><?php echo $resvar['corrals']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['pens']): ?>
										<tr>
											<th>Pens :</th>
											<td><?php echo $resvar['pens']; ?></td>
										</tr>
									<?php endif; ?>

									<?php if($resvar['units']): ?>
										<tr>
											<th>Units :</th>
											<td><?php echo $resvar['units']; ?></td>
										</tr>
									<?php endif; ?>

								</table>
							</td>
							<td> </td>
						</tr>
					</table>


					<h3>General Description :</h3>

					<?php if($resvar['remarks']): ?>
					<p> <?php echo stripslashes($resvar['remarks']); ?> </p>
					<?php endif; ?>


					<?php if($additionalinfos['showmap'] == 1): ?>
					<div class="viewmap_new">
							<a href ="<?php echo get_bloginfo('url'); ?>/propertyview/map-page?mlsid=<?php echo $mlsid ?>" class="map-page" target="_blank"> Map it </a>
					</div>
					<br clear="all" />
					<?php endif; ?>

						

					<?php if($resvar['proptype'] != 'Lots & Acreage' && $resvar['proptype'] != 'Commercial'): ?>
						<ul class="addr_des">
						<?php if($resvar['schooldistrict'] != '' || $resvar['schoolname1'] != ''): ?>
							<span class="boldspan">Schools :</span><br clear="all" />
							<?php if($resvar['schooldistrict'] != ''): ?>
							<li><span class="boldspan">School District :</span><span class="normalspans"><?php echo $resvar['schooldistrict']; ?></span></li><br clear="all" />
							<?php endif; ?>
							<?php if($resvar['schoolname1'] != ''): ?>
								<li><span class="boldspan">School names :</span><span class="normalspans" ><?php echo ucfirst(strtolower($resvar['schoolname1'])).', '.ucfirst(strtolower($resvar['schoolname2'])).', '.ucfirst(strtolower($resvar['schoolname3'])); ?></span></li><br clear="all" />
							<?php endif; ?>
						<?php endif; ?>
						</ul>
					<?php endif; ?>	


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