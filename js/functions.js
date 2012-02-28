$(document).ready(function() {
	/* Using custom settings */
	$("a.zoomimg").fancybox({
		'showCloseButton'	: 	true,
		'hideOnContentClick': 	true,
		'transitionIn'		:	'fade',
		'transitionOut'		:	'fade',
		'speedIn'			:	600, 
		'speedOut'			:	200, 
		'overlayShow'		:	true,
		'overlayColor'		:	'#333',
		'titlePosition'		:	'inside',
		'titleFormat'		: 	formatSingleTitle
	});
	/* Apply fancybox to multiple items */
	$("a.group").fancybox({
		'transitionIn'	:	'fade',
		'transitionOut'	:	'fade',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	true,
		'overlayColor'	:	'#333',
		'titlePosition'	:	'inside',
		'titleFormat'	: 	formatTitle
	});
	
	//contact form
	$('.error').hide();
	$('#csubmit').click(function() {
		$('.error').hide();
		var error = false;
		
		if ($('input#cname').val() == '') {
			$('span#cnameError').show();
			$('input#cname').css('border-color','#CC0000').css('background-color','#FFCCCC');
			error = true;
		} else {
			$('input#cname').css('border-color','#CCCCCC').css('background-color','#F2F2F2');
		}
		if ($('input#cemail').val() == '') {
			$('span#cemailError').show();
			$('input#cemail').css('border-color','#CC0000').css('background-color','#FFCCCC');
			error = true;
		} else {
			$('input#cemail').css('border-color','#CCCCCC').css('background-color','#F2F2F2');
		}
		if ($('input#csubject').val() == '') {
			$('span#csubjectError').show();
			$('input#csubject').css('border-color','#CC0000').css('background-color','#FFCCCC');
			error = true;
		} else {
			$('input#csubject').css('border-color','#CCCCCC').css('background-color','#F2F2F2');
		}
		if ($('input#captcha').val() == '') {
			$('span#captchaError').show();
			$('input#captcha').css('border-color','#CC0000').css('background-color','#FFCCCC');
			error = true;
		} else {
			$('input#captcha').css('border-color','#CCCCCC').css('background-color','#F2F2F2');
		}		
		if ( !error ){
			$.ajax({
				type: 'POST',
				url: 'http://www.distractedbysquirrels.com/wp-content/themes/DistractedBySquirrels/js/contactform/send.php',
				data: {
					name 	: $('input#cname').val(),
					email 	: $('input#cemail').val(),
					captcha	: $('input#captcha').val(),
					subject	: $('input#csubject').val(),
					message	: $('textarea#cmessage').val()
				},
				success : function(data){
					if( data == '418' ) {
						$('span#captchaError').show();
						$('input#captcha').css('border-color','#CC0000').css('background-color','#FFCCCC');
						$('#contacterror').fadeIn('slow');
					}
					if( data == '200' ) {
						$('#csubmit').fadeOut('slow', function() {
							// Animation complete.
							$('#contacterror').fadeOut('slow');
							$('#contactsuccess').fadeIn('slow');
						});	
					} else {
						$('#contacterror').fadeIn('slow');					
					}
				},
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					$('#contacterror').fadeIn('slow');
				}
			});
		}
		return false;		
	});	

	//scroll top
	$('#backtop').click(function(event) {
		event.preventDefault();
		$('html, body').animate({scrollTop:0}, 'slow'); 
	});
	
});

//fancy box custom title
function formatTitle(title, currentArray, currentIndex, currentOpts) {
    return '<div id="group-title">' + (title && title.length ? '<b>' + title + '</b>' : '' ) + 'Image ' + (currentIndex + 1) + ' of ' + currentArray.length + '</div>';
}

function formatSingleTitle(title, currentArray, currentIndex, currentOpts) {
    return '<div id="group-title">' + (title && title.length ? '<b>' + title + '</b>' : '' ) + '</div>';
}

function scrollToID(id, speed){
	var offSet = 15;
	var targetOffset = $(id).offset().top-offSet;
	$('html,body').animate({scrollTop:targetOffset}, speed);
}

/*
* hoverFlow - A Solution to Animation Queue Buildup in jQuery
* Version 1.00
*
* Copyright (c) 2009 Ralf Stoltze, http://www.2meter3.de/code/hoverFlow/
* Dual-licensed under the MIT and GPL licenses.
* http://www.opensource.org/licenses/mit-license.php
* http://www.gnu.org/licenses/gpl.html
*/
(function($){$.fn.hoverFlow=function(c,d,e,f,g){if($.inArray(c,['mouseover','mouseenter','mouseout','mouseleave'])==-1){return this}var h=typeof e==='object'?e:{complete:g||!g&&f||$.isFunction(e)&&e,duration:e,easing:g&&f||f&&!$.isFunction(f)&&f};h.queue=false;var i=h.complete;h.complete=function(){$(this).dequeue();if($.isFunction(i)){i.call(this)}};return this.each(function(){var b=$(this);if(c=='mouseover'||c=='mouseenter'){b.data('jQuery.hoverFlow',true)}else{b.removeData('jQuery.hoverFlow')}b.queue(function(){var a=(c=='mouseover'||c=='mouseenter')?b.data('jQuery.hoverFlow')!==undefined:b.data('jQuery.hoverFlow')===undefined;if(a){b.animate(d,h)}else{b.queue([])}})})}})(jQuery);