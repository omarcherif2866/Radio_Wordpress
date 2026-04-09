(function ($) {
	"use strict";

   $(".bytf-trigger-open").on("click", function () {
		$(".bytf__search-wrapper").addClass("opened");
		$(".bytf__body-overlay").addClass("opened");
	});
	$(".bytf__search-close-btn").on("click", function () {
		$(".bytf__search-wrapper").removeClass("opened");
		$(".bytf__body-overlay").removeClass("opened");
	});
   $(".bytf__body-overlay").on("click", function () {
		$(".bytf__search-wrapper").removeClass("opened");
		$(".bytf__body-overlay").removeClass("opened");
	});

   /**
    * Sticky Header
    */
   var e = "",
        g = 0,
        d,
        b,
        c;

    if ($('.bytf-sticky-header').length) {
        $('.bytf-sticky-header').addClass('original').clone(true).insertAfter('.bytf-sticky-header').addClass('main-header-sticky rr-sticky-stt').removeClass('original');
    }

    $(window).on("scroll", function () {
        (b = $(window).scrollTop()), (c = $(window).height()), (d = $(window).width()), b < g ? (e = "up") : (e = "down"), (g = b), h();
    });



    function h() {
        $(".main-header").hasClass("is-sticky") &&
            (b > 300
                ? ($(".main-header-sticky.rr-sticky-stb").addClass("bytf-sticky-header-fixed"), $("#bytf-sticky-header-mobile").addClass("bytf-sticky-header-mobile-fixed"))
                : ($(".main-header-sticky.rr-sticky-stb").removeClass("bytf-sticky-header-fixed"), $("#bytf-sticky-header-mobile").removeClass("bytf-sticky-header-mobile-fixed")),
            e == "up" && b > 300 ? $(".main-header-sticky.rr-sticky-stt").addClass("bytf-sticky-header-fixed") : $(".main-header-sticky.rr-sticky-stt").removeClass("bytf-sticky-header-fixed")),
            $(".main-header-sticky").parents("body").addClass("bytf-sticky-header-sticky");
    }
    //End Sticky Header

   /**
    * post Gallery Thumb
    */
   jQuery('.post__single-gallery-wrapper').marquee({
		gap: 15,
		speed: 80,
		delayBeforeStart: 0,
		direction: 'left',
		duplicated: true,
		pauseOnHover: true,
		startVisible:true,
	});


  $(window).on("load", function () {
      $("#bytf__loader").fadeOut(1000);
   });

   /**
    * MObile Menu
    */
   $('#empath-mobile-menu').metisMenu();

    $('#empath-mobile-menu .dropdown > a').on('click', function (e) {
        e.preventDefault();
    });

    $(".hamburger_menu").on("click", function (e) {
		e.preventDefault();
		$(".slide-bar").toggleClass("show");
		$("body").addClass("on-side");
		$('.body-overlay').addClass('active');
		$(this).addClass('active');
	});

    $(".close-mobile-menu > a").on("click", function (e) {
		e.preventDefault();
		$(".slide-bar").removeClass("show");
		$("body").removeClass("on-side");
		$('.body-overlay').removeClass('active');
		$('.hamburger_menu > a').removeClass('active');
	});

	$('.body-overlay').on('click', function () {
		$(this).removeClass('active');
		$(".slide-bar").removeClass("show");
		$("body").removeClass("on-side");
		$('.hamburger-menu > a').removeClass('active');
	});
   if ($('.hidden-bar').length){
      //Menu Toggle Btn
      $('.toggle-hidden-bar').on('click', function() {
          $('body').addClass('active-hidden-bar');
      });

      //Menu Toggle Btn
      $('.hidden-bar-back-drop, .hidden-bar .close-btn').on('click', function() {
          $('body').removeClass('active-hidden-bar');
      });
  }
  
   //   Back to top
   $(window).on('scroll', function() {
      var scrolled = $(window).scrollTop();
      if (scrolled > 300) $('.back-top-btn').addClass('active');
      if (scrolled < 300) $('.back-top-btn').removeClass('active');
   });
   $('.back-top-btn').on('click', function() {
      $('html, body').animate(
         {
            scrollTop: '0'
         },
         1200
      );
   });


	function ajax_active($scope, $) {
         //One
        var $container = $scope.find('.empath-post-grid-loadmore');
        if ($container.length > 0) {
           $container.on('click',function(event){
              event.preventDefault();

              var $that = $(this);
              var ajaxjsondata = $that.data('json_grid_meta');
              var empath_json_data = Object (ajaxjsondata);

              var contentwrap = $scope.find('.grid-loadmore-content'), // item contentwrap
                 postperpage = parseInt(empath_json_data.posts_per_page), // post per page number
                 showallposts = parseInt(empath_json_data.total_post); // total posts count

                 var items = contentwrap.find('.pfy-grid-item'),
                 totalpostnumber = parseInt(items.length),
                 paged =  parseInt( totalpostnumber / postperpage ) + 1; // paged number

                 $.ajax({
                    url: empath_ajax.ajax_url,
                    type: 'POST',
                    data: {
                       action: 'empath_post_ajax_loading',
                       ajax_json_data: ajaxjsondata,
                       paged:paged
                    },
                    beforeSend: function(){

                       $('<i class="fa fa-spinner fa-spin" style="margin-left:10px"></i>').appendTo( "#empath-post-grid-loadmore" ).fadeIn(100);
                    },
                    complete:function(){
                       $scope.find('.empath-post-grid-loadmore .fa-spinner ').remove();
                    }
                 })

                 .done(function(data) {

                       var $pstitems = $(data);
                       $scope.find('.grid-loadmore-content').append( $pstitems );
                       var newLenght  = contentwrap.find('.pfy-grid-item').length;

                       if(showallposts <= newLenght){
                          $scope.find('.empath-post-grid-loadmore').fadeOut(300,function(){
                             $scope.find('.empath-post-grid-loadmore').remove();
                          });
                       }

                 })

                 .fail(function() {
                    $scope.find('.empath-post-grid-loadmore').remove();
                 });

           });
     }

     //two
     var $container = $scope.find('.empath-post-grid-loadmore-two');
        if ($container.length > 0) {
           $container.on('click',function(event){
              event.preventDefault();

              var $that = $(this);
              var ajaxjsondata = $that.data('json_grid_meta');
              var empath_json_data = Object (ajaxjsondata);

              var contentwrap = $scope.find('.grid-loadmore-content-two'), // item contentwrap
                 postperpage = parseInt(empath_json_data.posts_per_page), // post per page number
                 showallposts = parseInt(empath_json_data.total_post); // total posts count

                 var items = contentwrap.find('.pfy-grid-item'),
                 totalpostnumber = parseInt(items.length),
                 paged =  parseInt( totalpostnumber / postperpage ) + 1; // paged number

                 $.ajax({
                    url: empath_ajax.ajax_url,
                    type: 'POST',
                    data: {
                       action: 'empath_post_ajax_loading_2',
                       ajax_json_data: ajaxjsondata,
                       paged:paged
                    },
                    beforeSend: function(){

                       $('<i class="fa fa-spinner fa-spin" style="margin-left:10px"></i>').appendTo( "#empath-post-grid-loadmore-two" ).fadeIn(100);
                    },
                    complete:function(){
                       $scope.find('.empath-post-grid-loadmore-two .fa-spinner ').remove();
                    }
                 })

                 .done(function(data) {

                       var $pstitems = $(data);
                       $scope.find('.grid-loadmore-content-two').append( $pstitems );
                       var newLenght  = contentwrap.find('.pfy-grid-item').length;

                       if(showallposts <= newLenght){
                          $scope.find('.empath-post-grid-loadmore-two').fadeOut(300,function(){
                             $scope.find('.empath-post-grid-loadmore-two').remove();
                          });
                       }

                 })

                 .fail(function() {
                    $scope.find('.empath-post-grid-loadmore-two').remove();
                 });

           });
     }


     }

     

     function testimonialActive($scope, $) {

         var slider = new Swiper('.testimonial__active', {
            "slidesPerView": 1, 
            "loop": true,
            "speed": 2000,
            "autoplay": {
               "delay": 5000
            },
            navigation: {
               nextEl: ".testi-sl-nxt",
               prevEl: ".testi-sl-prev"
            },
         });
   }


   function postSliderTwoActive($scope, $) {
      var slider = new Swiper('.post_slider_two__active', {
         "slidesPerView": 1, 
         "loop": true,
         "speed": 2000,
         "autoplay": {
            "delay": 5000
         },
         speed: 2000,
         navigation: {
            nextEl: ".testi-sl-nxt",
            prevEl: ".testi-sl-prev"
         },
      });
   }
   function quoteSliderTwoActive($scope, $) {
      var slider = new Swiper('.quoteslide__active', {
         "slidesPerView": 1, 
         "loop": true,
         "speed": 2000,
         spaceBetween: 30,
         "autoplay": {
            "delay": 5000
         },
         speed: 2000,
         
      });
   }

   /**
    * Post Gallery Slider Active
    * @param {Post gallery} $scope 
    * @param {*} $ 
    */
   function postGallerySliderActive($scope, $) {
      $('.bytf__post__gallery-for').slick({
         slidesToShow: 1,
         slidesToScroll: 1,
         arrows: false,
         fade: true,
         asNavFor: '.bytf__post__gallery-nav'
      });
      $('.bytf__post__gallery-nav').slick({
         slidesToShow: 4,
         padding:10,
         slidesToScroll: 1,
         arrows: false,
         asNavFor: '.bytf__post__gallery-for',
         dots: false,
         focusOnSelect: true,
         responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 3,
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
              }
            }
          ]
         
      });
   }

   function postCarouslActive($scope, $) {
      var sliderThumbnail = new Swiper('.post_grid__active', {
         slidesPerView: 4,
         freeMode: true,
         speed: 400,
         spaceBetween: 5,
         watchSlidesVisibility: true,
         watchSlidesProgress: true,
          "autoplay": {
            "delay": 5000
         },
         
         // Add breakpoints for responsiveness
         breakpoints: {
           // When window width is >= 320px
           320: {
             slidesPerView: 1,
             spaceBetween: 5,
           },
           // When window width is >= 480px
           480: {
             slidesPerView: 1,
             spaceBetween: 5,
           },
           // When window width is >= 768px
           768: {
             slidesPerView: 2,
             spaceBetween: 5,
           },
           // When window width is >= 1024px
           1024: {
             slidesPerView: 4,
             spaceBetween: 5,
           }
         }
       });
   }
   function sliderThumbActive($scope, $) {
      var sliderThumbnail = new Swiper('.post_slider_three__thumb', {
         slidesPerView: 3,
         freeMode: true,
         spaceBetween: 36,
         watchSlidesVisibility: true,
         watchSlidesProgress: true,
         
         // Add breakpoints for responsiveness
         breakpoints: {
           // When window width is >= 320px
           320: {
             slidesPerView: 1,
             spaceBetween: 10,
           },
           // When window width is >= 480px
           480: {
             slidesPerView: 1,
             spaceBetween: 20,
           },
           // When window width is >= 768px
           768: {
             slidesPerView: 2,
             spaceBetween: 30,
           },
           // When window width is >= 1024px
           1024: {
             slidesPerView: 3,
             spaceBetween: 36,
           }
         }
       });
       
   
   var slider = new Swiper('.post_slider_three__active', {
      effect: "slide",
      parallax: true,
      speed: 1600,
      autoplay: {
         delay: 10000, 
         disableOnInteraction: false
     },
      navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
      },
      thumbs: {
      swiper: sliderThumbnail
      }
   });

   //Slider Two
   
   $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slider-nav'
   });
   $('.slider-nav').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      vertical:true,
      arrows: false,
      infinite: true,
      centerMode: true,
      asNavFor: '.slider-for',
      dots: false,
      focusOnSelect: true,
      verticalSwiping:true,
      responsive: [
      {
         breakpoint: 992,
         settings: {
            vertical: false,
            slidesToShow: 3,
         }
      },
      {
      breakpoint: 768,
      settings: {
         vertical: false,
         slidesToShow: 3,
      }
      },
      {
      breakpoint: 580,
      settings: {
         vertical: false,
         slidesToShow: 2,
      }
      },
      {
      breakpoint: 380,
      settings: {
         vertical: false,
         slidesToShow: 2,
      }
      }
      ]
   });

   }

   $('.bytf_breaking_active').slick({
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      vertical: true,
      verticalSwiping: true,
      nextArrow: '',
    prevArrow: '<i class="fal fa-angle-down"></i>',
   });


    
   $('.bookmark-icon').on('click', function(e) {
      e.preventDefault();
      
      var post_id = $(this).data('post-id');
      var $this = $(this);
      
      $.ajax({
          type: 'POST',
          url: bookmarkAjax.ajaxurl,
          data: {
              action: 'handle_bookmark',
              post_id: post_id,
              nonce: bookmarkAjax.nonce
          },
          success: function(response) {
              if (response.success) {
                  if (response.data === 'Bookmark added') {
                      $this.addClass('bookmarked');
                      showToast(`
                        <div class="bookmark__content-wrp">
                           <i class="fas fa-solid fa-check check"></i> 
                           <div class="bokmark_msg_">
                              <span>Bookmark added</span>
                           </div>
                        </div>
                      `);
                  } else if (response.data === 'Bookmark removed') {
                      $this.removeClass('bookmarked');
                      showToast( `
                      <div class="bookmark__content-wrp">
                      <i class="far fa-trash"></i>
                           <div class="bokmark_msg_">
                              <span>Bookmark Removed</span>
                           </div>
                        </div>
                      `);
                  }
                  updateBookmarkCount();
              } else {
                  showToast(`
                  <div class="bookmark__content-wrp">
                  <i class="fal fa-lock"></i>
                       <div class="bokmark_msg_">
                          <span>Please login to add bookmark</span>
                       </div>
                    </div>
                  `);
              }
          }
      });
  });

  function showToast(message) {
      var $toast = $(`
         <div class="toast"> ${message} </div>
      `);
      $('body').append($toast);
      $toast.fadeIn(400).delay(2000).fadeOut(400, function() {
          $(this).remove();
      });
  }

  /**
   * Dark Mode
   */
  window.onload = function () {
   // Dark
   const toggleSwitch = document.querySelector(
     '.empath-switch-box__input'
   );
   const currentTheme = localStorage.getItem("theme");
   if (currentTheme) {
     document.documentElement.setAttribute("data-theme", currentTheme);
     if (currentTheme === "dark") {
      toggleSwitch.checked = true;
     }
   }
   function switchTheme(e) {
     if (e.target.checked) {
      document.documentElement.setAttribute("data-theme", "dark");
      localStorage.setItem("theme", "dark");
     } else {
      document.documentElement.setAttribute("data-theme", "light");
      localStorage.setItem("theme", "light");
     }
   }
   if (toggleSwitch) {
     toggleSwitch.addEventListener("change", switchTheme, false);
   }
  };
  
  $(function () {
   /*var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
   var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
   });
   */

   $('[data-toggle="tooltip"]').tooltip();
})
   function movingPost($scope, $) {
      $(".post-ov-sroller").marquee({
         gap: 0,
         speed: 80,
         delayBeforeStart: 0,
         direction: "left",
         duplicated: true,
         pauseOnHover: true,
         startVisible: true,
      });
   }

   jQuery(function(){
      jQuery("#bgndVideo").YTPlayer();
    });
   
    
	

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/empath-post-ajax.default', ajax_active);
		elementorFrontend.hooks.addAction('frontend/element_ready/empath-testimonial.default', testimonialActive);
		elementorFrontend.hooks.addAction('frontend/element_ready/empath-post-slider.default', postSliderTwoActive);
		elementorFrontend.hooks.addAction('frontend/element_ready/empath-post-galley.default', postGallerySliderActive);
		elementorFrontend.hooks.addAction('frontend/element_ready/empath-post-slider-tw.default', sliderThumbActive);
		elementorFrontend.hooks.addAction('frontend/element_ready/empath-post-moving.default', movingPost);
		elementorFrontend.hooks.addAction('frontend/element_ready/empath-quote.default', quoteSliderTwoActive);
		elementorFrontend.hooks.addAction('frontend/element_ready/empath-post-grid-car.default', postCarouslActive);

	});

 
	
})(jQuery);