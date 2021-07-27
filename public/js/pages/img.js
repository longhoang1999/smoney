$(document).ready(function(){
	var stt=0;
	starImg=$('img.anh:first').attr("stt");
	endImg=$('img.anh:last').attr("stt");
	$('img.anh').each(function(){
		if($(this).is(':visible'))
			stt=$(this).attr("stt");
	});
	$('.prev').click(function(){
		if(stt==0)
		{
			stt=endImg;
			prev=stt++;
		}
		prev=--stt;
		$('img.anh').hide();
		$('img.anh').eq(prev).show();
	});
	$('.next').click(function(){
		if(stt==endImg){
			stt=-1;
		}
		
		next=++stt;
		$('img.anh').hide();
		$('img.anh').eq(next).show();
	});
	setInterval(function(){
		$('.next').click();
	},2000);

});