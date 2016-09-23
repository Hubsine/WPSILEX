/*  
Theme Name: Sellegance
Version: 1.0.4.4
Description: Theme specific scripts
*/


jQuery(document).ready(function($) {

/*-----------------------------------------------------------------------------------*/
/*  Siblings Fader
/*-----------------------------------------------------------------------------------*/         
	
  siblingsFader=function(){
  
	$("#social-icons li, #header_topbar .topbarmenu ul li, .branditems_slider ul li").hover(function() {
	  $(this).siblings().stop().fadeTo(400,0.5);
	}, function() {
	  $(this).siblings().stop().fadeTo(400,1);
	});
  
  };
  siblingsFader();
	

/*-----------------------------------------------------------------------------------*/
/*  fitVids
/*-----------------------------------------------------------------------------------*/
  
  $(".vcontainer, .entry-content").fitVids();

	
/*-----------------------------------------------------------------------------------*/
/*  Product button
/*-----------------------------------------------------------------------------------*/

  /* button show */ 
  $('.product_item').mouseenter(function(){
	$(this).find('.product_button_cont').fadeIn(100, function() {
	  // Animation complete.
	});
  }).mouseleave(function(){
	$(this).find('.product_button_cont').fadeOut(100, function() {
	  // Animation complete.
	});
  });
  
/*-----------------------------------------------------------------------------------*/
/*  Smartresize Plugin
/*-----------------------------------------------------------------------------------*/

  (function($,sr){

	// debouncing function from John Hann
	// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
	var debounce = function (func, threshold, execAsap) {
	  var timeout;

	  return function debounced () {
		var obj = this, args = arguments;
		function delayed () {
		  if (!execAsap)
			func.apply(obj, args);
		  timeout = null;
		};

		if (timeout)
		  clearTimeout(timeout);
		else if (execAsap)
		  func.apply(obj, args);

		timeout = setTimeout(delayed, threshold || 100);
	  };
	}
	// smartresize 
	$.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

  })($,'smartresize');


/*-----------------------------------------------------------------------------------*/
/*  Product thumbs resize
/*-----------------------------------------------------------------------------------*/

	$(window).load(function(){

	  productSetup=function() {
		$('li.productanim3').each(function() {
		  var productImageHeight = $(this).find('.loop_product > img').height();
		  $(this).find('.image_container').css('padding-bottom', productImageHeight  + 'px');
		});     
	  
	  },
	  productSetup();

	});

	$(window).smartresize(function(){ 
	  productSetup();
	});


	
/*-----------------------------------------------------------------------------------*/
/*  Custom Select
/*-----------------------------------------------------------------------------------*/ 
  
  // $('select.main-menu-mobile').width(180).customSelect({customClass:'mobile_menu_select'});
  //$('.woocommerce-ordering select').width(130).customSelect({customClass:'product_sort'});

  
/*-----------------------------------------------------------------------------------*/
/*  Navigation
/*-----------------------------------------------------------------------------------*/ 

  var temp, menu = $("#navigation .menu");
  menu.find("li").hover(function(){
	$(this).children('.children').hide().slideDown('normal');
	if($(this).hasClass('mega-item'))
	  $(this).children('.children').find('.children').hide().slideDown('normal');
	try{
	  $tmp=($(this).children('.children').offset().left+$(this).children('.children').width())-($(".header_box .nav").offset().left+$(".header_box .nav").width());
	  if($tmp>0){
		$(this).children('.children').css("right","0");
	  }
	}
	catch(e){}
  },function(){
	$(this).children('.children').stop(true,true).hide();
  });

  menu.children("li").each(function(){
	temp = $(this);
	if(temp.children().hasClass("children"))
	  temp.addClass("showdropdown");

	/*if(temp.hasClass('rel'))
	  temp.find('.children').append('<span class="mg-menu-tip" style="width:'+temp.width()+'px"></span>');
	else
	  temp.find('.children').append('<span class="mg-menu-tip" style="left:'+(temp.position().left-20)+'px;width:'+temp.width()+'px"></span>');*/
  });


  menu.find(".children.columns").each(function(){
	$countItems=1;
	$(this).children(".mega-item").each(function(){
	  temp = $(this);
	  if(temp.hasClass("clearleft")){
		$countItems=4;
	  }else if(($countItems%3)==1 && $countItems!=1){
		temp.addClass("clearleft");
	  }
	  $countItems++;
	});
  });
  

  var config = {
	over: function(){
	  if ($(this).hasClass('.header-dropdown')){
		$(this).parent().addClass('over');
	  } else {
		$(this).addClass('over');
	  }
	  $('.header-dropdown', this).animate({opacity:1, height:'toggle'}, 100);
	},
	timeout: 0, // number = milliseconds delay before onMouseOut
	out: function(){
	  var that = this;
	  $('.header-dropdown', this).animate({opacity:0, height:'toggle'}, 100, function(){
		if ($(this).hasClass('.header-dropdown')){
		  $(that).parent().removeClass('over');
		} else {
		  $(that).removeClass('over');
		}
	  });
	}
  };
  $('.header-switch, .header-switch .header-dropdown').hoverIntent( config );



  
/*-----------------------------------------------------------------------------------*/
/*  Mobile Navigation
/*-----------------------------------------------------------------------------------*/

  $('.main-menu-mobile').change(function(){
	if($(this).val() !== null){
	  document.location.href = $(this).val()
	}
  });
  

  /* mobile menu */

  var navList = $('.mobile-nav div > ul');
  var etOpener = '<span class="open-child">(open)</span>';
  navList.addClass('side-mobile-menu');
  
  navList.find('li:has(ul)',this).each(function() {
	$(this).prepend(etOpener);
  })
  
  navList.find('.open-child').click(function(){
	if ($(this).parent().hasClass('over')) {
	  $(this).parent().removeClass('over').find('>ul').slideUp(200);
	}else{
	  $(this).parent().parent().find('>li.over').removeClass('over').find('>ul').slideUp(200);
	  $(this).parent().addClass('over').find('>ul').slideDown(200);
	}
  });
  
  $('.menu-icon, .close-mobile-nav').click(function(event) {
	if(!$('body').hasClass('mobile-nav-shown')) {
	  $('body').addClass('mobile-nav-shown', function() {
		// Hide search input on click
		setTimeout(function(){
		  $(document).one("click",function(e) {
			var target = e.target;
			if (!$(target).is('.mobile-nav') && !$(target).parents().is('.mobile-nav')) {

				  $('body').removeClass('mobile-nav-shown');
			}
		  });  
		}, 111);
	  });



	} else{
	  $('body').removeClass('mobile-nav-shown');
	}
  });
  
/*-----------------------------------------------------------------------------------*/
/*  Sticky Header
/*-----------------------------------------------------------------------------------*/ 
  
	var headerHeight = $('#header').outerHeight() + 100;
	
	stickyMenuFunction=function(){
	
	var scrollTimer = null;
	$(window).scroll(function () {
	  if (scrollTimer) {
		clearTimeout(scrollTimer);
	  }
	  scrollTimer = setTimeout(handleScroll, 200);
	});
	
	function handleScroll() {
	  scrollTimer = null;
	  
	  var stickyWindowWidth = $(window).width();
	  
	  if( stickyWindowWidth > 978 ) {
	  
		if ($(window).scrollTop() > headerHeight) {
		  $('#sticky-menu').show();
		  $('#sticky-menu').filter(':not(:animated)').animate({top:'0px'}, 200);
		} else {
		  $('#sticky-menu').filter(':not(:animated)').animate({top:'-60px'}, 100, function(){
			$(this).hide();
		  });
		
		}
	  
	  } else {
		$('#sticky-menu').hide();       
	  }
	}
	
	};
	stickyMenuFunction();
	
	
	$('.sticky-search-trigger a').click(function() {
	  $('.header_shopbag').hide();
	  $('.sticky-search-trigger').hide();
	  
	  $('.sticky-search-area').fadeIn('fast', function(){       
		$(this).find('input').focus();
	  });
	  return false;
	});
	
	$('.sticky-search-area-close a').click(function() {
	  $('.header_shopbag').show();
	  $('.sticky-search-trigger').fadeIn('fast');
	  $('.sticky-search-area').fadeOut('fast');     
	  return false;
	}); 
  
	$('.search-trigger a').click(function() {
	  $('.search-trigger').hide();
	  $('.header_shopbag').hide();
	  $('.search-area').fadeIn('fast', function(){        
		$(this).find('input').focus();
	  });
	  return false;
	});
	
	$('.search-area-close a').click(function() {
	  $('.search-area').fadeOut('fast');
	  $('.search-trigger').fadeIn('fast');
	  $('.header_shopbag').fadeIn('fast');
	  return false;
	}); 


/*-----------------------------------------------------------------------------------*/
/*  Category Accordion
/*-----------------------------------------------------------------------------------*/ 

	var plusIcon = '+';
	var minusIcon = '&ndash;';
	var catsAccordion = false;
	catsAccordion = true;

	
	if(catsAccordion) {
	  var etCats = $('.product-categories');
	  var openerHTML = '<div class="open-this">'+plusIcon+'</div>';

	  etCats.find('>li').has('.children').has('li').addClass('parent-level0').prepend(openerHTML);

	  if($('.current-cat.parent-level0, .current-cat-parent').length > 0) {
		$('.current-cat.parent-level0, .current-cat-parent').find('.open-this').html(minusIcon).parent().addClass('opened').find('ul.children').show();
	  } else {
		etCats.find('>li').first().find('.open-this').html(minusIcon).parent().addClass('opened').find('ul.children').show();
	  }

	  etCats.find('.open-this').click(function() {
		if($(this).parent().hasClass('opened')) {
		  $(this).html(plusIcon).parent().removeClass('opened').find('ul.children').slideUp(200);
		}else {
		  $(this).html(minusIcon).parent().addClass('opened').find('ul.children').slideDown(200);
		}
	  });
	}

  

/*-----------------------------------------------------------------------------------*/
/*  Product view switch
/*-----------------------------------------------------------------------------------*/ 


	function listSwitcher() {
	  var gridClass = 'products-grid';
	  var listClass = 'products-list';
	  jQuery('#switchToList').click(function(){
		if(!jQuery.totalStorage('products_page') || jQuery.totalStorage('products_page') == 'grid'){
		  switchToList();
		}
	  });
	  jQuery('#switchToGrid').click(function(){
		if(!jQuery.totalStorage('products_page') || jQuery.totalStorage('products_page') == 'list'){
		  switchToGrid();
		}
	  });
	  
	  function switchToList(){
		jQuery('.product-loop').fadeOut(300,function(){
		  jQuery(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
		  jQuery.totalStorage('products_page', 'list', { expires: 3, path: '/' });
		});
	  }
	  
	  function switchToGrid(){
		jQuery('.product-loop').fadeOut(300,function(){
		  jQuery(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
		  jQuery.totalStorage('products_page', 'grid', { expires: 3, path: '/' });
		});
		
	  }

	}

	function check_view_mod(){
	  var activeClass = 'active';
	  
	  if(jQuery.totalStorage('products_page') == 'grid') {
		jQuery('.product-loop').removeClass('products-list').addClass('products-grid');
		jQuery('#switchToGrid').addClass(activeClass);
	  }else if(jQuery.totalStorage('products_page') == 'list') {
		jQuery('.product-loop').removeClass('products-grid').addClass('products-list');
		jQuery('#switchToList').addClass(activeClass);
	  }else{
		if(products_default_view == 'list') {
		  jQuery('#switchToList').addClass(activeClass);
		}else{
		  jQuery('#switchToGrid').addClass(activeClass);
		}
	  }
	}

	listSwitcher();
	check_view_mod();



/*-----------------------------------------------------------------------------------*/
/*  Tabs
/*-----------------------------------------------------------------------------------*/ 


  var tabs = $('.tabs');
  $('.tabs > p > a').unwrap('p');
  
  var leftTabs = $('.left-bar, .right-bar');
  var newTitles;
  
  leftTabs.each(function(){
	var currTab = $(this);
	//currTab.find('> a.tab-title').each(function(){
	  newTitles = currTab.find('> a.tab-title').clone().removeClass('tab-title').addClass('tab-title-left');
	//});

	newTitles.first().addClass('opened');

	
	var tabNewTitles = $('<div class="left-titles"></div>').prependTo(currTab);
	tabNewTitles.html(newTitles);

	currTab.find('.tab-content').css({
	  'minHeight' : tabNewTitles.height()
	});
  });
  
  
  tabs.each(function(){
	var currTab = $(this);

	currTab.find('.tab-title').first().addClass('opened').next().show();

	currTab.find('.tab-title, .tab-title-left').click(function(e){
	  
	  e.preventDefault();
	  
	  var tabId = $(this).attr('id');
	
	  if($(this).hasClass('opened')){
		if(currTab.hasClass('tab_accordion') || $(window).width() < 767){
		  $(this).removeClass('opened');
		  $('#content_'+tabId).hide();
		}
	  }else{
		currTab.find('.tab-title, .tab-title-left').each(function(){
		  var tabId = $(this).attr('id');
		  $(this).removeClass('opened');
		  $('#content_'+tabId).hide();
		});


		if(currTab.hasClass('tab_accordion') || $(window).width() < 767){
		  $('#content_'+tabId).removeClass('tab-content').show();
		  setTimeout(function(){
			$('#content_'+tabId).addClass('tab-content').show(); // Fix it
		  },1);
		} else {
		  $('#content_'+tabId).show();
		}
		$(this).addClass('opened');
	  }
	});
  });
	
/*-----------------------------------------------------------------------------------*/
/*  Minicart
/*-----------------------------------------------------------------------------------*/ 

  $(".header_box .header_shopbag").live("mouseenter", function() {
	if(!$(this).data('init'))
	{
	  $(this).data('init', true);
	  $(this).hoverIntent
	  (
		function()
		{
		  $('.header_box .minicart_wrapper').fadeIn(200);
		},

		function()
		{
		  $('.header_box .minicart_wrapper').fadeOut(200);
		}
	  );
	  $(this).trigger('mouseenter');
	}
	$(".header_box .header_shopbag").live('click', function() {
	  $('.header_box .minicart_wrapper').fadeOut(200);
	});
  });

/*  Sticky Menu Cart */ 

  
  $("#sticky-menu .header_shopbag").live("mouseenter", function() {
	if(!$(this).data('init'))
	{
	  $(this).data('init', true);
	  $(this).hoverIntent
	  (
		function()
		{
		  $('#sticky-menu .minicart_wrapper').fadeIn(200);
		},

		function()
		{
		  $('#sticky-menu .minicart_wrapper').fadeOut(200);
		}
	  );
	  $(this).trigger('mouseenter');
	}
  });


/*-----------------------------------------------------------------------------------*/
/* Magnific Popup
/*-----------------------------------------------------------------------------------*/


  $('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]').each(function(){
	//single image popup
	if ($(this).parents('.gallery').length == 0) {
	  $(this).magnificPopup({type:'image'});
	}
  });
  
  //gallery popup
  $('.gallery').each(function() {
	$(this).magnificPopup({
		delegate: 'a',
		type: 'image',
		gallery: {enabled:true}
	});
  });
  
  $("a[rel^='lightboxGall']").magnificPopup({
	type:'image',
	gallery:{
	  enabled:true
	}
  });



 /*-----------------------------------------------------------------------------------*/
 /* Ajax Quickview
 /*-----------------------------------------------------------------------------------*/


	$(document.body).on('click', '.show-quickly, .show-quickly-btn', (function() {
		var $thisbutton = $(this);
		var prodid = $thisbutton.data('prodid');
		var magnificPopup;
		$.ajax({
			url: woocommerce_params.ajax_url,
			method: 'POST',
			data: {
				'action': 'et_product_quick_view',
				'prodid': prodid
			},
			dataType: 'html',
			beforeSend: function() {
				$thisbutton.parents().eq(3).addClass('loading');
				$thisbutton.parents().eq(2).after('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>');
			},
			complete: function() {
				$thisbutton.parents().eq(3).find('#floatingCirclesG').remove();
				$thisbutton.parents().eq(3).removeClass('loading');
			},
			success: function(response){

				$.magnificPopup.open({
					items: { src: '<div class="quick-view-popup mfp-with-anim">' + response + '</div>' },
					type: 'inline',
					removalDelay: 500, //delay removal by X to allow out-animation
					callbacks: {
						beforeOpen: function() {
							this.st.mainClass = 'mfp-zoom-in-to-left-out';
						}
					}
				}, 0);

				$(function() {
					$('.variations_form').wc_variation_form();
					$('.variations_form .variations select').change();
					$('.productSlider').iosSlider({
						 scrollbar: false,
						 snapToChildren: true,
						 desktopClickDrag: true,
						 infiniteSlider: false,
						 navPrevSelector: $('.products_slider_previous'),
						 navNextSelector: $('.products_slider_next'),
						 scrollbarHeight: '2',
						 scrollbarBorderRadius: '0',
						 scrollbarOpacity: '0.5',
						 onSliderLoaded: productSlider2Load,
						 onSlideChange: productSlider2Load,
						 onSliderResize: productSlider2Load
					 });
					 
				   
					 function productSlider2Load(args) {
								  
					  currentSlide = args.currentSlideNumber;
					 
					  /* update height of the first slider */
  
					  setTimeout(function() {
						  var setHeight = $('.productSlider .item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
						  $('.productSlider').animate({ height: setHeight }, 300);
					  },300);
					  
				  }
				});
				$('.images').addClass('shown');
			},
			error: function() {
				$.magnificPopup.open({
					items: {
						src: '<div class="quick-view-popup mfp-with-anim">Error with AJAX request</div>'
					},
					type: 'inline',
					removalDelay: 500, //delay removal by X to allow out-animation
					callbacks: {
						beforeOpen: function() {
							this.st.mainClass = 'mfp-zoom-in-to-left-out';
						}
					}
				}, 0);
			}
		});

	}));

/*!
 * Magnific Popup Variation plugin
 */
!function(a,b,c,d){a.fn.wc_variation_form=function(){return a.fn.wc_variation_form.find_matching_variations=function(b,c){for(var d=[],e=0;e<b.length;e++){{var f=b[e];f.variation_id}a.fn.wc_variation_form.variations_match(f.attributes,c)&&d.push(f)}return d},a.fn.wc_variation_form.variations_match=function(a,b){var c=!0;for(var e in a){var f=a[e],g=b[e];f!==d&&g!==d&&0!==f.length&&0!==g.length&&f!=g&&(c=!1)}return c},this.unbind("check_variations update_variation_values found_variation"),this.find(".reset_variations").unbind("click"),this.find(".variations select").unbind("change focusin"),$form=this.on("click",".reset_variations",function(){a(this).closest(".variations_form").find(".variations select").val("").change();var b=a(this).closest(".product").find(".sku"),c=a(this).closest(".product").find(".product_weight"),d=a(this).closest(".product").find(".product_dimensions");return b.attr("data-o_sku")&&b.text(b.attr("data-o_sku")),c.attr("data-o_weight")&&c.text(c.attr("data-o_weight")),d.attr("data-o_dimensions")&&d.text(d.attr("data-o_dimensions")),!1}).on("change",".variations select",function(){$variation_form=a(this).closest(".variations_form"),$variation_form.find("input[name=variation_id]").val("").change(),$variation_form.trigger("woocommerce_variation_select_change").trigger("check_variations",["",!1]),a(this).blur(),a().uniform&&a.isFunction(a.uniform.update)&&a.uniform.update()}).on("focusin touchstart",".variations select",function(){$variation_form=a(this).closest(".variations_form"),$variation_form.trigger("woocommerce_variation_select_focusin").trigger("check_variations",[a(this).attr("name"),!0])}).on("check_variations",function(c,d,e){var f=!0,g=!1,h={},i=a(this),j=i.find(".reset_variations");i.find(".variations select").each(function(){0===a(this).val().length?f=!1:g=!0,d&&a(this).attr("name")==d?(f=!1,h[a(this).attr("name")]=""):(value=a(this).val(),h[a(this).attr("name")]=value)});var k=parseInt(i.data("product_id")),l=i.data("product_variations");l||(l=b.product_variations[k]),l||(l=b.product_variations),l||(l=b["product_variations_"+k]);var m=a.fn.wc_variation_form.find_matching_variations(l,h);if(f){var n=m.shift();n?(i.find("input[name=variation_id]").val(n.variation_id).change(),i.trigger("found_variation",[n])):(i.find(".variations select").val(""),e||i.trigger("reset_image"),alert(wc_add_to_cart_variation_params.i18n_no_matching_variations_text))}else i.trigger("update_variation_values",[m]),e||i.trigger("reset_image"),d||i.find(".single_variation_wrap").slideUp(200);g?"hidden"===j.css("visibility")&&j.css("visibility","visible").hide().fadeIn():j.css("visibility","hidden")}).on("reset_image",function(){var b=a(this).closest(".product"),c=b.find("div.images img:eq(0)"),e=b.find("div.images a.zoom:eq(0)"),f=c.attr("data-o_src"),g=c.attr("data-o_title"),h=c.attr("data-o_alt"),i=e.attr("data-o_href");f!==d&&c.attr("src",f),i!==d&&e.attr("href",i),g!==d&&(c.attr("title",g),e.attr("title",g)),h!==d&&c.attr("alt",h)}).on("update_variation_values",function(b,c){$variation_form=a(this).closest(".variations_form"),$variation_form.find(".variations select").each(function(b,d){current_attr_select=a(d),current_attr_select.data("attribute_options")||current_attr_select.data("attribute_options",current_attr_select.find("option:gt(0)").get()),current_attr_select.find("option:gt(0)").remove(),current_attr_select.append(current_attr_select.data("attribute_options")),current_attr_select.find("option:gt(0)").removeClass("active");var e=current_attr_select.attr("name");for(var f in c)if("undefined"!=typeof c[f]){var g=c[f].attributes;for(var h in g){var i=g[h];h==e&&(i?(i=a("<div/>").html(i).text(),i=i.replace(/'/g,"\\'"),i=i.replace(/"/g,'\\"'),current_attr_select.find('option[value="'+i+'"]').addClass("active")):current_attr_select.find("option:gt(0)").addClass("active"))}}current_attr_select.find("option:gt(0):not(.active)").remove()}),$variation_form.trigger("woocommerce_update_variation_values")}).on("found_variation",function(b,c){var e=a(this),f=a(this).closest(".product"),g=f.find("div.images img:eq(0)"),h=f.find("div.images a.zoom:eq(0)"),i=g.attr("data-o_src"),j=g.attr("data-o_title"),k=g.attr("data-o_alt"),l=h.attr("data-o_href"),m=c.image_src,n=c.image_link,o=c.image_title,p=c.image_alt;e.find(".variations_button").show(),e.find(".single_variation").html(c.price_html+c.availability_html),i===d&&(i=g.attr("src")?g.attr("src"):"",g.attr("data-o_src",i)),l===d&&(l=h.attr("href")?h.attr("href"):"",h.attr("data-o_href",l)),j===d&&(j=g.attr("title")?g.attr("title"):"",g.attr("data-o_title",j)),k===d&&(k=g.attr("alt")?g.attr("alt"):"",g.attr("data-o_alt",k)),m&&m.length>1?(g.attr("src",m).attr("alt",p).attr("title",o),h.attr("href",n).attr("title",o)):(g.attr("src",i).attr("alt",k).attr("title",j),h.attr("href",l).attr("title",j));var q=e.find(".single_variation_wrap"),r=f.find(".product_meta").find(".sku"),s=f.find(".product_weight"),t=f.find(".product_dimensions");r.attr("data-o_sku")||r.attr("data-o_sku",r.text()),s.attr("data-o_weight")||s.attr("data-o_weight",s.text()),t.attr("data-o_dimensions")||t.attr("data-o_dimensions",t.text()),r.text(c.sku?c.sku:r.attr("data-o_sku")),s.text(c.weight?c.weight:s.attr("data-o_weight")),t.text(c.dimensions?c.dimensions:t.attr("data-o_dimensions")),q.find(".quantity").show(),c.is_in_stock||c.backorders_allowed||e.find(".variations_button").hide(),c.variation_is_visible||(e.find(".variations_button").hide(),e.find(".single_variation").html("<p>"+wc_add_to_cart_variation_params.i18n_unavailable_text+"</p>")),c.min_qty?q.find("input[name=quantity]").attr("min",c.min_qty).val(c.min_qty):q.find("input[name=quantity]").removeAttr("min"),c.max_qty?q.find("input[name=quantity]").attr("max",c.max_qty):q.find("input[name=quantity]").removeAttr("max"),"yes"===c.is_sold_individually&&(q.find("input[name=quantity]").val("1"),q.find(".quantity").hide()),q.slideDown(200).trigger("show_variation",[c])}),$form.trigger("wc_variation_form"),$form},a(function(){return"undefined"==typeof wc_add_to_cart_variation_params?!1:(a(".variations_form").wc_variation_form(),void a(".variations_form .variations select").change())})}(jQuery,window,document);



/*-------------------------------------------------------------------------*/
/*  Scroll to top
/* -------------------------------------------------------------------- */

  $(window).scroll(function () {
	if ($(this).scrollTop() > 500) {
	  $('.go-top').removeClass('off').addClass('on');
	}
	else {
	  $('.go-top').removeClass('on').addClass('off');
	}
  });

  $('.go-top').click(function () {
	$("html, body").animate({
	  scrollTop: 0
	}, 800);
	return false;
  });
  

/*-------------------------------------------------------------------------*/
/*  Content Tabs
/*-------------------------------------------------------------------------*/
  
  $('.shortcode_tabgroup').find("div.panel").hide();
  $('.shortcode_tabgroup').find("div.panel:first").show();
  $('.shortcode_tabgroup').find("ul li:first").addClass('active');
   
  $('.shortcode_tabgroup ul li a').click(function(){

	$(this).parent().parent().parent().find('ul li').removeClass('active');
	$(this).parent().addClass('active');
	var currentTab = $(this).attr('href');
	$(this).parent().parent().parent().find('div.panel').hide();
	$(currentTab).fadeIn(300);
	return false;
  });
  
/*-------------------------------------------------------------------------*/
/*  Comparison remove button class
/*-------------------------------------------------------------------------*/ 
  
  $('.product-actions .compare-button').find(".button").removeClass('button');
  $('.woocommerce .products').find(".product-category").removeClass('product');
  
/*-------------------------------------------------------------------------*/
/*  Content Accordion
/*-------------------------------------------------------------------------*/ 

  $('.accordion').each(function(){
	var acc = $(this).attr("rel") * 2;
	$(this).find('.accordion-inner:nth-child(' + acc + ')').show();
	$(this).find('.accordion-inner:nth-child(' + acc + ')').prev().addClass("active");
  });

  $('.toggle h3 a').click(function(){
	$(this).parents('.toggle').find('> div').slideToggle(300);
	$(this).parents('.toggle').toggleClass('open');
	return false;
  }); 


// tooltips


  $('.product_share a, .product_navigation_container a ').tooltip();


});