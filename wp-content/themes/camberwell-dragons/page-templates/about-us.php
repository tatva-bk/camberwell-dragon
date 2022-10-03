<?php /*
	Template Name: About us Page
	*/
get_header();
$aboutPageTitle = get_the_title();
$aboutPageContent = get_the_content();

?>
<main class="main-wrap fixed-main-wrap">
	<?php if (!empty($aboutPageContent)) { ?>
		<section class="introduction-section">
			<div class="container">
				<div class="content-block">
					<?php echo $aboutPageContent; ?>
				</div>
			</div>
		</section>
	<?php } ?>
	<?php if (have_rows('about_us_sections')) : ?>
		<section class="layers-section">
			<?php
			$index = 1;
			while (have_rows('about_us_sections')) : the_row();
				$sectionTitle = get_sub_field('section_title');
				$sectionContent = get_sub_field('section_description');
				$sectionDeskImage = get_sub_field('section_desktop_device_image');
				$sectionTabletImage = get_sub_field('section_tablet_device_image');
				$sectionMobileImage = get_sub_field('section_mobile_device_image');
				$sectionCTAUrl = get_sub_field('section_cta_link');
				$sectionCTALabel = get_sub_field('section_cta_copy');
				if (!$sectionTabletImage) {
					$sectionTabletImage = $sectionDeskImage;
				}
				if (!$sectionMobileImage) {
					$sectionMobileImage = $sectionTabletImage;
				}
				if($index == 1) {
					$wrapClass = 'first-layers-wrapper';
				} else {
					$wrapClass = '';
				}

				if ($index % 2 == 1) { ?>

					<div class="layers-wrapper <?php echo $wrapClass;?>">
						<div class="layers-inner-wrap">

							<?php if ($sectionDeskImage) { ?>
								<div class="img-wrapper desk" style="background-image: url(&quot;<?php echo $sectionDeskImage['url']; ?>&quot;);">
									<img src="<?php echo $sectionDeskImage['url']; ?>" alt="<?php echo $sectionTitle; ?>">
								</div>
							<?php } ?>

							<?php if ($sectionTabletImage) { ?>
								<div class="img-wrapper tab" style="background-image: url(&quot;<?php echo $sectionTabletImage['url']; ?>&quot;);">
									<img src="<?php echo $sectionTabletImage['url']; ?>" alt="<?php echo $sectionTitle; ?>">
								</div>
							<?php } ?>

							<?php if ($sectionMobileImage) { ?>
								<div class="img-wrapper mob" style="background-image: url(&quot;<?php echo $sectionMobileImage['url']; ?>&quot;);">
									<img src="<?php echo $sectionMobileImage['url']; ?>" alt="<?php echo $sectionTitle; ?>">
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
										<?php if ($sectionTitle) { ?>
											<h2><?php echo $sectionTitle; ?></h2>
										<?php } ?>

										<?php if (!empty($sectionContent)) { ?>
											<?php echo $sectionContent; ?>
										<?php } ?>

										<?php if (!empty($sectionCTAUrl) && !empty($sectionCTALabel)) { ?>
											<a href="<?php echo $sectionCTAUrl; ?>" class="btn-white btn-small" title="<?php echo $sectionCTALabel; ?>"><?php echo $sectionCTALabel; ?></a>
										<?php } ?>

									</div>
								</div>
							</div>
						</div>
					</div>

				<?php } else { ?>

					<div class="layers-wrapper">
						<div class="layers-inner-wrap row-reverse">
							<?php if ($sectionDeskImage) { ?>
								<div class="img-wrapper desk" style="background-image: url(&quot;<?php echo $sectionDeskImage['url']; ?>&quot;);">
									<img src="<?php echo $sectionDeskImage['url']; ?>" alt="<?php echo $sectionTitle; ?>">
								</div>
							<?php } ?>

							<?php if ($sectionTabletImage) { ?>
								<div class="img-wrapper tab" style="background-image: url(&quot;<?php echo $sectionTabletImage['url']; ?>&quot;);">
									<img src="<?php echo $sectionTabletImage['url']; ?>" alt="<?php echo $sectionTitle; ?>">
								</div>
							<?php } ?>

							<?php if ($sectionMobileImage) { ?>
								<div class="img-wrapper mob" style="background-image: url(&quot;<?php echo $sectionMobileImage['url']; ?>&quot;);">
									<img src="<?php echo $sectionMobileImage['url']; ?>" alt="<?php echo $sectionTitle; ?>">
								</div>
							<?php } ?>

							<div class="layers-row">
								<div class="layer-block">
									<div class="img-wrapper">
										<img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png" alt="<?php echo _e('ProgramImg', 'camberwell-dragons'); ?>">
									</div>
									<div class="content-wrap">
										<?php if ($sectionTitle) { ?>
											<h2><?php echo $sectionTitle; ?></h2>
										<?php } ?>

										<?php if (!empty($sectionContent)) { ?>
											<?php echo $sectionContent; ?>
										<?php } ?>
										
										<?php if (!empty($sectionCTAUrl) && !empty($sectionCTALabel)) { ?>
											<a href="<?php echo $sectionCTAUrl; ?>" class="btn-white btn-small" title="<?php echo $sectionCTALabel; ?>"><?php echo $sectionCTALabel; ?></a>
										<?php } ?>										
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php
				$index++;
			endwhile; ?>			
		</section>
	<?php endif; ?>
</main>
<?php
get_footer();
?>