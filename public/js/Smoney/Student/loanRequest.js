$(document).ready(function() {
	$("#modalRequiredInfo").on("click",".hide-block-info i",function() {
		$(".block-personal-infor").slideToggle("fast");
	})
	$("#modalRequiredInfo").on("click",".hide-block-uni i",function() {
		$(".block-school-infor").slideToggle("fast");
	})
	$("#modalRequiredInfo").on("click",".hide-block-parents i",function() {
		$(".block-parent-infor").slideToggle("fast");
	})
	$("#modalRequiredInfo").on("click",".hide-block-yourjob i",function() {
		$(".block-job-infor").slideToggle("fast");
	})
    $("#modalRequiredInfo").on("click",".hide-block-yourbank i",function() {
        $(".block-bank-infor").slideToggle("fast");
    })
    $("#modalRequiredInfo").on("click",".hide-block-yourloan i",function() {
        $(".block-loan-infor").slideToggle("fast");
    })

})

// hide modal 
$('#modalRequiredInfo').on('hidden.bs.modal', function (e) {
  $(".modal-head-btn").show();
  $(".success-title").hide();
  $(".modal-title-heading").text("Hãy đảm bảo thông tin cá nhân của bạn đầy đủ trước khi thực hiện yêu cầu vay !!");
  $(".modal-title-comfirm").show();
  $(".title-modal-Choseuni").text("Thông tin cơ sở đào tạo");
  let shool = document.querySelectorAll(".block-school-infor");
  shool.forEach((item) => {
      item.hidden = false;
      item.style.display = "flex";
  })
  $("#modalRequiredInfo .modal-body .info-hoso").remove();
  $(".block-personal-infor").slideDown("fast");
  $(".block-school-infor").slideDown("fast");
  $(".block-parent-infor").slideDown("fast");
  $(".block-job-infor").slideDown("fast");
})

$(".main").on('click','.square-item',function() {
  if($(this).hasClass("square-select")){
    $(this).removeClass("square-select");
    $(this).parent().parent().find("input[type='hidden']").val("");
  }else{
    let ul = $(this).parent();
    let allLi = ul.find(".square-item");
    allLi.removeClass("square-select");
    $(this).addClass("square-select");
    // add input hidden
    $(this).parent().parent().find("input[type='hidden']").val($(this).data("value"))
  }
})

window.addEventListener("scroll", function() {
    var elementTarget = document.getElementById("header");
    if (window.scrollY > 0) {
        $(".block-top-info").slideUp();
    }else{
        $(".block-top-info").slideDown();
    }
});
// ngăn tải lại trang
window.addEventListener('beforeunload', function (e) {
    e.preventDefault(); 
    if(sent == null){
        if(maHS == null)
            delete e['returnValue'];
        else
            e.returnValue = '';
    }else{
        delete e['returnValue'];
    }
});

$(".save-file").click(function() {
    if(maHS != null){
        $("#WantToSave").modal("show");
    }else{
        alert("Bạn chưa điền bất kì thông tin nào!");
    }
})