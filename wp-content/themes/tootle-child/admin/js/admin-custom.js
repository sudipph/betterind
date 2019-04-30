jQuery(document).ready(function ($) {

	var current_selected_tab = jQuery("li.nav-item a.nav-link.active").attr('aria-controls');

	if (current_selected_tab == 'video') {
		jQuery('#postdivrich').css('display', 'none');
	}
	jQuery("li.nav-item a").click(function () {
		jQuery('li.nav-item a').removeClass('active');

		jQuery(this).addClass('active');
		var current_tab_name = jQuery(this).attr('aria-controls');
		if (current_tab_name == 'video') {

			jQuery('#postdivrich').css('display', 'none');
		} else {
			jQuery('#postdivrich').css('display', 'block');
		}
		if (current_tab_name == 'solarticle') {

			jQuery('#tagsdiv-solutions_library').css('display', 'block');
			jQuery('#categorydiv').css('display', 'none');
		} else {
			jQuery('#categorydiv').css('display', 'block');
			jQuery('#tagsdiv-solutions_library').css('display', 'none');
		}
		jQuery('#gallery_card_type').val(current_tab_name);

		var add_class = jQuery(this).attr('aria-controls');
		remove_all_active()
		jQuery('#' + add_class).addClass('active');


		/*if (jQuery(this).attr('aria-controls') == 'story') {
			jQuery('#normal-sortables div#story_packagediv').css('display','block');
		}else{
			jQuery('#normal-sortables div#story_packagediv').css('display','none');
			jQuery('#story_packagediv input[type=checkbox]').attr('checked',false);
		}*/
	});
});

function remove_all_active() {
	jQuery("div.tab-content .tab-pane ").each(function (index) {
		jQuery(this).removeClass('active');
		//console.log(index + ": " + );
	});
}