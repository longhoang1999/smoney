$(document).ready(function (){
	var moneyNumber;
	$(".open-input-file").click(function(){
		$("#input-file").click();
	})
	$("#input-money").focus(function() {
		if(moneyNumber != undefined){
			$(this).val(moneyNumber);
			$(this).attr("type","number");
		}
	})
	$("#input-money").focusout(function() {
		moneyNumber = $(this).val();
		moneyNumber = moneyNumber.replace(/^0+/, ''); 
		let moneyText = moneyNumber.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");;
		$(this).attr("type","text");
		$(this).val(moneyText + ' VNĐ');
	})
	
	
})
