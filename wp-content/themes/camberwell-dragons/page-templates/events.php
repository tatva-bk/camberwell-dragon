<?php
/* Template Name: Events Template */

get_header();

$bgBannerDeskImage = get_field('background_banner_desktop_image', $post->ID);
$bgBannerTabletImage = get_field('background_banner_tablet_image', $post->ID);
$bgBannerMobileImage = get_field('background_banner_mobile_image', $post->ID);
$eventPageDescription = get_field('event_page_description', $post->ID);

?>
<main class="main-wrap fixed-main-wrap">
    <section class="calendar">
        <div class="container">
            <div id='loading'></div>
            <div id='calendar'></div>
            <div class="mobile-block hide">
                <ul>
                    <li>
                        Name of the Event One
                    </li>
                    <li>
                        Name of the Event Two
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="events-block inner-event-block">
        <div class="container">

            <div class="month-year">
                <dl id='countries' class="dropdown month">
                    <dt>
                        <a href="javascript:void(0);"><span>Month</span></a>
                    </dt>
                    <dd>
                        <ul>
                            <li class="top-arrow arrow disabled" start-value='1' end-value='7'>
                                <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/public/images/right-arrow.svg" alt=""></a>
                            </li>
                            <li value="1"><a href="javascript:void(0);">January</a></li>
                            <li value="2"><a href="javascript:void(0);">February</a></li>
                            <li value="3"><a href="javascript:void(0);">March</a></li>
                            <li value="4" class="active"><a href="javascript:void(0);">April</a></li>
                            <li value="5"><a href="javascript:void(0);">May</a></li>
                            <li value="6"><a href="javascript:void(0);">June</a></li>
                            <li value="7"><a href="javascript:void(0);">July</a></li>
                            <li value="8" style="display: none;"><a href="javascript:void(0);">August</a></li>
                            <li value="9" style="display: none;"><a href="javascript:void(0);">September</a></li>
                            <li value="10" style="display: none;"><a href="javascript:void(0);">October</a></li>
                            <li value="11" style="display: none;"><a href="javascript:void(0);">November</a></li>
                            <li value="12" style="display: none;"><a href="javascript:void(0);">December</a></li>
                            <li class="bottom-arrow arrow" start-value='1' end-value='7'>
                                <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/public/images/right-arrow.svg" alt=""></a>
                            </li>
                        </ul>
                    </dd>
                </dl>
                <dl id='countries' class="dropdown year">
                    <dt>
                        <a href="javascript:void(0);"><span>Year</span></a>
                    </dt>
                    <dd>
                        <ul>
                            <li class="top-arrow arrow">
                                <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/public/images/right-arrow.svg" alt=""></a>
                            </li>
                            <li class="bottom-arrow arrow disabled">
                                <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/public/images/right-arrow.svg" alt=""></a>
                            </li>
                        </ul>
                    </dd>
                </dl>
            </div>
            <div class="events-banner-slider">
                <?php
                $postsPerPage = 3;
                $current_month_start_date = date("Y-m-d", strtotime(date('m') . '/01/' . date('Y')));
                $current_month_end_date = date("Y-m-d", strtotime(date('m') . '/31/' . date('Y')));

                /** Display upcoming events of current month and year */
                $args = array(
                    'post_type' => 'event',
                    'posts_per_page' => $postsPerPage,
                    'post_status' => 'publish',
                    'order' => 'ASC',
                    'orderby' => 'meta_value',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'event_start_date',
                            'value' => date("Y-m-d"), // Set today's date (note the similar format)
                            'compare' => '>=', // Return the ones greater than today's date
                            'type' => 'DATE' // Let WordPress know we're working with date
                        ),
                        array(
                            'key' => 'event_start_date',
                            'value' => array($current_month_start_date, $current_month_end_date),
                            'compare' => 'BETWEEN',
                            'type' => 'DATE',
                        ),
                    ),
                );

                $sliderEventPosts = new WP_Query($args);

                $do_not_duplicate_arr = [];

                if ($sliderEventPosts->have_posts()) {
                    while ($sliderEventPosts->have_posts()) : $sliderEventPosts->the_post();
                        $eventPostId = get_the_ID();
                        $do_not_duplicate_arr[] = $eventPostId;

                        $sliderDeskImage = get_field('slider_section_desktop_device_image', $eventPostId);
                        $sliderTabletImage = get_field('slider_section_tablet_device_image', $eventPostId);
                        $sliderMobileImage = get_field('slider_section_mobile_device_image', $eventPostId);

                        $sliderSectionDescription = get_field('slider_section_description', $eventPostId);
                        $shareLinkLabel = get_field('share_link_label', $eventPostId);
                        $eventStartDate = get_field('event_start_date', $eventPostId);
                        $eventTime = get_field('event_time', $eventPostId);
                        $eventLocation = get_field('event_location', $eventPostId); ?>
                        <div class="slide-item">
                            <div class="event-wrapper">
                                <div class="event-img-block" style="background-image: url(<?php echo $sliderDeskImage['url']; ?>)">
                                    <div class="feature-event-block">
                                        <h2 class="block-title primary-title"><?php echo get_the_title(); ?></h2>

                                        <?php if ($eventStartDate) { ?>
                                            <p class="date"><?php echo $eventStartDate; ?></p>
                                        <?php } ?>

                                        <?php if (!empty($sliderSectionDescription)) {
                                            echo $sliderSectionDescription;
                                        } ?>

                                        <div class="view-and-share">

                                            <a href="<?php echo get_the_permalink(); ?>" class="btn-white" title="<?php echo _e('view', 'camberwell-dragons') ?>"><?php echo _e('View', 'camberwell-dragons') ?></a>

                                            <?php
                                            $subject = get_the_title($eventPostId);
                                            $body = get_the_permalink($eventPostId);
                                            $mailto = '';
                                            $shareLink = "mailto:$mailto?subject=$subject&body=$body";

                                            if ($shareLinkLabel && $shareLink) { ?>
                                                <a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
                                                    <span><?php echo $shareLinkLabel; ?></span>
                                                    <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt=""></i>
                                                </a>
                                            <?php } ?>

                                            <a href="javascript:void(0);" class="share-btn add-to-cal" title="<?php echo _e('Add', 'camberwell-dragons') ?>" data-title="<?php echo get_the_title(); ?>"  data-date="<?php echo $eventStartDate; ?>" data-time="<?php echo $eventTime; ?>" data-location="<?php echo $eventLocation; ?>" data-excerpt="<?php echo get_the_excerpt(); ?>">
                                                <span><?php echo _e('Add', 'camberwell-dragons') ?></span>
                                                <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/plus.svg" alt=""></i>
                                            </a>
                                            <div class="add-to-calendar-btn-wrap"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><?php
                    endwhile;
                } else { ?>
                    <h5 class="no-results">No upcoming events found for current month.</h5><?php
                }
                wp_reset_query();
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <section class="article-section inner-article three-articles-section">
        <div class="container">
            <div class="article-block-wrapper">
                <?php
                $postsPerPage = 6;
                /** Display upcoming events of current month and year */
                $args = array(
                    'post_type' => 'event',
                    'posts_per_page' => $postsPerPage,
                    'post_status' => 'publish',
                    'order' => 'ASC',
                    'orderby' => 'meta_value',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'event_start_date',
                            'value' => date("Y-m-d"), // Set today's date (note the similar format)
                            'compare' => '>=', // Return the ones greater than today's date
                            'type' => 'DATE' // Let WordPress know we're working with date
                        ),
                        array(
                            'key' => 'event_start_date',
                            'value' => array($current_month_start_date, $current_month_end_date),
                            'compare' => 'BETWEEN',
                            'type' => 'DATE',
                        ),
                    ),
                );

                $eventPosts = new WP_Query($args);

                if ($eventPosts->have_posts()) : while ($eventPosts->have_posts()) : $eventPosts->the_post();
                        $eventPostId = get_the_ID();

                        if (in_array($eventPostId, $do_not_duplicate_arr)) continue;   // skip the first three ids of news post

                        $eventDeskImage = get_field('event_section_desktop_device_image', $eventPostId);
                        $eventTabletImage = get_field('event_section_tablet_device_image', $eventPostId);
                        $eventMobileImage = get_field('event_section_mobile_device_image', $eventPostId);

                        $eventStartDate = get_field('event_start_date', $eventPostId);
                        $shareLinkLabel = get_field('share_link_label', $eventPostId);
                        $eventTime = get_field('event_time', $eventPostId);
                        $eventLocation = get_field('event_location', $eventPostId);
                ?>
                        <div class="article-block">
                            <div class="image-block">
                                <i>
                                    <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                        <?php if ($eventDeskImage) { ?>
                                            <!-- <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="desktop-img"> -->
                                            <img src="<?php echo $eventDeskImage['sizes']['medium']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="desktop-img">
                                        <?php } ?>

                                        <?php if ($eventTabletImage) { ?>
                                            <img src="<?php echo $eventTabletImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="tablet-img">
                                        <?php } else { ?>
                                            <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="tablet-img">
                                        <?php } ?>

                                        <?php if ($eventMobileImage) { ?>
                                            <img src="<?php echo $eventMobileImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="mobile-img">
                                        <?php } else { ?>
                                            <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="mobile-img">
                                        <?php } ?>
                                    </a>
                                </i>
                            </div>
                            <div class="article-detail">
                                <h4 class="white-border secondary-title"><?php echo get_the_title(); ?></h4>

                                <?php if ($eventStartDate) { ?>
                                    <span><?php echo $eventStartDate; ?></span>
                                <?php } ?>

                                <?php
                                $excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $eventPostId));
                                echo $excerpt;
                                ?>

                                <div class="article-btns">
                                    <a href="<?php echo get_the_permalink(); ?>" class="btn-white" title="<?php echo _e('view', 'camberwell-dragons') ?>"><?php echo _e('View', 'camberwell-dragons') ?></a>
                                    <?php
                                    $subject = get_the_title($eventPostId);
                                    $body = get_the_permalink($eventPostId);
                                    $mailto = '';
                                    $shareLink = "mailto:$mailto?subject=$subject&body=$body";

                                    if ($shareLinkLabel && $shareLink) { ?>
                                        <a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
                                            <span><?php echo $shareLinkLabel; ?></span>
                                            <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt=""></i>
                                        </a>
                                    <?php } ?>

                                    <a href="javascript:void(0);" class="share-btn add-to-cal" title="<?php echo _e('Add', 'camberwell-dragons') ?>" title="<?php echo _e('Add', 'camberwell-dragons') ?>" data-title="<?php echo get_the_title(); ?>" data-date="<?php echo $eventStartDate; ?>" data-time="<?php echo $eventTime; ?>" data-location="<?php echo $eventLocation; ?>" data-excerpt="<?php echo get_the_excerpt(); ?>">
                                        <span><?php echo _e('Add', 'camberwell-dragons') ?></span>
                                        <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/plus.svg" alt=""></i>
                                    </a>
                                    <div class="add-to-calendar-btn-wrap"></div>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                endif;
                wp_reset_query();
                wp_reset_postdata();

                /** Get all upcoming events of current month and year */
                $args = array(
                    'post_type' => 'event',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'order' => 'ASC',
                    'orderby' => 'meta_value',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'event_start_date',
                            'value' => date("Y-m-d"), // Set today's date (note the similar format)
                            'compare' => '>=', // Return the ones greater than today's date
                            'type' => 'DATE' // Let WordPress know we're working with date
                        ),
                        array(
                            'key' => 'event_start_date',
                            'value' => array($current_month_start_date, $current_month_end_date),
                            'compare' => 'BETWEEN',
                            'type' => 'DATE',
                        ),
                    ),
                );

                $allEventPosts = new WP_Query($args);
                $totalPosts = $allEventPosts->found_posts;

                wp_reset_query();
                wp_reset_postdata();

                ?>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="view-top-wrap events-template-page">
                <?php
                $style = 'style="display:none"';
                if ($totalPosts > $postsPerPage) {
                    $style = 'style="display:block"';
                } ?>
                <a class="view-more" <?php echo $style; ?> href="javascript:void(0)" title="<?Php echo _e('View more events', 'camberwell-dragons'); ?>">
                    <span><?Php echo _e('View more events', 'camberwell-dragons'); ?></span>
                    <i><img src="<?php echo get_template_directory_uri(); ?>/public/images/plus-large-red.svg" alt=""></i>
                </a>

                <div class="custom-total" data-total='<?php echo $totalPosts; ?>'></div>
                <div class="postsCount" data-posts-count='<?Php echo $postsPerPage; ?>'></div>
                <div class="pageNumber" data-page='1'></div>

                <a class="back-to-top" href="javascript:void(0)" title="<?Php echo _e('Back to top', 'camberwell-dragons'); ?>">
                    <i><img src="<?php echo get_template_directory_uri(); ?>/public/images/right_arrow.svg" alt="<?Php echo _e('Totop', 'camberwell-dragons'); ?>"></i>
                    <span><?Php echo _e('Back to top', 'camberwell-dragons'); ?></span>
                </a>

            </div>
        </div>
    </section>
</main>

<?php get_footer();