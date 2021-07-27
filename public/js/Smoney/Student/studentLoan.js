$(document).ready(function(){
	$(".open-select-file").click(function(){
		$(".hidden").click();
	})
	$(".btn-open-change").click(function(){
		$(".infomation-content input").not('.not-change').css("border-bottom","1px solid #d4d1d1");
		$(".infomation-content input").not('.not-change').removeAttr("readonly");
		$("#selecct-gender").removeAttr("disabled");
		$(".btn-submit-form").show();
	})
	setTimeout(function() {
		$(".notification-error").slideUp(400);
	},3000);
})