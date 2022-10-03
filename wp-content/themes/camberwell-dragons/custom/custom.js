$(document).ready(function () {

    /*  Add to calender feature*/
    /* if ($('.single-event').length && $('.add-to-calendar-btn-wrap').length) {
        var cal_title = jQuery(".event-title h3").html();
        var start_date = jQuery(".add-to-cal").attr('data-date');
        var start_time = jQuery(".add-to-cal").attr('data-time');
        var cal_description = jQuery(".add-to-cal").attr('data-excerpt');
        var cal_address = jQuery(".add-to-cal").attr('data-location');
        var cal_reminder = '30';
        var cal_time = new Date(start_date + " " + start_time);

        var cal_btn_html = createCalendar({ data: { title: cal_title, start: cal_time, duration: 60, description: cal_description, address: cal_address, reminder: cal_reminder } });
        $(".add-to-calendar-btn-wrap").html(cal_btn_html);
        $('.add-to-cal').click(function (event) {
            event.stopPropagation();
            $(".add-to-calendar-btn-wrap").toggleClass('active');
        });
    } */

    /*if ( ($('.single-event').length || $('.page-template-events').length) && $('.add-to-calendar-btn-wrap').length) {
        $('.article-section .add-to-cal, .events-banner-slider .add-to-cal, .event-detail .add-to-cal').each(function() {
            // var cal_title = jQuery(".event-title h3").html();
            var cal_title = jQuery(this).attr('data-title');
            var start_date = jQuery(this).attr('data-date');
            var start_time = jQuery(this).attr('data-time');
            var cal_description = jQuery(this).attr('data-excerpt');
            var cal_address = jQuery(this).attr('data-location');
            var cal_reminder = '30';
            var cal_time = new Date(start_date + " " + start_time);
    
               
            var cal_btn_html = createCalendar({ data: { title: cal_title, start: cal_time, duration: 60, description: cal_description, address: cal_address, reminder: cal_reminder } });
            $(this).parent().find('.add-to-calendar-btn-wrap').html(cal_btn_html);
            $(this).click(function (event) {
                event.stopPropagation();
                // $(".add-to-calendar-btn-wrap").toggleClass('active');
                $(this).parent().find('.add-to-calendar-btn-wrap').toggleClass('active');
            });
        })        
    }*/
	
	
	$("body").on( "click", '.add-to-cal', function() {
		//$(".add-to-calendar-btn-wrap").removeClass("active");
		var cal_title = jQuery(this).attr('data-title');
		var start_date = jQuery(this).attr('data-date');
		var start_time = jQuery(this).attr('data-time');
		var cal_description = jQuery(this).attr('data-excerpt');
		var cal_address = jQuery(this).attr('data-location');
		var cal_reminder = '30';
		var cal_time = new Date(start_date + " " + start_time);
		   
		var cal_btn_html = createCalendar({ data: { title: cal_title, start: cal_time, duration: 60, description: cal_description, address: cal_address, reminder: cal_reminder } });
		$(this).parent().find('.add-to-calendar-btn-wrap').html(cal_btn_html).toggleClass('active');
	});

	

    /** Close add to calendar dropdown if clicked outside div 
    $(document).on("click", function (e) {
        if ($(e.target).is(".add-to-calendar-btn-wrap, .add-to-cal") === false) {
            $(".add-to-calendar-btn-wrap").removeClass("active");
        }
    });*/

    /**
     * Create calendar and add events to it start
     */
    var calendarEl = document.getElementById('calendar');

    /** Render calender only if calendar ID found in DOM */
    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {

            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            displayEventTime: false,
            googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',
            events: ajax_posts.template_directory_uri + '/events-json.php',
            // events: 'en.usa#holiday@group.v.calendar.google.com',

            dateClick: function (info) {
                $('.mobile-block ul').html('')
                $('.mobile-block').removeClass('hide');

                var dateStr = info.dateStr; // Get date of clicked event
                var dayEl = $("td[data-date='" + dateStr + "']").find('.fc-daygrid-day-events div.fc-event-title'); // Get element that contains events for clicked day

                var events_li_html = "";
                dayEl.each(function () {
                    var event_detail_link= $(this).parents('.fc-daygrid-event').attr('href');
                    events_li_html += '<li><a href='+event_detail_link+' target="_blank">' + $(this).text() + '</a></li>';
                })
                $('.mobile-block ul').html(events_li_html)
            },
			eventsSet: function(events) {
				 setTimeout(function () {
						$('.fc-event-title-container').parents('.fc-daygrid-day.fc-day').addClass('active-date-dragon');
				}, 100);				
			},
            loading: function (bool) {
                document.getElementById('loading').style.display =
                    bool ? 'block' : 'none';
            }
        });

        calendar.render();
    }

    /** Create calendar and add events to it end */

    /* Get year dropdown for news filter start */
    var year = (new Date()).getFullYear();
    var starting_year = 2010;
    var current = year;

    var j = 1;
    for (var i = current; i >= starting_year; i--) {
        if (i == (current - 3)) {
            $('<li class="active"><a href="javascript:void(0);">' + i + '</a></li>').insertAfter('#countries.year ul li.top-arrow')
        } else if (j > 7) {
            $('<li style="display:none"><a href="javascript:void(0);">' + i + '</a></li>').insertAfter('#countries.year ul li.top-arrow')
        } else {
            $('<li ><a href="javascript:void(0);">' + i + '</a></li>').insertAfter('#countries.year ul li.top-arrow')
        }
        j++;
    }

    var last_li_value = $('#countries.year dd ul').find('li').length - 1;
    var first_li_value = last_li_value - 6;

    $('#countries.year ul li.top-arrow, #countries.year ul li.bottom-arrow').attr('start-value', first_li_value).attr('end-value', last_li_value);

    /* Get year dropdown for news filter end */

    /** Load more news post in news listing page start */
    $('.news-template-page.view-top-wrap .view-more').click(function (e) {
        e.preventDefault();

        var postsCount = $(".postsCount").attr('data-posts-count');
        var postspage = 4; // Post per page

        $(this).attr("disabled", true); // Disable the button, temp.

        var month_selected = $('#countries.month dt span').text();
        var year_selected = $('#countries.year dt span').text();

        console.log(month_selected, 'month')

        if (month_selected == 'Month') {
            month_selected = '';
        }

        if (year_selected == 'Year') {
            year_selected = '';
        }

        camberwell_load_more_news_posts(month_selected, year_selected, postspage, postsCount);
    })
    /** Load more news post in news listing page end */

    /** Load more events post in events listing page start */
    $('.events-template-page.view-top-wrap .view-more').click(function (e) {
        e.preventDefault();

        // Offset of events post
        var postsCount = $(".postsCount").attr('data-posts-count');

        var postspage = 3; // Post per page
        // var postspage = 6; // Post per page

        $(this).attr("disabled", true); // Disable the button, temp.

        var month_selected = $('#countries.month dt span').text();
        var year_selected = $('#countries.year dt span').text();

        console.log(month_selected, 'month')

        if (month_selected == 'Month') {
            month_selected = '';
        }

        if (year_selected == 'Year') {
            year_selected = '';
        }

        camberwell_load_more_events_posts(month_selected, year_selected, postspage, postsCount);
    })
    /** Load more events post in events listing page end */

    /** Load more other news post in news detail page start */
    $('.view-top-wrap .view-more-detail').click(function (e) {
        e.preventDefault();

        // var postsCount = $(".postsCount").attr('data-posts-count');
        var exclude_post_id = $('.exclude-post').attr('data-id');
        var otherNewsPerPage = 4; // Post per page

        var device_name = camberwell_detect_device();
        if (device_name == 'mobile') {
            otherNewsPerPage = 2;
        }

        $(this).attr("disabled", true); // Disable the button, temp.

        camberwell_load_more_other_news_on_detail_page(otherNewsPerPage, exclude_post_id);
    })
    /** Load more other news post in news detail page end */

    /**
     * Filter news posts by month and year start
     */
    $('.news-banner-section #countries.year ul').on('click', 'li', function (e) {
        e.preventDefault();

        // Unslick the banner slider while filtering
        $('.news-banner-section .news-slider').slick('unslick');

        // var postspage = 4; // Post per page

        var li_selector = '.news-banner-section #countries.year ul li';
        var ul_selector = '.news-banner-section #countries.year dd ul';

        camberwell_year_selection_for_filter(this, li_selector, ul_selector);

        if (!$(this).hasClass('arrow')) {
            $(".dropdown dd ul").hide();
            $(".pageNumber").attr('data-page', 1);

            /* Empty html for each div that contains post content */
            $('.news-banner-section .news-slider').html('');
            $('.two-articles-section .article-block-wrapper').html('');
            $('.four-articles-section .article-block-wrapper').html('');
            $('.four-articles-section .article-block-wrapper:not(:first)').remove();

            var year_selected = parseInt($(this).text());
            var month_selected = $('#countries.month dt span').text();

            if (month_selected == 'Month') {
                month_selected = '';
            }

            // filter_news_post(month_selected, year_selected, postspage);
            camberwell_filter_news_post(month_selected, year_selected);
        }

    });

    $('.news-banner-section #countries.month ul').on('click', 'li', function () {

        // Unslick the banner slider while filtering
        $('.news-banner-section .news-slider').slick('unslick');

        // var postspage = 4; // Post per page
        var start_value = $(this).attr('start-value');
        var end_value = $(this).attr('end-value');

        if ($(this).hasClass('top-arrow')) {

            var prev_value = parseInt(start_value) - 1;
            var next_value = parseInt(end_value) - 1;

            if ($('.month ul li:nth-child(' + (next_value + 2) + ')').hasClass('active')) {
                $('.month ul li:nth-child(' + (next_value + 2) + ')').removeClass('active');
                $('.month ul li:nth-child(' + (next_value + 1) + ')').addClass('active');
            }

            $('.month ul li:nth-child(' + (next_value + 2) + ')').css('display', 'none');
            $('.month ul li:nth-child(' + (prev_value + 1) + ')').css('display', 'block');

            $(this).attr('start-value', prev_value);
            $(this).attr('end-value', next_value);

            $('#countries.month ul li.bottom-arrow').attr('start-value', prev_value);
            $('#countries.month ul li.bottom-arrow').attr('end-value', next_value);

            if (prev_value == 1) {
                $(this).addClass('disabled')
            } else {
                $('#countries.month ul li.bottom-arrow').removeClass('disabled')
            }

        } else if ($(this).hasClass('bottom-arrow')) {

            var prev_value = parseInt(start_value) + 1;
            var next_value = parseInt(end_value) + 1;

            if ($('.month ul li:nth-child(' + (prev_value) + ')').hasClass('active')) {
                $('.month ul li:nth-child(' + (prev_value) + ')').removeClass('active');
                $('.month ul li:nth-child(' + (prev_value + 1) + ')').addClass('active');
            }

            $('.month ul li:nth-child(' + (prev_value) + ')').css('display', 'none');
            $('.month ul li:nth-child(' + (next_value + 1) + ')').css('display', 'block');

            $(this).attr('start-value', prev_value);
            $(this).attr('end-value', next_value);

            $('#countries.month ul li.top-arrow').attr('start-value', prev_value);
            $('#countries.month ul li.top-arrow').attr('end-value', next_value);

            if (next_value == 12) {
                $(this).addClass('disabled')
            } else {
                $('#countries.month ul li.top-arrow').removeClass('disabled')
            }

        } else {

            $(".pageNumber").attr('data-page', 1);

            /* Empty html for each div that contains post content */
            $('.news-banner-section .news-slider').html('');
            $('.two-articles-section .article-block-wrapper').html('');
            $('.four-articles-section .article-block-wrapper').html('');
            $('.four-articles-section .article-block-wrapper:not(:first)').remove();

            var month_selected = $(this).text();
            var year_selected = $('#countries.year dt span').text();

            $('#countries.month dt span').text(month_selected);

            camberwell_filter_news_post(month_selected, year_selected);
        }

    });

    /* Filter news posts by month and year end */

    /**
     * Filter events posts by month and year start
     */
    $('.events-block #countries.year ul').on('click', 'li', function (e) {
        e.preventDefault();

        var postspage = 6; // Post per page

        var li_selector = '.events-block #countries.year ul li';
        var ul_selector = '.events-block #countries.year dd ul';

        camberwell_year_selection_for_filter(this, li_selector, ul_selector);

        if (!$(this).hasClass('arrow')) {
            $(".dropdown dd ul").hide();
            $(".pageNumber").attr('data-page', 1);

            $('.events-block .events-banner-slider').html('');
            $('.three-articles-section .article-block-wrapper').html('');
            $('.three-articles-section .article-block-wrapper:not(:first)').remove();

            var year_selected = parseInt($(this).text());
            var month_selected = $('#countries.month dt span').text();

            if (month_selected == 'Month') {
                month_selected = '';
            }

            camberwell_filter_events_post(month_selected, year_selected, postspage);
        }

    });

    $('.events-block #countries.month ul').on('click', 'li', function () {

        var postspage = 6; // Post per page		
        var start_value = $(this).attr('start-value');
        var end_value = $(this).attr('end-value');

        if ($(this).hasClass('top-arrow')) {

            var prev_value = parseInt(start_value) - 1;
            var next_value = parseInt(end_value) - 1;

            if ($('.month ul li:nth-child(' + (next_value + 2) + ')').hasClass('active')) {
                $('.month ul li:nth-child(' + (next_value + 2) + ')').removeClass('active');
                $('.month ul li:nth-child(' + (next_value + 1) + ')').addClass('active');
            }

            $('.month ul li:nth-child(' + (next_value + 2) + ')').css('display', 'none');
            $('.month ul li:nth-child(' + (prev_value + 1) + ')').css('display', 'block');

            $(this).attr('start-value', prev_value);
            $(this).attr('end-value', next_value);

            $('#countries.month ul li.bottom-arrow').attr('start-value', prev_value);
            $('#countries.month ul li.bottom-arrow').attr('end-value', next_value);

            if (prev_value == 1) {
                $(this).addClass('disabled')
            } else {
                $('#countries.month ul li.bottom-arrow').removeClass('disabled')
            }

        } else if ($(this).hasClass('bottom-arrow')) {

            var prev_value = parseInt(start_value) + 1;
            var next_value = parseInt(end_value) + 1;

            if ($('.month ul li:nth-child(' + (prev_value) + ')').hasClass('active')) {
                $('.month ul li:nth-child(' + (prev_value) + ')').removeClass('active');
                $('.month ul li:nth-child(' + (prev_value + 1) + ')').addClass('active');
            }

            $('.month ul li:nth-child(' + (prev_value) + ')').css('display', 'none');
            $('.month ul li:nth-child(' + (next_value + 1) + ')').css('display', 'block');

            $(this).attr('start-value', prev_value);
            $(this).attr('end-value', next_value);

            $('#countries.month ul li.top-arrow').attr('start-value', prev_value);
            $('#countries.month ul li.top-arrow').attr('end-value', next_value);

            if (next_value == 12) {
                $(this).addClass('disabled')
            } else {
                $('#countries.month ul li.top-arrow').removeClass('disabled')
            }

        } else {

            $(".pageNumber").attr('data-page', 1);

            $('.events-block .events-banner-slider').html('');
            $('.three-articles-section .article-block-wrapper').html('');
            $('.three-articles-section .article-block-wrapper:not(:first)').remove();

            var month_selected = $(this).text();
            var year_selected = $('#countries.year dt span').text();

            $('#countries.month dt span').text(month_selected);

            camberwell_filter_events_post(month_selected, year_selected, postspage);
        }

    });


    /**
     * Add class in contact form 7 on input focus
     */
    $('.dragon-form input.wpcf7-form-control').focus(function () {
        $(this).parents('.text-field').addClass('focus-active');
    })
    $('.dragon-form input.wpcf7-form-control').focusout(function () {

        // if input box has value, do not remove focus-active class
        if ($.trim($(this).val()) == '' && $.trim($(this).val()).length == 0) {
            $(this).parents('.text-field').removeClass('focus-active');
        }
    })

    /**
     * Add icons for submenu for opening it and toggle submenu
     */
    $('li.has-submenu > a').prepend('<i><img src="' + ajax_posts.template_directory_uri + '/public/images/plus.svg" class="open" alt=""><img src="' + ajax_posts.template_directory_uri + '/public/images/minus.svg" class="close" alt=""></i>');
    // $(".has-submenu i").click(function (e) {
    //     e.preventDefault();
    //     $(this).hasClass("open") ? $(this).removeClass("open") : $(this).toggleClass("open");
    //     $(this).parents(".menu-item").find(".sub-menu-list").toggle();
    // });

    $(".has-submenu i").click(function (e) {
        if ($(this).hasClass('open')) {
          $(this).removeClass("open");
          $(this).parents(".menu-item").find(".sub-menu-list").hide();
        } else {
          $(".has-submenu i").parents(".menu-item").find(".sub-menu-list").hide();
          $(".has-submenu i").removeClass("open");
          $(this).parents(".menu-item").find(".sub-menu-list").toggle();
          $(this).toggleClass("open");
        }
        e.preventDefault();
      });


    if ($('.sub-menu-list li').hasClass('current_page_item')) {
        var device_name = camberwell_detect_device();
        if (device_name == 'mobile' || device_name == 'tablet') {            
            $(".has-submenu i").trigger('click');
        }
    }

    /**
     * Display loader on ajaxstart and hide on complete
     */
    $(document).ajaxStart(function () {
        // $(".loader").show();
        $(".loader").css('display', 'flex');
        $('body').addClass('active-loader');
    });
    $(document).ajaxComplete(function () {
        setTimeout(function () {
            $(".loader").hide();
        }, 1000);

        $('body').removeClass('active-loader');
    });

    /**
     * Display custom loader for contact form submission
     */
    jQuery('.wpcf7 .wpcf7-form').on('submit', function (e) {
        if ($(this).hasClass('submitting')) {
            e.preventDefault();
            $(".loader").css('display', 'flex');
            $('body').addClass('active-loader');
        }
    });
    document.addEventListener('wpcf7submit', function (event) {
        $(".loader").hide();
        $('body').removeClass('active-loader');
    }, false);

});

/**
 * Load posts on click of view more button
 */
function camberwell_load_more_news_posts(month, year, ppp, offset) {

    var str = '&month_selected=' + month + '&year_selected=' + year + '&offset=' + offset + '&ppp=' + ppp + '&action=load_more_news_post_ajax';

    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function (data) {
            var $data = $(data);

            if ($data.length) {
                $($data).insertAfter('.four-articles-section .article-block-wrapper:last');
                $(".news-template-page.view-top-wrap .view-more").attr("disabled", false);
            } else {
                $(".news-template-page.view-top-wrap .view-more").attr("disabled", true);
            }

            // Update offset to display next 4 posts
            var total_news_post = $(".custom-total").attr('data-total');
            offset = (parseInt(offset) + ppp >= total_news_post) ? total_news_post : parseInt(offset) + ppp;
            $(".postsCount").attr('data-posts-count', offset);

            // Hide view more link if displayed all news posts			
            if (total_news_post <= offset) {
                $('.news-template-page.view-top-wrap .view-more').hide();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('.four-articles-section .container').html(textStatus);
        }

    });
    return false;
}

/**
 * Load posts on click of view more button
 */
function camberwell_load_more_events_posts(month, year, ppp, offset) {

    var pageNumber = parseInt($(".pageNumber").attr('data-page'));
    pageNumber++;

    // var str = '&month_selected=' + month + '&year_selected=' + year + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=load_more_events_post_ajax';

    var str = '&month_selected=' + month + '&year_selected=' + year + '&offset=' + offset + '&ppp=' + ppp + '&action=load_more_events_post_ajax';

    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function (data) {
            var $data = $(data);

            if ($data.length) {
                $($data).insertAfter('.three-articles-section .article-block-wrapper:last');
                $(".events-template-page.view-top-wrap .view-more").attr("disabled", false);
            } else {
                $(".events-template-page.view-top-wrap .view-more").attr("disabled", true);
            }

            // Update offset to display next 4 posts
            var total_news_post = $(".custom-total").attr('data-total');
            offset = (parseInt(offset) + ppp >= total_news_post) ? total_news_post : parseInt(offset) + ppp;
            $(".postsCount").attr('data-posts-count', offset);

            // Hide view more link if displayed all news posts			
            if (total_news_post <= offset) {
                $('.events-template-page.view-top-wrap .view-more').hide();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('.three-articles-section .container').html(textStatus);
        }

    });
    return false;
}

/**
 * Load more other news post for news detail page
 */
function camberwell_load_more_other_news_on_detail_page(otherNewsPerPage, exclude_post_id) {
    var pageNumber = parseInt($(".pageNumber").attr('data-page'));
    pageNumber++;

    var str = '&pageNumber=' + pageNumber + '&ppp=' + otherNewsPerPage + '&action=load_more_other_news_post_for_detail_page&exclude_post_id=' + exclude_post_id;

    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function (data) {

            var $data = $(data);

            $(".pageNumber").attr('data-page', pageNumber);

            if ($data.length) {
                $($data).insertAfter('.four-articles-section .article-block-wrapper:last');
                $(".view-more-detail").attr("disabled", false);
            } else {
                $(".view-more-detail").attr("disabled", true);
            }

            // $('.news-section .column .inner-column .image-block a').equalHeights(); // Equal image
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('.four-articles-section .container').html(textStatus);
        }

    });
    return false;

}

/**
 * Filter news posts by date, month and year function
 */
// function camberwell_filter_news_post(month, year, ppp) {
function camberwell_filter_news_post(month, year) {

    var pageNumber = $(".pageNumber").attr('data-page');

    var str = '&month_selected=' + month + '&year_selected=' + year + '&action=filter_news_post&pageNumber=' + pageNumber;

    // Unslick the slick slider intially
    $('.news-banner-section .news-slider').slick('unslick');

    $.ajax({
        type: "POST",
        dataType: "json",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function (data) {

            $(".pageNumber").attr('data-page', pageNumber);

            $(".custom-total").attr('data-total', data.totalNewsPosts);
            // $(".postsCount").attr('data-posts-count', ppp);
            $(".postsCount").attr('data-posts-count', data.foundPosts);


            if (data.totalNewsPosts < 1) {
                $('.loader').hide();  // hide loader immediately

                $('.news-banner-section .news-slider').html('');
                $('.two-articles-section .article-block-wrapper').html('<h5 class="no-results">No Post Found</h5>');
                $('.four-articles-section  .article-block-wrapper').html('');
            } else {
                $('.news-banner-section .news-slider').html(data.sliderSectionHtml);
                $('.two-articles-section  .article-block-wrapper').html(data.twoColumnSectionHtml);
                $('.four-articles-section  .article-block-wrapper').html(data.fourColumnSectionHtml);

                //Reinitialize slick slider after adding html
                news_banner_slick();
                $(window).trigger('resize');
            }

            // $('.news-section .column .inner-column .image-block a').equalHeights(); // Equal image

            if (data.viewMoreBtn) {
                $('.view-more').show();
            } else {
                $('.view-more').hide();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('.news-banner-section .container').html(textStatus);
        }
    });
    return false;
}

/**
 * Filter events posts by month and year function
 */
function camberwell_filter_events_post(month, year, ppp) {

    var pageNumber = $(".pageNumber").attr('data-page');

    var str = '&month_selected=' + month + '&year_selected=' + year + '&action=filter_events_post&pageNumber=' + pageNumber;

    // Unslick the slick slider intially
    $('.events-block .events-banner-slider ').slick('unslick');
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function (data) {

            $(".pageNumber").attr('data-page', pageNumber);

            $(".custom-total").attr('data-total', data.totalNewsPosts);
            $(".postsCount").attr('data-posts-count', ppp);

            if (data.totalNewsPosts < 1) {
                $('.loader').hide();  // hide loader immediately

                $('.events-block .events-banner-slider').html('');
                $('.three-articles-section .article-block-wrapper').html('<h5 class="no-results">No Post Found</h5>');
            } else {
                $('.events-block .events-banner-slider').html(data.sliderSectionHtml);
                $('.three-articles-section .article-block-wrapper').html(data.threeColumnSectionHtml);

                //Reinitialize slick slider after adding html				
                $(".events-banner-slider").not(".slick-initialized").slick({ dots: !1, infinite: !0, cssEase: "linear", slidesToShow: 1, slidesToScroll: 1, arrows: !1, autoplay: !0, fade: !0, responsive: [{ breakpoint: 768, settings: { dots: !0, autoplay: !1 } }] })
                $(window).trigger('resize');
            }

            if (data.viewMoreBtn) {
                console.log('view')
                $('.view-more').show();
            } else {
                console.log('view not')
                $('.view-more').hide();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('.events-block .container').html(textStatus);
        }
    });
    return false;
}

/**
 * Select year for news filter function 
 */
function camberwell_year_selection_for_filter(sel, li_selector, ul_selector) {

    var up_arrow_selector = li_selector + '.top-arrow';
    var down_arrow_selector = li_selector + '.bottom-arrow';

    var start_value = $(sel).attr('start-value');
    var end_value = $(sel).attr('end-value');

    if (!$(sel).hasClass('arrow')) {
        $(sel).parents(".dropdown").find("dd ul li").removeClass("active");
        $(sel).addClass("active")
        var e = $(sel).find('a').text();
        $(sel).parents(".dropdown").find("dt a span").html(e)
    }

    if ($(sel).hasClass('top-arrow')) {

        var prev_value = parseInt(start_value) - 1;
        var next_value = parseInt(end_value) - 1;

        if ($(li_selector + ':nth-child(' + (next_value + 1) + ')').hasClass('active')) {
            $(li_selector + ':nth-child(' + (next_value + 1) + ')').removeClass('active');
            $(li_selector + ':nth-child(' + (next_value) + ')').addClass('active');
        }

        $(li_selector + ':nth-child(' + (next_value + 1) + ')').css('display', 'none');
        $(li_selector + ':nth-child(' + (prev_value) + ')').css('display', 'block');

        $(sel).attr('start-value', prev_value);
        $(sel).attr('end-value', next_value);

        $(down_arrow_selector).attr('start-value', prev_value);
        $(down_arrow_selector).attr('end-value', next_value);

        if (prev_value == 2) {
            $(sel).addClass('disabled')
        } else {
            $(down_arrow_selector).removeClass('disabled')
        }

    } else if ($(sel).hasClass('bottom-arrow')) {

        var prev_value = parseInt(start_value) + 1;
        var next_value = parseInt(end_value) + 1;

        if ($(li_selector + ':nth-child(' + (prev_value) + ')').hasClass('active')) {
            $(li_selector + ':nth-child(' + (prev_value) + ')').removeClass('active');
            $(li_selector + ':nth-child(' + (prev_value + 1) + ')').addClass('active');
        } else if ($(li_selector + ':nth-child(' + (start_value) + ')').hasClass('active')) {
            $(li_selector + ':nth-child(' + (start_value) + ')').removeClass('active');
            $(li_selector + ':nth-child(' + (prev_value) + ')').addClass('active');
        }

        $(li_selector + ':nth-child(' + (prev_value - 1) + ')').css('display', 'none');
        $(li_selector + ':nth-child(' + (next_value) + ')').css('display', 'block');

        $(sel).attr('start-value', prev_value);
        $(sel).attr('end-value', next_value);

        $(up_arrow_selector).attr('start-value', prev_value);
        $(up_arrow_selector).attr('end-value', next_value);

        var last_li_value = $(ul_selector).find('li').length - 1;
        if (next_value == last_li_value) {
            $(down_arrow_selector).addClass('disabled')
        } else {
            $(up_arrow_selector).removeClass('disabled')
        }
    }
}

/**
 * Ditect device if it is desktop, tablet or mobile
 */
function camberwell_detect_device() {
    if (/mobile/i.test(navigator.userAgent) && !/ipad|tablet/i.test(navigator.userAgent)) {
        return 'mobile';
    } else if (/ipad|tablet/i.test(navigator.userAgent)) {
        return 'tablet';
    } else {
        return 'desktop';
    }
}