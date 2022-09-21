!function(e) {
    e("#home-slider-one").owlCarousel( {
          loop:!0, items:1, dots:!0, nav:!0, autoHeight:!0, touchDrag:!0, mouseDrag:!0, margin:0, autoplay:!0, autoplayTimeout:7e3, slideSpeed:1e4, smartSpeed:1400, rtl:true, navText:['<i class="flaticon-left-arrow" aria-hidden="true"></i>', '<i class="flaticon-right-arrow" aria-hidden="true"></i>'], responsive: {
              0: {
                  items: 1, nav: !1, dots: !1
              }
              , 600: {
                  items: 1, nav: !1, dots: !1
              }
              , 768: {
                  items: 1, nav: !1
              }
              , 1100: {
                  items: 1, nav: !0, dots: !0
              }
          }
      }
      ),
      e(".genre-main-slider").owlCarousel( {
          loop:!0, items:4, dots:!0, nav:!1, autoHeight:!0, touchDrag:!0, mouseDrag:!0, margin:25, autoplay:!1, autoplayTimeout:15e3, slideSpeed:1e4, smartSpeed:1400, rtl:true,navText:['<i class="flaticon-left-arrow" aria-hidden="true"></i>', '<i class="flaticon-right-arrow" aria-hidden="true"></i>'], responsive: {
              0: {
                  items: 2, nav: !1, dots: !1
              }
              , 500: {
                  items: 2, nav: !1, dots: !1
              }
              , 992: {
                  items: 3, nav: !1
              }
              , 1100: {
                  items: 4, nav: !1, dots: !0
              }
              , 1800: {
                  items: 5, nav: !1, dots: !0
              }
          }
      }
      ),
      e(".genre-prime-slider").owlCarousel( {
          loop:false, items:8, dots:!1, nav:!0, autoHeight:!0, touchDrag:!0, mouseDrag:!0, margin:15, autoWidth:!1, autoplay:!1, autoplayTimeout:12e3, slideSpeed:1e4, smartSpeed:1400, rtl:true,navText:['<i class="flaticon-left-arrow" aria-hidden="true"></i>', '<i class="flaticon-right-arrow" aria-hidden="true"></i>'], responsive: {
              0: {
                  items: 1, nav: !1, dots: !1
              }
              , 265: {
                  items: 1.5, nav: !1, dots: !1
              }
              , 320: {
                  items: 2, nav: !1, dots: !1
              }
              , 400: {
                  items: 2.5, nav: !1, dots: !1
              }
               , 468: {
                  items: 3, nav: !1, dots: !1
              }
              , 555: {
                  items: 3.5, nav: !1, dots: !1
              }
               , 655: {
                  items: 4, nav: !1, dots: !1
              }
              
              , 715: {
                  items: 4.2, nav: !1, dots: !1
              }
              , 751: {
                  items: 4.5, nav: !1, dots: !1
              }
              , 875: {
                  items: 5, nav: !0, dots: !1
              }
              , 1100: {
                  items: 6, nav: !0, dots: !1
              }
              , 1200: {
                  items: 7, nav: !0, dots: !1
              }
              , 1450: {
                  items: 8, nav: !0, dots: !1
              }
              , 1675: {
                  items: 9, nav: !0, dots: !1
              }
              , 1800: {
                  items: 10, nav: !0, dots: !1
              }
              , 2500: {
                  items: 12, nav: !0, dots: !1
              }
          }
      }
      ),
      e("#home-out-section-slider").owlCarousel( {
          loop:!0, items:1, dots:!0, nav:0, autoHeight:!0, touchDrag:!0, mouseDrag:!0, margin:0, autoplay:!0, autoplayTimeout:7e3, slideSpeed:1e4, smartSpeed:1400, rtl:true,lnavText:['<i class="flaticon-left-arrow" aria-hidden="true"></i>', '<i class="flaticon-right-arrow" aria-hidden="true"></i>'], responsive: {
              0: {
                  items: 1, nav: !1, dots: !1
              }
              , 600: {
                  items: 1, nav: !1, dots: !1
              }
              , 768: {
                  items: 1, nav: !1
              }
              , 1100: {
                  items: 1, nav: 0, dots: !0
              }
          }
      }
      ),
      e('.owl-carousel').owlCarousel({
          rtl:true,
          loop:true,
          margin:10,
          nav:true,
          responsive:{
              0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:5
          }
      }
      }),
      e(window).on("load", function() {
          setTimeout(function() {
              e(".loading").fadeOut("slow")
          }
          , 350)
      }
      )
  }
  
  
  (jQuery)