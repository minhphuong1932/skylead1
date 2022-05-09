$(document).ready(function(){
 
	//auto add alt in img 
	$('img').each(function () {
		var img = $(this);
		var alt = img.attr("alt");
		if(alt ==  undefined || alt == false) {
			img.attr("alt", "image");
		}
	
	});
   // toggle menu
   $('.header__bar > img').click(function (e) { 
      e.preventDefault();
      $('.header__menu').addClass('header__menu--toggle');
      $('.modal__shadow').addClass('modal__shadow--toggle');
   });
   $('.header__menu > i').click(function (e) { 
      e.preventDefault();
      $('.header__menu').removeClass('header__menu--toggle');
      $('.modal__shadow').removeClass('modal__shadow--toggle');
   });
   $('.modal__shadow').click(function (e) { 
      e.preventDefault();
      $('.header__menu').removeClass('header__menu--toggle');
      $('.modal__shadow').removeClass('modal__shadow--toggle');
   });
   $(".header__list li a").each(function(){
      $(this).click(function (e) { 
         e.preventDefault();
         $('.header__menu').removeClass('header__menu--toggle');
         $('.modal__shadow').removeClass('modal__shadow--toggle');

         if(Number($(this).attr("data-target")) > 2){
            setTimeout(()=>{
               $(".header__logo > img").attr("src", newLogo);
            }, 1000)
         }else{
            setTimeout(()=>{
               $(".header__logo > img").attr("src", currLogo);
            }, 1000)
         }
      });
   })
   // loading
   setTimeout(()=>{
      $('.loading').remove();
        //  load lazy page
      if($(".lazy").length){
         $(".lazy").each(function(){
            $(this).parallax();
         })
      }
      if($(".how__top__block").length){
         $(".how__top__block").addClass("how__top__block--toggle")
      }
      if($(".load-effect").length){
         $(".load-effect").addClass("load-effect--toggle")
      }
   }, 1500);
 
 

// get id how 
   if($(".how").length){
      var url = window.location.href.substr(-3);     
      $(".idCategory").each(function(){
         const x = $(this).val();
         if(x === url){
            setTimeout(()=>{
               $(`#${x}`).parents(".slick-slide")[0].click()
            }, 500)
         }
      })
   }
   if($(".plane").length){
      var url = window.location.href.substr(-7);     
      if(url === "khoahoc"){
         setTimeout(()=>{
            $(".item-4")[0].click()
         })
      }

      $(".khoahoc").click(function (e) { 
         e.preventDefault();
         $(".item-4")[0].click()
      });

   }

// hover shadow plane

if($(".how__duongbang__shadow-plane img").length){
   const overPlane = $("#over-plane").val();
   const outPlane = $("#out-plane").val();
   if(window.innerWidth > 1023){
      $(".how__duongbang__shadow-plane img").each(function(){
         $(this).hover(function () {
               // over
               $(this).attr("src", overPlane);
            }, function () {
               // out
               $(this).attr("src", outPlane);
            }
         );
      })
   }
}
// ---------------------------------------------------------
   var stop2 = null
   var stop = null
   const changeSlideDown = ()=>{
      const down = $('<div class="change-slide change-slide--down"><div class="change-slide--color1"></div><div class="change-slide--color2"></div></div>')
      const stopWheel = $('<div class="stop-wheel"></div>')
      $(".wrapper").append(down);
      $(".wrapper").append(stopWheel);
      setTimeout(()=>{
         down.addClass("change-slide--down--toggle");
         setTimeout(()=>{
            down.remove()
            stopWheel.remove()
         }, 1800)
      }, 100)
   }
   const changeSlideUp = ()=>{
      const up = $('<div class="change-slide change-slide--up"><div class="change-slide--color1"></div><div class="change-slide--color2"></div></div>')
      const stopWheel = $('<div class="stop-wheel"></div>')
      $(".wrapper").append(up);
      $(".wrapper").append(stopWheel);
      setTimeout(()=>{
         up.addClass("change-slide--up--toggle");
         setTimeout(()=>{
            up.remove()
            stopWheel.remove()
         }, 1800)
      }, 100)
   }
   // slider plane
   const sound1 = $(".sound1")[0]
   const sound2 = $(".sound2")[0]

  
   if($(".plane__fly__volume").length){
      setTimeout(()=>{
         var url = window.location.href.substr(-7);     
        
         $(".plane__loading__fly").click(function (e) { 
            e.preventDefault();
            sound2.play()
            sound1.muted = false
            sound2.muted = false
         });
      }, 1000)

      $(".volume--on").click(function (e) { 
         e.preventDefault();
         $(this).removeClass("active");
         $(".volume--mute").addClass("active");

         sound1.muted = true
         sound2.muted = true

         localStorage.setItem("sound", "no")
      });
      $(".volume--mute").click(function (e) { 
         e.preventDefault();
         $(this).removeClass("active");
         $(".volume--on").addClass("active");
         sound2.play()
         sound1.muted = false
         sound2.muted = false

         localStorage.setItem("sound", "yes")
      });
   }

   const newLogo = $("#new-logo").attr("value");
   const currLogo = $(".header__logo > img").attr("src");
   if($(".header__list li a").length){
      $(".header__list li a").addClass("item--black");
   }
   if($('.plane').length){
      if(window.innerWidth < 1024){
         $(".plane__fly__gif").each(function(){
            $(this).attr("src", $(this).data("gifmobile"));
         })
      }
      if($(".plane__fly__video").length){
         $(".plane__fly__video").eq(0)[0].play()
      }
      $('.plane').slick({
         arrows: false,
         vertical: true,
         infinite: false,
         speed: 50,
         swipe: false,
      })
   
      // $('.plane').on
      var stop3 = null
      $('.plane').on("wheel", function(e){
         e.preventDefault()
         if(stop3){
            clearTimeout(stop3)
         }
         stop3 = setTimeout(()=>{
            $(".header__list .active").removeClass("active")
            setTimeout(()=>{
               const x = $(".plane .slick-current .plane-slide").attr("data-slide")
               $(`.item-${x}`).addClass("active")
            }, 1600)
         }, 500)
      })
      
      $('.plane-slide').each(function(){
         if($(this).attr('class').includes('plane__fly')){
            const allItem = $('.plane__fly__ul li')
            const allTheme = $(".plane__fly__block")
            const activeText = {
               "transform": "scale(0.05)",
               "opacity": "0",
               "transition": "all ease-in 0s"
            }
            const fadeText = {
               "transform": "scale(0.0.5)",
               "opacity": "1",
               "transition": "all ease-in 0.3s"
            }
            const flyInText = {
               "transform": "scale(1) translateY(10vh)",
               "transition": "all ease 1.2s",
               "opacity": "1",
            }
            const flyOutText = {
               "transform": "scale(3) translateY(10vh)",
               "opacity": "0",
               "transition": "all linear 0.3s"
            }
            const resetText = {
               "transform": "scale(0)",
               "opacity": "1",
               "transition": "all linear 0.2s"
            }
        
            const flyInPlane = {
               "transform": "scale(0.01)",
               "transition": "all ease-out 7s"
            }
            const flyOutPlane = {
               "transform": "scale(0)",
               "transition": "all linear 0.3s"
            }
            const resetPlane = {
               "transform": "scale(1)",
               "transition": "all linear 0.2s"
            }

            let x = 0
            let y = 0

            allItem.eq(x).css(activeText)
            allTheme.eq(y).find(".plane__fly__video")[0].play()

            let test = 1
            var stop4 = null
            var stopScroll = null
            $(this).on("wheel", function(e){
               if(stop4){
                  clearTimeout(stop4)
               }
               stop4 = setTimeout(()=>{
                  if(e.originalEvent.deltaY > 0){
                     sound1.play()
                     // if(sound2.currentTime === 0){
                     //    sound2.play()
                     // }
                     if(test == 1){
                        test = 3
                        if(stopScroll){
                           clearTimeout(stopScroll)
                        }
                        stopScroll = setTimeout(()=>{
                           allTheme.find(".plane__fly__image").css(resetPlane)
                           allTheme.eq(y).find(".plane__fly__image").css(flyInPlane)
                           setTimeout(()=>{
                              allItem.eq(x).css(fadeText)

                              setTimeout(()=>{
                                 allItem.eq(x).css(flyInText)
                                 setTimeout(()=>{
                                    setTimeout(()=>{
                                       test = 2
                                    }, 1000)
                                 }, 1200)
                              }, 400)
                           }, 500)

                        }, 300)
                     }else if(test == 2){
                        test = 1
                        allItem.eq(x).css(flyOutText)
                        allTheme.eq(y).find(".plane__fly__image").css(flyOutPlane)
                        $(".header__list li a").removeClass("item--black");
                        x++
                        if(x >= allItem.length){
                           setTimeout(()=>{
                              x = allItem.length - 1
                              allItem.css(resetText)
                              allItem.eq(x).css(activeText)

                              allTheme.find(".plane__fly__image").css(resetPlane)
                           }, 1000)
                           changeSlideDown()
                           setTimeout(()=>{
                              $(".plane__fly__block.active > .plane__fly__video")[0].pause()
                           }, 2300)
                           sound2.pause()
                           sound2.currentTime = 0
                           $('.image__zoom').addClass("image__zoom--toggle");
 
                           setTimeout(()=>{
                              $('.plane').slick('slickNext')
                              setTimeout(()=>{
                                 $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                              }, 300)
                           }, 1000)
                        }
                        allItem.eq(x).css(activeText)
                       
                      
                        allTheme.eq(y).removeClass("active")
                        y++
                        if(y >= allTheme.length){
                           y =  allTheme.length - 1
                        }
                        allTheme.eq(y).addClass("active")
                        allTheme.eq(y).find(".plane__fly__video")[0].play()
                        sound1.pause()
                        sound1.currentTime = 0
                     
                        setTimeout(()=>{
                           allTheme.eq(y-1).find(".plane__fly__video")[0].pause()
                        }, 500)
                     }
                  }
                  else{
                     if(x === 1 && test === 1){
                        $(".header__list li a").addClass("item--black");
                     }
                     if(x === 1 && test === 2){
                        setTimeout(()=>{
                           $(".header__list li a").addClass("item--black");
                        }, 500)
                     }
                    if(test === 2 && x === 0 && y === 0){
                        allItem.eq(x).css(resetText)
                        allTheme.eq(y).find(".plane__fly__image").css(resetPlane)
                        test = 1
                    }
                    if(test === 1 && x > 0){
                       x--
                       allItem.eq(x).css(resetText)

                       allTheme.find(".plane__fly__image").css(resetPlane)
                       allTheme.eq(y).removeClass("active")
                       y--
                       if(y < 0){
                          y = 0
                       }
                       allTheme.eq(y).addClass("active")
                       allTheme.eq(y).find(".plane__fly__video")[0].play()
                    
                       setTimeout(()=>{
                        allTheme.eq(y+1).find(".plane__fly__video")[0].pause()
                        }, 500)
                    }
                    if(test === 2 && x !== 0 && y !== 0){
                        allItem.eq(x).css(resetText)
                        x--
                        allItem.eq(x).css(resetText)

                        allTheme.find(".plane__fly__image").css(resetPlane)
                        allTheme.eq(y).removeClass("active")
                        y--
                        if(y < 0){
                           y = 0
                        }
                        allTheme.eq(y).addClass("active")
                        allTheme.eq(y).find(".plane__fly__video")[0].play()
                     
                        setTimeout(()=>{
                           allTheme.eq(y+1).find(".plane__fly__video")[0].pause()
                        }, 500)

                        test = 1
                    }
                  }
               }, 300)
             
            })
           var tsX = 0
           var tsY = 0
           var teX = 0
           var teY = 0
           $(this).bind('touchstart', function (e){
            tsY = e.originalEvent.touches[0].clientY;
            tsX = e.originalEvent.touches[0].clientX;
           });
     
           $(this).bind('touchend', function (e){
            teY = e.originalEvent.changedTouches[0].clientY;
            teX = e.originalEvent.changedTouches[0].clientX;
              if(Math.abs(teX - tsX) < 80 && teY < tsY){
               sound1.play()
               if(sound2.currentTime === 0){
                  sound2.play()
               }
               if(test == 1){
                  test = 3
                  if(stopScroll){
                     clearTimeout(stopScroll)
                  }
                  stopScroll = setTimeout(()=>{
                     allTheme.find(".plane__fly__image").css(resetPlane)
                     allTheme.eq(y).find(".plane__fly__image").css(flyInPlane)
                     setTimeout(()=>{
                        allItem.eq(x).css(fadeText)

                        setTimeout(()=>{
                           allItem.eq(x).css(flyInText)
                           setTimeout(()=>{
                              setTimeout(()=>{
                                 test = 2
                              }, 1000)
                           }, 1200)
                        }, 400)
                     }, 500)

                  }, 300)
               }else if(test == 2){
                  test = 1
                  allItem.eq(x).css(flyOutText)
                  allTheme.eq(y).find(".plane__fly__image").css(flyOutPlane)
                  $(".header__list li a").removeClass("item--black");
                  x++
                  if(x >= allItem.length){
                     setTimeout(()=>{
                        x = allItem.length - 1
                        allItem.css(resetText)
                        allItem.eq(x).css(activeText)

                        allTheme.find(".plane__fly__image").css(resetPlane)
                     }, 1000)

                     changeSlideDown()
                     setTimeout(()=>{
                        $(".plane__fly__block.active > .plane__fly__video")[0].pause()
                     }, 2300)
                     sound2.pause()
                     sound2.currentTime = 0
                     $('.image__zoom').addClass("image__zoom--toggle");

                     setTimeout(()=>{
                        $('.plane').slick('slickNext')
                        setTimeout(()=>{
                           $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        }, 300)
                     }, 1000)
                  }
                  allItem.eq(x).css(activeText)
                 
                
                  allTheme.eq(y).removeClass("active")
                  y++
                  if(y >= allTheme.length){
                     y = allTheme.length - 1
                  }
                  allTheme.eq(y).addClass("active")
                  allTheme.eq(y).find(".plane__fly__video")[0].play()
                  sound1.pause()
                  sound1.currentTime = 0
               
                  setTimeout(()=>{
                     allTheme.eq(y-1).find(".plane__fly__video")[0].pause()
                  }, 500)
               }
                 
              }else if(Math.abs(teX - tsX) < 80 && teY > tsY ){
               if(x === 1 && test === 1){
                  $(".header__list li a").addClass("item--black");
               }
               if(x === 1 && test === 2){
                  setTimeout(()=>{
                     $(".header__list li a").addClass("item--black");
                  }, 500)
               }
               if(test === 2 && x === 0 && y === 0){
                  allItem.eq(x).css(resetText)
                  allTheme.eq(y).find(".plane__fly__image").css(resetPlane)
                  test = 1
              }
              if(test === 1 && x > 0){
                 x--
                 allItem.eq(x).css(resetText)

                 allTheme.find(".plane__fly__image").css(resetPlane)
                 allTheme.eq(y).removeClass("active")
                 y--
                 if(y < 0){
                    y = 0
                 }
                 allTheme.eq(y).addClass("active")
                 allTheme.eq(y).find(".plane__fly__video")[0].play()
              
                 setTimeout(()=>{
                  allTheme.eq(y+1).find(".plane__fly__video")[0].pause()
                  }, 500)
              }
              if(test === 2 && x !== 0 && y !== 0){
                  allItem.eq(x).css(resetText)
                  x--
                  allItem.eq(x).css(resetText)

                  allTheme.find(".plane__fly__image").css(resetPlane)
                  allTheme.eq(y).removeClass("active")
                  y--
                  if(y < 0){
                     y = 0
                  }
                  allTheme.eq(y).addClass("active")
                  allTheme.eq(y).find(".plane__fly__video")[0].play()
               
                  setTimeout(()=>{
                     allTheme.eq(y+1).find(".plane__fly__video")[0].pause()
                  }, 500)

                  test = 1
              }
              }
           });

           $(this).find(".plane__fly__gif").on("click", function(e){
            e.preventDefault()
            $(".header__list li a").removeClass("item--black");
            setTimeout(()=>{
               x = 0
               allItem.css(resetText)
               allItem.eq(x).css(activeText)

               allTheme.find(".plane__fly__image").css(resetPlane)
            }, 1000)

            changeSlideDown()
            setTimeout(()=>{
               $(".plane__fly__block.active > .plane__fly__video")[0].pause()
            }, 2300)
            sound2.pause()
            sound2.currentTime = 0
            sound1.pause()
            sound1.currentTime = 0

            $('.image__zoom').addClass("image__zoom--toggle");

            setTimeout(()=>{
               $('.plane').slick('slickNext')
               setTimeout(()=>{
                  $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
               }, 300)
            }, 1000)

            $(".header__list .active").removeClass("active")
            setTimeout(()=>{
               const x = $(".plane .slick-current .plane-slide").attr("data-slide")
               $(`.item-${x}`).addClass("active")
            }, 1600)
         })

         }else if($(this).attr('class').includes('plane-form__container')){
            $(this).on("wheel", function(e){
               e.preventDefault()
               if(e.originalEvent.deltaY < 0){
                  if(stop){
                     clearTimeout(stop)
                  }
                  stop = setTimeout(()=>{
                     changeSlideUp()
                     $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
                     $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
                     $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");
      
                     setTimeout(() => {
                        $('.plane').slick('slickPrev')
                        setTimeout(()=>{
                           $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                           $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                        }, 300)
                     }, 1000);
                  }, 500)
               }
            })
            var tsX = 0
            var tsY = 0
            var teX = 0
            var teY = 0
            $(this).bind('touchstart', function (e){
               tsY = e.originalEvent.touches[0].clientY;
               tsX = e.originalEvent.touches[0].clientX;
            });
      
            $(this).bind('touchend', function (e){
               teY = e.originalEvent.changedTouches[0].clientY;
               teX = e.originalEvent.changedTouches[0].clientX;
               if(Math.abs(teX - tsX) < 80 && teY > tsY){
                  changeSlideUp()
                  $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
                  $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
                  $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");
   
                  setTimeout(() => {
                     $('.plane').slick('slickPrev')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                     }, 300)
                  }, 1000);
               }
            });
         }else if($(this).attr('class').includes('plane__bottom')){
            $(this).find('.plane__bottom__slide ').on("wheel", function(e){
               e.preventDefault()
               if(stop2){
                  clearTimeout(stop2)
               }
                  stop2 = setTimeout(()=>{
                  $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
                  $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
                  $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
                  $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

                  setTimeout(()=>{
                     $('.image__zoom').removeClass("image__zoom--toggle");

                     setTimeout(()=>{
                        $('.image__zoom').addClass("image__zoom--toggle");
                     }, 1000)
                  }, 1000)
                  
                  if(e.originalEvent.deltaY > 0){
                     changeSlideDown()
                     setTimeout(() => {
                        $('.plane').slick('slickNext')
                        setTimeout(()=>{
                           $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                           $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                           $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                           $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
                        }, 300)
                     }, 1000);
                  }else{
                     changeSlideUp()
                     setTimeout(() => {
                        $('.plane').slick('slickPrev')
                        setTimeout(()=>{
                           $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");

                        }, 300)
                        $(".header__logo > img").attr("src", currLogo);

                     }, 1000);
                  }
               }, 500)
            })
            var tsX = 0
            var tsY = 0
            var teX = 0
            var teY = 0
            $(this).bind('touchstart', function (e){
               tsY = e.originalEvent.touches[0].clientY;
               tsX = e.originalEvent.touches[0].clientX;
            });
      
            $(this).bind('touchend', function (e){
               teY = e.originalEvent.changedTouches[0].clientY;
               teX = e.originalEvent.changedTouches[0].clientX;
              if(Math.abs(teX - tsX) < 80 && teY != tsY){
               $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
               $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
               $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
               $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

               setTimeout(()=>{
                  $('.image__zoom').removeClass("image__zoom--toggle");

                  setTimeout(()=>{
                     $('.image__zoom').addClass("image__zoom--toggle");
                  }, 1000)
               }, 1000)
              }
               if(Math.abs(teX - tsX) < 80 && teY < tsY){
                  changeSlideDown()
                  setTimeout(() => {
                     $('.plane').slick('slickNext')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                        $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
                     }, 300)
                  }, 1000);
               }else if(Math.abs(teX - tsX) < 80 && teY > tsY){
                  changeSlideUp()
                  setTimeout(() => {
                     $('.plane').slick('slickPrev')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                     }, 300)
                     $(".header__logo > img").attr("src", currLogo);
                  }, 1000);
               }
            });
            $(this).find(".plane__fly__gif").on("click", function(e){
               e.preventDefault()
               $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
               $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
               $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
               $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

               setTimeout(()=>{
                  $('.image__zoom').removeClass("image__zoom--toggle");

                  setTimeout(()=>{
                     $('.image__zoom').addClass("image__zoom--toggle");
                  }, 1000)
               }, 1000)

               changeSlideDown()
               setTimeout(() => {
                  $('.plane').slick('slickNext')
                  setTimeout(()=>{
                     $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                     $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                     $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                     $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
                  }, 300)
               }, 1000);

               $(".header__list .active").removeClass("active")
               setTimeout(()=>{
                  const x = $(".plane .slick-current .plane-slide").attr("data-slide")
                  $(`.item-${x}`).addClass("active")
               }, 1600)
            })

         }else if($(this).attr('class').includes('scroll-1')){
            $(this).on("wheel", function(e){
               e.preventDefault()
               if(stop2){
                  clearTimeout(stop2)
               }
                  stop2 = setTimeout(()=>{
                  $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
                  $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
                  $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
                  $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

                  $(this).find(".plane__video__popup__icon").eq(0).click();
                  setTimeout(()=>{
                     $('.image__zoom').removeClass("image__zoom--toggle");

                     setTimeout(()=>{
                        $('.image__zoom').addClass("image__zoom--toggle");
                     }, 1000)
                  }, 1000)
                  
                  if(e.originalEvent.deltaY > 0){
                     changeSlideDown()
                     setTimeout(() => {
                        $('.plane').slick('slickNext')
                        setTimeout(()=>{
                           $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                           $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                           $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                           $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
                        }, 300)
                      
                     }, 1000);
                  }else{
                     changeSlideUp()
                     setTimeout(()=>{
                        $(".plane__fly__block.active > .plane__fly__video")[0].play()
                     }, 1000)
                     setTimeout(() => {
                        $('.plane').slick('slickPrev')
                        setTimeout(()=>{
                           $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        }, 300)
                        if($(".slick-current .plane__fly").length){
                           sound2.play()
                        }

                        const allTheme = $(".plane__fly__block")
                        allTheme.each(function(inx){
                           if($(this).attr("class").includes("active")){
                              if(inx === 0){
                                 $(".header__list li a").addClass("item--black");
                              }
                           }
                        })
                     }, 1000);
                  }
               }, 500)
            })
            var tsX = 0
            var tsY = 0
            var teX = 0
            var teY = 0
            $(this).bind('touchstart', function (e){
               tsY = e.originalEvent.touches[0].clientY;
               tsX = e.originalEvent.touches[0].clientX;
            });
      
            $(this).bind('touchend', function (e){
               teY = e.originalEvent.changedTouches[0].clientY;
               teX = e.originalEvent.changedTouches[0].clientX;

              if(Math.abs(teX - tsX) < 80 && teY != tsY){
               $(this).parents(".plane__video").find(".plane__video__popup__icon").eq(0).click();
               $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
               $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
               $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
               $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");
               $(this).find(".plane__video__popup__icon").eq(0).click();

               setTimeout(()=>{
                  $('.image__zoom').removeClass("image__zoom--toggle");
                  setTimeout(()=>{
                     $('.image__zoom').addClass("image__zoom--toggle");
                  }, 1000)
               }, 1000)
              }
               if(Math.abs(teX - tsX) < 80 && teY < tsY){
                  changeSlideDown()
                  setTimeout(() => {
                     $('.plane').slick('slickNext')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                        $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
                     }, 300)
                  }, 1000);
               }else if(Math.abs(teX - tsX) < 80 && teY > tsY){
                  changeSlideUp()
                  setTimeout(()=>{
                     $(".plane__fly__block.active > .plane__fly__video")[0].play()
                  }, 1000)
                  setTimeout(() => {
                     $('.plane').slick('slickPrev')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                     }, 300)
                     if($(".slick-current .plane__fly").length){
                        sound2.play()
                     }
                     const allTheme = $(".plane__fly__block")
                     allTheme.each(function(inx){
                        if($(this).attr("class").includes("active")){
                           if(inx === 0){
                              $(".header__list li a").addClass("item--black");
                           }
                        }
                     })
                  }, 1000);
               }
            });
            $(this).find(".plane__fly__gif").on("click", function(e){
               e.preventDefault()

               $(this).parents(".plane__video").find(".plane__video__popup__icon").eq(0).click();
              
               $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
               $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
               $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
               $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");
               setTimeout(()=>{
                  $('.image__zoom').removeClass("image__zoom--toggle");

                  setTimeout(()=>{
                     $('.image__zoom').addClass("image__zoom--toggle");
                  }, 1000)
               }, 1000)

               changeSlideDown()
                  setTimeout(() => {
                     $('.plane').slick('slickNext')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                        $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
                     }, 300)
                  }, 1000);
                  $(".header__list .active").removeClass("active")
                  setTimeout(()=>{
                     const x = $(".plane .slick-current .plane-slide").attr("data-slide")
                     $(`.item-${x}`).addClass("active")
                  }, 1600)
            })
         }else if($(this).attr('class').includes('scroll-2')){
            $(this).on("wheel", function(e){
               e.preventDefault()
               if(stop2){
                  clearTimeout(stop2)
               }
                  stop2 = setTimeout(()=>{
                  $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
                  $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
                  $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
                  $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

                  $(this).find(".plane__video__popup__icon").eq(0).click();
                  setTimeout(()=>{
                     $('.image__zoom').removeClass("image__zoom--toggle");

                     setTimeout(()=>{
                        $('.image__zoom').addClass("image__zoom--toggle");
                     }, 1000)
                  }, 1000)
                  
                  if(e.originalEvent.deltaY > 0){
                     changeSlideDown()
                     setTimeout(() => {
                        $('.plane').slick('slickNext')
                        setTimeout(()=>{
                           $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                           $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                           $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                           $(".plane .slick-current .plane-form").addClass("plane-form--toggle");

                           $(".header__logo > img").attr("src", newLogo);
                        }, 300)
                      
                     }, 1000);
                  }else{
                     changeSlideUp()
                     
                     setTimeout(() => {
                        $('.plane').slick('slickPrev')
                        setTimeout(()=>{
                           $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        }, 300)
                       
                     }, 1000);
                  }
               }, 500)
            })
            var tsX = 0
            var tsY = 0
            var teX = 0
            var teY = 0
            $(this).bind('touchstart', function (e){
               tsY = e.originalEvent.touches[0].clientY;
               tsX = e.originalEvent.touches[0].clientX;
            });
      
            $(this).bind('touchend', function (e){
               teY = e.originalEvent.changedTouches[0].clientY;
               teX = e.originalEvent.changedTouches[0].clientX;
              if(Math.abs(teX - tsX) < 80 && teY != tsY){
               $(this).parents(".plane__video").find(".plane__video__popup__icon").eq(0).click();
               $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
               $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
               $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
               $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

               $(this).find(".plane__video__popup__icon").eq(0).click();

               setTimeout(()=>{
                  $('.image__zoom').removeClass("image__zoom--toggle");

                  setTimeout(()=>{
                     $('.image__zoom').addClass("image__zoom--toggle");
                  }, 1000)
               }, 1000)
              }
               if(Math.abs(teX - tsX) < 80 && teY < tsY){
                  changeSlideDown()
                  setTimeout(() => {
                     $('.plane').slick('slickNext')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                        $(".plane .slick-current .plane-form").addClass("plane-form--toggle");

                        $(".header__logo > img").attr("src", newLogo);

                     }, 300)
                  }, 1000);
               }else if(Math.abs(teX - tsX) < 80 && teY > tsY){
                  changeSlideUp()
                  setTimeout(() => {
                     $('.plane').slick('slickPrev')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                     }, 300)
                  }, 1000);
               }
            });

              $(this).find(".plane__fly__gif").on("click", function(e){
               e.preventDefault()
               $(this).parents(".plane__video").find(".plane__video__popup__icon").eq(0).click();

               $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
               $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
               $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
               $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

               setTimeout(()=>{
                  $('.image__zoom').removeClass("image__zoom--toggle");

                  setTimeout(()=>{
                     $('.image__zoom').addClass("image__zoom--toggle");
                  }, 1000)
               }, 1000)

               changeSlideDown()
                  setTimeout(() => {
                     $('.plane').slick('slickNext')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                        $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
                     }, 300)
                  }, 1000);
                  $(".header__list .active").removeClass("active")
                  setTimeout(()=>{
                     const x = $(".plane .slick-current .plane-slide").attr("data-slide")
                     $(`.item-${x}`).addClass("active")
                  }, 1600)
            })

         }
         else{
            $(this).on("wheel", function(e){
               e.preventDefault()
               if(stop2){
                  clearTimeout(stop2)
               }
                  stop2 = setTimeout(()=>{
                  $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
                  $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
                  $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
                  $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

                  setTimeout(()=>{
                     $('.image__zoom').removeClass("image__zoom--toggle");

                     setTimeout(()=>{
                        $('.image__zoom').addClass("image__zoom--toggle");
                     }, 1000)
                  }, 1000)
                  
                  if(e.originalEvent.deltaY > 0){
                     changeSlideDown()
                     setTimeout(() => {
                        $('.plane').slick('slickNext')
                        setTimeout(()=>{
                           $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                           $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                           $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                           $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
                        }, 300)
                      
                     }, 1000);
                  }else{
                     changeSlideUp()
                     setTimeout(() => {
                        $('.plane').slick('slickPrev')
                        setTimeout(()=>{
                           $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        }, 300)
                       
                     }, 1000);
                  }
               }, 500)

               
            })
            var tsX = 0
            var tsY = 0
            var teX = 0
            var teY = 0
            $(this).bind('touchstart', function (e){
               tsY = e.originalEvent.touches[0].clientY;
               tsX = e.originalEvent.touches[0].clientX;
            });
      
            $(this).bind('touchend', function (e){
               teY = e.originalEvent.changedTouches[0].clientY;
               teX = e.originalEvent.changedTouches[0].clientX;
              if(Math.abs(teX - tsX) < 80 && teY != tsY){
               $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
               $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
               $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
               $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

               setTimeout(()=>{
                  $('.image__zoom').removeClass("image__zoom--toggle");

                  setTimeout(()=>{
                     $('.image__zoom').addClass("image__zoom--toggle");
                  }, 1000)
               }, 1000)
              }
               if(Math.abs(teX - tsX) < 80 && teY < tsY){
                  changeSlideDown()
                  setTimeout(() => {
                     $('.plane').slick('slickNext')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                        $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
                     }, 300)
                  }, 1000);
               }else if(Math.abs(teX - tsX) < 80 && teY > tsY){
                  changeSlideUp()
                  setTimeout(() => {
                     $('.plane').slick('slickPrev')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                     }, 300)
                  }, 1000);
               }
            });

              $(this).find(".plane__fly__gif").on("click", function(e){
               e.preventDefault()
               $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
               $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
               $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
               $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

               setTimeout(()=>{
                  $('.image__zoom').removeClass("image__zoom--toggle");

                  setTimeout(()=>{
                     $('.image__zoom').addClass("image__zoom--toggle");
                  }, 1000)
               }, 1000)

               changeSlideDown()
                  setTimeout(() => {
                     $('.plane').slick('slickNext')
                     setTimeout(()=>{
                        $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
                        $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
                        $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
                     }, 300)
                  }, 1000);
                  $(".header__list .active").removeClass("active")
                  setTimeout(()=>{
                     const x = $(".plane .slick-current .plane-slide").attr("data-slide")
                     $(`.item-${x}`).addClass("active")
                  }, 1600)
            })

         }
      })
   }
   // slick
if($('.plane__bottom__slider').length){
   $('.plane__bottom__slider').slick({
      slidesToShow: 1,
      arrows: false,
      fade: true,
    });
    $('.plane__bottom__nav').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      asNavFor: '.plane__bottom__slider',
      focusOnSelect: true,
      nextArrow: '<button class="slide-arrow next-arrow"><i class="fas fa-arrow-circle-right"></i></button>',
      swipeToSlide: true,
      responsive: [
         {
           breakpoint: 739,
           settings: {
             slidesToShow: 2,
           }
         },
      ]
    });
    $(".plane__bottom__nav .slick-slide").each(function(){
       $(this).click(function (e) {
          e.preventDefault()
            $(".plane__bottom__slider .slick-current .plane__bottom__slide__block").addClass("plane__bottom__slide__block--toggle");
            setTimeout(()=>{
               $(".plane__bottom__slider .slick-current .plane__bottom__slide__block").removeClass("plane__bottom__slide__block--toggle");
            }, 500)
       });
    })
    $(".plane__bottom__nav .next-arrow").click(function(e){
      $(".plane__bottom__slider .slick-current .plane__bottom__slide__block").addClass("plane__bottom__slide__block--toggle");
      setTimeout(()=>{
         $(".plane__bottom__slider .slick-current .plane__bottom__slide__block").removeClass("plane__bottom__slide__block--toggle");
      }, 500)
    })
}

//   form
if($('.plane-form').length){
   $('.plane-form__group label').each(function(){
      $(this).click(function (e) { 
         e.preventDefault();
         $('.plane-form__popup--toggle').removeClass('plane-form__popup--toggle');
         $(this).parents('.plane-form__group').find('.plane-form__popup').addClass('plane-form__popup--toggle');
         $(this).parents('.plane-form__group').find('.plane-form__popup').find("input").focus()
      });
    })
}
// slick about
if($('.about__slider')){
   $('.about__slider').slick({
      arrows: false,
      dots: true,
      autoplay: true,
      autoplaySpeed: 4000,
      speed: 1750,
      pauseOnHover: false,
      infinite: false,
      adaptiveHeight: true
   })
}
// slick bottom
if($('.about__bot').length){
   if($('.about__bot__image').length <= 11){
      $('.about__bot').slick({
         arrows: false,
         slidesToShow: 6,
         speed: 1000,
         swipeToSlide: true,
         responsive: [
            {
              breakpoint: 739,
              settings: {
                slidesToShow: 2,
              }
            },
         ]
      })
   }else if($('.about__bot__image').length <= 17){
      $('.about__bot').slick({
         arrows: false,
         rows: 2,
         slidesToShow: 6,
         speed: 1000,
         swipeToSlide: true,
         responsive: [
            {
              breakpoint: 739,
              settings: {
                slidesToShow: 2,
              }
            },
         ]
      })
   }else{
      $('.about__bot').slick({
         arrows: false,
         rows: 3,
         slidesToShow: 6,
         speed: 1000,
         swipeToSlide: true,
         responsive: [
            {
              breakpoint: 739,
              settings: {
                slidesToShow: 2,
              }
            },
         ]
      })
   }
   setInterval(()=>{
      $('.about__bot').slick('slickNext')
   }, 1000)
}
if(window.innerWidth > 1023){
   $('.how__bot__item').each(function(){
      $(this).hover(function () {
            // over
            $(this).find('.how__bot__item__hover').addClass('how__bot__item__hover--toggle');
            $(this).find(".how__bot__item__icon").addClass('how__bot__item__icon--toggle');
            $(this).addClass('how__bot__item--toggle');
         }, function () {
            // out
            $(this).find('.how__bot__item__hover').removeClass('how__bot__item__hover--toggle');
            $(this).find(".how__bot__item__icon").removeClass('how__bot__item__icon--toggle');
            $(this).removeClass('how__bot__item--toggle');
         }
      );
   })
}else{
   $(".how__bot__item__icon").each(function(){
      $(this).click(function (e) { 
         e.preventDefault();
         $(this).parents(".how__bot__item").find('.how__bot__item__hover').addClass('how__bot__item__hover--toggle');
         $(this).addClass('how__bot__item__icon--toggle');
         $(this).parents(".how__bot__item").addClass('how__bot__item--toggle');
      });
   })

   $(".how__bot__item__icon--back").each(function(){
      $(this).click(function (e) { 
         e.preventDefault();
         $(this).parents(".how__bot__item").find('.how__bot__item__hover').removeClass('how__bot__item__hover--toggle');
         $(this).parents(".how__bot__item").find('.how__bot__item__icon').removeClass('how__bot__item__icon--toggle');
         $(this).parents(".how__bot__item").removeClass('how__bot__item--toggle');
      });
   })

   $('.plane__fly__item img').each(function(){
      const mobile = $(this).data("mobile");
      $(this).attr("src", mobile);
   })


   // var hieghtOld = window.innerHeight
   // $(window).resize(function () {
   //    const x = window.location.href
   //    if(x.includes("index") || x.includes("conduongtrothanhphicong")){
   //       if(window.innerHeight !== hieghtOld){
   //          location.reload()
   //          hieghtOld = window.innerHeight
   //       }
   //    }
   // });
}
// slick news
if($('.news__slider1').length){
   $('.news__slider1__for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
      asNavFor: '.news__slider1__nav'
    });
    $('.news__slider1__nav').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      asNavFor: '.news__slider1__for',
      dots: true,
      arrows: false,
    });
}
// slick news
if($('.news__slider2').length){
   $('.news__slider2__for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
      asNavFor: '.news__slider2__nav'
    });
    $('.news__slider2__nav').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      asNavFor: '.news__slider2__for',
      dots: true,
      arrows: false,
    });
}
// hover detail plane
if($('.detail-plane').length){
   $('.detail-plane__block').each(function(){
      $(this).hover(function () {
            // over
            $(this).find('.detail-plane__body').addClass('detail-plane__body--toggle');
            $(this).find('.detail-plane__nav').addClass('detail-plane__nav--toggle');
         }, function () {
            // out
            $(this).find('.detail-plane__body').removeClass('detail-plane__body--toggle');
            $(this).find('.detail-plane__nav').removeClass('detail-plane__nav--toggle');

         }
      );
   })
}
// hover play video
if($('.video__item').length){
   $(".video__item__link").each(function(){
      const link = $(this).data("link")
      const x = `https://i.ytimg.com/vi/${link}/maxresdefault.jpg`
      $(this).find("img").attr("src", x)
   })
   $('.video__item').each(function(){
      $(this).click(function (e) { 
         e.preventDefault();
         $('.video--main').addClass('video--main--toggle');
         $('.video--extra').addClass('video--extra--toggle');
         const link = $(this).find(".video__item__link").data("link")
         playThisVideo(link)
        

         const titleVideo = $(this).find(".video__item__title").text()
         const contentVideo =  $(this).find(".video__item__content").text()
         $(".detail-video__current__title").text(titleVideo);
         $(".detail-video__current__content").text(contentVideo);

         const x =  $(".news__cover").height();
         var body = $("html, body");
         body.animate({scrollTop: x}, 0);
      });

   })
}
// hover play video detail video
if($('.detail-video__list').length){
   $(".detail-video__image").each(function(){
      const link = $(this).data("link")
      const x = `https://i.ytimg.com/vi/${link}/maxresdefault.jpg`
      $(this).find("img").attr("src", x)
   })

   $('.detail-video__item').each(function(){
      $(this).click(function (e) { 
         e.preventDefault();
         const link = $(this).find(".detail-video__image").data("link")
        
         playThisVideo(link)

         const titleVideo = $(this).find(".detail-video__title").text()
         const contentVideo =  $(this).find(".detail-video__content").text()
         $(".detail-video__current__title").text(titleVideo);
         $(".detail-video__current__content").text(contentVideo);

         const x =  $(".news__cover").height();
         var body = $("html, body");
         body.animate({scrollTop: x}, 0);
      });
   })
}
if($(".plane__video__popup").length){
   let test = 1
   $(".plane__video__play").each(function(inx){
      $(this).click(function (e) { 
         e.preventDefault();
            $(this).parents(".plane__video__popup").addClass("plane__video__popup--zoom");
            $(this).parents(".plane__video__popup").find(".plane__video__popup__icon").addClass("plane__video__popup__icon--toggle");
            $(".header").addClass("header--toggle");
            $(".plane__video__link").addClass("plane__video__link--toggle");
            setTimeout(()=>{
               $(this).parents(".plane__video__popup").find("iframe").addClass("active")
            }, 1000)
            if(inx === 0){
               const link = $(this).data("link");
               playThisPopup1(link)
            }else{
               const link = $(this).data("link");
               playThisPopup2(link)
            }
            if(test === 1){
               test = 2
            }
      });
   })
   $(".plane__video__popup__icon").each(function(inx){
      $(this).click(function (e) { 
         e.preventDefault();
         $(".plane__video__popup--zoom").removeClass("plane__video__popup--zoom");
         $(".plane__video__popup__icon--toggle").removeClass("plane__video__popup__icon--toggle");
         $(".header").removeClass("header--toggle");

         $(this).parents(".plane__video__popup").find("iframe").removeClass("active")
         setTimeout(()=>{
            $(".plane__video__link").removeClass("plane__video__link--toggle");
         }, 1000)
         if(test === 2){
            if(inx === 0){

               stopVideo1()
            }else{
               stopVideo2()
            }
            test = 1
         }
      });
   })

}
// click link khoa hoc
if($(".plane__bottom__item__title").length){
   $(".plane__bottom__item__title").each((inx, cur)=>{
      $(cur).click(function (e) { 
         e.stopPropagation();
      });
   })
}
// scroll 
if($(".header__list li a").length){
   // const menu1 = $(".header__list").eq(0).clone();
   // const menu2 = $(".header__list").eq(1).clone();
   // $(".header__menu ul").after(menu1, menu2);

   // if(window.innerWidth < 1024){
   //    $(".header > .header__list").remove()
   // }
   let max = 0
    $('.header__list a').on('click', function(e){
      e.preventDefault();

      sound2.pause()
      sound2.currentTime = 0
      sound1.pause()
      sound1.currentTime = 0
      $(".header__menu i")[0].click()
      $(".header__list .active").removeClass("active");


      var targetSlide = $(this).data('target');
      $('.header__list a').each(function(){
         if($(this).data('target') === targetSlide){
            $(this).addClass("active")
            return false
         }
      })
      if(targetSlide > max){
         max = targetSlide
         changeSlideDown()
      }else{
         changeSlideUp()
         max = targetSlide
      }
      $(".plane .slick-current .plane__video__popup--toggle").removeClass("plane__video__popup--toggle");
      $(".plane .slick-current .plane__bottom .plane__bottom__slide__block--zoom").removeClass("plane__bottom__slide__block--zoom");
      $(".plane .slick-current .plane__bottom .plane__bottom__nav--toggle").removeClass("plane__bottom__nav--toggle");
      $(".plane .slick-current .plane-form--toggle").removeClass("plane-form--toggle");

      $(".header__list li a").removeClass("item--black");
      setTimeout(()=>{
         $('.image__zoom').removeClass("image__zoom--toggle");

         setTimeout(()=>{
            $('.image__zoom').addClass("image__zoom--toggle");
         }, 1000)
      }, 1000)
      setTimeout(()=>{
         $('.plane').slick('slickGoTo', targetSlide );

         setTimeout(()=>{
            $(".plane .slick-current .plane__video__popup").addClass("plane__video__popup--toggle");
            $(".plane .slick-current .plane__bottom .plane__bottom__nav").addClass("plane__bottom__nav--toggle");
            $(".plane .slick-current .plane__bottom .plane__bottom__slide__block").addClass("plane__bottom__slide__block--zoom");
            $(".plane .slick-current .plane-form").addClass("plane-form--toggle");
         }, 300)
      }, 1000)
    });//click()
}
// about__bot__image
if($('.about__bot__image').length){
   $(".about__bot__image").each(function(){
      $(this).parent().height($(this).height())
      $(this).hover(function () {
            // over
            $(this).find(".about__bot__image__modal").addClass('about__bot__image__modal--toggle');
            $(this).find(".about__bot__image__body").addClass('about__bot__image__body--toggle');
         }, function () {
            // out
            $(this).find(".about__bot__image__modal").removeClass('about__bot__image__modal--toggle');
            $(this).find(".about__bot__image__body").removeClass('about__bot__image__body--toggle');
         }
      );
   })
}

// plane-slide plane__fly
// if($('.plane-slide').length){
//    $(".plane-slide").each(function(){
//       $(this).parent().height($(this).height())
//    })
// }
// click open popup form
if($('.about__slider__popup').length){
   $('.about__slider__link').click(function (e) { 
      e.preventDefault();
      if(!$(this).attr("class").includes("no-popup-form")){
         $('.about__slider__popup').addClass('about__slider__popup--toggle');
      }
   });
   $('.about__slider__popup > i').click(function (e) { 
      e.preventDefault();
      $('.about__slider__popup').removeClass('about__slider__popup--toggle');
   });
}

// // click shadow plane move on
if($(".how__slider").length){
   $(".how__slider").slick({
      arrows: false,
      vertical: true,
      verticalSwiping: false,
      speed: 800,
      cssEase: "ease-in-out",
      infinite: false,
      asNavFor: '.how__duongbang__all',
      swipe: false,

   })
   $(".how__slider").on("wheel", function(e){
      e.preventDefault()
      if($(".how__slider .slick-current .how__slide__left").length){
         $(".how__slider .slick-current .how__slide__left").removeClass('how__slide__left--toggle')
         $(".how__slider .slick-current .how__slide__right").removeClass('how__slide__right--toggle')
      }
      if($(".how__slider .slick-current .how__contact__block").length){
         $(".how__slider .slick-current .how__contact__block").removeClass('how__contact__block--toggle')
      }
    
      if($(".how__top__block").length){
         $(".how__top__block").removeClass("how__top__block--toggle")
      }
      if($(".how__slider .slick-current .image__zoom").length){
         $(".how__slider .slick-current .image__zoom").removeClass('image__zoom--toggle')
      }
      if(e.originalEvent.deltaY > 0){
         $(this).slick("slickNext")
         $(".how__duongbang__all  .slick-slide").each(function(inx){
            if($(this).attr("class").includes("slick-current")){
               const b = (inx) * 9
               $('.how__duongbang__plane').css('top', `calc(18% + ${b}%)`)

               const title = $(".how__slider .slick-current .how__title").text()
               $(".how__duongbang__plane span").text(title);

               setTimeout(()=>{
                  if($(".how__slider .slick-current .how__slide__left").length){
                     $(".how__slider .slick-current .how__slide__left").addClass('how__slide__left--toggle')
                     $(".how__slider .slick-current .how__slide__right").addClass('how__slide__right--toggle')
                  }
                  if($(".how__slider .slick-current .how__contact__block").length){
                     $(".how__slider .slick-current .how__contact__block").addClass('how__contact__block--toggle')
                  }
                  if($(".how__top__block").length){
                     $(".how__top__block").addClass("how__top__block--toggle")
                  }
                  if($(".how__slider .slick-current .image__zoom").length){
                     $(".how__slider .slick-current .image__zoom").addClass('image__zoom--toggle')
                  }
            
               }, 800)
            }
         })
      }else{
         $(this).slick("slickPrev")
         $(".how__duongbang__all  .slick-slide").each(function(inx){
            if($(this).attr("class").includes("slick-current")){
               const b = (inx) * 9

               $('.how__duongbang__plane').css('top', `calc(18% + ${b}%)`)

               const title = $(".how__slider .slick-current .how__title").text()
               $(".how__duongbang__plane span").text(title);

               setTimeout(()=>{
                  if($(".how__slider .slick-current .how__slide__left").length){
                     $(".how__slider .slick-current .how__slide__left").addClass('how__slide__left--toggle')
                     $(".how__slider .slick-current .how__slide__right").addClass('how__slide__right--toggle')
                  }
                  if($(".how__slider .slick-current .how__contact__block").length){
                     $(".how__slider .slick-current .how__contact__block").addClass('how__contact__block--toggle')
                  }
                  if($(".how__top__block").length){
                     $(".how__top__block").addClass("how__top__block--toggle")
                  }
                  if($(".how__slider .slick-current .image__zoom").length){
                     $(".how__slider .slick-current .image__zoom").addClass('image__zoom--toggle')
                  }
               }, 800)
            }
         })
      }
   })
   var tsX = 0
   var tsY = 0
   var teX = 0
   var teY = 0
   $(".how__slider").bind('touchstart', function (e){
      tsY = e.originalEvent.touches[0].clientY;
      tsX = e.originalEvent.touches[0].clientX;
   });

   $(".how__slider").bind('touchend', function (e){
      teY = e.originalEvent.changedTouches[0].clientY;
      teX = e.originalEvent.changedTouches[0].clientX;
      if(Math.abs(teX - tsX) < 80 && teY != tsY){
         if($(".how__slider .slick-current .how__slide__left").length){
            $(".how__slider .slick-current .how__slide__left").removeClass('how__slide__left--toggle')
            $(".how__slider .slick-current .how__slide__right").removeClass('how__slide__right--toggle')
         }
         if($(".how__slider .slick-current .how__contact__block").length){
            $(".how__slider .slick-current .how__contact__block").removeClass('how__contact__block--toggle')
         }
         if($(".how__top__block").length){
            $(".how__top__block").removeClass("how__top__block--toggle")
         }
         if($(".how__slider .slick-current .image__zoom").length){
            $(".how__slider .slick-current .image__zoom").removeClass('image__zoom--toggle')
         }
      }
      if(Math.abs(teX - tsX) < 80 && teY > tsY){
         $(this).slick("slickPrev")
         $(".how__duongbang__all  .slick-slide").each(function(inx){
            if($(this).attr("class").includes("slick-current")){
               const b = (inx) * 9

               $('.how__duongbang__plane').css('top', `calc(18% + ${b}%)`)

               const title = $(".how__slider .slick-current .how__title").text()
               $(".how__duongbang__plane span").text(title);

               setTimeout(()=>{
                  if($(".how__slider .slick-current .how__slide__left").length){
                     $(".how__slider .slick-current .how__slide__left").addClass('how__slide__left--toggle')
                     $(".how__slider .slick-current .how__slide__right").addClass('how__slide__right--toggle')
                  }
                  if($(".how__slider .slick-current .how__contact__block").length){
                     $(".how__slider .slick-current .how__contact__block").addClass('how__contact__block--toggle')
                  }
                  if($(".how__top__block").length){
                     $(".how__top__block").addClass("how__top__block--toggle")
                  }
                  if($(".how__slider .slick-current .image__zoom").length){
                     $(".how__slider .slick-current .image__zoom").addClass('image__zoom--toggle')
                  }
               }, 800)
            }
         })
      }else if(Math.abs(teX - tsX) < 80 && teY < tsY){
         $(this).slick("slickNext")
         $(".how__duongbang__all  .slick-slide").each(function(inx){
            if($(this).attr("class").includes("slick-current")){
               const b = (inx) * 9
               $('.how__duongbang__plane').css('top', `calc(18% + ${b}%)`)

               const title = $(".how__slider .slick-current .how__title").text()
               $(".how__duongbang__plane span").text(title);

               setTimeout(()=>{
                  if($(".how__slider .slick-current .how__slide__left").length){
                     $(".how__slider .slick-current .how__slide__left").addClass('how__slide__left--toggle')
                     $(".how__slider .slick-current .how__slide__right").addClass('how__slide__right--toggle')
                  }
                  if($(".how__slider .slick-current .how__contact__block").length){
                     $(".how__slider .slick-current .how__contact__block").addClass('how__contact__block--toggle')
                  }
                  if($(".how__top__block").length){
                     $(".how__top__block").addClass("how__top__block--toggle")
                  }
                  if($(".how__slider .slick-current .image__zoom").length){
                     $(".how__slider .slick-current .image__zoom").addClass('image__zoom--toggle')
                  }
               }, 800)
            }
         })
      }
   });
   $(".how__duongbang__all").slick({
      arrows: false,
      vertical: true,
      infinite: false,
      slidesToShow: 6,
      asNavFor: '.how__slider',
      focusOnSelect: true
   })
   $(".how__duongbang__all .slick-slide").each(function(inx){
      $(this).click(function () { 
         if($(".how__slider .slick-current .how__slide__left").length){
            $(".how__slider .slick-current .how__slide__left").removeClass('how__slide__left--toggle')
            $(".how__slider .slick-current .how__slide__right").removeClass('how__slide__right--toggle')
         }
         if($(".how__slider .slick-current .how__contact__block").length){
            $(".how__slider .slick-current .how__contact__block").removeClass('how__contact__block--toggle')
         }
         if($(".how__top__block").length){
            $(".how__top__block").removeClass("how__top__block--toggle")
         } 
         if($(".how__slider .slick-current .image__zoom").length){
            $(".how__slider .slick-current .image__zoom").removeClass('image__zoom--toggle')
         }
         const b = (inx) * 9
            $('.how__duongbang__plane').css('top', `calc(18% + ${b}%)`)

            const title = $(".how__slider .slick-current .how__title").text()
            $(".how__duongbang__plane span").text(title);

            setTimeout(()=>{
               if($(".how__slider .slick-current .how__slide__left").length){
                  $(".how__slider .slick-current .how__slide__left").addClass('how__slide__left--toggle')
                  $(".how__slider .slick-current .how__slide__right").addClass('how__slide__right--toggle')
               }
               if($(".how__slider .slick-current .how__contact__block").length){
                  $(".how__slider .slick-current .how__contact__block").addClass('how__contact__block--toggle')
               }
               if($(".how__top__block").length){
                  $(".how__top__block").addClass("how__top__block--toggle")
               }
               if($(".how__slider .slick-current .image__zoom").length){
                  $(".how__slider .slick-current .image__zoom").addClass('image__zoom--toggle')
               }
            }, 800)
      });
   })
}
//   set video
if($(".set-video").length){
   if(window.innerWidth > 739){
      $(".set-video").each(function(){
         if(window.innerHeight > $(this).height()){
            $(this).height(window.innerHeight)
            $(this).css("width", "auto");
   
            setTimeout(()=>{
               if(window.innerWidth > $(this).width()){
                  $(this).width(window.innerWidth)
                  $(this).css("height", "auto");
               }
            }, 300)
         }
      })
   }
 
}

window.addEventListener("orientationchange", function() {
  location.reload();
}, false);

$( window ).resize(function() {
   if(window.innerWidth > 1023){
      location.reload()
   }
 });




   
})

// notistack
function notiStack(status, message){
   const container = $('.noti-stack')
   if(status === "success"){
      var content = {
         icon: '<i class="fas fa-check-circle"></i>',
         message
      }
      container.append(`<div class="noti-stack__item noti-stack__success">${content.icon}<span>${message}</span></div>`);
   }else if(status === "failed"){
      var content = {
         icon: ' <i class="fas fa-exclamation-circle"></i>',
         message
      }
      container.append(`<div class="noti-stack__item noti-stack__failed">${content.icon}<span>${message}</span></div>`);
   }else{
      var content = {
         icon: '<i class="fas fa-check-circle"></i>',
         message
      }
      container.append(`<div class="noti-stack__item noti-stack__success">${content.icon}<span>${message}</span></div>`);
   }
   const length = container.children().length - 1
   setTimeout(()=>{
      container.children().eq(length).addClass('noti-stack__item--toggle')
   }, 300)
   setTimeout(()=>{
         $('.noti-stack__item').eq(0).removeClass('noti-stack__item--toggle')
         setTimeout(()=>{
            $('.noti-stack__item').eq(0).remove()
         }, 500)
   }, 3000)
 
}

window.addEventListener("load", function(){
   this.localStorage.removeItem("save")
})
// video 
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
function onPlayerReady(event) {
  event.target.playVideo();
}
var player;
// play
function playThisVideo(vidid) {
  if(player){
    player.destroy()
  }
  player = new YT.Player('detail-video__player', {
    videoId: vidid,
    events: {
      'onReady': onPlayerReady,
    }
  });
}

var playerPopup1;
function playThisPopup1(vidid) {
   if(playerPopup1){
      playerPopup1.destroy()
   }
   playerPopup1 = new YT.Player('plane__video__popup-player1', {
     videoId: vidid,
     events: {
       'onReady': onPlayerReady,
     }
   });
 }
 function stopVideo1() {
   playerPopup1.stopVideo();
 }
var playerPopup2;
function playThisPopup2(vidid) {
   if(playerPopup2){
      playerPopup2.destroy()
   }
   playerPopup2 = new YT.Player('plane__video__popup-player2', {
     videoId: vidid,
     events: {
       'onReady': onPlayerReady,
     }
   });
 }
 function stopVideo2() {
   playerPopup2.stopVideo();
 }




//  gsap
var tl = gsap.timeline();
gsap.to(".plane__loading__progress__percent", {"width": "100%", duration: 4, onComplete: ()=>{
   gsap.fromTo(".plane__loading__boarding", {"opacity": "0"}, {duration: 0, "display" : "none"})
   gsap.fromTo(".plane__loading__progress", {"opacity": "0"}, {duration: 0, "display" : "none"})
   gsap.to(".plane__loading__fly", {"opacity": "1", "pointer-events": "all"})
   gsap.to(".plane__loading__khach", {"opacity": "0"})
}})

if(document.querySelector(".plane__loading__fly")){
   document.querySelector(".plane__loading__fly").addEventListener("click", function(){
      gsap.to(".plane__loading__fly", {opacity: 0, duration: 0.5})
      gsap.to(".plane__loading__plane", {x: 250, y: -100, duration: 2, rotate: -15, onComplete: ()=>{
         gsap.to(".plane__loading", {opacity: 0, duration: 0.5, "display": "none"})
      }})
   })
}
