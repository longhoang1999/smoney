$(document).ready(function(){
	$("#link_service").click(function(){
		if ($('.more_service').is(':visible'))
		{
			$(".more_service").slideUp("fast");
		}
		else
		{
			$(".more_service").slideDown("fast");
		}
	});
	$(document).click(function (e)
	{
	    var container = $(".menu_service");
	    //click ra ngoài đối tượng
	    if (!container.is(e.target) && container.has(e.target).length === 0)
	    {
	        $(".more_service").slideUp("fast");
	    }
	});

	$(".multi-language-select").click(function(){
		if ($('.multi-language-choose').is(':visible'))
		{
			$(".multi-language-choose").slideUp("fast");
		}
		else
		{
			$(".multi-language-choose").slideDown("fast");
		}
	});
	$(document).click(function (e)
	{
	    var container = $(".multi-language");
	    //click ra ngoài đối tượng
	    if (!container.is(e.target) && container.has(e.target).length === 0)
	    {
	        $(".multi-language-choose").slideUp("fast");
	    }
	});


	$(".user_logged_content").click(function(){
		if ($('.user_logged_more').is(':visible'))
		{
			$(".user_logged_more").slideUp("fast");
		}
		else
		{
			$(".user_logged_more").slideDown("fast");
		}
	});
	$(document).click(function (e)
	{
	    var container = $("#user_logged");
	    //click ra ngoài đối tượng
	    if (!container.is(e.target) && container.has(e.target).length === 0)
	    {
	        $(".user_logged_more").slideUp("fast");
	    }
	});


	$("#res_link_service").click(function(){
		if ($('.res_more_service').is(':visible'))
		{
			$(".res_more_service").slideUp("fast");
		}
		else
		{
			$(".res_more_service").slideDown("fast");
		}
	});
	$(document).click(function (e)
	{
	    var container = $("#res_link_service");
	    //click ra ngoài đối tượng
	    if (!container.is(e.target) && container.has(e.target).length === 0)
	    {
	        $(".res_more_service").slideUp("fast");
	    }
	});


	$("#res_link_login").click(function(){
		if ($('.res_more_login').is(':visible'))
		{
			$(".res_more_login").slideUp("fast");
		}
		else
		{
			$(".res_more_login").slideDown("fast");
		}
	});
	$(document).click(function (e)
	{
	    var container = $(".li_res_link_login");
	    //click ra ngoài đối tượng
	    if (!container.is(e.target) && container.has(e.target).length === 0)
	    {
	        $(".res_more_login").slideUp("fast");
	    }
	});


	// window.addEventListener("scroll", function() {
	// 	var elementTarget = document.getElementById("section_definition");
	// 	if (window.scrollY > (parseFloat(elementTarget.offsetTop) - 550)) {
	// 		$(".header-top").slideUp(200);
	// 		$(".header").css("height","4rem");
	// 		$(".responsive-header-icon-content").css("top","1rem");
	// 	}
	// 	var elementTarget_2 = document.getElementById("header");
	// 	if (window.scrollY <= (elementTarget_2.offsetTop) + 20) {
	// 		$(".header-top").slideDown(200);
	// 		$(".header").css("height","6rem");
	// 		$(".responsive-header-icon-content").css("top","3rem");
	// 	}
	// });


	$(window).bind('mousewheel', function(event) {
		if (event.originalEvent.wheelDelta < 0) {
		    $(".responsive-header-icon-content").hide();
		}
	});

	// .... Cuộn chuột lên xuống
	// $(window).bind('mousewheel', function(event) {
	// 	if (event.originalEvent.wheelDelta >= 0) {
	// 	    console.log('Scroll up');
	// 	}
	// 	else {
	// 	    console.log('Scroll down');
	// 	}
	// });

	$(".responsive-header").click(function(){
		if ($('.responsive-header-icon-content').is(':visible'))
		{
			$(".responsive-header-icon-content").slideUp("fast");
		}
		else
		{
			$(".responsive-header-icon-content").slideDown("fast");
		}
	});
	
    $("#backtotop_btn").click(function(){
    	$("html, body").animate({scrollTop: 0}, 1000);
    })
    $(".using_university").click(function(e){
    	e.preventDefault();
    	$(this).addClass('using_selected');
    	$(".using_student").removeClass('using_selected');
    	$(".using_bank").removeClass('using_selected');

    	$(".content_university").fadeIn(600);
    	$(".content_student").fadeOut(600);
    	$(".content_bank").fadeOut(600);
    })
    $(".using_student").click(function(e){
    	e.preventDefault();
    	$(this).addClass('using_selected');
    	$(".using_university").removeClass('using_selected');
    	$(".using_bank").removeClass('using_selected');

    	$(".content_university").fadeOut(600);
    	$(".content_student").fadeIn(600);
    	$(".content_bank").fadeOut(600);
    })
    $(".using_bank").click(function(e){
    	e.preventDefault();
    	$(this).addClass('using_selected');
    	$(".using_university").removeClass('using_selected');
    	$(".using_student").removeClass('using_selected');

    	$(".content_university").fadeOut(600);
    	$(".content_student").fadeOut(600);
    	$(".content_bank").fadeIn(600);
    })
});
mybutton = document.getElementById("backtotop_btn");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	    mybutton.style.display = "block";
	} else {
	    mybutton.style.display = "none";
	}
}

var elementOb = [];
function animateValue(id, start, end, duration) {
	if(elementOb.includes(id) == false)
    {
    	if (start === end) return;
	    var range = end - start;
	    var current = start;
	    var increment = end > start? 1 : -1;
	    var stepTime = Math.abs(Math.floor(duration / range));
	    var obj = document.getElementById(id);
	    var timer = setInterval(function() {
	        current += increment;
	        obj.innerHTML = current;
	        if (current == end) {
	            clearInterval(timer);
	        }
	    }, stepTime);

	    elementOb.push(id);
    }
}

(function() {
	let header = document.querySelector("#header");
	let headeroom = new Headroom(header);
	headeroom.init();
    // var header = new Headroom(document.querySelector("#header"), {
    //     tolerance: 5,
    //     offset : 205,
    //     classes: {
    //       initial: "animated",
    //       pinned: "slideDown",
    //       unpinned: "slideUp"
    //     }
    // });
    // header.init();
}());

