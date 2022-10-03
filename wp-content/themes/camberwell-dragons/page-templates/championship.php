<?php
/*
  Template Name: Championship Page
 */
get_header();
?>

<main class="main-wrap fixed-main-wrap">

    <?php if (get_the_content()) { ?>
        <section class="introduction-section">
            <div class="container">
                <div class="content-block">
                    <?php echo get_the_content(); ?>
                </div>
            </div>
        </section>
    <?php } ?>

    <section class="layers-section">
        <?php
        $query_championship = new WP_Query(array(
            'post_type' => 'championship',
            'order' => 'DESC',
            'posts_per_page' => -1
        ));

        if ($query_championship->have_posts()) {
            $counter = 0;
            while ($query_championship->have_posts()) {
                $query_championship->the_post();
                $championshipListingDesktopImage = get_field('championship_listing_desktop_image');
                $championshipListingTabletImage = get_field('championship_listing_tablet_image');
                $championshipListingMobileImage = get_field('championship_listing_mobile_image');
                if (!$championshipListingTabletImage) {
                    $championshipListingTabletImage = $championshipListingDesktopImage;
                }
                if (!$championshipListingMobileImage) {
                    $championshipListingMobileImage = $championshipListingTabletImage;
                }
                ?>
                <div class="layers-wrapper">
                    <div class="layers-inner-wrap <?php if ($counter % 2 != 0) { echo 'row-reverse';} ?>">
                             <?php if ($championshipListingDesktopImage) { ?>
                            <div class="img-wrapper desk" style="background-image: url('<?php echo $championshipListingDesktopImage['url']; ?>');">
                                <img src="<?php echo $championshipListingDesktopImage['url']; ?>" alt="">
                            </div>
                        <?php } ?>

                        <?php if ($championshipListingTabletImage) { ?>
                            <div class="img-wrapper tab" style="background-image: url('<?php echo $championshipListingTabletImage['url']; ?>');">
                                <img src="<?php echo $championshipListingTabletImage['url']; ?>" alt="">
                            </div>
                        <?php } ?>

                        <?php if ($championshipListingMobileImage) { ?>
                            <div class="img-wrapper mob" style="background-image: url('<?php echo $championshipListingMobileImage['url']; ?>');">
                                <img src="<?php echo $championshipListingMobileImage['url']; ?>" alt="">
                            </div>
                        <?php } ?>

                        <div class="layers-row">
                            <div class="layer-block">
                                <?php if ($counter % 2 == 0) { ?>
                                <div class="img-wrapper desk"
                                     style="background-image: url('<?php echo get_template_directory_uri(); ?>/public/images/card-shape-01.png');">
                                    <img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-01.png" alt="ProgramImg">
                                </div>
                                <div class="img-wrapper mob"
                                     style="background-image: url('<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png');">
                                    <img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png" alt="ProgramImg">
                                </div>
                                <?php } else { ?>
                                <div class="img-wrapper"
                                    style="background-image: url('<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png');">
                                    <img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png" alt="ProgramImg">
                                </div>  
                              <?php  } ?>
                                <div class="content-wrap">
                                    <h2><?php echo get_the_title(); ?></h2>
                                    <p><?php echo get_the_excerpt(); ?></p>
                                    <a href="<?php echo get_the_permalink(); ?>" class="btn-white" title="Learn More">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $counter++;
            }
        }
        wp_reset_query();
        wp_reset_postdata();
        ?>
    </section>
</main>

<?php
get_footer();
