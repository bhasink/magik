$(document).ready(function(){
    //fixed header
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if (scroll >= 40){
            $(".main").addClass("fixed");
            $("body").addClass("fixed");
        } else{
            $(".main").removeClass("fixed");
            $("body").removeClass("fixed");
        }
    });

    $('ul.main-nav').slicknav({
        // allowParentLinks: true,
        // duplicate: false,
        //prependTo: 'nav .main-container .wrapper'
        closeOnClick: true
    });
    
    
   
});


$(document).ready(function(){
    debugger;
    $(".box").click(function(){
        $(".show-div").hide();
        var divid = $(this).attr('id');
        //alert(divid);
    $("#boxm"+divid).show();

    $('.cross').click(function(){
    $('.show-div').hide()
    });
    });

    $("#slider2").responsiveSlides({
        auto: true,
        pager: true,
        speed: 500,
       
    });  
});

//animations
wow = new WOW({
    mobile: true
});
wow.init();



