//$(".infomation-content p").not('.not-change').fadeOut(400);
$(document).ready(function(){
	$(".open-select-file").click(function(){
		$(".hidden").click();
	})
	setTimeout(function() {
		$(".notification-error").slideUp(400);
	},3000);

	$(".btn-fix-address").click(function() {
		$(".choose-address").slideDown();
		$(this).hide();
	})
	$(".btn-fix-addressNow").click(function() {
		$(".choose-address-now").slideDown();
		$(this).hide();
	})

	$(".btn-plus-stk").click(function() {
		$(".parent-input-stk").append('<input type="text" placeholder="Ví dụ: 0123456789 - Agribank - Chi nhánh Hà Nội" name="stk[]" >');
	})
	$(".btn-plus-other").click(function() {
		$(".parent-input-other").append(`<input placeholder="Số điện thoại khác" name="otherPhone[]" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\\..*?)\\..*/g, '$1');">`);
	})
	$(".btn-submit-form").click(function() {
        let tinh = $("#select_province").val();
        let huyen = $("#select_district").val();
        let xa = $("#select_ward").val();
        let nha = $("#input-number-house").val();

        let tinh_now = $("#select_province-now").val();
        let huyen_now = $("#select_district-now").val();
        let xa_now = $("#select_ward-now").val();
        let nha_now = $("#inputNumberHouseNow").val();

        if(tinh == '' && huyen == '' && xa == '' && nha == '' && tinh_now == '' && huyen_now == '' && xa_now == '' && nha_now == '') {
            $(".form-change-info").submit();
        }else if(tinh != '' && huyen != '' && xa != '' && nha != '' && tinh_now == '' && huyen_now == '' && xa_now == '' && nha_now == ''){
            $(".form-change-info").submit();
        }else if(tinh == '' && huyen == '' && xa == '' && nha == '' && tinh_now != '' && huyen_now != '' && xa_now != '' && nha_now != ''){
            $(".form-change-info").submit();
        }else if(tinh != '' && huyen != '' && xa != '' && nha != '' && tinh_now != '' && huyen_now != '' && xa_now != '' && nha_now != ''){
            $(".form-change-info").submit();
        }else{
            alert("Bạn nhập thiếu thông tin địa chỉ");
        } 
    })
})