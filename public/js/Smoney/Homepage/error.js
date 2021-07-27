setTimeout(function(){ 
    let element = document.querySelector(".notification-error");
    element.setAttribute("style","transform: translateX(-200%)");
}, 4000);

setTimeout(function(){ 
    let elementRespon = document.querySelector(".error-responsive-phone");
    elementRespon.setAttribute("style","transform: translateX(-200%)");
    setTimeout(function(){
        elementRespon.setAttribute("style","display: none");
    },300)
}, 3000);

