$(document).ready(function(){
    $(".link-service").on('click',function(){
        let more = $(this).parent().find('.more-service');
        if(more.is(':visible'))
		{
			more.slideUp("fast");
		}
		else
		{
			more.slideDown("fast");
		}
	});
	$(document).click(function (e)
	{
	    var container = $(".menu-service");
	    //click ra ngoài đối tượng
	    if (!container.is(e.target) && container.has(e.target).length === 0)
	    {
	        $(".more-service").slideUp("fast");
	    }
	});

    $(".icon-bell").on('click',function(){
        let more = $(this).parent().find('.more-notification');
        if(more.is(':visible'))
		{
			more.slideUp("fast");
		}
		else
		{
			more.slideDown("fast");
		}
	});
	$(document).click(function (e)
	{
	    var container = $(".nav-notification");
	    //click ra ngoài đối tượng
	    if (!container.is(e.target) && container.has(e.target).length === 0)
	    {
	        $(".more-notification").slideUp("fast");
	    }
	});

    $(".information-user").on('click',function(){
        let more = $(this).parent().find('.information-more');
        if(more.is(':visible'))
		{
			more.slideUp("fast");
		}
		else
		{
			more.slideDown("fast");
		}
	});
	$(document).click(function (e)
	{
	    var container = $(".information-user-avatar");
	    //click ra ngoài đối tượng
	    if (!container.is(e.target) && container.has(e.target).length === 0)
	    {
	        $(".information-more").slideUp("fast");
	    }
	});

    window.addEventListener("scroll", function() {
    	if (window.scrollY > 0) {
            $('.come-back').slideUp('fast');
        }
        else{
            $('.come-back').slideDown('fast');
        }
    });
    // cuộn chuột xuống
    $(window).bind('mousewheel', function(event) {
		if (event.originalEvent.wheelDelta < 0) {
		    $(".more-service").hide();
		    $(".information-more").hide();
		    $(".more-notification").hide();
		}
	});

    $(".add-file-btn").click(function(){
        $(".add-file-input").click();
    })
	$(".back_to_top").click(function(){
    	$("html, body").animate({scrollTop: 0}, 1000);
    })

    // show - hide table
    $(".btn-send-loan-request").click(function(){
    	$(".loan-choose-company").slideDown("fast");
    })
});

mybutton = document.querySelector(".back_to_top");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	    mybutton.style.display = "block";
	} else {
	    mybutton.style.display = "none";
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

var countSelect = 0, arrSelect = [];
$(".table-loan-choose-company .table-content").on("click", ".btn-choose", function(){
	let rowTr = $(this).parent().parent();
	if(!rowTr.hasClass("selected")){
		if(countSelect < 3){
			rowTr.find("td").css("background", "#c4ffc4");
			rowTr.addClass("selected");
			$(this).css("background","#1da91d");
			countSelect += 1;
		}else{
			alert("Bạn chỉ có thể chọn tối đa 3 ngân hàng");
		}
	}else{
		rowTr.find("td").css("background", "#fff");
		rowTr.removeClass("selected");
		$(this).css("background","#1dd51d");
		countSelect -= 1;
	}
})

$(".table-content .btn-apply-for-loan").click(function() {
	getIdBack();
	if(arrSelect.length > 0){
		$.ajax({
	        url: `${$url_path}/save-id-back-request`,
	        method: "POST",
	        data:{
	            "arrSelect": arrSelect
	        },
	        success:function(data)
	        {
	            if(data.trim() == "true"){
	            	let link = `${$url_path}/loan-request`;
	            	$(".table-content .link-apply-for-loan").attr("href", link);
	            	$(".table-content .link-apply-for-loan")[0].click();
	            }
	        }
	    });
	}else{
		alert("Hãy chọn ngân hàng nơi gửi hồ sơ của bạn");
	}
    
})

function getIdBack() {
	let arrTr = $(".table-loan-choose-company tbody tr");
	for(let i = 0 ; i < arrTr.length ; i++){
		if(arrTr[i].className == "selected" ){
			arrSelect.push(arrTr[i].getAttribute("data-id"));
		}
	}
}