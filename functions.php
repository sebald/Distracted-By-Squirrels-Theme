<?php

/************************************************/
/*					GENERAL						*/
/************************************************/	

// Load jQuery
if ( !is_admin() ) {
   wp_deregister_script('jquery');
   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"), false);
   wp_enqueue_script('jquery');
}

// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');	

// Add Feeds
add_theme_support( 'automatic-feed-links' );

// Remove Tool Bar
add_filter( 'show_admin_bar', '__return_false' );

// remove more jump
function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

// Tiny URL
function getTinyUrl($url) {
    $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
    return $tinyurl;
}

// print debug
function print_a(){
	$numargs = func_num_args();
	if($numargs>1){
		$out = '';
		ob_start();
		echo "<div style='background-color:#FFCC33;border:1px solid black;margin:3px;padding:5px;'>";
		for($a=0;$a<$numargs;$a++)
		print_a(func_get_arg($a));
		echo "</div>";
		$out .= ob_get_contents();
		ob_end_clean();
		echo $out;
	}else{
		echo "<pre style='background-color:#FFDF80;border:1px solid #000;margin:3px;padding:5px;'>";
		$a = func_get_arg(0);
		$a = (is_bool($a))?(($a)?'true':'false'):$a;
		print_r($a);
		echo "</pre>";
	}
}

add_shortcode( 'zoom', 'zoom_handler' );
function zoom_handler($atts, $content = null) {
	$title = ( isset($atts['title']) ? $atts['title'] : $content);
	$alt = ( isset($atts['alt']) ? $atts['alt'] : $content);
	$img = '<a class="zoomimg" title="'.$title.'" href="'.$content.'"><img alt="'.$alt.'" src="'.$content.'" /></a>';
	if( isset($atts['autor']) ) {
		$autor = explode(";", $atts['autor']);
		$img = '<div class="imgsrc">'.$img.'<p>Image from <a href="'.$autor[1].'">'.$autor[0].'</a></p></div>';	
	}
	return $img;
}

add_shortcode( 'img', 'img_handler' );
function img_handler($atts, $content = null) {
	$title = ( isset($atts['title']) ? $atts['title'] : $content);
	$alt = ( isset($atts['alt']) ? $atts['alt'] : $content);
	$img = '<img title="'.$title.'" alt"'.$alt.'" src="'.$content.'" />';
	if( isset($atts['autor']) ) {
		$autor = explode(";", $atts['autor']);
		$img = '<div class="imgsrc">'.$img.'<p>Image from <a href="'.$autor[1].'">'.$autor[0].'</a></p></div>';	
	}
	return $img;
}
// Warning: getimagesize() [function.getimagesize]: http:// wrapper is disabled in the server configuration by allow_url_fopen=0
/*function img_handler($atts, $content = null) {
	$max_width = 300;	// maximum image width (e.g. width of post div)

	// set title and alt attributes
	$title = ( isset($atts['title']) ? $atts['title'] : $content);
	$alt = ( isset($atts['alt']) ? $atts['alt'] : $content);

	list($img_width) = getimagesize($content);
	// use fancybox if the image is bigger than $max_width
	if( $img_width > $max_width ) {
		$img = '<a class="zoomimg" title="'.$title.'" href="'.$content.'"><img alt="'.$alt.'" src="'.$content.'" /></a>';
		$box_width = $max_width;
	} else {
		$img = '<img title="'.$title.'" alt="'.$alt.'" src="'.$content.'" />';
		$box_width = $img_width+2;
	}

	// for attribution
	if ( isset($atts['autor']) ) {
		$autor = explode(";", $atts['autor']);
		$img = '<div class="imgsrc" style="width:'.$box_width.'px;">'.$img.'<p>Image from <a href="'.$autor[1].'">'.$autor[0].'</a></p></div>';
	}	
	
	return $img;
}*/

add_shortcode ( 'pgallery', 'pgallery_handler' );
function pgallery_handler($atts, $content = null) {
	global $post;
	$items = explode(';', $content);
	$count = count($items);
	$gallery = '<div class="pgallery">';	
	for ($i=0; $i < $count; $i++){
		$item = explode(',', $items[$i], 2);
		$gallery .= '<a class="group';
		//add alpha to first item
		if ( $i == 0 || ($i+1)%4 == 1)
			$gallery .= ' first';
		//add omega to first item
		if ( $i == ($count-1) || ($i+1)%4 == 0  )
			$gallery .= ' last';
		$gallery .= '" href="'.$item[0].'" title="'.$item[1].'" rel="pgallery_'.$atts['id'].'"><img src="'.$item[0].'" alt="'.$item[0].'"></a>';
		//new line of images
		if ( ($i+1)%4 == 0 )
			$gallery .= '<div class="clear"></div>';
	}
	$gallery .= '</div>';
	return $gallery;;
}

add_shortcode ( 'sig', 'sig_handler' );
function sig_handler(){
	return 'Greetings,<br/><img class="sig" src="'.get_bloginfo('template_url').'/img/sig.png" alt="Sebastian"/>';
}

add_shortcode ( 'demo', 'demo_handler' );
function demo_handler($atts,$content = null) {
	if ( isset($atts['src']) ) {
		return '<div class="action-buttons"><a class="goto-demo" href="'.$content.'">Demo</a><a class="download-src" href="'.$atts['src'].'">Download</a></div>';
	} else {
		return '<div class="action-buttons"><a class="goto-demo" href="'.$content.'">Demo</a></div>';
	}
}

add_shortcode ( 'download', 'download_handler' );
function download_handler($atts,$content = null) {
		return '<div class="action-buttons"><a class="download-src" style="margin:0;" href="'.$content.'">Download</a></div>';
}

/************************************************/
/*					LOOP						*/
/************************************************/

//catches the first images of a post (http://www.wprecipes.com/how-to-get-the-first-image-from-the-post-and-display-it)
//Usage: catch_image_from_post() 
function catch_image_from_post() {
	global $post, $posts;
	$img = '';
	ob_start();
	ob_end_clean();
	preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	
	//Defines a default image
	$img = '<img class="thumb" alt="thumb" src="http://localhost/blog/wp-content/themes/DistractedBySquirrels/img/dummy.png" />';
	if(!empty($matches[0])){ 
		$img = '<img class="thumb" alt="thumb" src="'.$matches[1][0].'" />';
	}
	return $img;
}

// Excerpt Length
function new_excerpt_length($length) {
	if ( is_page_template('homepage.php') ) {
		return 50;
	} else {
		return 200;
	}
}
add_filter('excerpt_length', 'new_excerpt_length');

// Variable excerpt length.
function dynamic_excerpt($length) { // Variable excerpt length. Length is set in characters
	global $post;
	$text = $post->post_excerpt;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
	}
	$text = strip_shortcodes($text); // optional, recommended
	$text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

	$text = substr($text,0,$length);
	// echo $text; // Use this is if you want a unformatted text block
	echo apply_filters('the_excerpt',$text); // Use this if you want to keep line breaks
}

// Variable & intelligent excerpt length.
function print_excerpt($length) {
	global $post;
	$text = $post->post_excerpt;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
	}
	$text = strip_shortcodes($text);
	$text = strip_tags($text);

	$text = substr($text,0,$length);
	$excerpt = reverse_strrchr($text, '.', 1);
	if(	$excerpt) {
		echo apply_filters('the_excerpt',$excerpt);
	} else {
		echo apply_filters('the_excerpt',$text);
	}
}

function reverse_strrchr($haystack, $needle, $trail) {
    return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
}

// Read more Link
function new_excerpt_more($more) {
       global $post;
	return '<p><a class="more-link" href="'. get_permalink($post->ID) . '">' . 'read more' . '</a></p>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function print_paragraphs($count) {
	global $post;
	$text = $post->post_content;
	$lines = explode("\n", $post->post_content);
	foreach( $lines as $line ) {
		// skip images
		if( preg_match('/<img(.*?)>/si',$line, $m) )
			continue;
			
		// blockquote fix (paragraph inside the blockquote)	
		if( preg_match('/<blockquote(.*?)>(.*?)<\/blockquote>/si',trim($line), $m) ) {
			echo '<blockquote '.$m[1].'><p>'.$m[2].'</p></blockquote>';
			$count--;
		// start with html
		} elseif( preg_match('/^<[a-z](.*?)>/si',trim($line), $m) ) {
			echo $line;
			$count--;
		// just text, add paragraph tags
		} else {
			echo '<p>'.$line.'</p>';
			$count--;
		}
		
		// break condition
		if ( $count == 0 )
			break;
	}
}

// align vertically + same height
function query_homepage_posts($query, $link_prefix = null, $link_name = null){
	query_posts($query);
	
	// post titles
	while (have_posts()) : the_post(); ?>
		<div class="grid_4">
			<h3><a href="<?php
			if( $link_prefix ){
				echo get_bloginfo('url').$link_prefix.get_the_ID();
			} else {
				the_permalink();
			}
			?>"><?php the_title(); ?></a></h3>
		</div>
	<?php endwhile; ?>
		<div class="clear"></div>
	<?php
	
	// post content
	rewind_posts();
	while (have_posts()) : the_post();
	?>
		<div class="grid_4">
			<?php print_excerpt(350); ?>
		</div>
	<?php endwhile; ?>
		<div class="clear"></div>
	<?php
	
	// post links
	rewind_posts();
	while (have_posts()) : the_post();
	?>
		<p class="grid_4 hpmore"><a class="more-link" href="<?php
			if( $link_prefix ){
				echo get_bloginfo('url').$link_prefix.get_the_ID();
			} else {
				the_permalink();
			}
			?>"><?php $link_text = ($link_name != '' ? $link_name : 'read more'); echo $link_text; ?></a></p>
	<?php endwhile; ?>
		<div class="clear"></div>
	<?php			
}

/************************************************/
/*					PAGINATION					*/
/************************************************/
// http://design.sparklette.net/teaches/how-to-add-wordpress-pagination-without-a-plugin/
// http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"navigation\">";//<span id=\"pagecount\">Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged - 1)."\">&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

/************************************************/
/*					COMMENTS					*/
/************************************************/

//Remove HTML in comments(http://www.wprecipes.com/wordpress-hack-get-rid-of-html-in-comments)
// This will occur when the comment is posted
function plc_comment_post( $incoming_comment ) {

	// convert everything in a comment to display literally
	$incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']);

	// the one exception is single quotes, which cannot be #039; because WordPress marks it as spam
	$incoming_comment['comment_content'] = str_replace( "'", '&apos;', $incoming_comment['comment_content'] );

	return( $incoming_comment );
}

// This will occur before a comment is displayed
function plc_comment_display( $comment_to_display ) {

	// Put the single quotes back in
	$comment_to_display = str_replace( '&apos;', "'", $comment_to_display );

	return $comment_to_display;
}

add_filter( 'preprocess_comment', 'plc_comment_post', '', 1);
add_filter( 'comment_text', 'plc_comment_display', '', 1);
add_filter( 'comment_text_rss', 'plc_comment_display', '', 1);
add_filter( 'comment_excerpt', 'plc_comment_display', '', 1);
	
function advanced_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-avatar">
			<?php echo get_avatar($comment,$size='70',$default=''.get_bloginfo('template_url').'/img/avatar.png' ); ?>
		</div>
		<cite>
			<a href="<?php the_author_meta( 'user_url'); ?>"><?php printf(__('%s'), get_comment_author_link()) ?></a>
		</cite>
		<?php if ($comment->comment_approved == '0') : ?>
		<p><em><?php _e('Your comment is awaiting moderation.') ?></em></p>
		<br />
		<?php endif; ?>
		<?php comment_text() ?>	
		<p class="comment-date">
			<?php printf(__('%1$s'), get_comment_date()) ?> &#8211;
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</p>
	</li>

<?php }

/************************************************/
/*					RELATED POSTS				*/
/************************************************/
function related_posts($post) {
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'showposts'=>5, // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1,
			'post__not_in' => array($post->ID)
		);
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) {
			echo '<ul>';
			while ($my_query->have_posts()) {
				$my_query->the_post();
			?>
				<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php
			}
			echo '</ul>';
		} else {
			echo '<p id="no-posts-found">No related Posts found :-(</p>';
		}
		wp_reset_query();
	} else {
			echo '<p id="no-posts-found">No related Posts found :-(</p>';
	}
}

/************************************************/
/*						WORK					*/
/************************************************/

add_action('init', 'work_init'); 

function work_init() {
  $labels = array(
    'name' => _x('Work', 'post type general name'),
    'singular_name' => _x('Work', 'post type singular name'),
    'add_new' => _x('Add New', 'Work'),
    'add_new_item' => __('Add New Work'),
    'edit_item' => __('Edit Work'),
    'new_item' => __('New Work'),
    'view_item' => __('View Work'),
    'search_items' => __('Search Works'),
    'not_found' =>  __('No Works found'),
    'not_found_in_trash' => __('No Works found in Trash'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
	'exclude_from_search' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail','custom-fields'),
	'taxonomies' => array('category')
  );
  register_post_type('work',$args);
}

function the_work_content() {
	// get_work_thumb(get_the_ID());
	?>
	<div>
		<h2><?php the_title(); ?></h2>
		<?php //get_work_date(); ?>
		<?php the_content(); ?>
		<?php get_work_buttons(); ?>
	</div>
	<div class="clear"></div>
	<?php
	
}

//get thumbnail
function get_work_thumb($id){
	$img = get_post_meta($id, 'thumb', true);
	$thumb = '<div class="grid_3 alpha"><img class="workthumb" src="http://www.distractedbysquirrels.com/wp-content/uploads/work/'.$img.'" /></div>';
	echo $thumb;
}

function get_work_date() {
	global $post;
	$date = get_post_meta($post->ID, 'date', true);
	if ( $date ) {
		echo '<p class="workdate"><strong>Date:</strong> '.$date.'</p>';
	}
}

add_shortcode( 'wgallery', 'wgallery_handler' );
function wgallery_handler ($atts, $content = null){
	global $post;
	$cols = 3;
	$items = explode(';', $content);
	$count = count($items);
	$gallery = '<div class="wgallery">';
	for ($i=0; $i < $count; $i++){
		$item = explode(',', $items[$i], 2);
		$gallery .= '<div class="galleryimg';
		//add alpha to first item
		if ( $i == 0 || ($i+1)%$cols == 1)
			$gallery .= ' first';
		//add omega to first item
		if ( $i == ($count-1) || ($i+1)%$cols == 0  )
			$gallery .= ' last';
		$gallery .= '"><a class="group" href="'.$item[0].'" title="'.$item[1].'" rel="wgallery'.$post->ID.'"><img src="'.$item[0].'" alt="'.$item[0].'"></a></div>';
		//new line of images
		if ( ($i+1)%$cols == 0 )
			$gallery .= '<div class="clear"></div>';
	}
	$gallery .= '</div><div class="clear"></div>';
	return $gallery;
}

function get_work_buttons() {
	global $post;
	$download = get_post_meta($post->ID, 'download', true);
	$added = false;
	if ( $download ) {
		echo '<a class="workbutton downloadbutton" href="http://www.distractedbysquirrels.com/wp-content/uploads/work/'.$download.'" >Download</a>';
		$added = true;
	}
	$doc = get_post_meta($post->ID, 'pdf', true);
	if ( $doc ) {
		echo '<a class="workbutton docbutton" href="http://www.distractedbysquirrels.com/wp-content/uploads/work/'.$doc.'" target="_blank" >Read it</a>';
		$added = true;
	}
	$slides = get_post_meta($post->ID, 'slides', true);
	if ( $slides ) {
		echo '<a class="workbutton slidesbutton" href="http://www.distractedbysquirrels.com/wp-content/uploads/work/'.$slides.'" target="_blank" >Slides</a>';
		$added = true;
	}
	$goto = get_post_meta($post->ID, 'goto', true);
	if ( $goto ) {
		echo '<a class="workbutton gotobutton" href="'.$goto.'" target="_blank" >Go to</a>';
		$added = true;
	}
	$demo = get_post_meta($post->ID, 'demo', true);
	if ( $demo ) {
		echo '<a class="workbutton demobutton" href="'.$demo.'" >Demo</a>';
		$added = true;
	}	
	if ( $added ) 
		echo '<div class="clear"></div>';
}

/************************************************/
/*					CONTACT FORM				*/
/************************************************/

function print_contact_form() {
	?>
	<div id="contact">
		<form name="contact" method="post" action="">
		<fieldset>
			<p>
				<label for="name" id="cnameLabel">Your Name:</label>
				<input type="text" name="name" id="cname" size="30" value="" class="text-input" />
				<span class="error" for="name" id="cnameError">This field is required.</span>
			</p>	
			<p>
				<label for="email" id="cemailLabel">Your Email:</label>
				<input type="text" name="email" id="cemail" size="30" value="" class="text-input" />
				<span class="error" for="email" id="cemailError">This field is required.</span>
			</p>
			<p>
				<label for="subject" id="csubjectLabel">Subject:</label>
				<input type="text" name="subject" id="csubject" size="30" value="" class="text-input" />
				<span class="error" for="subject" id="csubjectError">This field is required.</span>
			</p>
			<p>
				<label for="name" id="cmessageLabel">Message:</label>
				<textarea rows="10" cols="100%" id="cmessage" name="comment"></textarea>
			</p>
			<p id="captchaimg">
				<img src="<?php bloginfo('template_url'); ?>/js/contactform/captcha.php" />
				<span><strong>Please note:</strong> Don't type in the shown captcha! Instead type in the animal, which appears in this site's name (lowercase).</span>
			</p>
			<p>
				<label for="captcha" id="csubjectLabel">Captcha:</label>
				<input type="text" name="captcha" id="captcha" value="" />
				<span class="error" for="email" id="captchaError">Wrong captcha. <strong>(Read the note!)</strong>.</span>
			</p>
			<p>
				
				<div id="contacterror">Messages could not be sent!</div>
				<div id="contactsuccess">Messages has been sent!</div>
				<input type="submit" name="submit" class="button" id="csubmit" value="Send" />
			</p>
		</fieldset>
		</form>
	</div>
	<?php 
}

?>