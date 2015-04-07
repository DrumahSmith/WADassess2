jQuery("document").ready(function(){
	jQuery('embed,object,iframe').wrap("<div class='video-container'></div>")
		jQuery(".top-nav-list li").hover(function(){
			//if(jQuery(this).parents(".container").hasClass("phone") ){return false;}
			jQuery(this).parent("ul").find("ul").slideUp(50);
			jQuery(this).parent("ul").children().removeClass("active");
			jQuery(this).addClass("active");
			if(jQuery(this).find("ul").length){jQuery(this).children("ul").slideDown("slow").addClass("opensub");}
		},function(){
			//if(jQuery(this).find(".container").hasClass("phone")){return false;}
			jQuery(this).parent("ul").children().removeClass("active");
			jQuery(this).parent("ul").children().children("ul").css('display','none');
			jQuery(this).parent("ul").find("ul").slideUp(50).stop();
			jQuery(".opensub").removeClass("opensub");
		});
		
		
		jQuery("header").on("click","#menu-button-block", function(){
			if(jQuery("#top-nav").hasClass("open")){
				jQuery("header .container.phone #top-nav").slideUp("fast");
				jQuery("#top-nav").removeClass("open");
			}
			else{
				jQuery("header .container.phone #top-nav").slideDown("slow");
				jQuery("#top-nav").addClass("open");
			}
		});
		
		//in responsive js added size of staff-list-block
		function leftMove(){
			
			leftsize=jQuery('.staff-list-block').offset().left;
			if((jQuery('.staff-list').offset().left-jQuery('.staff-list-block').width()+jQuery('.staff-list').outerWidth())>=leftsize){
				clearInterval(goleft);
				return false;
			}
			jQuery('.staff-list-block').css({"left": "-=1px"});
			leftsize-=1;
		}
		
		
		function rightMove(){
			
			if(jQuery('.staff-list-block').offset().left>=jQuery('.staff-list').offset().left){
				clearInterval(goleft);
				return false;
			}
			jQuery('.staff-list-block').css({"left": "+=1px"});
			leftsize-=1;
		}
		
		var mobile   = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent); 
		windowsPhone = /windows phone/i.test(navigator.userAgent); 
		var clickstart = mobile ? "touchstart" : "mousedown";
		var clickend = mobile ? "touchend" : "mouseup";

		
		if(windowsPhone){
			jQuery(".staff-button-right").click(function(event){
				leftsize=jQuery('.staff-list-block').offset().left;
				if((jQuery('.staff-list').offset().left-jQuery('.staff-list-block').width()+jQuery('.staff-list').outerWidth())>=leftsize){
					clearInterval(goleft);
					return false;
				}
				jQuery('.staff-list-block').animate({"left": "-=50px"},500);
				leftsize-=100;
			});
				
			jQuery(".staff-button-left").click(function(event){
				if(jQuery('.staff-list-block').offset().left>=jQuery('.staff-list').offset().left){
				clearInterval(goleft);
				return false;
				}
				jQuery('.staff-list-block').animate({"left": "+=100px"},500);
				leftsize-=100;
			});
			
		}else{
			jQuery(".staff-button-right").bind(clickstart,function(event){
				goleft=setInterval(leftMove,5);
			}).bind(clickend,function(event) {
				clearInterval(goleft);
				return false;
			});
			
				
			jQuery(".staff-button-left").bind(clickstart,function(event){
				goright=setInterval(rightMove,5);
			}).bind(clickend,function(event) {
				clearInterval(goright);
				return false;
			});
		}
	
});