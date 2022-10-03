<?php

/*
Template Name: Programs Page
*/
get_header();
$programsPageTitle = get_the_title();
$programsPageContent = get_the_content();
$mainBgDeskImage = get_field('main_background_desktop_device_image', $post->ID);
$mainBgTabletImage = get_field('main_background_tablet_device_image', $post->ID);
$mainBgMobileImage = get_field('main_background_mobile_device_image', $post->ID);
$mainTitle = get_field('banner_main_title', $post->ID);
$newsSectionTitle = get_field('news_section_title', $post->ID);
$shareLinkLabel = get_field('share_link_label', $post->ID);
$noOfNewsToDisplay = get_field('number_of_news_to_display', $post->ID);
$eventsSectionTitle = get_field('events_section_title', $post->ID);
$viewFullCalendarButtonLabel = get_field('view_full_calendar_button_label', $post->ID);
$viewFullCalendarLink = get_field('view_full_calendar_link', $post->ID);

?>
<main class="main-wrap fixed-main-wrap">

    <?php if (!empty($programsPageContent)) { ?>
        <section class="introduction-section">
            <div class="container">
                <div class="content-block">
                    <?php echo $programsPageContent; ?>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php
    $programsPostPerPage = -1;
    $queryPrograms = new WP_Query(array('post_type' => 'program', 'order' => 'DESC', 'posts_per_page' => $displayPost));

    if ($queryPrograms->have_posts()) { ?>
        <section class="layers-section">
            <?php
            $index = 1;
            while ($queryPrograms->have_posts()) {
                $queryPrograms->the_post();
                $id = get_the_ID();
                $programDeskImage = get_field('program_desktop_device_image', $id);
                $programTabletImage = get_field('program_tablet_device_image', $id);
                $programMobileImage = get_field('program_mobile_device_image', $id);
                if (!$programTabletImage) {
                    $programTabletImage = $programDeskImage;
                }
                if (!$programMobileImage) {
                    $programMobileImage = $programTabletImage;
                }
                if ($index % 2 == 1) {
            ?>
                    <div class="layers-wrapper">
                        <div class="layers-inner-wrap">
                            <?php if ($programDeskImage) { ?>
                                <div class="img-wrapper desk" style="background-image: url(&quot;<?php echo $programDeskImage['url']; ?>&quot;);">
                                    <img src="<?php echo $programDeskImage['url']; ?>" alt="<?php echo get_the_title(); ?>">
                                </div>
                            <?php } ?>
                            <?php if ($programTabletImage) { ?>
                                <div class="img-wrapper tab" style="background-image: url(&quot;<?php echo $programTabletImage['url']; ?>&quot;);">
                                    <img src="<?php echo $programTabletImage['url']; ?>" alt="<?php echo get_the_title(); ?>">
                                </div>
                            <?php } ?>
                            <?php if ($programMobileImage) { ?>
                                <div class="img-wrapper mob" style="background-image: url(&quot;<?php echo $programMobileImage['url']; ?>&quot;);">
                                    <img src="<?php echo $programMobileImage['url']; ?>" alt="<?php echo get_the_title(); ?>">
                                </div>
                            <?php } ?>

                            <div class="layers-row">
                                <div class="layer-block">
                                    <div class="img-wrapper desk">
                                        <img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-01.png" alt="<?php echo _e('ProgramImg', 'camberwell-dragons'); ?>">
                                    </div>
                                    <div class="img-wrapper mob">
                                        <img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png" alt="<?php echo _e('ProgramImg', 'camberwell-dragons'); ?>">
                                    </div>
                                    <div class="content-wrap">
                                        <h2><?php the_title(); ?></h2>
                                        <?php the_excerpt(); ?>

                                        <a href="<?php the_permalink(); ?>" class="btn-white" title="<?php echo _e('Learn More', 'camberwell-dragons') ?>"><?php echo _e('Learn More', 'camberwell-dragons') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  } else { ?>
                    <div class="layers-wrapper">
                        <div class="layers-inner-wrap row-reverse">
                            <?php if ($programDeskImage) { ?>
                                <div class="img-wrapper desk" style="background-image: url(&quot;<?php echo $programDeskImage['url']; ?>&quot;);">
                                    <img src="<?php echo $programDeskImage['url']; ?>" alt="<?php echo get_the_title(); ?>">
                                </div>
                            <?php } ?>
                            <?php if ($programTabletImage) { ?>
                                <div class="img-wrapper tab" style="background-image: url(&quot;<?php echo $programTabletImage['url']; ?>&quot;);">
                                    <img src="<?php echo $programTabletImage['url']; ?>" alt="<?php echo get_the_title(); ?>">
                                </div>
                            <?php } ?>
                            <?php if ($programMobileImage) { ?>
                                <div class="img-wrapper mob" style="background-image: url(&quot;<?php echo $programMobileImage['url']; ?>&quot;);">
                                    <img src="<?php echo $programMobileImage['url']; ?>" alt="<?php echo get_the_title(); ?>">
                                </div>
                            <?php } ?>
                            <div class="layers-row">
                                <div class="layer-block">
                                    <div class="img-wrapper">
                                        <img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png" alt="<?php echo _e('ProgramImg', 'camberwell-dragons'); ?>">
                                    </div>
                                    <div class="content-wrap">
                                        <h2><?php the_title(); ?></h2>
                                        <?php the_excerpt(); ?>

                                        <a href="<?php the_permalink(); ?>" class="btn-white" title="<?php echo _e('Learn More', 'camberwell-dragons') ?>"><?php echo _e('Learn More', 'camberwell-dragons') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php
                $index++;
            }

            ?>

        </section>
    <?php } ?>
</main>

<?php get_footer();
