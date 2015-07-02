<?php
/*
Template Name: Home
*/

get_header();
 ?>
 <div id="left-sidebar">
<?php
	 dynamic_sidebar( 'sidebar-main' );
	?>
<img src="<?php echo get_home_url(); ?>/wp-content/themes/realestatenew/images/sherrill_side bar.jpg">
</div>
 <div id="main-cont">

<?php
	  while (have_posts()) { 
			the_post(); 
			the_content();

			
			}
			?>

</div>


<?php

	get_footer();
	?>