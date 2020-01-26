//jquery for routes

$(document).ready(function(){
        
    $(".route-header").click(function(){
        $(this).siblings(".stops-list").slideToggle("fast");
    });
    
    
    let isSmallWindow = $(window).width() < 751;
    $(window).on('resize', function() {
        isSmallWindow = $(this).width() < 751;
        if (!isSmallWindow) {
            $('.stutand-info').attr('style', false);
        }
    });
    $(".stutand-row").click(function(){
        if (isSmallWindow) {
            $(this).find(".stutand-info").slideToggle("fast");
            console.log($(window).width());

        }
    });

    // $(".fa-print").click(function(){
    //     $(this).closest(".route").printThis();
    // })
});