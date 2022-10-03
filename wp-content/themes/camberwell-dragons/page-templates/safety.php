<?php
/*
  Template Name: Safety Page
 */
get_header();
$SafetyPageTitle = get_the_title();
$SafetyPageContent = get_the_content();
$SafetyContent = get_field('safety_content');
?>

<main class="main-wrap fixed-main-wrap">
    <?php
    /* Display initial content if added from backend */
    if (get_field('introduction_content')) {
        ?>
        <section class="introduction-section">
            <div class="container">
                <div class="content-block">
                    <?php echo get_field('introduction_content'); ?>
                </div>
            </div>
        </section>
    <?php } ?>

    <section class="image-and-content-section">
        <div class="container-fluid">

            <?php
            /* Display content above quote section */
            if (get_field('content_above_quote_section')) {
                ?>
                <div class="container container-small">
                    <div class="first-block">
                        <?php echo get_field('content_above_quote_section'); ?>
                    </div>
                </div>
            <?php } ?>

            <?php
            /* Display quote section */
            if (get_field('quote_content')) {
                ?>
                <blockquote><?php echo get_field('quote_content'); ?></blockquote>
            <?php } ?>

            <?php
            /* Display content below quote section */
            if (get_field('content_below_quote_section')) {
                ?>
                <div class="container container-small">
                    <div class="third-block">
                        <?php echo get_field('content_below_quote_section'); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</main>
<?php
get_footer();
