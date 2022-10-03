<?php

 /*
Template Name: Coaches & Referes Page
*/
get_header();

$postId = get_the_ID();

?>
<main class="main-wrap fixed-main-wrap">
	<section class="introduction-section">
		<div class="container">
			<div class="content-block">
				<?php echo get_the_content();?>
			</div>
		</div>
	</section>
	<?php if(have_rows('page_sections')) { ?>
	<section class="layers-section">
		<?php 
			$count = 1;
			while(have_rows('page_sections')) {
			the_row();
			$coachesReferesName = get_sub_field('section_title');
			$coachesReferesDescription = get_sub_field('section_description');
			$coachesReferesDesktopImage = get_sub_field('section_desktop_device_image');
			$coachesReferesTabletImage = get_sub_field('section_tablet_device_image');
			$coachesReferesMobileImage = get_sub_field('section_mobile_device_image');
			$coachesReferesPageLink = get_sub_field('section_cta_link');
			$coachesReferesPageLabel = get_sub_field('section_cta_label');
			if (!$coachesReferesTabletImage) {
				$coachesReferesTabletImage = $coachesReferesDesktopImage;
			}
			if (!$coachesReferesMobileImage) {
				$coachesReferesMobileImage = $coachesReferesTabletImage;
			}
			if($count%2 == 0 ) {
				$class="row-reverse";
			}
			?>
		<div class="layers-wrapper">
			<div class="layers-inner-wrap <?php echo $class; ?>">
				<?php if ($coachesReferesDesktopImage) { ?>
				<div class="img-wrapper desk" style="background-image: url('<?php echo $coachesReferesDesktopImage['url']; ?>');">
					<img src="<?php echo $coachesReferesDesktopImage['url']; ?>" alt="LayredImage">
				</div>
				<?php } ?>
				<?php if ($coachesReferesTabletImage) { ?>
				<div class="img-wrapper tab"
					style="background-image: url('<?php echo $coachesReferesTabletImage['url']; ?>');">
					<img src="<?php echo $coachesReferesTabletImage['url']; ?>" alt="LayredImage">
				</div>
				<?php } ?>
				<?php if ($coachesReferesMobileImage) { ?>
				<div class="img-wrapper mob"
					style="background-image: url('<?php echo $coachesReferesMobileImage['url']; ?>');">
					<img src="<?php echo $coachesReferesMobileImage['url']; ?>" alt="LayredImage">
				</div>
				<?php } ?>
				<div class="layers-row">
					<div class="layer-block">
						<?php if($count%2 == 1) { ?>
							<div class="img-wrapper desk">
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-01.png"  alt="<?php echo _e('card', 'camberwell-dragons') ?>">
							</div>
							<div class="img-wrapper mob">
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png"  alt="<?php echo _e('card', 'camberwell-dragons') ?>">
							</div>
						<?php } else {?>
							<div class="img-wrapper">
								<img src="<?php echo get_template_directory_uri(); ?>/public/images/card-shape-02.png"  alt="<?php echo _e('card', 'camberwell-dragons') ?>">
							</div>
						<?php } ?>
						<div class="content-wrap">
						<?php if (!empty($coachesReferesName)) { ?>
							<h2><?php echo $coachesReferesName; ?></h2>
						<?php } ?>
						<?php if (!empty($coachesReferesDescription)) { ?>
							<?php echo $coachesReferesDescription; ?>	
						<?php } ?>
						<?php if (!empty($coachesReferesPageLabel) && !empty($coachesReferesPageLink)) { ?>
							<a  class="btn-white btn-small" href="<?php echo $coachesReferesPageLink; ?>"><?php echo $coachesReferesPageLabel; ?></a>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $count++; } ?>
	</section>
	<?php } ?>
</main>
<?php
get_footer();
