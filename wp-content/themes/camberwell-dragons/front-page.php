<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package camberwell-dragons
 */
get_header();

$mainBgDeskImage = get_field('main_background_desktop_device_image', $post->ID);
$mainBgTabletImage = get_field('main_background_tablet_device_image', $post->ID);
$mainBgMobileImage = get_field('main_background_mobile_device_image', $post->ID);
$mainTitleImage = get_field('banner_main_title_image', $post->ID);
$newsSectionTitle = get_field('news_section_title', $post->ID);
$shareLinkLabel = get_field('share_link_label', $post->ID);
$storeSectionTitle = get_field('store_section_title', $post->ID);
?>
<main class="main-wrap">
    <section class="main-banner">
        <?php if (have_rows('main_desktop_image_slider')) : ?>
            <div class="home-banner-slider">
                <?php
                while (have_rows('main_desktop_image_slider')) : the_row();
                    $mainBgDeskImage = get_sub_field('main_background_desktop_device_image', $post->ID);
                    $mainBgTabletImage = get_sub_field('main_background_tablet_device_image', $post->ID);
                    $mainBgMobileImage = get_sub_field('main_background_mobile_device_image', $post->ID);
                    if (!$mainBgTabletImage) {
                        $mainBgTabletImage = $mainBgDeskImage;
                    }
                    if (!$mainBgMobileImage) {
                        $mainBgMobileImage = $mainBgTabletImage;
                    }
                ?>
                    <div class="slide-item">
                        <div class="image-block">
                            <?php if ($mainBgDeskImage) { ?>
                                <div class="banner-img desktop-img" style="background-image: url(<?php echo $mainBgDeskImage['url']; ?>);"></div>
                            <?php } ?>

                            <?php if ($mainBgTabletImage) { ?>
                                <div class="banner-img tablet-img" style="background-image: url(<?php echo $mainBgTabletImage['url']; ?>);"></div>
                            <?php } ?>

                            <?php if ($mainBgMobileImage) { ?>
                                <div class="banner-img mobile-img" style="background-image: url(<?php echo $mainBgMobileImage['url']; ?>);"></div>
                            <?php } ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($mainTitleImage)) { ?>
            <div class="container">
                <div class="banner-content">
                    <i><img src="<?php echo $mainTitleImage['url']; ?>" alt="<?php echo $mainTitleImage['alt']; ?>"></i>
                </div>
            </div>
        <?php } ?>
    </section>

    <section class="col-section">
        <div class="container">
            <h1></h1>
            <div class="col-wrapper three-col">
                <!-- Become a dragon section start -->
                <?php
                $becomeDragonSection = get_field('become_a_dragon_section');
                if ($becomeDragonSection) :
                ?>
                    <div class="col">
                        <div class="inner-div">
                            <h2><?php echo $becomeDragonSection['section_title']; ?></h2>
                            <div class="detail">
                                <?php echo $becomeDragonSection['section_description']; ?>
                                <a class="btn-white" href="<?php echo esc_url($becomeDragonSection['join_button_link']); ?>" title="<?php echo esc_html($becomeDragonSection['join_button_label']); ?>"><?php echo esc_html($becomeDragonSection['join_button_label']); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Become a dragon section end -->

                <!-- Club Programs section start -->
                <?php
                $clubProgramSection = get_field('club_program_section');
                if ($clubProgramSection) :
                ?>
                    <div class="col">
                        <div class="inner-div">
                            <h2><?php echo $clubProgramSection['section_title']; ?></h2>
                            <div class="detail">
                                <?php echo $clubProgramSection['section_description']; ?>
                                <a class="btn-white" href="<?php echo esc_url($clubProgramSection['view_buttton_link']); ?>" title="<?php echo esc_html($clubProgramSection['view_button_label']); ?>"><?php echo esc_html($clubProgramSection['view_button_label']); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Club Programs section end -->

                <!-- SUBSCRIBE TO  DRAGONS DEN section start -->
                <?php
                $subsribeToDragonSection = get_field('subscribe_to_dragons_den_section');
                if ($subsribeToDragonSection) :
                ?>
                    <div class="col">
                        <div class="inner-div">
                            <h2><?php echo $subsribeToDragonSection['section_title']; ?></h2>
                            <div class="detail">
                                <?php echo $subsribeToDragonSection['section_description']; ?>
                                <a class="btn-white" title="<?php echo esc_html($subsribeToDragonSection['subscribe_button_label']); ?>" href="<?php echo esc_url($subsribeToDragonSection['subscribe_button_link']); ?>"><?php echo esc_html($subsribeToDragonSection['subscribe_button_label']); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- SUBSCRIBE TO  DRAGONS DEN section end -->
            </div>
            <div class="col-wrapper two-col">
                <!-- VJBL SCORES & FIXTURES section start -->
                <?php
                $vjblScoresSection = get_field('vjbl_scores_section');
                if ($vjblScoresSection) :
                ?>
                    <div class="col vjbl-section">
                        <a title="<?php echo $vjblScoresSection['section_title']; ?>" href="<?php echo $vjblScoresSection['section_link']; ?>" target="_blank">
                            <div class="inner-div">
                                <h2><?php echo $vjblScoresSection['section_title']; ?></h2>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <!-- VJBL SCORES & FIXTURES section end -->

                <!-- VJBL SCORES & FIXTURES section start -->
                <?php
                $bigvScoresSection = get_field('bigv_scores_section');
                if ($bigvScoresSection) :
                ?>
                    <div class="col club-section">
                        <a title="<?php echo $bigvScoresSection['section_title']; ?>" href="<?php echo $bigvScoresSection['section_link']; ?>" target="_blank">
                            <div class="inner-div">
                                <h2><?php echo $bigvScoresSection['section_title']; ?></h2>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <!-- VJBL SCORES & FIXTURES section end -->
            </div>
        </div>
    </section>
    <!-- News Section Start -->
    <?php
    $newsViewMoreLabel = get_field('news_view_more_cta_label');
    $newsViewMoreUrl = get_field('news_view_more_cta_url');
    $newsPostPerPage = 3;
    $queryNews = new WP_Query(array('post_type' => 'post', 'order' => 'DESC', 'posts_per_page' => $newsPostPerPage));
    if ($queryNews->have_posts()) {
    ?>
        <section class="article-section">
            <div class="container">
                <div class="article-title">
                    <?php if ($newsSectionTitle) { ?>
                        <h3><?php echo $newsSectionTitle; ?></h3>
                    <?php } else { ?>
                        <h3><?php echo _e('NEWS', 'camberwell-dragons'); ?></h3>
                    <?php } ?>
                    <?php if (!empty($newsViewMoreLabel) && !empty($newsViewMoreUrl)) { ?>
                        <a href="<?php echo $newsViewMoreUrl; ?>" title="<?php echo $newsViewMoreLabel; ?>" class="more-news">
                            <i><img src="<?php echo get_template_directory_uri(); ?>/public/images/right_arrow.svg" alt="<?php echo _e('right-arrow', 'camberwell-dragons') ?>"></i><span><?php echo $newsViewMoreLabel; ?></span>
                        </a>
                    <?php } ?>
                </div>
                <div class="article-block-wrapper article-slider">
                    <?php
                    $countClass = 1;
                    while ($queryNews->have_posts()) {

                        $queryNews->the_post();
                        $id = get_the_ID();
                        $newsDeskImage = get_field('news_section_desktop_device_image', $id);
                        $newsTabletImage = get_field('news_section_tablet_device_image', $id);
                        $newsMobileImage = get_field('news_section_mobile_device_image', $id);
                        if (!$newsTabletImage) {
                            $newsTabletImage = $newsDeskImage;
                        }
                        if (!$newsMobileImage) {
                            $newsMobileImage = $newsTabletImage;
                        }
                        if ($countClass % 3 == 1) {
                            $articleClass = 'one';
                        } elseif ($countClass % 3 == 2) {
                            $articleClass = 'two';
                        } elseif ($countClass % 3 == 0) {
                            $articleClass = 'three';
                        } else {
                            $articleClass = '';
                        }
                    ?>
                        <div class="article-block">
                            <div class="image-block">
                                <i>
                                    <a href="<?php the_permalink(); ?>" title="<?php echo _e('News', 'camberwell-dragons') ?>">
                                        <?php if ($newsDeskImage) { ?>
                                            <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?php echo _e('News', 'camberwell-dragons') ?>" class="desktop-img">
                                        <?php } ?>

                                        <?php if ($newsTabletImage) { ?>
                                            <img src="<?php echo $newsTabletImage['url']; ?>" alt="<?php echo _e('News', 'camberwell-dragons') ?>" class="tablet-img">
                                        <?php } ?>

                                        <?php if ($newsMobileImage) { ?>
                                            <img src="<?php echo $newsMobileImage['url']; ?>" alt="<?php echo _e('News', 'camberwell-dragons') ?>" class="mobile-img">
                                        <?php } ?>
                                    </a>
                                </i>

                            </div>
                            <div class="article-detail article-<?php echo $articleClass; ?>">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <h4 class="white-border secondary-title"><?php the_title(); ?></h4>
                                </a>

                                <!-- <span><?php echo get_the_date('l d M Y', $post->ID); ?></span> -->
                                <span><?php echo get_the_date('D d M Y', $post->ID); ?></span>
                                
                                <?php
                                $excerptContent = get_the_excerpt();
                                $excerptContent = (strlen($excerptContent) > 129) ? substr($excerptContent, 0, 91) . '...' : $excerptContent;
                                ?>
                                <p><?php echo $excerptContent; ?></p>
                                <div class="article-btns">
                                    <a href="<?php the_permalink(); ?>" title="View" class="btn-white"><?php echo _e('view', 'camberwell-dragons') ?></a>
                                    <?php
                                    $subject = get_the_title($id);
                                    $body = get_the_permalink($id);
                                    $mailto = '';
                                    $shareLink = "mailto:$mailto?subject=$subject&body=$body";
                                    ?>
                                    <?Php if ($shareLinkLabel && $shareLink) { ?>
                                        <a class="share-btn" href="<?php echo $shareLink; ?>" title="<?php echo $shareLinkLabel; ?>"><span><?php echo $shareLinkLabel; ?></span>
                                            <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt="<?php echo _e('share', 'camberwell-dragons') ?>"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php
                        $countClass++;
                    }
                    wp_reset_query();
                    wp_reset_postdata();
                    ?>
                </div>
        </section>
    <?php } ?>
    <!-- News Section End -->

    <!-- Events Section Start -->
    <?php
    $eventsSectionTitle = get_field('events_section_title', $post->ID);
    $eventsViewMoreLabel = get_field('event_view_more_cta_label');
    $eventsViewMoreUrl = get_field('event_view_more_cta_url');

    $count_posts = wp_count_posts('event');
    $totalPosts = $count_posts->publish;

    /* Display event section if events found */
    if ($totalPosts) {
    ?>
        <section class="events-block">
            <div class="container">
                <div class="article-title">
                    <?php if (!empty($eventsSectionTitle)) { ?>
                        <h3><?php echo $eventsSectionTitle; ?></h3>
                    <?php } else { ?>
                        <h3><?php echo _e('EVENTS', 'camberwell-dragons'); ?></h3>
                    <?php } ?>
                    <?php if (!empty($eventsViewMoreLabel) && !empty($eventsViewMoreUrl)) { ?>
                        <a class="more-events" href="<?php echo $eventsViewMoreUrl; ?>" title="<?php echo $eventsViewMoreLabel; ?>" class="more-news">
                            <i><img src="<?php echo get_template_directory_uri(); ?>/public/images/right_arrow.svg" alt="<?php echo _e('right-arrow', 'camberwell-dragons') ?>"></i><span><?php echo $eventsViewMoreLabel; ?></span>
                        </a>
                    <?php } ?>
                </div>
                <div class="event-wrapper">
                    <?php
                    $postsPerPage = 1;
                    $args = array(
                        'post_type' => 'event',
                        'posts_per_page' => $postsPerPage,
                        'post_status' => 'publish',
                        'order' => 'ASC',
                        'orderby' => 'meta_value',
                        'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
                            array(
                                'key' => 'event_start_date', // Check the start date field
                                'value' => date("Y-m-d"), // Set today's date (note the similar format)
                                'compare' => '>=', // Return the ones greater than today's date
                                'type' => 'DATE' // Let WordPress know we're working with date
                            )
                        ),
                    );

                    $eventPosts = new WP_Query($args);
                    if ($eventPosts->post_count == 1) {
                        $do_not_duplicate = '';
                        $shareLinkLabel = get_field('share_link_label', $post->ID);
                        if ($eventPosts->have_posts()) : while ($eventPosts->have_posts()) : $eventPosts->the_post();
                                $eventPostId = get_the_ID();
                                $do_not_duplicate = $eventPostId;

                                $featuredDeskImage = get_field('featured_desktop_device_image', $eventPostId);
                                $featuredTabletImage = get_field('featured_tablet_device_image', $eventPostId);
                                $featuredDescription = get_field('featured_section_description', $eventPostId);
                                // $fullWidthMobileImage = get_field('full_width_mobile_device_image', $eventPostId);
                                $featuredDescription = (strlen($featuredDescription) > 250) ? substr($featuredDescription, 0, 250) . '...' : $featuredDescription;
                                $eventStartDate = get_field('event_start_date', $eventPostId);
                                if (!$featuredTabletImage) {
                                    $featuredTabletImage = $featuredDeskImage;
                                }
                    ?>
                                <div class="event-img-block event-inner-container">
                                    <?php if ($featuredDeskImage) { ?>
                                        <div class="desktop-img bg-img" style="background-image: url('<?php echo $featuredDeskImage['url']; ?>');"></div>
                                    <?php } ?>
                                    <?php if ($featuredTabletImage) { ?>
                                        <div class="tablet-img bg-img" style="background-image: url('<?php echo $featuredTabletImage['url']; ?>');">
                                        </div>
                                    <?php } ?>

                                    <div class="feature-event-block">
                                        <a target="_blank" href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
                                            <h4 class="block-title primary-title"><?php the_title() ?></h4>
                                        </a>
                                        <?php if ($eventStartDate) { ?>
                                            <p class="date"><?php echo $eventStartDate; ?></p>
                                        <?php } ?>
                                        <?php if ($featuredDescription) { ?>
                                            <p class="content-block"><?php echo $featuredDescription; ?></p>
                                        <?php } ?>
                                        <div class="view-and-share">
                                            <a class="btn-white" target="_blank" href="<?php echo get_the_permalink($eventPostId); ?>" title="<?php echo get_the_title($eventPostId); ?>">View</a>
                                            <?php
                                            $subject = get_the_title($eventPostId);
                                            $body = get_the_permalink($eventPostId);
                                            $mailto = '';
                                            $shareLink = "mailto:$mailto?subject=$subject&body=$body";

                                            if ($shareLinkLabel && $shareLink) {
                                            ?>
                                                <a class="share-btn" href="<?php echo $shareLink; ?>" title="<?php echo $shareLinkLabel; ?>"><span><?php echo $shareLinkLabel; ?></span>
                                                    <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt="<?php echo _e('share', 'camberwell-dragons') ?>"></i>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                        endif;
                        wp_reset_query();
                        wp_reset_postdata();
                        ?>

                        <div class="event-info-block event-inner-container">
                            <?php
                            $viewFullCalendarButtonLabel = get_field('view_full_calendar_button_label', $post->ID);
                            $viewFullCalendarLink = get_field('view_full_calendar_link', $post->ID);
                            $postsPerPage = 5;
                            $args = array(
                                'post_type' => 'event',
                                'posts_per_page' => $postsPerPage,
                                'post_status' => 'publish',
                                'order' => 'ASC',
                                'orderby' => 'meta_value',
                                'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
                                    array(
                                        'key' => 'event_start_date', // Check the start date field
                                        'value' => date("Y-m-d"), // Set today's date (note the similar format)
                                        'compare' => '>=', // Return the ones greater than today's date
                                        'type' => 'DATE' // Let WordPress know we're working with date
                                    )
                                ),
                            );

                            $eventPosts = new WP_Query($args);
                            // $eventPosts->post_count = 1;
                            if ($eventPosts->post_count > 1) {
                                if ($eventPosts->have_posts()) :
                            ?>
                                    <div class="accordion-container">
                                        <div id="accordion" class="nicescroll-box">
                                            <?php
                                            $headingCount = 1;
                                            while ($eventPosts->have_posts()) : $eventPosts->the_post();
                                                $eventPostId = get_the_ID();

                                                if ($eventPostId == $do_not_duplicate)
                                                    continue;   // skip the first id of event post                        

                                                $eventStartDate = get_field('event_start_date', $eventPostId);
                                                if ($headingCount == 1) {
                                                    $collapseClass = 'One';
                                                } elseif ($headingCount == 2) {
                                                    $collapseClass = 'Two';
                                                } elseif ($headingCount == 3) {
                                                    $collapseClass = 'Three';
                                                } elseif ($headingCount == 4) {
                                                    $collapseClass = 'Four';
                                                } else {
                                                    $collapseClass = '';
                                                }
                                            ?>
                                                <div class="card">
                                                    <div class="card-header" id="heading<?php echo $collapseClass; ?>">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $collapseClass; ?>" aria-expanded="false" aria-controls="collapse<?php echo $collapseClass; ?>">
                                                                <i class="block-title primary-title"><a target="_blank" href="<?php echo get_the_permalink($eventPostId); ?>" title="<?php echo get_the_title($eventPostId); ?>">
                                                                        <?php echo get_the_title($eventPostId); ?>
                                                                    </a></i>
                                                                <i class="schedule"><?php if ($eventStartDate) { ?><?php echo $eventStartDate; ?><?php } ?><span class="toggle-plus">
                                                                        <img src="<?php echo get_template_directory_uri(); ?>/public/images/plus.svg" alt="<?php echo _e('plus', 'camberwell-dragons') ?>" class="plus-icon">
                                                                        <img src="<?php echo get_template_directory_uri(); ?>/public/images/minus.svg" alt="<?php echo _e('minus', 'camberwell-dragons') ?>" class="minus-icon">
                                                                    </span></i>
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapse<?php echo $collapseClass; ?>" class="collapse" aria-labelledby="heading<?php echo $collapseClass; ?>" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <?php
                                                            $excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $eventPostId));
                                                            echo $excerpt;
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                                $headingCount++;
                                            endwhile;

                                            wp_reset_query();
                                            wp_reset_postdata();
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                endif;
                                if (!empty($viewFullCalendarButtonLabel) && !empty($viewFullCalendarLink)) {
                                ?>
                                    <div class="btn-container">
                                        <a href="<?php echo $viewFullCalendarLink; ?>" title="View full calendar" class="btn-white"><?php echo $viewFullCalendarButtonLabel; ?></a>
                                    </div>
                                <?php }
                            } else {
                                ?>
                                <h5 class="no-results">No Upcoming Events Found.</h5>
                            <?php
                            }
                            ?>
                        </div>
                    <?php } else { ?>
                        <h5 class="no-results">Not any upcoming events.</h5>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- Events Section End -->

    <!-- Store Section Start -->
    <?php
    $storeViewMoreLabel = get_field('store_view_more_cta_label');
    $storeViewMoreUrl = get_field('store_view_more_cta_url');
    $productName = get_field('product_name');
    $productBuyingLink = get_field('product_buying_link');
    $productMobileImage = get_field('product_mobile_image');
    $productImage = get_field('product_image');
    $productTabletImage = get_field('product_tablet_image');
    $productMobileImage = get_field('product_mobile_image');
    if (!$productTabletImage) {
        $productTabletImage = $productImage;
    }
    if (!$productMobileImage) {
        $productMobileImage = $productTabletImage;
    }

    if ($productName || have_rows('store_products')) {
    ?>
        <section class="store-section">
            <div class="container">
                <div class="article-title">
                    <?php if (!empty($storeSectionTitle)) { ?>
                        <h3><?php echo $storeSectionTitle; ?></h3>
                    <?php } ?>
                    <?php if (!empty($storeViewMoreLabel) && !empty($storeViewMoreUrl)) { ?>
                        <a target="_blank" href="<?php echo $storeViewMoreUrl; ?>" title="<?php echo $storeViewMoreLabel; ?>">
                            <i><img src="<?php echo get_template_directory_uri(); ?>/public/images/right_arrow.svg" alt="<?php echo _e('right-arrow', 'camberwell-dragons') ?>"></i>
                            <span><?php echo $storeViewMoreLabel; ?></span>
                        </a>
                    <?php } ?>
                </div>
                <div class="store-wrapper">
                    <?php if ($productName) { ?>
                        <div class="left-store">
                            <?php if ($productImage) { ?>
                                <a href="<?php echo $productBuyingLink; ?>" class="image-block">
                                    <?php if ($productImage) { ?>
                                        <div class="desktop-img bg-image" style="background-image: url('<?php echo $productImage['url'] ?>');"></div>
                                    <?php } ?>
                                    <?php if ($productTabletImage) { ?>
                                        <div class="tablet-img bg-image" style="background-image: url(<?php echo $productTabletImage['url'] ?>);"></div>
                                    <?php } ?>
                                    <div class="detail">
                                        <?php if (!empty($productName)) { ?>
                                            <p class="product-name"><?php echo $productName; ?></p>
                                        <?php } ?>
                                        <?php if (!empty($productBuyingLink)) { ?>
                                            <button type="button" class="buy btn-white" title="Buy">buy</button>
                                        <?php } ?>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if (have_rows('store_products')) { ?>
                        <div class="right-store-wrap">
                            <ul class="right-store">
                                <li class="item left-img">
                                    <div class="img-wrap">
                                        <a href="<?php echo $productBuyingLink; ?>" class="wrap" title="Product">
                                            <?php if ($productMobileImage) { ?>
                                                <img src="<?php echo $productMobileImage['url']; ?>" alt="<?php echo _e('product', 'camberwell-dragons') ?>" class="mobile">
                                            <?php } ?>
                                            <?php if (!empty($productBuyingLink)) { ?>
                                                <button class="buy btn-red btn-white" title="Buy">buy</button>
                                            <?php } ?>
                                        </a>
                                    </div>
                                </li>
                                <?php
                                while (have_rows('store_products')) {
                                    the_row();
                                    $storeDesktopImage = get_sub_field('store_deskotp_product_image');
                                    $storeTabletImage = get_sub_field('store_tablet_product_image');
                                    $storeMobileImage = get_sub_field('store_mobile_product_image');
                                    $productBuyingLink = get_sub_field('product_buying_link');
                                    if (!$storeTabletImage) {
                                        $storeTabletImage = $storeDesktopImage;
                                    }
                                    if (!$storeMobileImage) {
                                        $storeMobileImage = $storeTabletImage;
                                    }
                                ?>
                                    <li class="item">
                                        <div class="img-wrap">
                                            <a href="<?php echo $productBuyingLink; ?>" class="wrap" title="product">
                                                <?php if ($storeDesktopImage) { ?>
                                                    <img src="<?php echo $storeDesktopImage['url']; ?>" alt="<?php echo _e('product', 'camberwell-dragons') ?>" class="desktop-img">
                                                <?php } ?>
                                                <?php if ($storeTabletImage) { ?>
                                                    <img src="<?php echo $storeTabletImage['url']; ?>" alt="<?php echo _e('product', 'camberwell-dragons') ?>" class="tablet-img">
                                                <?php } ?>
                                                <?php if ($storeMobileImage) { ?>
                                                    <img src="<?php echo $storeMobileImage['url']; ?>" alt="<?php echo _e('product', 'camberwell-dragons') ?>" class="mobile-img">
                                                <?php } ?>
                                                <?php if (!empty($productBuyingLink)) { ?>
                                                    <button class="buy btn-red btn-white" title="Buy">buy</button>
                                                <?php } ?>
                                            </a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="buy-mobile">
                            <a href="<?php echo $storeViewMoreUrl; ?>" class="buy btn-red btn-white" title="<?php echo _e('Buy', 'camberwell-dragons') ?>"><?php echo _e('Buy', 'camberwell-dragons') ?></a>
                        </div>
                    <?php } else { ?>
                        <h5>There is not any other product</h5>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- Store Section End -->

    <!-- Partner Section Start -->
    <?php
    $partnerSectionTitle = get_field('partners_section_title');
    $partnerViewMoreLabel = get_field('partner_view_all_label');
    $partnerViewMoreUrl = get_field('partner_view_all_url');

    /* Display partners if any partners added from admin panel */
    if (have_rows('partners_section_fields')) {
    ?>
        <section class="partners-section">
            <div class="container">
                <div class="article-title">
                    <?php if (!empty($partnerSectionTitle)) { ?>
                        <h3><?php echo $partnerSectionTitle; ?></h3>
                    <?php } ?>
                    <?php if (!empty($partnerViewMoreLabel) && !empty($partnerViewMoreUrl)) { ?>
                        <a class="view-all" target="_blank" href="<?php echo $partnerViewMoreUrl; ?>" title="<?php echo $partnerViewMoreLabel; ?>">
                            <i><img src="<?php echo get_template_directory_uri(); ?>/public/images/right_arrow.svg" alt="<?php echo _e('right-arrow', 'camberwell-dragons') ?>"></i>
                            <span><?php echo $partnerViewMoreLabel; ?></span>
                        </a>
                    <?php } ?>
                </div>

                <ul class="partner-list">
                    <?php
                    $counter = 1;
                    while (have_rows('partners_section_fields')) {
                        the_row();
                        if ($counter == 1) {
                            $class = "physio-logo";
                        } else {
                            $class = "";
                        }
                        $partnerLogo = get_sub_field('partner_logo_image');
                    ?>
                        <li class="<?php echo $class; ?>"><i><img src="<?php echo $partnerLogo['url']; ?>" alt="<?php echo _e('partner', 'camberwell-dragons') ?>"></i></li>
                    <?php
                        $counter++;
                    }
                    ?>
                </ul>

            </div>
        </section>
    <?php } ?>
    <!-- Partner Section End -->

</main>
<?php
get_footer();
