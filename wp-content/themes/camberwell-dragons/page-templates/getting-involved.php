<?php
/*
  Template Name: Getting Involved Page
 */
get_header();

$gettingInvolvedPageContent = get_the_content();
$gettingInvolvedDeskImage = get_field('full_desktop_device_image');
$gettingInvolvedTabletImage = get_field('full_tablet_device_image');
$gettingInvolvedMobileImage = get_field('full_mobile_device_image');
if (!$gettingInvolvedTabletImage) {
    $gettingInvolvedTabletImage = $gettingInvolvedDeskImage;
}
if (!$gettingInvolvedMobileImage) {
    $gettingInvolvedMobileImage = $gettingInvolvedTabletImage;
}
$contentBelowFullImageSection = get_field('content_below_full_image_section');
$contentBelowSliderSection = get_field('content_below_slider_section');
$contentBelowSliderSection = get_field('content_below_slider_section');
$quote_content = get_field('quote_content');
$content_below_quote_section = get_field('content_below_quote_section');

$level1Heding = get_field('level1_heading');
$level1Content = get_field('level1_content');
$level2Heding = get_field('level2_heading');
$level2Content = get_field('level2_content');
$level3Heding = get_field('level3_heading');
$level3Content = get_field('level3_content');

$contactFormShortcode = get_field('become_dragon_form_shortcode');
?>

<main class="main-wrap fixed-main-wrap">

    <?php if ($gettingInvolvedPageContent != '') { ?>
        <section class="introduction-section">
            <div class="container">
                <div class="content-block">
                    <?php echo $gettingInvolvedPageContent; ?>
                </div>
            </div>
        </section>
    <?php } ?>

    <section class="large-image-section">
        <div class="image-block">
            <?php if ($gettingInvolvedDeskImage) { ?>
                <img src="<?php echo $gettingInvolvedDeskImage['url']; ?>" alt="<?php echo $gettingInvolvedDeskImage['alt']; ?>" class="desktop-img">
            <?php } ?>

            <?php if ($gettingInvolvedTabletImage) { ?>
                <img src="<?php echo $gettingInvolvedTabletImage['url']; ?>" alt="<?php echo $gettingInvolvedTabletImage['alt']; ?>" class="tablet-img">
            <?php } ?>

            <?php if ($gettingInvolvedMobileImage) { ?>
                <img src="<?php echo $gettingInvolvedMobileImage['url']; ?>" alt="<?php echo $gettingInvolvedMobileImage['alt']; ?>" class="mobile-img">
            <?php } ?>
        </div>
    </section>

    <?php if ($contentBelowFullImageSection != '') { ?>
        <section class="content-section">
            <div class="container container-small">
                <div class="content-block">
                    <?php echo $contentBelowFullImageSection; ?>
                </div>
            </div>
        </section>
    <?php } ?>

    <section class="level-one-section level-section">
        <div class="container container-small">
            <?php if (!empty($level1Heding)) { ?>
                <div class="title-block">
                    <h3 class="level-title"><?php echo $level1Heding; ?></h3>
                </div>
            <?php } ?>
            <?php if (!empty($level1Content)) { ?>
                <div class="content-block">
                    <?php echo $level1Content; ?>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="level-two-section level-section">
        <div class="container container-small">
            <?php if (!empty($level2Heding)) { ?>
                <div class="title-block">
                    <h4 class="level-title"><?php echo $level2Heding; ?></h4>
                </div>
            <?php } ?>
            <?php if (!empty($level2Content)) { ?>
                <div class="content-block">
                    <?php echo $level2Content; ?>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="level-three-section level-section">
        <div class="container container-small">
            <?php if (!empty($level3Heding)) { ?>
                <div class="title-block">
                    <h5 class="level-title"><?php echo $level3Heding; ?></h5>
                </div>
            <?php } ?>
            <?php if (!empty($level3Content)) { ?>
                <div class="content-block">
                    <?php echo $level3Content; ?>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php if (have_rows('image_slider_section')): ?>
        <section class="slider-section">
            <div class="slider-container">
                <ul class="story-slider">
                    <?php
                    while (have_rows('image_slider_section')): the_row();
                        $desktop_device_image = get_sub_field('desktop_device_image');
                        $tablet_device_image = get_sub_field('tablet_device_image');
                        $mobile_device_image = get_sub_field('mobile_device_image');

                        if (!$tablet_device_image) {
                            $tablet_device_image = $desktop_device_image;
                        }
                        if (!$mobile_device_image) {
                            $mobile_device_image = $tablet_device_image;
                        }
                        ?>
                        <li>
                            <div class="image-block">
                                <img src="<?php echo $desktop_device_image['url']; ?>" alt="" class="desktop-img">
                                <img src="<?php echo $tablet_device_image['url']; ?>" alt="" class="tablet-img">
                                <img src="<?php echo $mobile_device_image['url']; ?>" alt="" class="mobile-img">
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>

    <section class="image-and-content-section our-story-section">
        <div class="container-fluid">
            <?php if (!empty($contentBelowSliderSection)) { ?>
                <div class="container container-small">
                    <div class="first-block">
                        <?php echo $contentBelowSliderSection; ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (!empty($quote_content)) { ?>
                <blockquote><?php echo $quote_content; ?></blockquote>
            <?php } ?>
            <?php if (!empty($content_below_quote_section)) { ?>
                <div class="container container-small">
                    <div class="third-block">
                        <?php echo $content_below_quote_section; ?> 
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php if (!empty($contactFormShortcode)) { ?>
        <section class="dragon-form-section">
            <div class="container container-small">
                <?php $contactFormName = $contactFormShortcode->post_title; ?>
                <div class="dragon-title-block">
                    <h3 class="form-title"><?php echo $contactFormName; ?></h3>
                </div>
                <?php
                $contactFormID = $contactFormShortcode->ID;
                echo do_shortcode('[contact-form-7 html_class="dragon-form" id="' . $contactFormID . '" title="' . $contactFormName . '"]');
                ?>
            </div>
        </section>
    <?php } ?>
</main>
<?php
get_footer();
