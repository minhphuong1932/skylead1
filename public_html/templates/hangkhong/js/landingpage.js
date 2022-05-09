$(document).ready(function () {

	setTimeout(()=>{
		$('.loading').remove();
		gsap.from(".ldp__skylead__top__text", {
			y: 300,
			opacity: 0,
			duration: 1.5, 
			ease: "circ.out"
		  });
	}, 1500)


	// change image
	if(window.innerWidth < 1024){
		var popup = $("#popup").val();
		console.log(popup);	
		if(popup ==1){
			$(".popup__success").attr("src", "/templates/hangkhong/img/success-mobile.png");
		}
	}
	$('.background__modal').click(function (e) { 
		e.preventDefault();
		$(this).remove();
	});
	$(".popup__success").click(function (e) { 
		e.preventDefault();
		e.stopPropagation();
	});


	// animation start
	$(".ldp__skylead__heading").each(function(){
		gsap.from(this, {
			scrollTrigger: {
				trigger: this,
				start: "20px 95%",
			},
			opacity: 0,
			y: 200,
			duration: 1, 
		  });
	})
	$(".ldp__skylead__why-1__body").each(function(){
		gsap.from(this, {
			scrollTrigger: {
				trigger: this,
				start: "20px 95%",
			},
			opacity: 0,
			y: 200,
			duration: 1,
			delay: 0.5
		  });
	})
	$(".ldp__skylead__why-1__image").each(function(){
		gsap.from(this, {
			scrollTrigger: {
				trigger: this,
				start: "20px 95%",
			},
			opacity: 0,
			y: 200,
			duration: 1,
		  });
	})
	$(".ldp__skylead__video").each(function(){
		gsap.from(this, {
			scrollTrigger: {
				trigger: this,
				start: "20px 95%",
			},
			opacity: 0,
			y: 200,
			duration: 1,
		  });
	})
	$(".ldp__skylead__sub").each(function(){
		gsap.from(this, {
			scrollTrigger: {
				trigger: this,
				start: "20px 95%",
			},
			opacity: 0,
			y: 200,
			duration: 1,
		  });
	})
	$(".ldp__skylead__why-2__block").each(function(){
		gsap.from(this, {
			scrollTrigger: {
				trigger: this,
				start: "20px 95%",
			},
			opacity: 0,
			y: 200,
			duration: 1,
		  });
	})
	gsap.from(".ldp__skylead__after__block", {
		scrollTrigger: {
			trigger: ".ldp__skylead__after",
			start: "20px 95%",
		},
		opacity: 0,
		y: 200,
		duration: 1,
		stagger: 0.4,
		delay: 1
	  });
	$(".ldp__skylead__bot__block").each(function(){
		gsap.from(this, {
			scrollTrigger: {
				trigger: this,
				start: "20px 95%",
			},
			opacity: 0,
			y: 200,
			duration: 1,
		  });
	})


	// animation end




      // landingpage popup
   if(window.innerWidth < 1024){
    var x = 1;
    var lang = $("#lang").val();
    $(".ldp__skylead__open-form").click(function (e) { 
        e.preventDefault();
		if(lang=="vn"){
			if(x === 1){
				$(this).find("span").text("Đóng");
				$(this).addClass("ldp__skylead__open-form--close");
				$(".ldp__skylead__sticky").addClass("ldp__skylead__sticky--open");
				x = 2;
			}else if(x === 2){
				$(this).find("span").text("Nhận tư vấn");
				$(this).removeClass("ldp__skylead__open-form--close");
				$(".ldp__skylead__sticky").removeClass("ldp__skylead__sticky--open");
				x = 1;
			}
		}else{
			if(x === 1){
				$(this).find("span").text("Close");
				$(this).addClass("ldp__skylead__open-form--close");
				$(".ldp__skylead__sticky").addClass("ldp__skylead__sticky--open");
				x = 2;
			}else if(x === 2){
				$(this).find("span").text("Consultant");
				$(this).removeClass("ldp__skylead__open-form--close");
				$(".ldp__skylead__sticky").removeClass("ldp__skylead__sticky--open");
				x = 1;
			}
		}
    });
	}
});

// gsap
if(window.innerWidth > 1023){
	gsap.registerPlugin(ScrollTrigger);

	smoothScroll(".ldp__skylead__container");
	
	function smoothScroll(content, viewport, smoothness) {
		content = gsap.utils.toArray(content)[0];
		smoothness = smoothness || 1;
	
		gsap.set(viewport || content.parentNode, {overflow: "hidden", position: "fixed", height: "100%", width: "100%", top: 0, left: 0, right: 0, bottom: 0});
		gsap.set(content, {overflow: "visible", width: "100%"});
	
		let getProp = gsap.getProperty(content),
			setProp = gsap.quickSetter(content, "y", "px"),
			setScroll = ScrollTrigger.getScrollFunc(window),
			removeScroll = () => content.style.overflow = "visible",
			killScrub = trigger => {
				let scrub = trigger.getTween ? trigger.getTween() : gsap.getTweensOf(trigger.animation)[0]; // getTween() was added in 3.6.2
				scrub && scrub.kill();
				trigger.animation.progress(trigger.progress);
			},
			height, isProxyScrolling;
	
		function refreshHeight() {
			height = content.clientHeight;
			content.style.overflow = "visible"
			document.body.style.height = height + "px";
		return height - document.documentElement.clientHeight;
		}
	
		ScrollTrigger.addEventListener("refresh", () => {
			removeScroll();
			requestAnimationFrame(removeScroll);
		})
		ScrollTrigger.defaults({scroller: content});
		ScrollTrigger.prototype.update = p => p; // works around an issue in ScrollTrigger 3.6.1 and earlier (fixed in 3.6.2, so this line could be deleted if you're using 3.6.2 or later)
	
		ScrollTrigger.scrollerProxy(content, {
			scrollTop(value) {
				if (arguments.length) {
					isProxyScrolling = true; // otherwise, if snapping was applied (or anything that attempted to SET the scroll proxy's scroll position), we'd set the scroll here which would then (on the next tick) update the content tween/ScrollTrigger which would try to smoothly animate to that new value, thus the scrub tween would impede the progress. So we use this flag to respond accordingly in the ScrollTrigger's onUpdate and effectively force the scrub to its end immediately.
					setProp(-value);
					setScroll(value);
					return;
				}
				return -getProp("y");
			},
		scrollHeight: () => document.body.scrollHeight,
			getBoundingClientRect() {
				return {top: 0, left: 0, width: window.innerWidth, height: window.innerHeight};
			}
		});
	
		return ScrollTrigger.create({
			animation: gsap.fromTo(content, {y:0}, {
				y: () => document.documentElement.clientHeight - height,
				ease: "none",
				onUpdate: ScrollTrigger.update
			}),
			scroller: window,
			invalidateOnRefresh: true,
			start: 0,
			end: refreshHeight,
		refreshPriority: -999,
			scrub: smoothness,
			onUpdate: self => {
				if (isProxyScrolling) {
					killScrub(self);
					isProxyScrolling = false;
				}
			},
			onRefresh: killScrub // when the screen resizes, we just want the animation to immediately go to the appropriate spot rather than animating there, so basically kill the scrub.
		});
	}
}
