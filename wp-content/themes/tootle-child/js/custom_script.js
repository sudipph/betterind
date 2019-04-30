jQuery(document).ready(function () {

    //dinamic_title_height
    //dinamic_height_with_title
    //
    var title_height = jQuery('#dinamic_title_height').css('height');
    title_height = parseInt(title_height, 10);
    var padding = title_height + 200;
    var title_height = jQuery('#dinamic_height_with_title').css('padding-top', padding + 'px');
    //console.log(title_height);
    //padding - top
    jQuery.fn.scrollView = function () {

        return this.each(function () {

            jQuery('html, body').animate({
                scrollTop: jQuery(this).offset().top
            }, 500);
        });
    }

    //
    jQuery("body").on("click", ".click_on_view", function () {
        var selected_attr = jQuery(this).parent().parent();
        selected_attr.children('.row').css('overflow', 'auto');
        selected_attr.children('.row').css('height', 'unset');
        jQuery(this).css('display', 'none');
        console.log(selected_attr);
    });
    jQuery("div.click_on_view").click(function (e) {
        var selected_attr = jQuery(this).parent().parent().attr('class');
        console.log(selected_attr);
    });
    jQuery("div.force_click").click(function (e) {

        console.log(jQuery('div.row.spotlight_heading').hasClass('.solution_library_for_head'));
        e.preventDefault();

        // jQuery('html, body').animate({
        //     scrollTop: jQuery('div.content .container-fluid').offset().top
        // }, 500);

        if (jQuery('div.row.spotlight_heading').hasClass('.solution_library_for_head') == true) {}
        jQuery('#primary section:nth-child(2)').scrollView();

        return false;
    });
    jQuery("div.arrow_head .down_arrow").click(function (e) {
        // jQuery("html, body").animate({
        //     scrollTop: jQuery(document).height()
        // }, 1000);
        console.log('start');
        e.preventDefault();

        jQuery('html, body').animate({
            scrollTop: jQuery('div.content .container-fluid').offset().top
        }, 500);


        //jQuery('div.container-fluid').scrollView();
        console.log('end');
        return false;
        if (jQuery('body').hasClass('.container-fluid') == true) {
            jQuery('div.container-fluid').scrollView();

        }
        //return false;

    });
    jQuery(".slide_down").click(function () {
        var selected_id = jQuery(this).attr("rel");
        jQuery("#" + selected_id).slideToggle("slow");
    });
    jQuery(".post_content_click").click(function () {
        var selected_post_id = jQuery(this).attr("rel");
        //console.log(selected_post_id);
        var box_status = jQuery("#post_content_with_id_" + selected_post_id).css(
            "display"
        );

        // jQuery(".post_content_border_" + selected_post_id).css("border-top",'1px solid #ccc;');

        console.log(".post_content_border_" + selected_post_id);
        if (box_status == "none") {
            console.log(
                jQuery(this)
                .children("div")
                .attr("class", "down_up_arrow")
            );
            jQuery(".post_content_border_" + selected_post_id).css("border-top", '1px solid #ccc');

        } else {
            jQuery(this)
                .children("div")
                .attr("class", "up_down_arrow");
            jQuery(".post_content_border_" + selected_post_id).css("border-top", '0');

        }
        jQuery("#post_content_with_id_" + selected_post_id).slideToggle("slow");
    });
    jQuery(".slide_down").click(function () {
        jQuery("#box").animate({
            height: "300px"
        });
    });
    //$('#myModal').modal('show');
    //$('#myModal').modal('hide');
    //---------------------------------------------validate
    jQuery("#success_story").validate({
        rules: {
            fullname: "required",
            email: {
                required: true,
                email: true
            },
            success_story: "required"
        },
        messages: {
            fullname: "Please enter your name",
            email: {
                required: "Please enter your email id",
                email: "Please enter valid email id"
            },
            success_story: "Please enter your story",
        },
        submitHandler: function (form) {
            console.log('submit');
            //jQuery(form).ajaxSubmit();
            var fullname = jQuery('#fullname').val();
            var email = jQuery('#email').val();
            var success_story = jQuery('#success_story_text').val();
            var post_id = jQuery('#post_id').val();
            var solutions_library = jQuery('#solutions_library').val();

            jQuery.ajax({
                url: ajax_url,
                type: "post",
                data: {
                    action: "ajax_success_story_val",
                    fullname: fullname,
                    email: email,
                    post_id: post_id,
                    success_story: success_story,
                    solutions_library: solutions_library
                },
                success: function (result) {
                    if (result == 1) {
                        jQuery('#exampleModalCenter').modal('hide');;
                        jQuery('#exampleSuccessmsg').modal('show');;

                    }
                    console.log(result);
                    //jQuery(".search_result_from_contact_database").html(result);
                }
            });
        }
    });


    jQuery(function ($) {
        if ($('.sticky-header').length >= 1) {
            $(window).scroll(function () {
                var header = $(document).scrollTop();
                var headerHeight = $('.header-height').height();
                if (header > headerHeight) {

                    $('.to_build_dynamic_header_banner').addClass('uniquefadein');
                } else {

                    $('.to_build_dynamic_header_banner').removeClass('uniquefadein');
                }
            });
        }
    });


});
var mmenu = 0;

function go_to_menu_option(menu_option) {
    var menu_open_option = jQuery(".red_color_logo").css("display");
    console.log(menu_open_option);
    var main_window_height = jQuery(window).height();
    var top_header_height = jQuery('.red_color_logo').css('height');
    var top_header_height = parseInt(top_header_height, 10);
    console.log(top_header_height);
    var go_to_height = (main_window_height - top_header_height - 100);
    go_to_height = '75vh';
    console.log(go_to_height);


    if (menu_option == "menu" && menu_open_option == "none") {
        console.log('mmenu' + mmenu);
        mmenu = 1;

        jQuery("#sticky_menu_rotate").animate({
            bottom: go_to_height
        }, {
            complete: function () {
                jQuery(".red_color_logo").css("display", "block");
                // menu_box_dinamic_ajax_section("closed");
                menu_box_dinamic_ajax_section("open", menu_option);
                menu_box_dinamic_section("open");
                jQuery(".menu_box_dinamic_section").css("display", "block");
            }
        });

        //jQuery("#sticky_menu_rotate").slideToggle( "slow" );
    } else if (menu_option == "menu" && menu_open_option == "block") {

        jQuery("#sticky_menu_rotate").animate({
            bottom: go_to_height
        }, {
            complete: function () {
                jQuery(".red_color_logo").css("display", "block");
            },
            start: function () {
                // jQuery(".menu_box_dinamic_section").css("display", "none");
                // menu_box_dinamic_ajax_section("closed");
                menu_box_dinamic_ajax_section("open", menu_option);
                menu_box_dinamic_section("open");
            }
        });
        if (jQuery(".menu_box_dinamic_section").css("display") == 'none') {
            jQuery(".menu_box_dinamic_section").css("display", "block");
        }
        if (mmenu == 1) {
            menu_closed();
        }
        mmenu = 1;
    } else if (menu_option == "shop") {
        /*ajax menu*/

        common_function_back();
        if (menu_open_option == "none") {
            mmenu = 2;

            jQuery("#sticky_menu_rotate").animate({
                bottom: go_to_height
            }, {
                complete: function () {
                    jQuery(".red_color_logo").css("display", "block");
                    menu_box_dinamic_section("closed");
                    menu_box_dinamic_ajax_section("open", menu_option);
                    //jQuery(".menu_box_dinamic_ajax_section").css("display", "block");
                }
            });
        } else if (menu_open_option == "block") {

            jQuery("#sticky_menu_rotate").animate({
                bottom: go_to_height
            }, {
                complete: function () {
                    jQuery(".red_color_logo").css("display", "block");
                    menu_box_dinamic_section("closed");
                    menu_box_dinamic_ajax_section("open", menu_option);
                    //jQuery(".menu_box_dinamic_section").slideDown();
                },
                start: function () {
                    //jQuery(".menu_box_dinamic_ajax_section").css("display", "none");
                }
            });
            if (mmenu == 2) {
                menu_closed();
            }
            mmenu = 2;
        }
    } else if (menu_option == "video") {
        common_function_back();
        /*ajax menu*/
        if (menu_open_option == "none") {
            mmenu = 3;
            jQuery("#sticky_menu_rotate").animate({
                bottom: go_to_height
            }, {
                complete: function () {
                    jQuery(".red_color_logo").css("display", "block");
                    menu_box_dinamic_section("closed");
                    menu_box_dinamic_ajax_section("open", menu_option);
                }
            });
        } else if (menu_open_option == "block") {
            jQuery("#sticky_menu_rotate").animate({
                bottom: go_to_height
            }, {
                complete: function () {
                    jQuery(".red_color_logo").css("display", "block");
                    menu_box_dinamic_section("closed");
                    menu_box_dinamic_ajax_section("open", menu_option);
                },
                start: function () {}
            });
            if (mmenu == 3) {
                menu_closed();
            }
            mmenu = 3;
        }
    } else if (menu_option == "podcasts") {
        common_function_back();
        /*ajax menu*/
        if (menu_open_option == "none") {
            mmenu = 4;
            jQuery("#sticky_menu_rotate").animate({
                bottom: go_to_height
            }, {
                complete: function () {
                    jQuery(".red_color_logo").css("display", "block");
                    menu_box_dinamic_section("closed");
                    menu_box_dinamic_ajax_section("open", menu_option);
                }
            });
        } else if (menu_open_option == "block") {
            jQuery("#sticky_menu_rotate").animate({
                bottom: go_to_height
            }, {
                complete: function () {
                    jQuery(".red_color_logo").css("display", "block");
                    menu_box_dinamic_section("closed");
                    menu_box_dinamic_ajax_section("open", menu_option);
                },
                start: function () {}
            });
            if (mmenu == 4) {
                menu_closed();
            }
            mmenu = 4;
        }
    } else if (menu_option == "impact") {
        common_function_back();
        /*ajax menu*/
        if (menu_open_option == "none") {
            mmenu = 5;
            jQuery("#sticky_menu_rotate").animate({
                bottom: go_to_height
            }, {
                complete: function () {
                    jQuery(".red_color_logo").css("display", "block");
                    menu_box_dinamic_section("closed");
                    menu_box_dinamic_ajax_section("open", menu_option);
                }
            });
        } else if (menu_open_option == "block") {
            jQuery("#sticky_menu_rotate").animate({
                bottom: go_to_height
            }, {
                complete: function () {
                    jQuery(".red_color_logo").css("display", "block");
                    menu_box_dinamic_section("closed");
                    menu_box_dinamic_ajax_section("open", menu_option);
                },
                start: function () {}
            });
            if (mmenu == 5) {
                menu_closed();
            }
            mmenu = 5;
        }
    } else if (menu_option == "closed") {
        menu_closed();
        // common_function_back();
        // jQuery("#sticky_menu_rotate").animate({
        //     bottom: "0px"
        // }, {
        //     complete: function () {
        //         jQuery(".red_color_logo").css("display", "none");

        //         //jQuery(".menu_box_dinamic_section").css("display", "block");
        //     },
        //     start: function () {
        //         menu_box_dinamic_section("closed");
        //         menu_box_dinamic_ajax_section("closed");
        //     }
        // });
    }
}

function menu_closed() {
    common_function_back();

    jQuery("#sticky_menu_rotate").animate({
        bottom: "0px"
    }, {
        complete: function () {
            jQuery(".red_color_logo").css("display", "none");

            //jQuery(".menu_box_dinamic_section").css("display", "block");
        },
        start: function () {
            menu_box_dinamic_section("closed");
            menu_box_dinamic_ajax_section("closed");
        }
    });
    /** only for desktop*/
    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    // var element = document.getElementById('text');
    if (isMobile) {
        // element.innerHTML = "You are using Mobile";
    } else {
        // element.innerHTML = "You are using Desktop";
        jQuery(".menu_box_dinamic_section").css("display", "none");
    }

}

function common_function_back() {
    //jQuery(".menu_box_dinamic_section").css("display", "none");
}

function menu_box_dinamic_ajax_section(status, menu_type) {
    var display = jQuery(".menu_box_dinamic_ajax_section").css("display");
    console.log(status + "--" + display);

    // jQuery(".menu_box_dinamic_ajax_section").slideToggle();
    // if (status == "open") {
    //     jQuery(".menu_box_dinamic_ajax_section").slideDown(2000);
    // } else {
    //     jQuery(".menu_box_dinamic_ajax_section").slideUp(2000);
    // }
    if (menu_type == "shop") {
        functio_for_dinamic_ajax("shop");
    } else if (menu_type == "video") {
        functio_for_dinamic_ajax("video");
    } else if (menu_type == "podcasts") {
        functio_for_dinamic_ajax("podcasts");
    } else if (menu_type == "impact") {
        functio_for_dinamic_ajax("impact");
    } else if (menu_type == "menu") {
        jQuery("div.row.menu_data_from_ajax").addClass(menu_type);
        jQuery(".menu_data_from_ajax").html(jQuery("#primary_menu_show_hide").html());

        //functio_for_dinamic_ajax("menu");
    }
}

function menu_box_dinamic_section(status) {
    var display = jQuery(".menu_box_dinamic_section").css("display");
    console.log('menu_box_dinamic_section>>' + status + "--" + display);
    //&& display == "none"
    /*if (status == "open") {
      jQuery(".menu_box_dinamic_section").slideDown();
    } else if (display == "block") {
      jQuery(".menu_box_dinamic_section").slideUp();
    }*/
}

function functio_for_dinamic_ajax(menu) {
    var visible_area = jQuery(window).height();
    //var top = jQuery(".menu_box_dinamic_ajax_section").css("top");

    console.log(visible_area);

    jQuery(".menu_data_from_ajax").html('<div class="class_ajax_loader"></div>');
    //jQuery("div.row.menu_data_from_ajax").addClass(menu);
    jQuery("div.row.menu_data_from_ajax").removeClass('menu');
    jQuery.ajax({
        url: ajax_url,
        type: "post",
        data: {
            action: "ajax_menu_page",
            page_name: menu
        },
        success: function (result) {
            jQuery(".menu_data_from_ajax").html(result);
            if (result) {

                var top = jQuery(".menu_data_from_ajax").css("top");
                console.log('top' + top);
                console.log('visible_area' + visible_area);
                var height = visible_area - parseInt(top);
                //jQuery(".menu_box_dinamic_ajax_section").css("height", height);
                console.log(height);
                jQuery('.menu_data_from_ajax').css('height');

                // if (menu == 'menu') {
                //     jQuery(".menu_data_from_ajax").css("height", 'fit-content');
                // } else {
                //     jQuery(".menu_data_from_ajax").css("height", jQuery('.menu_data_from_ajax').css('height'));
                // }


                jQuery(".menu_box_dinamic_section").css("display", "block");
            }
            //alert(result);
        }
    });
}


jQuery(window).load(function () {



});

function search_with_term(cc, tag, cval) {
    search_contact_db(cc, tag, cval);
}

function search_contact_db(cc, tag, val = '', ) {
    if (jQuery(cc).hasClass("active")) {
        jQuery(cc).removeClass('active');
    } else {
        jQuery(cc).addClass('active');
    }
    var jsonObj = [];
    var jsonObj1 = [];

    var item, item1;
    jQuery(".solution_lib_block div").each(function () {
        console.log(jQuery(this).attr('class'));
        console.log(jQuery(this).hasClass('active'));
        if (jQuery(this).hasClass('active') == true) {
            // item = {}
            // item["category"] = jQuery.trim(jQuery(this).children().html());
            item = jQuery.trim(jQuery(this).children().html());
            jsonObj.push(item);
        }
    });


    jQuery(".location_block div").each(function () {
        // console.log(jQuery(this).attr('class'));
        // console.log(jQuery(this).hasClass('active'));
        if (jQuery(this).hasClass('active') == true) {
            item1 = jQuery.trim(jQuery(this).children().html());
            jsonObj1.push(item1);
        }
    });


    //console.log(jsonObj);
    jQuery('#taxonomy_search').val(JSON.stringify(jsonObj));
    jQuery('#location_block_search').val(JSON.stringify(jsonObj1));
    if (val == '') {
        var search_val = jQuery('#search_content').val();
        var tagv = '';
    } else {
        var search_val = jQuery('#taxonomy_search').val();
        //var search_val = jQuery('#search_content').val();
        var tagv = tag;
    }
    if (search_val == '' && val == '') {
        alert('Please enter search content.');
        return false;
    }

    if (search_val != '') {
        jQuery.ajax({
            url: ajax_url,
            type: "post",
            data: {
                action: "ajax_search_val",
                search_val: search_val,
                tagv: tagv,
                location_block_search: JSON.stringify(JSON.parse(jQuery('#location_block_search').val())),
                taxonomy_search: JSON.stringify(JSON.parse(jQuery('#taxonomy_search').val())),
                post_type: 'contacts_database'
            },
            success: function (result) {
                // alert(result);
                console.log(result);
                //jQuery(".menu_data_from_ajax").html(result);
                jQuery(".search_result_from_contact_database").html(result);
                //search_result_from_contact_database contacts_database
                //alert(result);
            }
        });
    }
}

function save_success_story() {
    console.log('start');
    //jQuery('#success_story').validator()
    jQuery("#success_story").validate({
        rules: {
            fullname: "required",
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            fullname: "Please specify your name",
            email: {
                required: "We need your email address to contact you",
                email: "Your email address must be in the format of name@domain.com"
            }
        },
        submitHandler: function (form) {
            console.log('submit');
            //jQuery(form).ajaxSubmit();
        }
    });
    // validator.showErrors({
    //   "fullname": "Please enter your name.",
    //   "email": "Please enter your valid email.",
    //   "success_story": "Please enter your story.",
    // });
    // return false;
    // var search_val = jQuery('#search_content').val();
    // if (search_val != '') {
    //   jQuery.ajax({
    //     url: ajax_url,
    //     type: "post",
    //     data: {
    //       action: "ajax_search_val",
    //       search_val: search_val,
    //       post_type: 'contacts_database'
    //     },
    //     success: function (result) {
    //       console.log(result);
    //       //jQuery(".menu_data_from_ajax").html(result);
    //       jQuery(".search_result_from_contact_database").html(result);
    //       //search_result_from_contact_database contacts_database
    //       //alert(result);
    //     }
    //   });
    // } else {
    //   alert('Please enter search content.');
    //   return false;
    // }
}


/** scroller script*/
var lastId,
    topMenu = jQuery("#mainNav"),
    topMenuHeight = topMenu.outerHeight() + 1,
    // All list items
    menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function () {
        var item = jQuery(jQuery(this).attr("href"));
        if (item.length) {
            return item;
        }
    });

// Bind click handler to menu items
// so we can get a fancy scroll animation
menuItems.click(function (e) {
    var href = jQuery(this).attr("href"),
        offsetTop = href === "#" ? 0 : jQuery(href).offset().top - topMenuHeight + 1;
    jQuery('html, body').stop().animate({
        scrollTop: offsetTop
    }, 850);
    e.preventDefault();
});
var offset_top = 0;
var general_offset_top = 0;
// Bind to scroll
jQuery(window).scroll(function () {

    // Get container scroll position
    var fromTop = jQuery(this).scrollTop() + topMenuHeight;
    //console.log(jQuery(this).scrollTop() + '+' + topMenuHeight);
    // Get id of current scroll item
    var cur = scrollItems.map(function () {

        if (jQuery(this).offset().top < fromTop)
            return this;
    });
    var cur_end = jQuery('#general').map(function () {
        general_offset_top = jQuery(this).offset().top;
        if (jQuery(this).offset().top < fromTop)
            return this;
    });
    var cur_end = jQuery('.success_story_button').map(function () {
        offset_top = jQuery(this).offset().top;
        if (jQuery(this).offset().top < fromTop)
            return this;
    });
    cur_end = cur_end[cur_end.length - 1];
    // Get the id of the current element
    cur = cur[cur.length - 1];

    var id = cur && cur.length ? cur[0].id : "";

    if (fromTop >= general_offset_top && id == 'general') {

        add_remove('add');
    } else if (fromTop <= general_offset_top) {

        add_remove('remove');
    } else if (fromTop >= offset_top && id == 'expected_results') {

        add_remove('remove');
    } else if (fromTop <= offset_top) {

        add_remove('add');
    }
    //console.log(jQuery('#expected_results').outerHeight());
    if (id == 'expected_results') {
        // console.log(jQuery('#expected_results').outerHeight());
    }
    if (lastId !== id) {
        lastId = id;

        // Set/remove active class
        // menuItems.parent().removeClass("active").end().filter("[href=#" + id + "]").parent().addClass("active");
        menuItems.parent().removeClass("active").children().filter('[href="#' + id + '"]').parent().addClass("active");
    }
});


function add_remove(add) {
    if (add == 'add') {
        jQuery('.scroll').addClass('position_fixed');
    } else {
        jQuery('.scroll').removeClass('position_fixed');
    }
}

function show_full(tt_this) {
    var selected_class = jQuery(tt_this).parent().parent().attr('class');
    console.log(selected_class);
}