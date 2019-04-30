// Change tab on click in page/post option
jQuery(document).ready(function ($) {

    jQuery('.t4p_metabox_tabs li a').click(function (e) {
        e.preventDefault();

        var id = jQuery(this).attr('href');

        jQuery(this).parents('ul').find('li').removeClass('active');
        jQuery(this).parent().addClass('active');

        jQuery(this).parents('.inside').find('.t4p_metabox_tab').removeClass('active').hide();
        jQuery(this).parents('.inside').find('#t4p_tab_' + id).addClass('active').fadeIn();

    });

});