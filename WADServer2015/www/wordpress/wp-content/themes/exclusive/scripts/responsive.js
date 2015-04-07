var window_cur_size = 'screen';

jQuery('document').ready(function(){

	screenSize=jQuery(".container").width();
	
	if(screenSize==null || !screenSize || screenSize<100){screenSize=1024;}
	
	sliderHeight=parseInt(jQuery("#slider-wrapper").height());
	sliderWidth=parseInt(jQuery("#slider-wrapper").width());
	sliderIndex=sliderHeight/sliderWidth;
	
	
	
	
	if($(".container").hasClass("phone")){
		phone();		
	}
	else if($(".container").hasClass("tablet")){
		tablet();
	}
	else{checkMedia();}
	
	jQuery(window).resize(function(){checkMedia();});

	function checkMedia(){
		//###############################SCREEN
		if(jQuery('body').width()>=1024){screen();}
		//###############################TABLET
		if(jQuery('body').width()<1024 && jQuery('body').width()>=768){tablet();}
		//################################PHONE
		if(jQuery('body').width()<768){phone(false);}
	}
	
	

	
	function screen(){
		if($(".container").hasClass("phone") || $(".container").hasClass("tablet"))
			jQuery('#sidebar1').after(jQuery('#blog'))
			
		jQuery(".container").width(screenSize);
		jQuery(".container").removeClass("tablet");
		jQuery(".container").removeClass("phone");
		jQuery(".top-nav-list").removeClass("phone");
		jQuery('.container').removeClass('small_shrifts');
	
		jQuery(".site-title-a").removeClass("phone");
		jQuery('.staff-list-block ').width('100%');
		jQuery("body > div, body header, body footer,  body nav").width("100%");
		jQuery("#top-nav").width("500%");
		sHeight=sliderIndex*parseInt(jQuery("#slider-wrapper").width());
		sliderSize(sHeight);	
		if(window_cur_size == 'phone'){
			jQuery("#header").find("#menu-button-block").remove();
			jQuery("#top-nav").css({"display":"block"});
		}
		jQuery(".top-nav-list  > li  a").css("height", "");
		jQuery(".container > #blog,.container > #sidebar2,.container > #sidebar1, .container> .page-navigation, #top-posts-list li a span").removeAttr("style");
		
		
	//SCREEN UNIQE STYLES BY OUR DESIGNER	

		var top_post_img=jQuery("#top-posts-list img").width()+15;
		var top_post_li=jQuery("#top-posts-list li").width()-top_post_img;
		
		for(var i=0;i<3;i++){
		jQuery("#top-posts-list li .top-posts-texts").eq(i).css('max-width',top_post_li);
		}
		var contwidth=jQuery("header .container").width();
		
		if(contwidth==null || !contwidth || contwidth<5){contwidth=1024;}
		
		
		describtionwidth=parseInt(contwidth-597);
		$("#site-description p").width(describtionwidth);
		
		var cont_width_for_menu=jQuery(".container").width()
		if(cont_width_for_menu==null || !cont_width_for_menu || cont_width_for_menu<5){cont_width_for_menu=1024;}
		
		menumaxwidth=parseInt(cont_width_for_menu-240);
		
		if($(".top-nav-list").length>0){
			if($(".top-nav-list").width()>menumaxwidth){
				$(".top-nav-list").width(menumaxwidth);
	
			
				if($(".top-nav-list").height())
					lisize=$(".top-nav-list").height();
				else
					lisize=66;
				
				
				
				$("#top-nav").css({"display":"block"});
				$("#header .container").not(".phone").css({"min-height":(lisize+57)+"px","height":"auto"});
				$("#logo-block").css({"min-height":(lisize+57)+"px","height":"auto"});
				$("#logo-block a div").css({"height":(lisize+57)+"px"});
			}else{
				$(".top-nav-list").width("100%");
				if($(".top-nav-list").height())
					lisize=$(".top-nav-list").height();
				else
					lisize=66;
								
				$("#top-nav").css({"display":"block"});
				$("#header .container").not(".phone").css({"min-height":(lisize+57)+"px","height":"auto"});
				$("#logo-block").css({"min-height":(lisize+57)+"px","height":"auto"});
				$("#logo-block a div").css({"height":(lisize+57)+"px"});
			}
		}
		else
		{
			
			if($("#top-nav .top-nav-list").width()>menumaxwidth){
				$("#top-nav .top-nav-list").width(menumaxwidth);
		
				if($(".top-nav-list").height())
					lisize=$(".top-nav-list").height();
				else
					lisize=66;	
												
				$("#top-nav").css({"display":"block"});
				$("#header .container").not(".phone").css({"min-height":(lisize+57)+"px","height":"auto"});
				$("#logo-block").css({"min-height":(lisize+57)+"px","height":"auto"});
				$("#logo-block a div").css({"height":(lisize+57)+"px"});
			}else{
				
				$("#top-nav .top-nav-list").width("100%");

				if($(".top-nav-list").height())
					lisize=$(".top-nav-list").height();
				else
					lisize=66;
				$("#top-nav").width("500%");			
				$("#top-nav").css({"display":"block"});
				$("#header .container").not(".phone").css({"min-height":(lisize+57)+"px","height":"auto"});
				$("#logo-block").css({"min-height":(lisize+57)+"px","height":"auto"});
				$("#logo-block a div").css({"height":(lisize+57)+"px"});
			}
			
			
		}
		
		$(".header-phone-block").css({'margin-top':"0px"});
		
		$("#top-posts-list li,#top-posts-list li a").css({"height":'110px'});
		$("#top-posts-list li a img").css({"height":'92px'});
		

		
		
		$(".container").not(".phone").not(".tablet").find("#sidebar1 .sidebar-container,#sidebar2 .sidebar-container").css({"min-height":($("#content").height()+10)+"px"});
		$("#header-wrapper").css({"padding-bottom":$("#content").height()+"px","margin-bottom":-$("#content").height()+"px"});

	//END OF DESINER'S FUTURISTYC STYLE :D	
	
		window_cur_size	= 'screen';
	}
	
	function tablet(){	
		if(!($(".container").hasClass("phone") || $(".container").hasClass("tablet")))
			jQuery('#blog').after(jQuery('#sidebar1'));
		
		jQuery(".container").removeClass("phone");
		jQuery(".top-nav-list").removeClass("phone");
		jQuery(".site-title-a").removeClass("phone");
		jQuery(".container").addClass("tablet");
		jQuery(".container").width(728);
		jQuery('.container').removeClass('small_shrifts')
		$(" body nav, .container").width(728);
		$('.staff-list-block ').width('100%');
		jQuery("#top-posts-list li a span").removeAttr("style");
		if(window_cur_size == 'phone'){$("#header").find("#menu-button-block").remove();$("#top-nav").css({"display":"block"});}
		
		sHeight=sliderIndex*parseInt(jQuery("#slider-wrapper").width());
		sliderSize(sHeight);	
		jQuery(".tablet .top-nav-list  > li  a").css("height", "");
	//SCREEN UNIQE STYLES BY OUR DESIGNER	
	    var top_post_img=jQuery("#top-posts-list img").width()+15;
		var top_post_li=jQuery("#top-posts-list li").width()-top_post_img;
		for(var i=0;i<3;i++){
		jQuery("#top-posts-list li .top-posts-texts").eq(i).css('max-width',top_post_li);
		}
		var contwidth=$("header .container.tablet").width();
		describtionwidth=parseInt(contwidth-470);
		$("#site-description p").width(describtionwidth);
		
		$("#top-nav").css({"display":"block"});
		tabletmenumaxwidth=parseInt($(".container.tablet").width()-230);
		if($(".tablet .top-nav-list").width()>tabletmenumaxwidth){
			$(".tablet .top-nav-list").width(tabletmenumaxwidth);

			if($(".top-nav-list").height())
				tablet_lisize=$(".top-nav-list").height();
			else
				tablet_lisize=66;		
			
			$("#header .container.tablet").not(".phone").css({"min-height":(tablet_lisize+57)+"px","height":"auto"});
			$("#logo-block").css({"min-height":(tablet_lisize+57)+"px","height":"auto"});
			$("#logo-block a div").css({"height":(tablet_lisize+57)+"px"});

		}else{
			if($(".top-nav-list").height())
				tablet_lisize=$(".top-nav-list").height();
			else
				tablet_lisize=66;		
			
			$("#header .container.tablet").not(".phone").css({"min-height":(tablet_lisize+57)+"px","height":"auto"});
			$("#logo-block").css({"min-height":(tablet_lisize+57)+"px","height":"auto"});
			$("#logo-block a div").css({"height":(tablet_lisize+57)+"px"});
		}
		
		$(".header-phone-block").css({'margin-top':"0px","height":"100px"});
		
		$("#top-posts-list li,#top-posts-list li a").css({"height":'110px'});
        $("#top-posts-list li a img").css({"height":'92px'});

		
		$(".container").find("#sidebar1 .sidebar-container,#sidebar2 .sidebar-container").css({"height":"auto","min-height":"0px"});
		$("#header-wrapper").css({"padding-bottom":$("#content").height()+"px","margin-bottom":-$("#content").height()+"px"});
	//END OF DESINER'S FUTURISTYC STYLE :D	

		
		window_cur_size	= 'tablet';
	}
	
	function phone(full){
		if(!(jQuery(".container").hasClass("phone") || jQuery(".container").hasClass("tablet"))){
			jQuery('#blog').after(jQuery('#sidebar1'));
		}
		for(var i=0;i<3;i++){
		jQuery("#top-posts-list li .top-posts-texts").eq(i).removeAttr('style');
		}
		jQuery("#logo-block").removeAttr('style');
		jQuery('#blog').after(jQuery('#sidebar1'));
		jQuery(".container").removeClass("tablet");
		jQuery(".top-nav-list").addClass("phone");
		jQuery(".container").addClass("phone");
		jQuery(".site-title-a").addClass("phone");
		jQuery('.phone .top-nav-list li:has(ul)').addClass("has-sub");
		count_width_of_list=$('.phone #our-staff li').length;
		count_width_of_list=count_width_of_list*130+50;

		$('.phone .staff-list-block ').width(count_width_of_list);
		
		if(jQuery('body').width()>320 && jQuery('body').width()<640){width="100%";}else if(jQuery('body').width()<=320){width=jQuery('body').width(); }else{width="640px";}
		
		if(jQuery('body').width()>420){ 
			jQuery('.container').removeClass('small_shrifts');
		}
		else
		{
			jQuery('.container').addClass('small_shrifts');
		}
		jQuery(".container").width(width);
		jQuery(" body nav, .top-nav-list,.container").width(width);
		jQuery(".container").width("100%");
		sHeight=sliderIndex*parseInt(jQuery("#slider-wrapper").width());
		sliderSize(sHeight);
		
		
		if(!$("#top-nav").hasClass("open")){$("#top-nav").css({"display":"none"})};
		$(".phone #site-description p").css({"width":($(".container").width()-120)+"px"});
	
		

		
		$("#header").find("#menu-button-block").remove();
		
		$("#header>.container.phone").prepend('<div id="menu-button-block" style="height:'+(jQuery('.container').width()*18.75/100)+'px;"><a href="#">'+(jQuery('body').width()*18.75/100)+'</a></div>');
		jQuery(".container.phone > #blog,.container.phone > #sidebar2,.container.phone > #sidebar1, .container.phone .page-navigation").width(jQuery('body').width()-14);
		jQuery(" #top-page .container.phone").width(jQuery('body').width()-10);
		setTimeout(function(){
			for(var i=1; i<=3; i++){
				if(jQuery(".phone #top-posts-list li").eq(i).find("img").length)
					jQuery(".phone #top-posts-list li a span").eq(i).css("display", "none");
			}
		},1000);		
		
		
	
		

		$("#header .container.phone").css({"min-height":(jQuery('.container').width()*18.75/100)+20+"px"});
		
		
		
		
		$(".phone.top-nav-list > ul > li  a").css({
			"height":(jQuery('.container').width()*(15.62/100)+10)+"px"
		});
		
		
		$(".phone #top-posts-list li").css({
			"height":(jQuery('.container').width()*(15.62/100)+20)+"px"
		});
	
		
		$(".phone #top-posts-list li a").css({
			"height":(jQuery('.container').width()*(15.62/100)+20)+"px"
		});
		
		
		$(".phone #top-posts-list li a img").css({
			"height":(jQuery('.container').width()*15.62/100)+"px"
		});

		$(".phone .header-phone-block").css({
			"height":(jQuery('.container').width()*18.75/100)+"px",
			'margin-top':-(jQuery('.container').width()*18.75/100)+"px"
		});
		$(".container").find("#sidebar1 .sidebar-container,#sidebar2 .sidebar-container").css({"height":"auto","min-height":"0px"});
		

		window_cur_size	= 'phone';
	}
	
	
	function sliderSize(sHeight) {
		jQuery("#slider-wrapper").css('height',sHeight);
	}		
}); 

