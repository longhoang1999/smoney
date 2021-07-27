$(document).ready(function(){
    $(".enter-input").focus(function(){
        let title = $(this).parent().find(".enter-title");
        title.addClass("enter-title-fly");
    })
    $(".enter-phone-input").keyup(function(){
        if($(this).val().length != 0){
            if(($(this).val().length >= 9) && ($(this).val().length <= 12)){
                $(this).parent().find(".icon-tick").slideDown("fast");
                $(this).parent().find(".icon-times").slideUp("fast");
            }else{
                $(this).parent().find(".icon-times").slideDown("fast");
                $(this).parent().find(".icon-tick").slideUp("fast");
            }
        }
        else{
            $(this).parent().find(".icon-times").slideUp("fast");
            $(this).parent().find(".icon-tick").slideUp("fast");
        }
    })
    $(".enter-password-input").keyup(function(){
        if($(this).val().length != 0){
            $(".icon-open-eye").slideDown();
        }
        else{
            $(".icon-open-eye").slideUp();
            $(".icon-close-eye").slideUp();
        }
    })
    
    $(".icon-open-eye").click(function(){
        $(".icon-open-eye").hide();
        $(".icon-close-eye").show();
        $(".enter-password-input").attr("type","text");
        $(".enter-password-comfirm-input").attr("type","text");
    })
    $(".icon-close-eye").click(function(){
        $(".icon-close-eye").hide();
        $(".icon-open-eye").show();
        $(".enter-password-input").attr("type","password");
        $(".enter-password-comfirm-input").attr("type","password");
    })
    $("#input-confirm").keyup(function(){
        if($("#input-password").val() != ""){
            if($(this).val() === $("#input-password").val()){
                $(".register-tick").slideDown("fast");
            }else{
                $(".register-tick").slideUp("fast");
            }
        }else{
            $(".register-tick").slideUp("fast");
        }
    })
    $("#input-password").keyup(function(){
        if($("#input-confirm").val() != ""){
            if($(this).val() === $("#input-confirm").val()){
                $(".register-tick").slideDown("fast");
            }else{
                $(".register-tick").slideUp("fast");
            }
        }else{
            $(".register-tick").slideUp("fast");
        }
    })
    $(".register-form").on('submit',function(e){
        let pass = $("#input-password").val();
        let confirm = $("#input-confirm").val();
        if(pass !== confirm || pass == ""){
            e.preventDefault();
            $(".register-tick").empty();
            $(".register-tick").append('<i class="fas fa-times"></i>');
            $(".register-tick").slideDown("fast");
        }
        if($("#rules-checkbox").is(':checked') == false)
        {
            e.preventDefault();
        }
    })
    $("#input-confirm").click(function(){
        let blockIcon = $(".register-confirm .register-tick i").hasClass("fa-check");
        if(blockIcon == false){
            $(".register-tick").empty();
            $(".register-tick").append('<i class="fas fa-check"></i>');
            $(".register-tick").hide();
        }
    })
    $("#input-password").click(function(){
        let blockIcon = $(".register-password .register-tick i").hasClass("fa-check");
        if(blockIcon == false){
            $(".register-tick").empty();
            $(".register-tick").append('<i class="fas fa-check"></i>');
            $(".register-tick").hide();
        }
    })

    if ($(window).width() > 1049) {
        // click btn register
        $(".tab-register").click(function(){
            $(".block-login").css("transform","translateX(-120%)");
            $(".block-register").css("transform","translateX(0)");
            $(".block-logo img").css("width","35%");
            $(".main-body").css("width","35%");
        })
        // click btn login
        $(".tab-login-now").click(function(){
            $(".block-login").css("transform","translateX(0)");
            $(".block-register").css("transform","translateX(100%)");
            $(".block-logo img").css("width","50%");
            $(".main-body").css("width","25%");
        })
        // forgot pass click
        $(".forgot-pass").click(function(){
            $(".block-login").css("transform","translateX(-120%)");
            $(".block-forgot").css("transform","translateX(0)");
            $(".block-logo img").css("width","50%");
            $(".main-body").css("width","25%");
        })
        // click btn login 2
        $(".tab-login-now-2").click(function(){
            $(".block-login").css("transform","translateX(0)");
            $(".block-forgot").css("transform","translateX(-100%)");
            $(".block-logo img").css("width","50%");
            $(".main-body").css("width","25%");
        })
    }
    if (($(window).width() > 739) && ($(window).width() < 1050))  {
        
        $(".register-label").addClass("register-label-longtext");
        // click btn register
        $(".tab-register").click(function(){
            $(".block-login").css("transform","translateX(-120%)");
            $(".block-register").css("transform","translateX(0)");
            $(".block-logo img").css("width","35%");
            $(".main-body").css("width","50%");
        })
        // click btn login
        $(".tab-login-now").click(function(){
            $(".block-login").css("transform","translateX(0)");
            $(".block-register").css("transform","translateX(100%)");
            $(".block-logo img").css("width","50%");
            $(".main-body").css("width","35%");
        })
        // forgot pass click
        $(".forgot-pass").click(function(){
            $(".block-login").css("transform","translateX(-120%)");
            $(".block-forgot").css("transform","translateX(0)");
            $(".block-logo img").css("width","50%");
            $(".main-body").css("width","35%");
        })
        // click btn login 2
        $(".tab-login-now-2").click(function(){
            $(".block-login").css("transform","translateX(0)");
            $(".block-forgot").css("transform","translateX(-100%)");
            $(".block-logo img").css("width","50%");
            $(".main-body").css("width","35%");
        })
    }
    if (($(window).width() > 319) && ($(window).width() < 740))  {
        $(".register-label").addClass("register-label-longtext");
        let error = $(".notification-error").html();
        $(".error-responsive-phone").html(error);

        // click btn register
        $(".tab-register").click(function(){
            $(".block-login").css("transform","translateX(-120%)");
            $(".block-register").css("transform","translateX(0)");
            $(".block-logo img").css("width","35%");
            $(".main-body").css("width","85%");
        })
        // click btn login
        $(".tab-login-now").click(function(){
            $(".block-login").css("transform","translateX(0)");
            $(".block-register").css("transform","translateX(100%)");
            $(".block-logo img").css("width","50%");
            $(".main-body").css("width","60%");
        })
        // forgot pass click
        $(".forgot-pass").click(function(){
            $(".block-login").css("transform","translateX(-120%)");
            $(".block-forgot").css("transform","translateX(0)");
            $(".block-logo img").css("width","35%");
            $(".main-body").css("width","85%");
        })
        // click btn login 2
        $(".tab-login-now-2").click(function(){
            $(".block-login").css("transform","translateX(0)");
            $(".block-forgot").css("transform","translateX(-100%)");
            $(".block-logo img").css("width","50%");
            $(".main-body").css("width","60%");
        })
    }




    // open, close block rules
    $(".open-block-rules").click(function(){
        $(".block-rules").fadeIn();
    })
    $(".block-rules-header-icon").click(function(){
        $(".block-rules").fadeOut();
    })
    


    $(document).click(function (e)
	{
        // phone
        $(".login-form .enter-phone-input").focusout(function(){
            if($(this).val() == ""){
                let title = $(this).parent().find(".enter-title");
                title.removeClass("enter-title-fly");
            }
        })
	    var containerPhone = $(".login-form .enter-phone");
	    if (!containerPhone.is(e.target) && containerPhone.has(e.target).length === 0)
	    {
            let loginInput = $(".login-form .enter-phone-input");
	        if(loginInput.val() == ""){
                let title = loginInput.parent().find(".enter-title");
                title.removeClass("enter-title-fly");
            }
	    }

        // phone forgot
        $(".form-forgot .enter-phone-input").focusout(function(){
            if($(this).val() == ""){
                let title = $(this).parent().find(".enter-title");
                title.removeClass("enter-title-fly");
            }
        })
        var containerPhoneRes = $(".form-forgot .enter-phone");
        if (!containerPhoneRes.is(e.target) && containerPhoneRes.has(e.target).length === 0)
        {
            let loginInputRes = $(".form-forgot .enter-phone-input");
            if(loginInputRes.val() == ""){
                let title = loginInputRes.parent().find(".enter-title");
                title.removeClass("enter-title-fly");
            }
        }

        // phone forgot
        $(".enter-password-input").focusout(function(){
            if($(this).val() == ""){
                let title = $(this).parent().find(".enter-title");
                title.removeClass("enter-title-fly");
            }
        })
        var containerPass = $(".enter-password");
	    if (!containerPass.is(e.target) && containerPass.has(e.target).length === 0)
	    {
	        if($(".enter-password-input").val() == ""){
                let title = $(".enter-password-input").parent().find(".enter-title");
                title.removeClass("enter-title-fly");
            }
	    }
        // phone forgot
        $(".enter-password-comfirm-input").focusout(function(){
            if($(this).val() == ""){
                let title = $(this).parent().find(".enter-title");
                title.removeClass("enter-title-fly");
            }
        })
        var containerPass = $(".enter-password-comfirm");
        if (!containerPass.is(e.target) && containerPass.has(e.target).length === 0)
        {
            if($(".enter-password-comfirm-input").val() == ""){
                let title = $(".enter-password-comfirm-input").parent().find(".enter-title");
                title.removeClass("enter-title-fly");
            }
        }


	});

    $(".send-verified-email").click(function(){
        $(this).empty();
        $(this).append('<i class="fas fa-circle-notch"></i>');

        var $rotator = rotateForEver($(".send-verified-email i"));
        // $('#some-button-to-cancel').click(function() {
        //     $rotator.stop();
        // });
    })
    $('input').on('keydown', function(e)
    { 
        if (e.keyCode == 9)  
            e.preventDefault();
    });

})
function rotateForEver($elem, rotator) {
    if (rotator === void(0)) {
        rotator = $({deg: 0});
    } else {
        rotator.get(0).deg = 0;
    }

    return rotator.animate(
        {deg: 360},
        {
            duration: 1000,
            easing: 'linear',
            step: function(now){
                $elem.css({transform: 'rotate(' + now + 'deg)'});
            },
            complete: function(){
                rotateForEver($elem, rotator);
            },
        }
    );
}