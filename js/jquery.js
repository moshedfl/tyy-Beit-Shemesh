//jquery for routes screen

$(document).ready(function(){
    
    //Showing the stops for selected route
    $(".route-header").click(function(){
        $(this).siblings(".stops-list").slideToggle("fast");
    });
    
    // checks on reload page if is in small screen
    let isSmallWindow = $(window).width() < 751;
    
    // checks on resize page if is small screen
    $(window).on('resize', function() {
        isSmallWindow = $(this).width() < 751;
        if (!isSmallWindow) {
            $('.student-info').attr('style', false);
        }
    });

    // if is small screen show students information at the click on students name
    $(".student-row").click(function(){
        if (isSmallWindow) {
            $(this).find(".student-info").slideToggle("fast");
        }
    });

});