jQuery(document).ready(function ($) {
    

    jQuery('#color-picker').click(function () {
        jQuery(this).iris('toggle'); //click came from somewhere else
    });
    jQuery('#color-picker').iris({
        width: 400,
        hide: true,
        change: function (event, ui) {
            jQuery("#color-picker").css('background', ui.color.toString());
        }

    });

});
