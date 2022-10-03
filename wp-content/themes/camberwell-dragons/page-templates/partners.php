<?php
/*
  Template Name: Partners Page
 */

get_header();
?>

<main class="main-wrap fixed-main-wrap">
    <?php
    /* Display content if added from backend */
    if (!empty(get_the_content())) {
        ?>
        <section class="introduction-section">
            <div class="container">
                <div class="content-block"><?php echo get_the_content(); ?></div>
            </div>
        </section>
        <?php
    }

    /* Display partners if added from backend */
    if (have_rows('partners_fields')):
        while (have_rows('partners_fields')): the_row();
            $partners_logo_desktop_device_image = get_sub_field('partners_logo_desktop_device_image');
            $partners_logo_tablet_device_image = get_sub_field('partners_logo_tablet_device_image');
            $partners_logo_mobile_device_image = get_sub_field('partners_logo_mobile_device_image');
            $partners_description = get_sub_field('partners_description');
            $partners_website = get_sub_field('partners_website');
            $partners_website_url = get_sub_field('partners_website_url');

            if (!$partners_logo_tablet_device_image) {
                $partners_logo_tablet_device_image = $partners_logo_desktop_device_image;
            }
            if (!$partners_logo_mobile_device_image) {
                $partners_logo_mobile_device_image = $partners_logo_tablet_device_image;
            }
            ?>
            <section class="partners-with-links-section">
                <div class="container container-small">
                    <div class="image-block">
                        <?php if ($partners_website && $partners_website_url) { ?>
                            <a href="<?php echo $partners_website_url; ?>" title="Partners" target="_blank">
                            <?php } ?>

                            <?php if ($partners_logo_desktop_device_image) { ?>
                                <img src="<?php echo $partners_logo_desktop_device_image['url']; ?>" alt="logo" class="desktop-img">
                            <?php } ?>

                            <?php if ($partners_logo_tablet_device_image) { ?>
                                <img src="<?php echo $partners_logo_tablet_device_image['url']; ?>" alt="logo" class="tablet-img">
                            <?php } ?>
                            <?php if ($partners_logo_mobile_device_image) { ?>
                                <img src="<?php echo $partners_logo_mobile_device_image['url']; ?>" alt="logo" class="mobile-img">
                            <?php } ?>

                            <?php if ($partners_website && $partners_website_url) { ?>
                            </a>
                        <?php } ?>

                    </div>
                    <div class="content-block">
                        <?php
                        if ($partners_description) {
                            echo $partners_description;
                        }
                        if ($partners_website && $partners_website_url) {
                            ?>
                            <a target="_blank" href="<?php echo $partners_website_url; ?>" title="<?php echo $partners_website; ?>"><?php echo $partners_website; ?></a>
                        <?php } ?>

                    </div>
                </div>
            </section>
            <?php
        endwhile;
    endif;

    /* Add Support infor if added from backend */
    if (get_field('support_text')) {
        ?>
        <section class="support-section">
            <div class="container container-small">
                <div class="content-block">
                    <?php echo get_field('support_text'); ?>
                </div>
            </div>
        </section>
    <?php } ?>
</main>

<?php
get_footer();
