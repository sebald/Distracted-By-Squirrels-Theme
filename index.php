<?php get_header(); ?>
<div id="main" class="grid_8">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="meta">
				on <?php the_time('F jS, Y') ?> in <?php the_category(', ') ?>
			</div>
			<div class="entry">
				<?php the_content('Read more'); ?>
			</div>
		</div>
		<div class="clear"></div>	
		
	<?php endwhile; ?>

		<?php if (function_exists("pagination")) {
			pagination();
		} else { ?>
			<div class="navigation">
				<div class="next-posts"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="prev-posts"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			</div>
		<?php } ?>
	
	<?php else : ?>

		<h2>Not Found</h2>

	<?php endif; ?>
</div><!-- #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>