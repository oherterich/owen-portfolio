	jQuery(document).ready(function() {
		jQuery(".fancybox")
		.attr('rel', 'gallery')
		.fancybox({
        	padding: 0,
        	helpers: {
        		title: {
        			type: 'outside'
        		},
        		overlay: {
            		opacity: 0.8,
            		css : {
                	'background-color' : '#222'
            		}
        		}
        	}

		});
		
		jQuery('.vimeo')
		.attr('rel', 'gallery')
		.fancybox({
			width: 960,
			height: 540,
			type: 'iframe',
			fitToView: false,
			padding: 0,
        	helpers: {
        		title: {
        			type: 'outside'
        		},
        		overlay: {
            		opacity: 0.8,
            		css : {
                	'background-color' : '#222'
            		}
        		}
        	}
		});
			
		// this is filtering your posts
		var all = false;
		var design = false;
		var motion = false;
		var other = false;
		var info = false;
		
		jQuery('li#all').click(function(){
			jQuery('section#infoContent').fadeOut(300);
			jQuery('div.design, div.motion, div.other').fadeIn(300)
			design = true;
			motion = true;
			other = true;
			info = false;
		});
		
		jQuery('li#design').click(function(){
			jQuery('section#infoContent').fadeOut(300);
			if(motion == true || other == true || info == true){
				jQuery('div.design').fadeIn(300);
				jQuery('div.other, div.motion').fadeOut(300);
				design = true;
			} else {
				jQuery('div.other, div.motion').fadeOut(300);
				design = true;
			}
		});
		jQuery('li#motion').click(function(){
			jQuery('section#infoContent').fadeOut(300);
			if(design == true || other == true || info == true){
				jQuery('div.motion').fadeIn(300);
				jQuery('div.design, div.other').fadeOut(300);
				motion = true;
			} else {
				jQuery('div.design, div.other').fadeOut(300);
				motion = true;
			}
		});
		
		jQuery('li#other').click(function(){
			jQuery('section#infoContent').fadeOut(300);
			if(design == true || motion == true || info == true){
				jQuery('div.other').fadeIn(300);
				jQuery('div.design, div.motion').fadeOut(300);
				other = true;
			} else {
				jQuery('div.design, div.motion').fadeOut(300);
				other = true;
			}
		});
		
		//this hides/shows the info
		jQuery('section#infoContent').hide();
		
		jQuery('li#info').click(function(){
			if(design == true || motion == true || other == true){
			jQuery('section#infoContent').fadeIn(300);
			jQuery('div.design, div.motion, div.other').fadeOut(300);
			}
			else {
				$('section#infoContent').fadeIn(300);
				$('div.design, div.motion, div.other').fadeOut(300);
				info = true;
			}
		});
		
		//Smooth Scrolling
		
		$("#fixed-bar")
			.css({position:'fixed',bottom:'0px'})
			.hide();
		$(window).scroll(function(){
			if ($(this).scrollTop() > 350) {
				$('#fixed-bar').fadeIn(300);
				} else {
				$('#fixed-bar').fadeOut(300);
				}
			});
			
		$('.go-top').click(function(){
			$('html,body').animate({
				scrollTop: 0
				}, 700);
			return false;
		});
		
		//Full Caption Sliding (Hidden to Visible)  
		$('.boxgrid.captionfull').hover(function(){  
			$(".cover", this).stop().animate({top:'145px'},{queue:false,duration:200});  
		}, function() {  
			$(".cover", this).stop().animate({top:'220px'},{queue:false,duration:200});  
		});  
	});