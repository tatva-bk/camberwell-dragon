<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package camberwell-dragon
 */
get_header();
$shareLinkLabel = get_field('share_link_label', $post->ID);
$eventDeskImage = get_field('event_detail_page_desktop_device_image', $post->ID);
$eventTabletImage = get_field('event_detail_page_tablet_device_image', $post->ID);
$eventMobileImage = get_field('event_detail_page_mobile_device_image', $post->ID);
if (!$eventTabletImage) {
    $eventTabletImage = $eventDeskImage;
}
if (!$eventMobileImage) {
    $eventMobileImage = $eventTabletImage;
}

$eventStartDate = get_field('event_start_date', $post->ID);
$eventTime = get_field('event_time', $post->ID);
$eventLocation = get_field('event_location', $post->ID);
$eventDetailsApplicationFormTitle = get_field('event_details_or_application_form_title', $post->ID);
$eventDetailsApplicationFormAttachment = get_field('event_details_or_application_form_attachment', $post->ID);
?>
<main class="main-wrap fixed-main-wrap">
    <section class="event-detail">
        <div class="container">
            <div class="article-title event-title">
                <h3><?php the_title(); ?></h3>
                <div class="article-btns">
                    <?php if (!empty($eventStartDate)) { 
                        // $eventStartDate = date('D d M Y', strtotime($eventStartDate));       // Display Fri 9 Jul 2021
                        // $eventStartDate = date('l d F Y', strtotime($eventStartDate));       // Display Friday 09 July 2021
                        
                        ?>
                        <div class="date">
                            <p class="date"><?php echo $eventStartDate; ?></p>
                        </div>
                    <?php } ?>
                    <div class="share-btn-wrapper">
                        <?php
                        $subject = get_the_title();
                        $body = get_the_permalink();
                        $mailto = '';
                        $shareLink = "mailto:$mailto?subject=$subject&body=$body";

                        if ($shareLinkLabel && $shareLink) {
                            ?>
                            <a class="share-btn" href="<?php echo $shareLink; ?>" title="<?php echo $shareLinkLabel; ?>">
                                <span><?php echo $shareLinkLabel; ?></span>
                                <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt="<?php echo _e('share', 'camberwell-dragons') ?>"></i>
                            </a>
                        <?php } ?>
                        <a href="javascript:void(0);" title="Add" class="share-btn add-to-cal" data-title="<?php echo get_the_title(); ?>" data-date="<?php echo $eventStartDate; ?>" data-time="<?php echo $eventTime; ?>" data-location="<?php echo $eventLocation; ?>" data-excerpt="<?php echo get_the_excerpt(); ?>">
                            Add <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/plus.svg" alt="<?php echo _e('plus', 'camberwell-dragons') ?>"></i>
                        </a>
                        <div class="add-to-calendar-btn-wrap"></div>
                    </div>
                    
                </div>
            </div>
            <div class="event-wrapper">
                <div class="event-img-block">
                    <a target="_blank" href="<?php echo get_the_permalink($eventPostId); ?>" title="<?php echo _e('event', 'camberwell-dragons'); ?>">

                        <?php if ($eventDeskImage) { ?>
                            <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('event', 'camberwell-dragons') ?>" class="desktop-img">
                        <?php } ?>

                        <?php if ($eventTabletImage) { ?>
                            <img src="<?php echo $eventTabletImage['url']; ?>" alt="<?php echo _e('event', 'camberwell-dragons') ?>" class="tablet-img">
                        <?php } ?>

                        <?php if ($eventMobileImage) { ?>
                            <img src="<?php echo $eventMobileImage['url']; ?>" alt="<?php echo _e('event', 'camberwell-dragons') ?>" class="mobile-img">
                        <?php } ?>

                    </a>
                </div>
                <div class="container container-small">
                    <div class="event-content">
                        <div class="event-timing">
                            <?php if (!empty($eventStartDate)) { ?>
                                <p><span>When</span><?php echo $eventStartDate; ?></p>
                            <?php } ?>
                            <?php if (!empty($eventTime) || !empty($eventLocation)) { ?>
                                <?php if (!empty($eventTime)) { ?>
                                    <p><span>Time</span><?php echo $eventTime; ?></p>
                                <?php } ?>
                                <?php if (!empty($eventLocation)) { ?>
                                    <p><span>Where</span><?php echo $eventLocation; ?></p>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="event-content-wrapper">
                            <?php echo get_the_content(); ?>
                            <?php if ($eventDetailsApplicationFormTitle && $eventDetailsApplicationFormAttachment) { ?>
                                <div class="event-application">
                                    <span><?php echo $eventDetailsApplicationFormTitle; ?></span>
                                    <a target="_blank" title="View" class="share-btn" href="<?php echo $eventDetailsApplicationFormAttachment; ?>">
                                        <span>View</span>
                                        <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/pdf.svg" alt="<?php echo _e('pdf', 'camberwell-dragons') ?>"></i>
                                    </a>
                                </div>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="article-section inner-article three-articles-section">
        <div class="container">
            <div class="article-title">
                <h3><?php echo _e('Other Events', 'camberwell-dragons') ?></h3>
            </div>
            <?php
            $postsPerPage = 3;
            $args = array(
                'post_type' => 'event',
                'posts_per_page' => $postsPerPage,
                'post_status' => 'publish',
                'order' => 'ASC',
                'orderby' => 'meta_value',
                'post__not_in' => array($post->ID),
                'meta_query' => array(// WordPress has all the results, now, return only the events after today's date
                    array(
                        'key' => 'event_start_date', // Check the start date field
                        'value' => date("Y-m-d"), // Set today's date (note the similar format)
                        'compare' => '>=', // Return the ones greater than today's date
                        'type' => 'DATE' // Let WordPress know we're working with date
                    )
                ),
            );

            $eventPosts = new WP_Query($args);

            if ($eventPosts->have_posts()) :
                ?>
                <div class="article-block-wrapper">
                    <?php
                    while ($eventPosts->have_posts()) : $eventPosts->the_post();
                        $eventPostId = get_the_ID();

                        if ($eventPostId == $do_not_duplicate)
                            continue;   // skip the first id of event post                        

                        $eventDeskImage = get_field('event_section_desktop_device_image', $eventPostId);
                        $eventTabletImage = get_field('event_section_tablet_device_image', $eventPostId);
                        $eventMobileImage = get_field('event_section_mobile_device_image', $eventPostId);
                        if (!$eventTabletImage) {
                            $eventTabletImage = $eventDeskImage;
                        }
                        if (!$eventMobileImage) {
                            $eventMobileImage = $eventTabletImage;
                        }

                        $eventStartDate = get_field('event_start_date', $eventPostId);
                        $eventTime = get_field('event_time', $eventPostId);
                        $eventLocation = get_field('event_location', $eventPostId);

                        ?>
                        <div class="article-block">
                            <div class="image-block">
                                <i>
                                    <a target="_blank" href="<?php echo get_the_permalink($eventPostId); ?>" title="<?php echo _e('event', 'camberwell-dragons'); ?>">

                                        <?php if ($eventDeskImage) { ?>
                                            <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('event', 'camberwell-dragons') ?>" class="desktop-img">
                                        <?php } ?>

                                        <?php if ($eventTabletImage) { ?>
                                            <img src="<?php echo $eventTabletImage['url']; ?>" alt="<?php echo _e('event', 'camberwell-dragons') ?>" class="tablet-img">
                                        <?php } ?>

                                        <?php if ($eventMobileImage) { ?>
                                            <img src="<?php echo $eventMobileImage['url']; ?>" alt="<?php echo _e('event', 'camberwell-dragons') ?>" class="mobile-img">
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
                                    <a target="_blank" title="View" href="<?php echo get_the_permalink($eventPostId); ?>" class="btn-white">View</a>
                                    <?php
                                    $subject = get_the_title($eventPostId);
                                    $body = get_the_permalink($eventPostId);
                                    $mailto = '';
                                    $shareLink = "mailto:$mailto?subject=$subject&body=$body";

                                    if ($shareLinkLabel && $shareLink) {
                                        ?>
                                        <a class="share-btn" href="<?php echo $shareLink; ?>" title="<?php echo $shareLinkLabel; ?>">
                                            <span><?php echo $shareLinkLabel; ?></span>
                                            <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt="<?php echo _e('share', 'camberwell-dragons') ?>"></i>
                                        </a>
                                    <?php } ?>
                                    <a href="javascript:void(0);" title="Add" class="share-btn add-to-cal" data-title="<?php echo get_the_title(); ?>" data-date="<?php echo $eventStartDate; ?>" data-time="<?php echo $eventTime; ?>" data-location="<?php echo $eventLocation; ?>" data-excerpt="<?php echo get_the_excerpt(); ?>">
                                        <span>Add</span>
                                        <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/plus.svg" alt="<?php echo _e('add', 'camberwell-dragons') ?>"></i>
                                    </a>
                                    <div class="add-to-calendar-btn-wrap"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_query();
                    wp_reset_postdata();
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer();
?>
<script>
    $(document).ready(function () {
        $('.menu-item-community').addClass('active');
    });
</script>