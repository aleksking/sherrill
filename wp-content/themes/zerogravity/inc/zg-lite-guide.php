<?php
//Añadir menú para la guia
add_action( 'admin_menu', 'zerogravity_menu_guia' );

function zerogravity_menu_guia() {  
  	
	add_theme_page( __('ZeroGravity Guide', 'zerogravity'), __('ZeroGravity Guide', 'zerogravity'), 'edit_theme_options', 'zerogravity_guide', 'zerogravity_mostrar_guia'); 
  
} 

//Página de presentación
function zerogravity_mostrar_guia() { 

	//Obtenemos la url actual para volver cuando cerramos el customizer
	$return = add_query_arg( array()) ;
?>

<style type="text/css">
.wrapper {overflow:hidden; line-height:1.5; font-size: 14px; width:85%; margin-top:14px; padding: 28px; background-color:#ffffff; border:1px solid #ccc; border-radius:5px;}
.col-left {float:left; width: 58%; padding-right:14px; border-right:1px solid #ccc;}
.col-right {float:left; width: 34%; padding-left:21px;}
.title {margin-bottom:28px;}
.img-left {float:left;}
.dash-middle {vertical-align:midlle !important;}
.icon:before, libro:before {
	content: "\f333";
	display: inline-block;
	-webkit-font-smoothing: antialiased;
	font: normal 20px/1 'dashicons';
	vertical-align: middle;
}
.libro:before {
	content: "\f331";
	display: inline-block;
	-webkit-font-smoothing: antialiased;
	font: normal 20px/1 'dashicons';
	vertical-align: middle;
	color:#25C4E6;
}
.check-title:before {
	content: "\f147";
	display: inline-block;
	-webkit-font-smoothing: antialiased;
	font: normal 40px/1 'dashicons';
	vertical-align: middle;
	/*color:#059820;*/
	color:#ffffff;
	background-color:#25C4E6;
	border:1px solid #25C4E6;
	border-radius:50%;
}
.pro-title:before {
	content: "\f155";
	display: inline-block;
	-webkit-font-smoothing: antialiased;
	font: normal 50px/1 'dashicons';
	vertical-align: middle;
	color:#25C4E6;
}
.check-lista:before {
	content: "\f147";
	display: inline-block;
	-webkit-font-smoothing: antialiased;
	font: normal 20px/1 'dashicons';
	vertical-align: middle;
	color:#25C4E6;
}
.imagen img {
	max-width:100%;
	max-height:auto;
}
</style>

<div class="wrapper">
	<div class="col-left">
		<div><a href="<?php echo ZEROGRAVITY_AUTHOR_URI; ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/galussothemes-logo.png" /></a></div>
		<hr />
		<h2 style="font-weight:bold;"><span class="check-title"></span> <?php _e('Thank you for choosing ZeroGravity', 'zerogravity'); ?></h1>
		
		<?php _e('ZeroGravity is a simple and light WordPress theme with a clear and neat design. Some its features are: left sidebar or right, custom theme color (blue, green, orange, red, pink or yellow), custom favicon, six different Google Fonts, thumbnails rounded or squared, two widgets areas (beginning and end of posts), customization panel, fully responsive, custom header, custom background and more. Translation Ready (English and spanish integrated). Required WordPress 4.1+.', 'zerogravity'); ?>
		
		<h2><span class="libro"></span> <?php _e('ZeroGravity Quick Start Guide', 'zerogravity'); ?></h2> 
		
		<h3><span class="icon"></span> <?php _e('Important: thumbnails', 'zerogravity'); ?></h3>
			&#9679; <?php _e('For images appear on the homepage, you must set the featured image of the posts.', 'zerogravity');?>
			<br />
			&#9679; <?php _e('If ZeroGravity is not the first theme you use, you must regenerate the thumbnails of image with some free plugin as', 'zerogravity'); ?> <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a>.
		
		<h3><span class="icon"></span>  <?php _e('Customize ZeroGravity', 'zerogravity'); ?></h3>
		<?php _e('Go to "Appearance >> Customize >> ZeroGravity Options" and set the options in the sections "ZG: Color, Favicon and Sidebar", "ZG: Top bar and social icons", "ZG: Logo in the header", "ZG: Posts and footer text", "ZG: Fonts".', 'zerogravity'); ?> <a href="customize.php?return=<?php echo $return ;?>"><?php _e('ZeroGravity Options', 'zerogravity'); ?></a>
		
		<h3><span class="icon"></span>  <?php _e('Logo in the header', 'zerogravity'); ?></h3>
		
		<div>
		<?php _e('if you choose a logo, instead full image for the header, go to the section "Logo in the header" and check the option "Header image is a logo". You can too center the logo.', 'zerogravity'); ?>
		<br />
		 <div><img style="max-width:100%; height:auto;" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/center-logo.png"  /></div>
		</div>
		
		<div style="clear:both; display:block;">
			<div style="float:left; width:46%; padding:0 2%;">
				<p><?php _e('Before to check "Header image is a logo".', 'zerogravity'); ?></p>
				<img style="max-width:100%; height:auto;" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/header-logo-no-activado.png"  />
			</div>
				
			<div style="float:left; width:46%; padding:0 2%;">
				<p><?php _e('After to check "Header image is a logo".', 'zerogravity'); ?></p>
				<img style="max-width:100%; height:auto;" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/header-logo-activado.png"  />
			</div>
		</div>
		
	</div><!-- .col-left -->
	
	<div class="col-right">
		<div class="imagen">
		<img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/zerogravity-pro-features.png" />
		</div>
		<div style="text-align:center; padding-bottom:14px;"><a href="<?php echo ZEROGRAVITY_AUTHOR_URI; ?>/wordpress-themes/zerogravity-pro" target="_blank">ZeroGravity Pro</a></div>
		<hr />
		<ul>
			<li><span class="check-lista"></span> <a href="<?php echo ZEROGRAVITY_AUTHOR_URI; ?>/soporte/foro/zerogravity-pro"><?php _e('Forum support', 'zerogravity'); ?></a></li>
			<li><span class="check-lista"></span> <?php _e('Customizable maximum width', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Unlimited theme colors', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Light gray main menu or black', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Sidebar left or right', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('7 widgets areas to add AdSense code or anything else', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Easily add your Favicon', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Easily add yor Login Logo', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Available 15 differents Google fonts', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Custom widgets (Recent posts with square thumbnails or rounded, Popular posts with square thumbnails or rounded, Recent comments with square avatars or rounded, Email subscription)', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Related posts with thumbnails', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Show/Hide post meta (author, date, comments number)', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Show/Hide pages title', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Breadcrumb navigation', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Custom pagination', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Custom shortcodes (Buttons, Messages, Accordion and Tabs)', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Social networks in user profile', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Google Plus Authorship Integration', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Easily apply ZeroGravity style to bbPress, just check the option.', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Google Analytics ready, just paste the code', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('AddThis ready, just paste the code', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Translation Ready (.po file integrated)', 'zerogravity'); ?></li>
			<li><span class="check-lista"></span> <?php _e('Integrated Spanish and English', 'zerogravity'); ?></li>
		</ul>
	</div>
</div><!-- .wrapper -->
<?php } ?>