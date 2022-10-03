<?php

/*
Template Name: Community Page
*/
get_header();

$postId = get_the_ID();
$pageContent = get_the_content();
?>
<main class="main-wrap fixed-main-wrap">
	<?php if (!empty($pageContent)) { ?>
		<section class="introduction-section">
			<div class="container">
				<div class="content-block">
					<?php echo $pageContent; ?>
				</div>
			</div>
		</section>
	<?php } ?>

	<?php if (have_rows('community_listing')) : ?>
		<section class="layers-section">
			<?php
			$index = 1;
			while (have_rows('community_listing')) : the_row();
				$sectionContent = get_sub_field('community_content');
				$sectionTitle = get_sub_field('community_name');
				$sectionCTAUrl = get_sub_field('community_page_link');
				$sectionCTALabel = get_sub_field('section_cta_label');
				$communityDesktopImage = get_sub_field('community_dektop_image');
				$communityTabletImage = get_sub_field('community_tablet_image');
				$communityMobileImage = get_sub_field('community_mobile_image');
				if (!$communityTabletImage) {
					$communityTabletImage = $communityDesktopImage;
				}
				if (!$communityMobileImage) {
					$communityMobileImage = $communityTabletImage;
				}

				if ($index % 2 == 1) { ?>
					<div class="layers-wrapper">
						<div class="layers-inner-wrap">
							<?php if ($communityDesktopImage) { ?>
								<div class="img-wrapper desk" style="background-image: url(&quot;<?php echo $communityDesktopImage['url']; ?>&quot;);">
									<img src="<?php echo $communityDesktopImage['url']; ?>" alt="<?php echo $communityName; ?>">
								</div>
							<?php } ?>
							<?php if ($communityTabletImage) { ?>
								<div class="img-wrapper tab" style="background-image: url(&quot;<?php echo $communityTabletImage['url']; ?>&quot;);">
									<img src="<?php echo $communityTabletImage['url']; ?>" alt="<?php echo $communityName; ?>">
								</div>
							<?php } ?>
							<?php if ($communityMobileImage) { ?>
								<div class="img-wrapper mob" style="background-image: url(&quot;<?php echo $communityMobileImage['url']; ?>&quot;);">
									<img src="<?php echo $communityMobileImage['url']; ?>" alt="<?php echo $communityName; ?>">
								</div>
							<?php } ?>
							<div class="layers-row">
								<div class="layer-block">
									<div class="img-wrapper desk" style="background-image: url(&quot;<?php echo get_template_directory_uri(); ?>/public/images/card-shape-01.png&quot;);">
										<img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-01.png" alt="<?php echo _e('ProgramImg', 'camberwell-dragons'); ?>">
									</div>
									<div class="img-wrapper mob" style="background-image: url(&quot;<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png&quot;);">
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
				<?php  } else { ?>
					<div class="layers-wrapper">
						<div class="layers-inner-wrap row-reverse">
							<?php if ($communityDesktopImage) { ?>
								<div class="img-wrapper desk" style="background-image: url(&quot;<?php echo $communityDesktopImage['url']; ?>&quot;);">
									<img src="<?php echo $communityDesktopImage['url']; ?>" alt="<?php echo $communityName; ?>">
								</div>
							<?php } ?>
							<?php if ($communityTabletImage) { ?>
								<div class="img-wrapper tab" style="background-image: url(&quot;<?php echo $communityTabletImage['url']; ?>&quot;);">
									<img src="<?php echo $communityTabletImage['url']; ?>" alt="<?php echo $communityName; ?>">
								</div>
							<?php } ?>
							<?php if ($communityMobileImage) { ?>
								<div class="img-wrapper mob" style="background-image: url(&quot;<?php echo $communityMobileImage['url']; ?>&quot;);">
									<img src="<?php echo $communityMobileImage['url']; ?>" alt="<?php echo $communityName; ?>">
								</div>
							<?php } ?>
							<div class="layers-row">
								<div class="layer-block">
									<div class="img-wrapper" style="background-image: url(&quot;<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png&quot;);">
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
