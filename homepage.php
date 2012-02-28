<?php
/*
	Template Name: Homepage
	Autor: Sebastian Sebald
*/
?>

<?php get_header(); ?>
<div id="main">
	<div id="homepic" class="grid_12"></div>
	<div class="clear"></div>
	
	<div id="intro" class="grid_12">
	<p><img id="hi" alt="hi" src="<?php bloginfo('template_url'); ?>/img/hi.png"/> Welcome to Distracted by Squirrels. My name is Sebastian. I am a computer science student from Southern Germany. I dig everything related to
	<strong>computer science</strong> and <strong>web design</strong>. This web page is my little virtual playground where I share and back up stuff from my work as a research assistant, 
	talk about computer science related topics and try to teach myself web design.</p>
	</div>
	<div class="clear"></div>	

	<div id="fromtheblog">
		<h2 class="grid_4">From the Blog</h2>
		<div class="clear"></div>
		<?php query_homepage_posts('showposts=3'); ?>
	</div><!-- #fromtheblog -->
	<div class="clear"></div>

	<div id="somework">
		<h2 class="grid_4">Some of my Work</h2>
		<div class="clear"></div>	
		<?php query_homepage_posts('post_type=work&showposts=3', '/work/#work', 'view'); ?>		
	</div><!-- #somework -->
	<div class="clear"></div>
	
</div><!-- #main -->

<?php get_footer(); ?>