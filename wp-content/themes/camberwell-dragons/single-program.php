<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package camberwell-dragons
 */

get_header();
$postId = get_the_ID();
$programDescription = get_the_content($postId);
$programDeskImage = get_field('program_details_desktop_featured_image', $postId);
$programTabletImage = get_field('program_details_tablet_featured_image', $postId);
$programMobileImage = get_field('program_details_mobile_featured_image', $postId);
if (!$programTabletImage) {
	$programTabletImage = $programDeskImage;
}
if (!$programMobileImage) {
	$programMobileImage = $programTabletImage;
}
$programSliderAboveContent = get_field('program_slider_above_content', $postId);
$programApplicationLabel = get_field('program_application', $postId);
$programApplicationLink = get_field('program_application_link', $postId);
$programContactInformation = get_field('program_contact_information', $postId);

$level1Heading = get_field('level1_heading');
$level1Content = get_field('level1_content');
$level2Heading = get_field('level2_heading');
$level2Content = get_field('level2_content');
$level3Heading = get_field('level3_heading');
$level3Content = get_field('level3_content');


?>
<main class="main-wrap fixed-main-wrap">
	<?php if (!empty($programDescription)) { ?>
		<section class="introduction-section">
			<div class="container">
				<div class="content-block">
					<?php echo $programDescription; ?>
				</div>
			</div>
		</section>
	<?php } ?>

	<section class="large-image-section">
		<div class="image-block">
			<?php if ($programDeskImage) { ?>
				<img src="<?php echo $programDeskImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="desktop-img">
			<?php } ?>

			<?php if ($programTabletImage) { ?>
				<img src="<?php echo $programTabletImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="tablet-img">
			<?php } ?>

			<?php if ($programMobileImage) { ?>
				<img src="<?php echo $programMobileImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="mobile-img">
			<?php } ?>
		</div>
	</section>

	<?php if (!empty($programSliderAboveContent)) { ?>
		<section class="content-section">
			<div class="container container-small">
				<div class="content-block">
					<?php echo $programSliderAboveContent; ?>
				</div>
			</div>
		</section>
	<?php } ?>

	<section class="level-one-section level-section">
		<div class="container container-small">
			<?php if (!empty($level1Heading)) { ?>
				<div class="title-block">
					<h3 class="level-title"><?php echo $level1Heading; ?></h3>
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
			<?php if (!empty($level2Heading)) { ?>
				<div class="title-block">
					<h4 class="level-title"><?php echo $level2Heading; ?></h4>
				</div>
			<?php } ?>
			<?php if (!empty($level2Content)) { ?>
				<div class="content-block">
					<?php echo $level2Content; ?>
				</div>
			<?php } ?>
		</div>
	</section>
	<?php if (have_rows('program_slider_image')) { ?>
		<section class="slider-section">
			<div class="slider-container">
				<ul class="story-slider">
					<?php while (have_rows('program_slider_image')) {
						the_row();
						$programSliderDesktopImage = get_sub_field('program_slider_desktop_image');
						$programSliderTabletImage = get_sub_field('program_tablet_desktop_image');
						$programSliderMobileImage = get_sub_field('program_slider_mobile_image');
						if (!$programSliderTabletImage) {
							$programSliderTabletImage = $programSliderDesktopImage;
						}
						if (!$programSliderMobileImage) {
							$programSliderMobileImage = $programSliderTabletImage;
						} ?>
						<li>
							<div class="image-block">

								<?php if ($programSliderDesktopImage) { ?>
									<img src="<?php echo $programSliderDesktopImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="desktop-img">
								<?php } ?>

								<?php if ($programSliderTabletImage) { ?>
									<img src="<?php echo $programSliderTabletImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="tablet-img">
								<?php }  ?>

								<?php if ($programSliderMobileImage) { ?>
									<img src="<?php echo $programSliderMobileImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="mobile-img">
								<?php }  ?>

							</div>
						</li>
					<?php } ?>
				</ul>
			</div>
		</section>
	<?php } ?>
	<section class="level-three-section level-section">
		<div class="container container-small">
			<?php if (!empty($level3Heading)) { ?>
				<div class="title-block">
					<h4 class="level-title"><?php echo $level3Heading; ?></h4>
				</div>
			<?php } ?>
			<?php if (!empty($level3Content)) { ?>
				<div class="content-block">
					<?php echo $level3Content; ?>
				</div>
			<?php } ?>
		</div>
	</section>
	<?php if ($programApplicationLabel && $programApplicationLink) { ?>
		<section class="link-download-section">
			<div class="container container-small">
				<div class="content-block">
					<div class="document-name">
						<p><?php echo $programApplicationLabel; ?></p>
						<a class="share-btn" href="<?php echo $programApplicationLink; ?>" title="<?php echo _e('View', 'camberwell-dragons') ?>">
							<span><?php echo _e('View', 'camberwell-dragons') ?></span>
							<i class="share-link">
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/pdf.svg" alt="<?php echo _e('View', 'camberwell-dragons') ?>">
							</i>
						</a>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>
	<?php if (!empty($programContactInformation)) { ?>
		<div class="further-info-block">
			<div class="container container-small">
				<div class="content-block">
					<?php echo $programContactInformation; ?>
				</div>
			</div>
		</div>
	<?php } ?>
</main>
<?php get_footer(); 
