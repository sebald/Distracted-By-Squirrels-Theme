<?php
/*
	Template Name: About
	Autor: Sebastian Sebald
*/
?>
<?php get_header(); ?>
<div id="about" class="grid_12">
	<img id="aboutpic" alt="Photo of me" src="<?php bloginfo('url')?>/uploads/about/me.png" />
	<h2 id="aboutheadline" >About me</h2>
	<div id="abouttext" class="grid_8 alpha">
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
			<?php the_content(); ?>
		<?php endwhile; endif; ?>
	</div>
	<div class="clear"></div>
<?php
/************************************************/
/*				STATIC CONTENT					*/
/************************************************/
?>
	<h3 id="contactinfo" class="grid_3 alpha aboutheadline">Contact</h3>
	<ul id="contactlist" class="grid_9 omega aboutlist">
		<li><strong>Name:</strong> Sebald</li>
		<li><strong>Firstname:</strong> Sebastian</li>
		<li id="mail"><strong>E-Mail:</strong> distractedbysquirrels (at) suremail (dot) info</li>
		<li><strong>Location:</strong> Freiburg, Germany</li>
		<li><div id="socialcontact">
			<a title="Me on Facebook." href="http://www.facebook.com/DistractedBySquirrels">
				<img alt="Me on Facebook" src="<?php bloginfo('template_url')?>/img/facebook.png">
			</a>
			<a title="Me on Twitter" href="http://twitter.com/sebastiansebald">
				<img alt="Me on Twitter" src="<?php bloginfo('template_url')?>/img/twitter.png">
			</a>
			<a title="Me on Flickr" href="http://www.flickr.com/photos/29887965@N06/sets/">
				<img alt="Me on Flickr" src="<?php bloginfo('template_url')?>/img/flickr.png">
			</a>			
			<a title="Me on Delicious" href="http://www.delicious.com/backseatsurfer">
				<img alt="Me on Delicious" src="<?php bloginfo('template_url')?>/img/delicious.png">
			</a>
		</div></li>
	</ul>
	<div class="clear"></div>
	<h3 id="education" class="grid_3 alpha aboutheadline">Education</h3>	
	<ul id="educationlist" class="grid_9 omega aboutlist">
		<li><strong>Master of Science in Computer Science</strong> <span>(since SS 2010)</span>
			<ul class="sublist">
				<li>Albert-Ludwigs-Universit&auml;t Freiburg<li/>
				<li>Minor Subject: Psychology</li>
			</ul>			
		</li>	
		<li><strong>Bachelor of Science in Computer Science</strong> <span>(February, 2010)</span>
			<ul class="sublist last">
				<li>Albert-Ludwigs-Universit&auml;t Freiburg<li/>
				<li>Minor Subject: Psychology</li>
			</ul>			
		</li>
	</ul>

	<div class="clear"></div>
	<h3 id="employment" class="grid_3 alpha aboutheadline">Employment</h3>		
	<ul id="employmentlist" class="grid_9 omega aboutlist">
		<li><strong>IT Support</strong> <span>(since October 2009)</span>
			<ul class="sublist">
				<li>Prof. Dr. J&uuml;rgen R&uuml;he <li/>
				<li>Department of Microsystems Engineering, Laboratory for Chemistry and Physics of Interfaces, University of Freiburg</li>
			</ul>
		</li>
		<li><strong>Student Assistant</strong> <span>(since March 2009)</span>
			<ul class="sublist">
				<li>Prof. Dr. G&uuml;nter M&uuml;ller<li/>
				<li>Institute for Computer Science and Social Studies, Department of Telematics,<br/>University of Freiburg</li>
			</ul>
		</li>
		<li><strong>Tutor: Theoretical Computer Science</strong> <span>(WS 08/09)</span>
			<ul class="sublist">
				<li>Prof. Dr. Susanne Albers<li/>
				<li>Algorithms and Complexity, University of Freiburg</li>
			</ul>
		</li>
		<li><strong>Tutor: Theoretical Computer Science</strong> <span>(WS 07/08)</span>
			<ul class="sublist last">
				<li>Prof. Dr. rer. nat. Christian Schindelhauer<li/>
				<li>Networks and Telematics, University of Freiburg</li>
			</ul>		
		</li>
	</ul>
	<div class="clear"></div>	
	<h3 id="skills" class="grid_3 alpha aboutheadline">I speak</h3>		
	<ul id="skillslist" class="grid_9 omega aboutlist">
		<li>Java, PHP, Javascript, CSS, MySQL, Wordpress, SOAP</li>
	</ul>	
	
	<div class="clear"></div>
	<h3 class="grid_3 alpha aboutheadline">Contact me</h3>
	<div class="grid_9 omega aboutlist">
		<div id="contactform"><?php print_contact_form(); ?></div>
	</div>		
	
</div><!-- #main -->
<div class="clear"></div>
<?php get_footer(); ?>