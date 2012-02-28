<?php
/*
	Template Name: Work Portfolio v2
	Autor: Sebastian Sebald
*/
?>
<?php get_header(); ?>
<div id="main" class="grid_12">
	<div>
		<ul id="worknav">
			<li><a id="navpapers" class="current" href="">Papers</a></li>
			<li><a id="navsoftware" href="">Software</a></li>
			<li><a id="navdesign" href="">Design</a></li>
			<li><a id="navtop" href="">Back to top</a></li>
		</ul>
	</div>
	<div id="workcontent">
	<?php
	/*
			PAPERS
	*/
		$cat_id = get_cat_id('Paper');
		query_posts('post_type=work&cat='.$cat_id);
	?>
	<?php if (have_posts()) : ?>
		<div class="section" id="papers">
			<ul class="worklist">
				<?php while (have_posts()) : the_post(); ?>
					<li id="work<?php the_id(); ?>">
						<?php the_work_content(); ?>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>
	<?php //wp_reset_query(); ?>
	<?php
	/*
			SOFTWARE
	*/
		$cat_id = get_cat_id('Software');
		query_posts('post_type=work&cat='.$cat_id);
	?>
	<?php if (have_posts()) : ?>
		<div class="section" id="software">
			<ul class="worklist">
				<?php while (have_posts()) : the_post(); ?>
					<li id="work<?php the_id(); ?>">
						<?php the_work_content(); ?>		
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>
	<?php //wp_reset_query(); ?>	
	<?php
	/*
			DESIGN
	*/
		$cat_id = get_cat_id('Design');
		query_posts('post_type=work&cat='.$cat_id);
	?>
	<?php if (have_posts()) : ?>
		<div class="section" id="design">
			<ul class="worklist">
				<?php while (have_posts()) : the_post(); ?>
					<li id="work<?php the_id(); ?>">
						<?php the_work_content(); ?>		
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>
	<?php //wp_reset_query(); ?>	
	</div><!-- #workcontent -->
	<div class="clear"></div>
</div><!-- #main -->
<div class="clear"></div>
<script>

$(document).ready(function() {
	/*********************************/
	/*	 	 Sticky Navigation  	 */
	/*********************************/

	// parameter
	var navOffset 	= 15,
		fadeSpeed 	= 300,
		hoverSpeed 	= 200;
	
	// top element, navigation is aligned to this element
	var minTop = $('#workcontent').offset().top,
		maxTop = $('#workcontent').height()+minTop-$('#worknav').height();
	// place navigation
	var currentScroll = $(window).scrollTop();
	$('#worknav').css({'top' : minTop});
	// align navigation to window scroll
	if( currentScroll > minTop && currentScroll < maxTop ) {
		// while scrolling though the content
		$('#worknav').css({'top' : navOffset+'px'});		
	}
	if( currentScroll <= minTop ) {
		// adjust navigation top to content top
		$('#worknav').css({'top' : minTop-currentScroll});
	}
	if( currentScroll >= maxTop ) {
		// end of content
		$('#worknav').css({'top' : maxTop-currentScroll});
	}
	
	// get section positions
	var papersTop 	= Math.floor($('#papers').offset().top),
		softwareTop = Math.floor($('#software').offset().top),
		designTop 	= Math.floor($('#design').offset().top);
	
	// on scroll
	$(window).scroll(function() {
		// current scroll
		var winScroll = $(window).scrollTop();
		// align navigation to window scroll
		if( winScroll > minTop && winScroll < maxTop ) {
			// while scrolling though the content
			$('#worknav').css({'top' : navOffset+'px'});		
		}
		if( winScroll <= minTop ) {
			// adjust navigation top to content top
			$('#worknav').css({'top' : minTop-winScroll});
		}
		if( winScroll >= maxTop ) {
			// end of content
			$('#worknav').css({'top' : maxTop-winScroll});
		}
		
		// indicator for current position in the document
		if(	(winScroll + navOffset) < softwareTop ) {
			// current section = papers
			$('#navpapers').css({'background-position' : '0 -133px'});
			$('#navsoftware').css({'background-position' : '-120px 0'});
			$('#navdesign').css({'background-position' : '-240px 0'});
			// animate
			$('#navpapers').stop().stop().animate({ opacity: 1.0 }, fadeSpeed);
			$('#navsoftware').stop().animate({ opacity: 0.2 }, fadeSpeed);
			$('#navdesign').stop().animate({ opacity: 0.2 }, fadeSpeed);
			$('#navtop').stop().animate({ opacity: 0.2 }, fadeSpeed);
			// current
			$('#navpapers').addClass('current');
			$('#navsoftware').removeClass('current');
			$('#navdesign').removeClass('current');			
		} else if ( (winScroll + navOffset) < designTop && (winScroll <= maxTop) ) {
			// current section = software
			$('#navpapers').css({'background-position' : '0 0'});
			$('#navsoftware').css({'background-position' : '-120px -133px'});
			$('#navdesign').css({'background-position' : '-240px 0'});
			// animate
			$('#navsoftware').stop().animate({ opacity: 1.0 }, fadeSpeed);
			$('#navpapers').stop().animate({ opacity: 0.2 }, fadeSpeed);
			$('#navdesign').stop().animate({ opacity: 0.2 }, fadeSpeed);
			$('#navtop').stop().animate({ opacity: 0.2 }, fadeSpeed);
			// current
			$('#navsoftware').addClass('current');
			$('#navpapers').removeClass('current');
			$('#navdesign').removeClass('current');				
		} else {
			// current section = design
			$('#navpapers').css({'background-position' : '0 0'});
			$('#navsoftware').css({'background-position' : '-120px 0'});
			$('#navdesign').css({'background-position' : '-240px -133px'});
			// animate
			$('#navdesign').stop().animate({ opacity: 1.0 }, fadeSpeed);
			$('#navsoftware').stop().animate({ opacity: 0.2 }, fadeSpeed);			
			$('#navpapers').stop().animate({ opacity: 0.2 }, fadeSpeed);
			$('#navtop').stop().animate({ opacity: 0.2 }, fadeSpeed);
			// current
			$('#navdesign').addClass('current');
			$('#navpapers').removeClass('current');
			$('#navsoftware').removeClass('current');				
		}
		// current section = last section, if end of page is reached
		if ($('body').height() <= ($(window).height() + $(window).scrollTop())) {
			// current section = design
			$('#navpapers').css({'background-position' : '0 0'});
			$('#navsoftware').css({'background-position' : '-120px 0'});
			$('#navdesign').css({'background-position' : '-240px -133px'});
			// animate
			$('#navdesign').stop().animate({ opacity: 1.0 }, fadeSpeed);
			$('#navsoftware').stop().animate({ opacity: 0.2 }, fadeSpeed);			
			$('#navpapers').stop().animate({ opacity: 0.2 }, fadeSpeed);
			$('#navtop').stop().animate({ opacity: 0.2 }, fadeSpeed);
			// current
			$('#navdesign').addClass('current');
			$('#navpapers').removeClass('current');
			$('#navsoftware').removeClass('current');			
		}
		
	});
		
	//nav actions	
	$('#navpapers').click(function(event) {
		event.preventDefault();
		scrollToID('#papers', 500);
	});	
	$('#navsoftware').click(function(event) {
		event.preventDefault();
		scrollToID('#software', 500);
	});
	$('#navdesign').click(function(event) {
		event.preventDefault();
		scrollToID('#design', 500);
	});
	$('#navtop').click(function(event) {
		event.preventDefault();
		scrollToID('#top', 500);
	});
	
	// hover
	$('#worknav a').hover(function(e) {
		$(this).hoverFlow(e.type, { opacity: 1.0 }, hoverSpeed);
	}, function(e) {
		if( $(this).hasClass('current') || $('html,body').is(':animated') ) return false;
		$(this).hoverFlow(e.type, { opacity: 0.2 }, hoverSpeed);
	});	
	
});	
</script>
<?php get_footer(); ?>