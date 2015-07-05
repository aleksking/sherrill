<?php
/**
 * @package ZeroGravity
 */
add_action ('wp_head', 'zerogravity_customizer_css');
function zerogravity_customizer_css() {
	?>
	<style type='text/css'>
	<?php 
	$color = esc_html(get_theme_mod('zerogravity_color_tema', '#0098D3'));
	?>
	a {color: <?php echo $color; ?>;}
	a:hover {color: <?php echo $color; ?>;}
	.blog-info-sin-imagen {background-color: <?php echo $color; ?>;}
	.social-icon-wrapper a:hover {color: <?php echo $color; ?>;}
	.toggle-search {color: <?php echo $color; ?>;}
	.prefix-widget-title {color: <?php echo $color; ?>;}
	.term-icon {color: <?php echo $color; ?>;}
	
	.sub-title a:hover {color:<?php echo $color; ?>;}
	.entry-content a:visited,.comment-content a:visited {color:<?php echo $color; ?>;}
	input[type="submit"] {background-color:<?php echo $color; ?> !important;}
	.bypostauthor cite span {background-color:<?php echo $color; ?>;}
	.site-header h1 a:hover,
	.site-header h2 a:hover {
		color: <?php echo $color; ?>;
	}
	.entry-header .entry-title a:hover {color:<?php echo $color; ?> ;}
	.archive-header {border-left-color:<?php echo $color; ?>;}
	.main-navigation a:hover,
	.main-navigation a:focus {
		color: <?php echo $color; ?>;
	}
	.widget-area .widget a:hover {
		color: <?php echo $color; ?> !important;
	}
	footer[role="contentinfo"] a:hover {
		color: <?php echo $color; ?>;
	}
	.entry-meta a:hover {
	color: <?php echo $color; ?>;
	}
	.format-status .entry-header header a:hover {
		color: <?php echo $color; ?>;
	}
	.comments-area article header a:hover {
		color: <?php echo $color; ?>;
	}
	a.comment-reply-link:hover,
	a.comment-edit-link:hover {
		color: <?php echo $color; ?>;
	}
	.template-front-page .widget-area .widget li a:hover {
		color: <?php echo $color; ?>;
	}
	.main-navigation .current-menu-item a,
	.main-navigation .current-menu-ancestor > a,
	.main-navigation .current_page_item > a,
	.main-navigation .current_page_ancestor > a {color: <?php echo $color; ?>;}
	.currenttext, .paginacion a:hover {background-color:<?php echo $color; ?>;}
	.main-navigation li a:hover  {color: <?php echo $color; ?>;}
	.aside{border-left-color:<?php echo $color; ?> !important;}
	blockquote{border-left-color:<?php echo $color; ?>;}
	.logo-header-wrapper, .image-header-wrapper {background-color:<?php echo $color; ?>;}
	h2.comments-title {border-left-color:<?php echo $color; ?>;}
	
	<?php if (get_theme_mod('zerogravity_color_excerpt_title', '') == 1) { ?>
		.entry-title a, entry-title a:visited {color:<?php echo $color; ?>;}
	<?php } ?>
	
	<?php if (get_theme_mod('zerogravity_header_color_white', '') == 1) { ?>
		.logo-header-wrapper, .image-header-wrapper {background-color:#ffffff;}
		.blog-info-sin-imagen {
			background-color:#ffffff;
			color:#444444 !important;
		}
		.blog-info-sin-imagen a {
			color:#444444 !important;
		}
		.blog-info-sin-imagen h2 {color:#444444 !important;}
	<?php } ?>
	
	<?php if (get_theme_mod('zerogravity_thumbnail_rounded', 1) == '') { ?>
		.wrapper-excerpt-thumbnail img {
	 		border-radius:0;
		}
	<?php } ?>
	
	<?php if (get_theme_mod('zerogravity_text_justify', '') == 1) { ?>
		.entry-content {
			text-align:justify;
		}
	<?php } ?>
		
	<?php $fuente = esc_html(get_theme_mod('zerogravity_fonts', 'Open Sans')); ?>
	body.custom-font-enabled {font-family: "<?php echo $fuente; ?>", Arial, Verdana;}
	
	<?php 
	if (get_theme_mod('zerogravity_sidebar_position') == 'derecha') : ?>
		@media screen and (min-width: 600px) {
			#primary {float:left;}
			#secondary {float:right;}
			.site-content {
				border-left: none;
				padding-left:0;
				padding-right: 24px;
				padding-right:1.714285714285714rem;
				/*border-right: 1px solid #e0e0e0;*/
			}
		}
		@media screen and (min-width: 960px) {
			.site-content {
				border-right: 1px solid #e0e0e0;
			}
		}
	<?php endif; ?>
	
	@media screen and (max-width: 599px) {
		.menu-toggle, .menu-toggle:hover {
			background:<?php echo $color; ?> !important;
			color:#ffffff !important;
			width:100%;
		}
	}
	</style>
	
<?php
}

// Favicon
if (get_theme_mod('zerogravity_favicon') != '') add_action('wp_head', 'zerogravity_favicon');
function zerogravity_favicon () {
	$favicon = esc_url(get_theme_mod('zerogravity_favicon'));
	$ext = strtolower(substr($favicon, -4));
	switch ($ext) {
		case ('.ico'):
			echo "<link rel='icon' type='image/vnd.microsoft.icon' href='" . $favicon . "' />\n";
            break;
		case ('.png'):
			echo "<link rel='icon' type='image/png' href='" . $favicon . "' />\n";
            break;
		case ('.gif'):
       		echo "<link rel='icon' type='image/gif' href='" . $favicon . "' />\n";
            break;
   }
}
?>