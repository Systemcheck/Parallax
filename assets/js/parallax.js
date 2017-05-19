/*! Customized Jquery from Pushpendu Paul. thementicteam@gmail.com  : www.thementic.com
Authors & copyright (c) 2016: Thementic Web Service. */
// Template Start
/**
* 2007-2017 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2017 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registred Trademark & Property of PrestaShop SA
*/
!function(t){var o={init:function(o){var e={offset:!0,bgfixed:!0,invert:!0};return this.each(function(){function n(){p=s.data("source-url"),g=parseFloat(s.data("source-width")),h=parseFloat(s.data("source-height")),s.css({"background-image":"url("+p+")"}),r()}function r(){u.on("scroll",function(){e.offset&&i()}).trigger("scroll"),u.on("resize",function(){s.css({}),e.offset&&l()}).trigger("resize")}function i(){c()}function l(){c()}function c(){var t,o,n,r;f=s.outerHeight(),windowHeight=u.height(),a=s.offset().top,t=d.scrollTop(),o=t+windowHeight,n=t-f,o>a&&a>n&&(r=o-n,pixelScrolled=t-(a-windowHeight),percentScrolled=pixelScrolled/r,e.invert?(deltaTopScrollVal=100*percentScrolled,s.css({"background-position":"50% "+deltaTopScrollVal+"%"})):(deltaTopScrollVal=100*(1-percentScrolled),s.css({"background-position":"50% "+deltaTopScrollVal+"%"})))}o&&t.extend(e,o);{var a,s=t(this),u=t(window),d=t(document),f=0,p="",g="",h="";Boolean(navigator.userAgent.match(/MSIE ([8]+)\./))}n()})},destroy:function(){},reposition:function(){},update:function(){}};t.fn.sitManParallex=function(e){return o[e]?o[e].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof e&&e?void t.error("Method with name "+e+" is not exist for jQuery"):o.init.apply(this,arguments)}}(jQuery);
$(document).ready(function(){
	
	
	
	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
	if(!isMobile) {
		if($(".parallax").length){ $(".parallax").sitManParallex({  invert: false });};
	}else{
		$(".parallax").sitManParallex({  invert: true });
	}

	$('.cart_block .block_content').on('click', function (event) {
		event.stopPropagation();
	});
	
	// ---------------- start more menu setting ----------------------
	 if (jQuery(window).width() >=992){
			
		var max_elem = 4;	
		var items = $('.menu ul#top-menu > li');	
		var surplus = items.slice(max_elem, items.length);
		
		surplus.wrapAll('<li class="category more_menu" id="more_menu"><div id="top_moremenu" class="popover sub-menu js-sub-menu collapse"><ul class="top-menu more_sub_menu">');
	
		$('.menu ul#top-menu .more_menu').prepend('<a href="#" class="dropdown-item" data-depth="0"><span class="pull-xs-right hidden-md-up"><span data-target="#top_moremenu" data-toggle="collapse" class="navbar-toggler collapse-icons"><i class="material-icons add">&#xE313;</i><i class="material-icons remove">&#xE316;</i></span></span></span>More</a>');
	
		$('.menu ul#top-menu .more_menu').mouseover(function(){
			$(this).children('div').css('display', 'block');
		})
		.mouseout(function(){
			$(this).children('div').css('display', 'none');
		});
	
	}
	else if((jQuery(window).width() >= 768) && (jQuery(window).width() < 991)) {
				var max_elem = 3;	
		var items = $('.menu ul#top-menu > li');	
		var surplus = items.slice(max_elem, items.length);
		
		surplus.wrapAll('<li class="category more_menu" id="more_menu"><div id="top_moremenu" class="popover sub-menu js-sub-menu collapse"><ul class="top-menu more_sub_menu">');
	
		$('.menu ul#top-menu .more_menu').prepend('<a href="#" class="dropdown-item" data-depth="0"><span class="pull-xs-right hidden-md-up"><span data-target="#top_moremenu" data-toggle="collapse" class="navbar-toggler collapse-icons"><i class="material-icons add">&#xE313;</i><i class="material-icons remove">&#xE316;</i></span></span></span>More</a>');
	
		$('.menu ul#top-menu .more_menu').mouseover(function(){
			$(this).children('div').css('display', 'block');
		})
		.mouseout(function(){
			$(this).children('div').css('display', 'none');
		});

	}	
	// ---------------- end more menu setting ----------------------

});
	
	$( ".products-section-title" ).wrap( "<div class='title-wrapper'></div>" );
	$( ".all-product-link" ).wrap( "<div class='product-more'></div>" );
	

	$('.search_button').click(function(event){
		$(this).toggleClass('active');
		event.stopPropagation();
		$(".searchtoggle").slideToggle("fast");
		$( ".ui-autocomplete-input" ).focus();
	});
	$(".searchtoggle").on("click", function (event) {
		event.stopPropagation();
	});
	
	$('.header-top .tm_userinfotitle').click(function(event){		
		$(this).toggleClass('active');		
		event.stopPropagation();		
	$(".user-info").slideToggle("fast");	
	});	
	$(".user-info").on("click", function (event) {		
		event.stopPropagation();	
	});	

// Add/Remove acttive class on menu active in responsive  
	$('#menu-icon').on('click', function() {
		$(this).toggleClass('active');
	});

// Loading image before flex slider load
	$(window).load(function() { 
		$(".loadingdiv").removeClass("spinner"); 
	});

// Flex slider load
	$(window).load(function() {
		if($('.flexslider').length > 0){ 
			$('.flexslider').flexslider({		
				slideshowSpeed: $('.flexslider').data('interval'),
				pauseOnHover: $('.flexslider').data('pause'),
				animation: "fade"
			});
		}
	});		

// Scroll page bottom to top
	$(window).scroll(function() {
		if ($(this).scrollTop() > 500) {
			$('.top_button').fadeIn(500);
		} else {
			$('.top_button').fadeOut(500);
		}
	});							
	$('.top_button').click(function(event) {
		event.preventDefault();		
		$('html, body').animate({scrollTop: 0}, 800);
	});


/*======  curosol For Additional ==== */
/*	 var tmadditional = $("#additional-carousel");
      tmadditional.owlCarousel({
     	 items : 4, //10 items above 1000px browser width
     	 itemsDesktop : [1199,3], 
     	 itemsDesktopSmall : [991,2], 
     	 itemsTablet: [480,2], 
     	 itemsMobile : [320,1],
		 pagination:false
      });
      // Custom Navigation Events
      $(".additional_next").click(function(){
        tmadditional.trigger('owl.next');
      })
      $(".additional_prev").click(function(){
        tmadditional.trigger('owl.prev');
      });*/




function display(view)
{
	if (view == 'list')
	{
		$('#products ul.product_list').removeClass('grid').addClass('list row');
		$('#products .product_list > li').removeClass('col-xs-12 col-sm-6 col-md-6 col-lg-4').addClass('col-xs-12');
		
		
		$('#products .product_list > li').each(function(index, element) {
			var html = '';
			html = '<div class="product-miniature js-product-miniature" data-id-product="'+ $(element).find('.product-miniature').data('id-product') +'" data-id-product-attribute="'+ $(element).find('.product-miniature').data('id-product-attribute') +'" itemscope itemtype="http://schema.org/Product"><div class="row">';
				html += '<div class="thumbnail-container col-xs-4 col-xs-5 col-md-4">' + $(element).find('.thumbnail-container').html() + '</div>';
				
				html += '<div class="product-description center-block col-xs-4 col-xs-7 col-md-8">';
					html += '<h3 class="h3 product-title" itemprop="name">'+ $(element).find('h3').html() + '</h3>';
					
					var price = $(element).find('.product-price-and-shipping').html();       // check : catalog mode is enabled
					if (price != null) {
						html += '<div class="product-price-and-shipping">'+ price + '</div>';
					}
					
					html += '<div class="product-detail">'+ $(element).find('.product-detail').html() + '</div>';
					
					var colorList = $(element).find('.highlighted-informations').html();
					if (colorList != null) {
						html += '<div class="highlighted-informations">'+ colorList +'</div>';
					}
					
					
				html += '</div>';
			html += '</div></div>';
		$(element).html(html);
		});
		$('.display').find('li#list').addClass('selected');
		$('.display').find('li#grid').removeAttr('class');
		$.totalStorage('display', 'list');
	}
	else
	{
		$('#products ul.product_list').removeClass('list').addClass('grid row');
		$('#products .product_list > li').removeClass('col-xs-12').addClass('col-xs-12 col-sm-6 col-md-6 col-lg-4');
		$('#products .product_list > li').each(function(index, element) {
		var html = '';
		html += '<div class="product-miniature js-product-miniature" data-id-product="'+ $(element).find('.product-miniature').data('id-product') +'" data-id-product-attribute="'+ $(element).find('.product-miniature').data('id-product-attribute') +'" itemscope itemtype="http://schema.org/Product">';
			html += '<div class="thumbnail-container">' + $(element).find('.thumbnail-container').html() +'</div>';
			
			html += '<div class="product-description">';
				html += '<h3 class="h3 product-title" itemprop="name">'+ $(element).find('h3').html() +'</h3>';
			
				var price = $(element).find('.product-price-and-shipping').html();       // check : catalog mode is enabled
				if (price != null) {
					html += '<div class="product-price-and-shipping">'+ price + '</div>';
				}
				
				html += '<div class="product-detail">'+ $(element).find('.product-detail').html() + '</div>';
				
				
				
				var colorList = $(element).find('.highlighted-informations').html();
				if (colorList != null) {
					html += '<div class="highlighted-informations">'+ colorList +'</div>';
				}
				
			html += '</div>';
		html += '</div>';
		$(element).html(html);
		});
		$('.display').find('li#grid').addClass('selected');
		$('.display').find('li#list').removeAttr('class');
		$.totalStorage('display', 'grid');
	}
}


function responsivecolumn(){
	
	if ($(document).width() <= 767){
				
		// ---------------- Fixed header responsive ----------------------
		$(window).bind('scroll', function () {
			if ($(window).scrollTop() > 0) {
				$('.header-nav').addClass('fixed');
			} else {
				$('.header-nav').removeClass('fixed');
			}
		});
	}
	
	
	if ($(document).width() <= 991)
	{
		$('.container #columns_inner #left-column').appendTo('.container #columns_inner');
		
	}
	else if($(document).width() >= 992)
	{
		$('.container #columns_inner #left-column').prependTo('.container #columns_inner');
	
        }
}
$(document).ready(function(){responsivecolumn();});
$(window).resize(function(){responsivecolumn();});
// JS for fixed the header
function HeadFixTop(){
	var num = 34;
   if ($(document).width() >= 768){
	$(window).bind('scroll', function () {
		if ($(window).scrollTop() > num) {
			$('.header-top').addClass('fixed');
		} else {
			$('.header-top').removeClass('fixed');
		}
	});
   }
}
jQuery(document).ready(function() {
    "use strict";
    HeadFixTop()
});
jQuery(window).resize(function() {
    "use strict";
    HeadFixTop()
});