<?php get_header(); ?>
<div id="main" class="grid_12">
	<div id="notfound">
		<img src="<?php bloginfo('template_url'); ?>/img/404.png" alt="404" />
		<h2>Error <span>404</span> - Page Not Found</h2>
		<p>Sorry, but the page you are looking for cannot be found.<br />
		It may have been moved or deleted. </p>
	</div>
	<div id="alternatives" class="grid_6 alpha">
		<h3>Let's try one of the following:</h3>
		<ul>
			<?php if (array_key_exists('HTTP_REFERER', $_SERVER)) { ?>
			<li>Visted the <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">previous page</a></li>
			<?php } ?>
			<li>Go to the <a href="<?php bloginfo('url'); ?>">homepage</a></li>
			<li>Use the search: <?php get_search_form(); ?></li>
		</ul>
	</div>
	<div id="reportlink" class="grid_6 omega">
		<h3>Report broken Link</h3>
		<p>Please report any broken (or non functioning) links that you may find!<br/>
		To do this, please use the <a href="<?php bloginfo('url'); ?>/imprint#contact">contact form</a>.</p>
	</div>	
	
	<div class="clear"></div>		
</div><!-- #main -->
<div class="clear"></div>
<?php get_footer(); ?>