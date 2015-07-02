<?php
session_start();
//i dont think this is used
if(is_page('map page')){
$_SESSION['mlsnum'] = $_GET['mlsid'];
include (TEMPLATEPATH . '/mcontent.php'); 

}else if(is_page('site map page')){ include (TEMPLATEPATH . '/mmcontent.php'); }else if(is_page('Agtview')){
include (TEMPLATEPATH . '/agtview.php'); 
}elseif(is_page('mlssearch')){ include (TEMPLATEPATH . '/mlssearch.php'); }else{ ?>

<?php get_header(); 


?>
<script>
var loadimg="<img src='<?php echo content_url()?>'/themes/realestatenew/loading16.gif' alt='loading...' width='100px'>";
	var $js = jQuery.noConflict();
	function getprice(id){
		// alert(id);
		var typeval = $js("#typeval").val();
		if(typeval == ''){
			typeval = 'Residential';
		}
		get_ntreis_pages(typeval,'1',id);
	}
	
	
	function gettype(type){
		// alert(id);
		var orderid = $js("#orderval").val();
		if(orderid == ''){
			orderid = 'ASC';
		}
		get_ntreis_pages(type,'1',orderid);
	}
	
	function gettype(type){
		// alert(id);
		var orderid = $js("#orderval").val();
		if(orderid == ''){
			orderid = 'ASC';
		}
		get_ntreis_pages(type,'1',orderid);
	}
	
	function get_ntreis_pages(proptype,pageid,order){
		$js("#imge_load").html(loadimg);
		$js("#ajax_rep_div").fadeOut("slow");
		// $js("#")
		var url = "<?php echo content_url().'/themes/realestatenew/ntreis_pagination.php'; ?>";
		$js.post( url,{proptype : proptype, pageid : pageid, order : order},
		  function( data ) {
			  //alert(data);
			  $js("#ajax_rep_div").html(data);
			  $js("#imge_load").html('');
			  $js("#ajax_rep_div").fadeIn("slow");
		  }
		);
	}
	
</script>
<style>
	.price_div_hr{
		float: right;
	}
	.price_div_hr label{
		color: #FFFFFF;
		float: left;
		font-size: 14px;
		padding: 0 10px;
	}
	#selectbxs{
		float:left;
	}
	
	.tooldivclass{float:left;}
</style>



<?php 
if(is_page('Properties Available')){
	$sql = "SELECT * FROM ".$wpdb->prefix."agentaccount ";
	$results = $wpdb->get_results($sql);
	// echo "<pre>"; print_r($results);die;
	$db_ip = $results[0]->host;
	$db_user = $results[0]->db_user;
	$db_pass = $results[0]->password;
	$db_name = $results[0]->db;
	$agent_offcodes = $results[0]->agent_offcode;
	
	$con = mysql_connect($db_ip,$db_user,$db_pass);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($db_name, $con);
	$cnt_prop = array();
	
	$cntsqls = "select count(proptype) as cntprop,proptype from ntreislist where officelist='".$agent_offcodes."' group by proptype ";
	$cntsqls1 = mysql_query($cntsqls); 
 ?>
		<div class="price_div_hr">
			<label>Price :</label>
			<select name="price" OnChange="getprice(this.value)" id="selectbxs">
			     <option value="desc">high to low</option>
				 <option value="asc">low to high</option>
			</select>
			
			<label>Type :</label>
			<select name="price" OnChange="gettype(this.value)" id="typeval">
				<?php
					echo '<option value="all">ALL</option>';
					while($resd = mysql_fetch_assoc($cntsqls1)){
						echo '<option value="'.$resd['proptype'].'">'.$resd['proptype'].'</option>';
					}
					mysql_select_db(DB_NAME);
				?>
			</select>
		</div>	
		<br clear="all" />
<?php } ?>
<?php if(is_page('Agents'))
{ 
	echo '<div id="ajax_rep_div" class="primary content" >';
		include (TEMPLATEPATH . '/agenstlistings.php'); 
	echo '</div>';	
  } else if(is_page('Tools')){ 
	echo '<div class="tooldivclass">';
	 echo '<div id="tooldiv" style="float: right; width:700px;" >';
		include (TEMPLATEPATH . '/tools/tool.html');
	 echo "</div>"; 
 } else{ ?> 
<div id="imge_load" style="width:300px;margin:0 auto;"></div>

<div class="primary<?php if (!is_singular()) echo ' posts'; ?> content" id="ajax_rep_div">
    <?php if (have_posts()) { ?>
        <?php if (is_singular()) { // Single entries and pages ?>
            <?php while (have_posts()) { the_post(); ?>
                <div <?php post_class('entry'); ?>>
                     <div class="meta">
                        <?php /* the_title('<h1 class="title entry-title">', '</h1>'); */ ?>
                        
                        <?php /* echo th_post_metadata(); */ ?>
                    </div>
                    <div class="content clearfix">
                        <?php echo tarski_post_thumbnail(); ?>
                        <?php the_content(); ?>
                    </div>
                    <?php th_postend(); ?>
                
                </div> <!-- /entry -->
            
            <?php } // End entry loop ?>
        
        <?php } else { ?>
        
            <?php get_template_part('app/templates/loop'); ?>
        
        <?php } // End loop types ?>
    
    <?php } else { // If no posts ?>
    
        <?php get_template_part('app/templates/no_posts'); ?>
    
    <?php } // End loop ?>
	
    
</div>

<?php } ?>

<?php get_sidebar(); ?>
<?php if(is_page('propertyview')){ ?>
		    <!--<script type="text/javascript">
				$js(window).bind("load", function() {
				$js("div#mygalone").slideView({
					easeFunc: "easeInOutBack",
					easeTime: 2200
					}); 
				});
			</script>-->
			<script>
				var $ = jQuery.noConflict();

					$(document).ready( function(){
						// buttons for next and previous item						 
						var buttons = { previous:$('#jslidernews1 .button-previous') ,
										next:$('#jslidernews1 .button-next') };			
						 $('#jslidernews1').lofJSidernews( { interval : 4000,
															direction		: 'opacitys',	
															easing			: 'easeInOutExpo',
															duration		: 1200,
															auto		 	: true,
															maxItemDisplay  : 4,
															navPosition     : 'horizontal', // horizontal
															navigatorHeight : 32,
															navigatorWidth  : 80,
															mainWidth		: 500,
															buttons			: buttons } );	
					});
			</script>
	<?php				
		wp_view_details();
		// wp_ntreis_logins();
	}
	 ?>
<?php if(is_page('Tools')){ echo '</div>'; } ?>


<?php get_footer(); ?>

<?php } ?>