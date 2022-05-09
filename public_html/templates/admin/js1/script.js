/**
 * @name Site
 * @description Global variables and functions
 * @version 1.0
 */
$(document).ready(function(e) {
 //    $('.project--link').click(function(){
	// 	var id=$(this).data('id');
	// 	var op="products";
 //    $(this).parents('.projects-tab').find('#all--project').removeClass('active');
	// 	$.ajax({
	// 		type:'post',
	// 		url:'/ajax.php',
	// 		data:{op:op,id:id},
	// 		success: function(data){
	// 		$('.project--tabContent').html(data);
	// 		$('.project--tabContent').addClass('active');
	// 		}	
	// 	})	
	// });
  //   $('.link-index').click(function(){
  //   var id=$(this).data('id');
  //   var op="main";
  //   $.ajax({
  //     type:'post',
  //     url:'/ajax.php',
  //     data:{op:op,id:id},
  //     success: function(data){
  //     $('#loadtab').html(data);
  //     $('.project-tabindex').addClass('active');
  //     } 
  //   })  
  // });
  
   $(".archiland--form-search").submit(function(){
	var keyword=$('.ipt-search').val();
   	if(keyword=="")
	{
		alert("Chưa nhập thông tin tìm kiếm . Mời nhập lại");
	}else{
		 window.location.href = '/search.html&keyword='+keyword;	
	}
	return false;
 });
});


var Site = (function($, window, undefined) {
  'use strict';

  var body = $('body');


  var initToggleNav = function() {
    $('.icon-nav').on('click', function() {
      var ctMenu = $('.ct-navbar-menu');

      if(ctMenu.hasClass('show-menu')) {
        ctMenu.removeClass('show-menu');
      }
      else {
        ctMenu.addClass('show-menu');
      }

      (ctMenu.hasClass('show-menu') === true)
      ? body.css('overflow', 'hidden')
      : body.css('overflow', 'auto');
    });

    $('.close-nav').on('click', function() {
      $('.icon-nav').trigger('click', true);
    });
  }

  var initToggleFormSearch = function() {
    $('.icon-search').on('click', function() {
      var formSearch = $('.ct-form-search');

      if(formSearch.hasClass('show-form')) {
       formSearch.removeClass('show-form');
      }
      else {
        formSearch.addClass('show-form');
      }

      (formSearch.hasClass('show-form') === true)
      ? body.css('overflow', 'hidden')
      : body.css('overflow', 'auto');
    });

    $('.close-search').on('click', function() {
      $('.icon-search').trigger('click', true);
    });
  }

  var heroSlider = function() {
    $('.hero-slider').slick({
      autoplay: true,
      fade: true,
      cssEase: 'ease',
      speed: 800,
      autoplaySpeed: 2000,
    });
  }

  var serviceSlider = function() {
    $('.service-slider').slick({
      cssEase: 'ease',
      speed: 500,
      slidesToShow: 2,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        }
      ]
    });
  };

  var projectSlider = function() {
    $('.project-slider').slick({
      cssEase: 'ease',
      speed: 500,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        }
      ]
    });
  };

  var projectListTab = function() {
    $('.project--list-tab').slick({
      cssEase: 'ease',
      speed: 500,
      slidesToShow: 7,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 6,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 992,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        }
      ]
    });
  };

  var initProjectTab = function() {
    var listTabProject = $('.projects-tab');
    var tabLinks = listTabProject.find('[data-project-tabtop]');
    var tabContents = listTabProject.find('[data-project-tabcontent]');
    tabLinks.on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();

      var self = $(this);
      var curTabContent = $(self.data('target'));

      tabLinks.removeClass('active');
      tabContents.removeClass('active');

      self.addClass('active');
      curTabContent.addClass('active');
    });
  };

  var newsSlider = function() {
    $('.news-slider').slick({
      cssEase: 'ease',
      speed: 500,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1300,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        }
      ]
    });
  };

  var teamSlider = function() {
    $('.teams-slider').slick({
      cssEase: 'linear',
      speed: 800,
      fade: true,
    });
  }

  var memberSlider = function() {
    $('.member-slider').slick({
      cssEase: 'ease',
      speed: 500,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        }
      ]
    });
  }

  var commentSlider = function() {
    $('.comment-slider').slick({
      cssEase: 'ease',
      speed: 500,
      dots: true,
    });
  }

  var initFixBot = function() {
    $(window).scroll(function() {
      if ($(this).scrollTop() > 250) {
        $('.fix-bot').fadeIn(500);
      }

      else {
        $('.fix-bot').fadeOut(500);
      }
    });

    $('.fix-bot').click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      $('html, body').animate({scrollTop: 0}, 400);
      return false;
    });
  }

  var scrollListTabs = function() {
    var win = $(window);
    var scrollSection = $('.tab-scroll');
    var listTab = $('.project--list-tab');

    var resizeTimeout = 0;
    var scrollTimeout = 0;

    win
      .off('resize.scrollTab')
      .on('resize.scrollTab', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
          win.trigger('scroll.scrollTab');
        }, 50);
      });

    win
      .off('scroll.scrollTab')
      .on('scroll.scrollTab', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function() {
          var scrollSectionTop = scrollSection.offset().top;
          var scrollSectionHeight = scrollSection.outerHeight(true);
          var listTabHeight = listTab.outerHeight(true);
          var scrollTop = win.scrollTop();

          if (scrollTop >= scrollSectionTop && scrollTop < scrollSectionHeight - listTabHeight) {
            listTab.animate({'top': (scrollTop - scrollSectionTop + 180) + 'px'}, 'slow');
          }
          else if (scrollTop < scrollSectionTop) {
            listTab.css('top', '');
          }
        }, 200);
      });
  };

  var projectDetailSlider = function() {
    $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      nextArrow: '<button type="button" class="slick-next"><img class="img" alt="icon-next" src="images/next.png"></button>',
      prevArrow: '<button type="button" class="slick-prev"><img class="img" alt="icon-prev" src="images/prev.png"></button>',
      asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      asNavFor: '.slider-for',
      focusOnSelect: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          }
        },

        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },
      ]
    });
  };

  var initGalleryTab = function() {
    var listTabGallery = $('.ct-gallery-tab');
    var tabLinks = listTabGallery.find('[data-gallery-taptop]');
    var tabContents = listTabGallery.find('[data-gallery-tapcontent]');
    tabLinks.on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();

      var self = $(this);
      var curTabContent = $(self.data('target'));

      tabLinks.removeClass('active');
      tabContents.removeClass('active');

      self.addClass('active');
      curTabContent.addClass('active');
    });
  };

  var initClickedText = function() {
    if (window.innerWidth < 768) {
      $('.link-tab').on('click', function() {
        var clickedLink = $(this);
        var clickedLinkText = clickedLink.text();
        var filterLabel = $('.label-tab');
        filterLabel.text(clickedLinkText);
        $('.list-recruitment').removeClass('show-list');
      })

      var listFil = $('.label-tab');
      listFil
        .off('click.showAcc')
        .on('click.showAcc', function() {
          var acc = $(this);
          listFil.not(acc).removeClass('active').next().removeClass('show-list');
          acc.toggleClass('active').next().toggleClass('show-list');
        });
    };
  }

  var initrecruitmentTab = function() {
    var listTab = $('.tabs-recruitment');
    var tabLinks = listTab.find('[data-recruitment-taptop]');
    var tabContents = listTab.find('[data-recruitment-tapcontent]');
    tabLinks.on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();

      var self = $(this);
      var curTabContent = $(self.data('target'));

      tabLinks.removeClass('active');
      tabContents.removeClass('active');

      self.addClass('active');
      curTabContent.addClass('active');
    });
  };

  var initSelectMenu = function(){
   var selectMenus = $('.select-custom');
    selectMenus.selectmenu({
     change: function(event, data) {
         $(event.target).prop('selectedIndex', data.index);
         $(event.target).trigger('change');
        }
    });
  };

  var initReSize = function() {
    $(window).resize(function() {
      var ctMenu = $('.ct-navbar-menu');
      if (window.innerWidth >= 1200) {
        if (ctMenu.hasClass('show-menu')) {
          ctMenu.removeClass('show-menu');
          body.css('overflow', 'auto');
        }
      };
    });
  };

  var initValidateForm = function() {
    $(".validate").validate({
      rules: {
      name: "required",
      mail: "required",
      tel: {
        required: true,
        minlength: 10
      }
      },

      messages: {
      name: "Vui lòng nhập tên",
      mail: "Vui lòng nhập Email",
      tel: {
        required: "Vui lòng nhập Số Điện Thoại",
        minlength: "Số điện thoại chưa đúng"
      }
      }
      });
  }


  var homePage = function() {
    initToggleNav();
    initToggleFormSearch();
    heroSlider();
    serviceSlider();
    projectSlider();
    projectListTab();
    initProjectTab();
    newsSlider();
    teamSlider();
    commentSlider();
    memberSlider();
    initFixBot();
    initReSize();
  };

  var aboutUsPage = function() {
    initToggleNav();
    initToggleFormSearch();
    teamSlider();
    commentSlider();
    memberSlider();
    initFixBot();
    initReSize();
  };

  var projectPage = function() {
    initToggleNav();
    initToggleFormSearch();
    commentSlider();
    memberSlider();
    initFixBot();
    scrollListTabs();
    initProjectTab();
    initReSize();
  };

  var projectDetailPage = function() {
    initToggleNav();
    initToggleFormSearch();
    initFixBot();
    projectDetailSlider();
    initGalleryTab();
    initReSize();
    initValidateForm();
  };

  var newsPage = function() {
    initToggleNav();
    initToggleFormSearch();
    initFixBot();
    initReSize();
  };

  var newsDetailPage = function() {
    initToggleNav();
    initToggleFormSearch();
    initFixBot();
    initReSize();
    initValidateForm();
  };

  var contactPage = function() {
    initToggleNav();
    initToggleFormSearch();
    initFixBot();
    initReSize();
    initValidateForm();
  };

  var videoPage = function() {
    initToggleNav();
    initToggleFormSearch();
    initFixBot();
    initReSize();
  };

  var recruitmentPage = function() {
    initToggleNav();
    initToggleFormSearch();
    initFixBot();
    initClickedText();
    initrecruitmentTab();
    initSelectMenu();
    initReSize();
  };

  

  return {
    homePage: homePage,
    aboutUsPage: aboutUsPage,
    projectPage: projectPage,
    projectDetailPage: projectDetailPage,
    newsPage: newsPage,
    newsDetailPage: newsDetailPage,
    contactPage: contactPage,
    videoPage: videoPage,
    recruitmentPage: recruitmentPage,
  };


})(jQuery, window);

jQuery(function() {
	if ($('.home-page').length) {
  	Site.homePage();
	};

  if ($('.about-us-page').length) {
    Site.aboutUsPage();
  };

  if ($('.project-page').length) {
    Site.projectPage();
  };

	if ($('.project-detail').length) {
    Site.projectDetailPage();
  };

  if ($('.news-page').length) {
    Site.newsPage();
  };

  if ($('.news-detail-page').length) {
    Site.newsDetailPage();
  };

  if ($('.contact-page').length) {
    Site.contactPage();
  };

  if ($('.video-page').length) {
    Site.videoPage();
  };

  if ($('.recruitment-page').length) {
    Site.recruitmentPage();
  };
  
});
