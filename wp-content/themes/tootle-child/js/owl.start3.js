jQuery(document).ready(function() {

    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    if (isMobile) {
        jQuery(".nav_h_responsive_type").touchFlow({
            axis: "x",
            snap: true,
            scrollbar: false,
        });
    } else {
        /*jQuery(".desktop_position_change div.nav_h_responsive_type").touchFlow({
          axis: "y",
          snap: true,
          scrollbar: false,
        });*/
        jQuery(".nav_h_responsive_type").touchFlow({
            axis: "x",
            snap: true,
            scrollbar: false,
        });

    }
});


function thirty_pc() {
    var height = jQuery(window).height();
    var thirtypc = (30 * height) / 100;
    thirtypc = parseInt(thirtypc) + 'px';
    console.log(thirtypc);
    //jQuery("div").css('height', thirtypc);
}

jQuery(document).ready(function() {
    thirty_pc();
    //jQuery(window).bind('resize', thirty_pc);
});