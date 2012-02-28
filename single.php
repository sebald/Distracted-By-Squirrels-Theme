<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="main" class="grid_8">
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<h2><?php the_title(); ?></h2>
			
			<div class="meta">
				on <?php the_time('F jS, Y') ?> in <?php the_category(', ') ?>
			</div>

			<div class="entry">
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
			</div>
				
		</div>

		<div id="social">
			<div id="social-text">
				<h4>Liked this? Share it!</h4>
				Subscribe to the <a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe to the RSS feed.">RSS Feed</a>.
			</div>
			<div id="social-bookmarks">
				<a href="http://del.icio.us/post?url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="Bookmark on Delicious.">
					<img src="<?php bloginfo('template_directory'); ?>/img/delicious.png" alt="Bookmark on Delicious" />
				</a>
				<a href="http://digg.com/submit?phase=2&amp;amp;url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="Digg this!">
					<img src="<?php bloginfo('template_directory'); ?>/img/digg.png" alt="Digg This!" />
				</a>
				<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;amp;t=<?php the_title(); ?>" title="Share on Facebook.">
					<img src="<?php bloginfo('template_directory'); ?>/img/facebook.png" alt="Share on Facebook" id="sharethis-last" />
				</a>					
				<a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;amp;title=<?php the_title(); ?>" title="StumbleUpon.">
					<img src="<?php bloginfo('template_directory'); ?>/img/stumbleupon.png" alt="StumbleUpon" />
				</a>
				<a href="http://twitter.com/home/?status=<?php the_title(); ?> : <?php echo getTinyUrl(get_permalink($post->ID)); ?>" title="Tweet this!">
					<img src="<?php bloginfo('template_directory'); ?>/img/twitter.png" alt="Tweet this!" />
				</a>
			</div>
		</div>
		
		<div id="related">
			<div id="related-text">
				<h4>You may also like</h4>
			</div>
			<div id="related-posts">
				<?php
					related_posts($post);
				?>
			</div>
		</div>
		<div class="clear"></div>
		<div id="tags">
			<?php the_tags( 'Tags: ', ', ', ''); ?>
		</div>
		<?php //edit_post_link('Edit this entry','','.'); ?>	
		
		<?php comments_template(); ?>
		
	</div>
	<?php endwhile; endif; ?>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>