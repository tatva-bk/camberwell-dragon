<?php
/*
  Template Name: Venues Page
 */
get_header();
?>
<main class="main-wrap fixed-main-wrap">
    <?php
    if (have_rows('location_details')) {
        while (have_rows('location_details')) {
            the_row();
            $locationName = get_sub_field('location_name');
            $locationAddress = get_sub_field('location_address');
            $locationURL = get_sub_field('location_url');
            $map_desktop_image = get_sub_field('location_map_image_for_desktop');
            $map_tablet_image = get_sub_field('location_map_image_for_tablet');
            $map_mobile_image = get_sub_field('location_map_image_for_mobile');

            if (!$map_tablet_image) {
                $map_tablet_image = $map_desktop_image;
            }
            if (!$map_mobile_image) {
                $map_mobile_image = $map_tablet_image;
            }
            ?>
            <section class="map-location-section">
                <?php if (!empty($locationName)) { ?>
                    <h3 class="secondary-title color-title primary-border"><?php echo $locationName; ?></h3>
                <?php } ?>
                <?php if (!empty($locationAddress)) { ?>
                    <address><span><?php echo $locationAddress; ?></span></address>
                <?php } ?>
                <?php if (!empty($locationAddress)) { ?>
                    <div class="inner-map-container">
                        <div class="map-block">
                            <a href="<?php echo $locationURL; ?>" target="_blank" title="Open in Map">
                                <img src="<?php echo $map_desktop_image; ?>" alt="" class="desktop-img">
                                <img src="<?php echo $map_tablet_image; ?>" alt="" class="tablet-img">
                                <img src="<?php echo $map_mobile_image; ?>" alt="" class="mobile-img">
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </section>
            <?php
        }
    }
    ?>
</main>
<?php
get_footer();
