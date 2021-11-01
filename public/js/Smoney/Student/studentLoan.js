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
            $('.submit-hide').trigger('click');
        }else if(tinh != '' && huyen != '' && xa != '' && nha != '' && tinh_now == '' && huyen_now == '' && xa_now == '' && nha_now == ''){
            $('.submit-hide').trigger('click');
        }else if(tinh == '' && huyen == '' && xa == '' && nha == '' && tinh_now != '' && huyen_now != '' && xa_now != '' && nha_now != ''){
            $('.submit-hide').trigger('click');
        }else if(tinh != '' && huyen != '' && xa != '' && nha != '' && tinh_now != '' && huyen_now != '' && xa_now != '' && nha_now != ''){
            $('.submit-hide').trigger('click');
        }else{
            alert("Bạn nhập thiếu thông tin địa chỉ");
        } 
    })
    $("#jobstatus").change(function() {
    	if($(this).val() == "3"){
    		$(".for-jobstatus").slideUp();
    	}else{
    		$(".for-jobstatus").slideDown();
    	}
    })


    // set up input range
  	var rangeElement = document.querySelector(".range__slider_child input[type='range']")
  	$(".range__slider_child input[type='range']").attr("min",min);
  	$(".range__slider_child input[type='range']").attr("max",max);
  	$(".range__slider_child input[type='range']").attr("value",cur);
  	$(".show-money").html(asMoney(cur))
  	$(".range__slider_child input[type='range']").
  		attr("style",generateBackground($(".range__slider_child input[type='range']")));

    rangeElement.addEventListener('input', updateSlider)
  	function asMoney(value) {
    	return parseFloat(value)
      		.toLocaleString('en-US', { maximumFractionDigits: 2 }) + '  VNĐ'
  	}
  	function generateBackground(rangeElement) {   
    	if (rangeElement.val() === min) {
     		return
    	}
    	let percentage =  (rangeElement.val() - min) / (max - min) * 100;
    	return 'background: linear-gradient(to right, #50299c, #7a00ff ' + percentage + '%, #d3edff ' + percentage + '%, #dee1e2 100%)'
  	}
  	function updateSlider () {
    	$(".show-money").html(asMoney($(".range__slider_child input[type='range']").val()))
    	$(".range__slider_child input[type='range']").
    		attr("style",generateBackground($("input[type='range']")));
  	}
  	$(".plus").click(function() {
    	$(".range__slider_child input[type='range']").
    		val(parseInt($("input[type='range']").val()) + 50000)
    	updateSlider()
  	})
  	$(".sub").click(function() {
    	$(".range__slider_child input[type='range']").
    		val(parseInt($("input[type='range']").val()) - 50000)
    	updateSlider()
  	})
  // end set up input range
})