<?php /*
Template Name: Our Story Page
*/
get_header();
$ourStoryPageTitle = get_the_title();
$ourStoryPageContent = get_the_content();
$ourStoryVideo = get_field('video_section');

$videoSectionDesktopImage = get_field('video_section_desktop_device_image');
$videoSectionTabletImage = get_field('video_section_tablet_device_image');
$videoSectionMobileImage = get_field('video_section_mobile_device_image');

if (!$videoSectionTabletImage) {
	$videoSectionTabletImage = $sliderDesktopImage;
}
if (!$videoSectionMobileImage) {
	$videoSectionMobileImage = $videoSectionTabletImage;
}

$ourStorySliderAboveContent = get_field('content_above_slider_section');
$intoductionContent = get_field('intoduction_content_below_slider_section');
$blockquoteContent = get_field('blockquote_content');
$conclusionContent = get_field('conclusion_content');

$becomeDragonFormShortcode = get_field('become_dragon_form_shortcode');

?>
<main class="main-wrap fixed-main-wrap">
	<?php if (!empty($ourStoryPageContent)) { ?>
		<section class="introduction-section">
			<div class="container">
				<div class="content-block">
					<?php echo $ourStoryPageContent; ?>
				</div>
			</div>
		</section>
	<?php } ?>
	<section class="video-content-block">
		<?php if (!empty($ourStoryVideo)) { ?>
			<div class="video-container">
				<div class="video-block">
					<i class="play-icon" data-toggle="modal" data-target="#story-modal">
						<img src="<?php echo get_template_directory_uri(); ?>/public/images/play-desktop.png" alt="play-icon" class="desktop-img">
						<img src="<?php echo get_template_directory_uri(); ?>/public/images/play-desktop.png" alt="play-icon" class="tablet-img">
						<img src="<?php echo get_template_directory_uri(); ?>/public/images/play_mobile.png" alt="play-icon" class="mobile-img">
					</i>
					<?php if ($videoSectionDesktopImage) { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/public/images/our-story-desktop.png" class="desktop-img" alt="<?php echo _e('video image', 'camberwell-dragons') ?>">
					<?php } ?>

					<?php if ($videoSectionTabletImage) { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/public/images/our-story-desktop.png" class="tablet-img" alt="<?php echo _e('video image', 'camberwell-dragons') ?>">
					<?php } ?>

					<?php if ($videoSectionTabletImage) { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/public/images/our-story-desktop.png" class="mobile-img" alt="<?php echo _e('video image', 'camberwell-dragons') ?>">
					<?php } ?>

				</div>
			</div>
		<?php } ?>

		<?php if (!empty($ourStorySliderAboveContent)) { ?>
			<div class="container container-small">
				<div class="content-block">
					<?php echo $ourStorySliderAboveContent; ?>
				</div>
			</div>
		<?php } ?>

	</section>
	<?php if (have_rows('slider_section')) { ?>
		<section class="slider-section">
			<div class="slider-container">
				<ul class="story-slider">
					<?php
					while (have_rows('slider_section')) : the_row();
						$sliderDesktopImage = get_sub_field('section_desktop_device_image');
						$sliderTabletImage = get_sub_field('section_tablet_device_image');
						$sliderMobileImage = get_sub_field('section_mobile_device_image');
						if (!$sliderTabletImage) {
							$sliderTabletImage = $sliderDesktopImage;
						}
						if (!$sliderMobileImage) {
							$sliderMobileImage = $sliderTabletImage;
						}
					?>
						<li>
							<div class="image-block">
								<?php if (!empty($sliderDesktopImage)) { ?>
									<img src="<?php echo $sliderDesktopImage['url']; ?>" alt="<?php echo _e('our-story', 'camberwell-dragons'); ?>" class="desktop-img">
								<?php } ?>
								<?php if (!empty($sliderTabletImage)) { ?>
									<img src="<?php echo $sliderTabletImage['url']; ?>" alt="<?php echo _e('our-story', 'camberwell-dragons'); ?>" class="tablet-img">
								<?php } ?>
								<?php if (!empty($sliderMobileImage)) { ?>
									<img src="<?php echo $sliderMobileImage['url']; ?>" alt="<?php echo _e('our-story', 'camberwell-dragons'); ?>" class="mobile-img">
								<?php } ?>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</section>
	<?php } ?>

	<section class="image-and-content-section our-story-section">
		<div class="container-fluid">
			<?php if (!empty($intoductionContent)) { ?>
				<div class="container container-small">
					<div class="first-block">
						<?php echo $intoductionContent; ?>
					</div>
				</div>
			<?php } ?>

			<?php if (!empty($blockquoteContent)) { ?>
				<blockquote>
					<?php echo $blockquoteContent; ?>
				</blockquote>
			<?php } ?>
			<?php if (!empty($conclusionContent)) { ?>
				<div class="container container-small">
					<div class="third-block">
						<?php echo $conclusionContent; ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</section>

	<?php if (!empty($becomeDragonFormShortcode)) { ?>
		<section class="dragon-form-section">
			<div class="container container-small">
				<?php $contactFormName = $becomeDragonFormShortcode->post_title; ?>
				<div class="dragon-title-block">
					<h3 class="form-title"><?php echo $contactFormName; ?></h3>
				</div>
				<?php $contactFormName = $becomeDragonFormShortcode->post_title;
				$contactFormID = $becomeDragonFormShortcode->ID;
				echo do_shortcode('[contact-form-7 html_class="dragon-form" id="' . $contactFormID . '" title="' . $contactFormName . '"]'); ?>
			</div>
		</section>
	<?php } ?>

	<div id="story-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<img src="<?php echo get_template_directory_uri(); ?>/public/images/black-close-icon.svg" alt="Close">
					</button>
				</div>
				<div class="modal-body">
					<div class="iframe-outer">
						<video width="100%" controls autoplay>
							<source src="<?php echo $ourStoryVideo; ?>" type="video/mp4">
						</video>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
?>