<?php get_header(); ?>
<div id="main" class="grid_12">
	<h2 id="searchheadline">Search Results</h2>

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h3 class="searchresults"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php print_paragraphs(2); ?>
				<p>
					<a class="more-link" href="<?php the_permalink(); ?>">Read more</a>
				</p>				
			</div>
		<?php endwhile; ?>

	<?php else : ?>

		<h3 id="noposts">Sorry. No Posts found.</h3>

	<?php endif; ?>

	<h3 class="grid_2 alpha" id="newsearch">New Search:</h3><div id="newsearchform" class="grid_4"><?php get_search_form(); ?></div>
	
</div><!-- #main -->
<div class="clear"></div>

<?php get_footer(); ?>
