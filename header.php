<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if (is_search()) { ?>
		<meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
	
	<title>
		<?php
		if ( is_front_page() ) {
			echo bloginfo('name').' &#150; Home';
		} else {
			echo bloginfo('name');
		}
		
		if (is_404()) {
			echo ' &#150; 404 Not Found';
		} elseif (is_category()) {
			echo ' &#150; Category:'; wp_title('');
		} elseif (is_search()) {
			echo ' &#150; Search Results';
		} elseif ( is_day() || is_month() || is_year() ) {
			echo ' &#150; Archives:'; wp_title('');
		} else {
			echo wp_title('-');
		}
		?>
	</title>
	
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/favicon.png" type="image/x-icon" />
	<link  href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200,300,400,700" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/960.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/text.css" />
	<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	
	<?php if ( !is_admin() ){
		wp_enqueue_script('jquery');
		wp_enqueue_script('functions', get_bloginfo('template_url') . '/js/functions.js', array('jquery'), '2.13a.4' );
		wp_enqueue_script('fancybox', get_bloginfo('template_url') . '/js/fancybox/jquery.fancybox-1.3.4.pack.js', array('jquery'), '2.13a.4', true );
		wp_enqueue_script('fancyboxmousewheel', get_bloginfo('template_url') . '/js/fancybox/jquery.mousewheel-3.0.4.pack.js', array('jquery'), '2.13a.4', true );
	}?>
	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
	<?php wp_head(); ?>	
	
</head>
<body>
	<div id="top"></div>
	<div id="wrapper" class="container_12">
		<div id="header">
				<div id="logo" class="grid_5">
					<a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
				</div><!-- #logo -->
				<div  class="grid_7">
				<ul id="nav">
					<li><a class="home" href="<?php bloginfo('url'); ?>/">Home</a></li>
					<li><a class="blog" href="<?php bloginfo('url'); ?>/blog/">Blog</a></li>
					<li><a class="work" href="<?php bloginfo('url'); ?>/work/">Work</a></li>
					<li><a class="about" href="<?php bloginfo('url'); ?>/about/">About</a></li>
				</ul><!-- #nav -->
				</div>
		</div><!-- #header -->
		<div class="clear"></div>