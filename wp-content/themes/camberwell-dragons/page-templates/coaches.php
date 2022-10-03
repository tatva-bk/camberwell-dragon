<?php /*
Template Name: Coaches Page
*/
get_header();

$coachesPageContent = get_the_content();
$coachesDeskImage = get_field('full_desktop_device_image');
$coachesTabletImage = get_field('full_tablet_device_image');
$coachesMobileImage = get_field('full_mobile_device_image');
if (!$coachesTabletImage) {
	$coachesTabletImage = $coachesDeskImage;
}
if (!$coachesMobileImage) {
	$coachesMobileImage = $coachesTabletImage;
}
$coachesContentDeskImage = get_field('coaches_desktop_device_image');
$coachesContentTabletImage = get_field('coaches_tablet_device_image');
$coachesContentMobileImage = get_field('coaches_mobile_device_image');
if (!$coachesContentTabletImage) {
	$coachesContentTabletImage = $coachesContentDeskImage;
}
if (!$coachesContentMobileImage) {
	$coachesContentMobileImage = $coachesContentTabletImage;
}
$sectionTitleForLinksAndDownloads = get_field('section_title_for_links_and_downloads');
$informationContentSection = get_field('information_content_section');
$contentBelowFullImageSection = get_field('content_below_full_image_section');
$level1Heding = get_field('level1_heading');
$level1Content = get_field('level1_content');
$level2Heding = get_field('level2_heading');
$level2Content = get_field('level2_content');
$level3Heding = get_field('level3_heading');
$level3Content = get_field('level3_content');

?>
<main class="main-wrap fixed-main-wrap">
	<section class="introduction-section">
		<div class="container">
			<div class="content-block">
				<?php if ($coachesPageContent != '') { ?>
					<?php echo $coachesPageContent; ?>
				<?php } ?>
			</div>
		</div>
	</section>
	<section class="large-image-section">
		<div class="image-block">
			<?php if ($coachesDeskImage) { ?>
				<img src="<?php echo $coachesDeskImage['url']; ?>" alt="<?php echo _e('Coaches', 'camberwell-dragons') ?>" class="desktop-img">
			<?php } ?>

			<?php if ($coachesTabletImage) { ?>
				<img src="<?php echo $coachesTabletImage['url']; ?>" alt="<?php echo _e('Coaches', 'camberwell-dragons') ?>" class="tablet-img">
			<?php } ?>

			<?php if ($coachesMobileImage) { ?>
				<img src="<?php echo $coachesMobileImage['url']; ?>" alt="<?php echo _e('Coaches', 'camberwell-dragons') ?>" class="mobile-img">
			<?php } ?>
		</div>
	</section>
	<?php if (!empty($contentBelowFullImageSection)) { ?>
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
	<section class="link-download-section">
		<div class="container container-small">
			<?php if (!empty($sectionTitleForLinksAndDownloads)) { ?>
				<div class="title-block">
					<h4 class="download-title">
						<?php echo $sectionTitleForLinksAndDownloads; ?>
					</h4>
				</div>
			<?php } ?>
			<?php if (have_rows('links_and_downloads_section')) { ?>
				<div class="content-block">
					<?php while (have_rows('links_and_downloads_section')) {
						the_row();
						$downloadTitle = get_sub_field('title_for_links_and_downloads');
						$downloadLink = get_sub_field('download_file');
					?>
						<?php if (!empty($downloadTitle) && !empty($downloadLink)) { ?>
							<div class="document-name">
								<p><?php echo $downloadTitle; ?></p>
								<a target="_blank" class="share-btn" href="<?php echo $downloadLink['url']; ?>" title="View">
									<span>View</span>
									<i class="share-link">
										<img src="<?php echo get_template_directory_uri(); ?>/public/images/pdf.svg" alt="<?php echo _e('view', 'camberwell-dragons') ?>">
									</i>
								</a>
							</div>
					<?php }
					} ?>
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
	<section class="small-image-section">
		<div class="container">
			<div class="image-block">
				<?php if ($coachesContentDeskImage) { ?>
					<img src="<?php echo $coachesContentDeskImage['url']; ?>" alt="<?php echo _e('Coaches', 'camberwell-dragons') ?>" class="desktop-img">
				<?php } ?>

				<?php if ($coachesContentTabletImage) { ?>
					<img src="<?php echo $coachesContentTabletImage['url']; ?>" alt="<?php echo _e('Coaches', 'camberwell-dragons') ?>" class="tablet-img">
				<?php } ?>

				<?php if ($coachesContentMobileImage) { ?>
					<img src="<?php echo $coachesContentMobileImage['url']; ?>" alt="<?php echo _e('Coaches', 'camberwell-dragons') ?>" class="mobile-img">
				<?php } ?>
			</div>
		</div>
	</section>
	<?php if (!empty($informationContentSection)) { ?>
		<div class="further-info-block">
			<div class="container container-small">
				<div class="content-block">
					<?php echo $informationContentSection; ?>
				</div>
			</div>
		</div>
	<?php } ?>
</main>

<?php
get_footer();

