<div id="sidebar" class="grid_4">
	<div id="sidebarsearch">
		<?php get_search_form(); ?>
	</div>
	
	<div id="feeds">
		<h3>Feeds</h3>
			<a class="feed" href="<?php bloginfo('rss_url'); ?>" alt="RRS">Subscribe to Posts</a>
			<a class="feed" href="<?php bloginfo('comments_rss2_url'); ?>" alt="RRS">Subscribe to Comments</a>
	</div>

	<div id="categories">
		<h3>Categories</h3>
		<?php	//http://www.blogohblog.com/10-wordpress-hacks-to-make-your-life-even-easier/
			$cat_left = '';
			$cat_right = '';
			$cats = explode("<br />",wp_list_categories('title_li=&echo=0&depth=1&style=none'));
			$cat_n = count($cats) - 1;
			for ($i=0;$i<$cat_n;$i++):
				if ($i<$cat_n/2):
					$cat_left = $cat_left.'<li>'.$cats[$i].'</li>';
				elseif ($i>=$cat_n/2):
					$cat_right = $cat_right.'<li>'.$cats[$i].'</li>';
				endif;
			endfor;
		?>
		<ul class="left">
			<?php echo $cat_left;?>
		</ul>
		<ul class="right">
			<?php echo $cat_right;?>
		</ul>
		<div class="clear"></div>
		
	</div>			
	
	<div id="archives">
		<h3>Archives</h3>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</div>
</div>
<div class="clear"></div>