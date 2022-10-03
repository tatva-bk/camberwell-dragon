<?php

 /*
Template Name: Life Members Page
*/
get_header();

$postId = get_the_ID();

?>
<main class="main-wrap fixed-main-wrap">
	<section class="introduction-section introduction-life-member-section">
		<div class="container">
			<div class="content-block">
				<?php echo get_the_content();?>
			</div>
		</div>
	</section>
	<section class="life-member-section">
		<?php if(have_rows('members_listing_section')) {
			while(have_rows('members_listing_section')) {
			the_row();
			$memberName = get_sub_field('member_name');
			$memberDescription = get_sub_field('member_description');
			$memberDesktopImage = get_sub_field('member_desktop_device_image');
			$memberTabletImage = get_sub_field('member_tablet_device_image');
			$memberMobileImage = get_sub_field('member_mobile_device_image');
			if (!$memberTabletImage) {
				$memberTabletImage = $memberDesktopImage;
			}
			if (!$memberMobileImage) {
				$memberMobileImage = $memberTabletImage;
			}
		?>
			<div class="two-col-wrap">
				<div class="life-member-block two-col-block">
					<div class="life-member-image">
						<div class="img-block">
							<?php if ($memberDesktopImage) { ?>
								<div class="desktop-img" style="background-image: url('<?php echo $memberDesktopImage['url']; ?>');"></div>
							<?php } ?>	
							<?php if ($memberTabletImage) { ?>
								<div class="tablet-img" style="background-image: url('<?php echo $memberTabletImage['url']; ?>');"></div>
							<?php } ?>
							<?php if ($memberMobileImage) { ?>
								<div class="mobile-img" style="background-image: url('<?php echo $memberMobileImage['url']; ?>');"></div>
							<?php } ?>
						</div>
						<i class="plus-minus-icon">
							<img src="<?php echo get_template_directory_uri(); ?>/public/images/plus.svg" class="plus" alt="<?php echo _e('plus', 'camberwell-dragons') ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/public/images/minus.svg" class="minus" alt="<?php echo _e('minus', 'camberwell-dragons') ?>">
						</i>
					</div>
					<div class="life-member-content">
						<div class="content-block">
							<?php if (!empty($memberName)) { ?>
								<h2><?php echo $memberName; ?></h2>
							<?php } ?>
							<?php if (!empty($memberDescription)) { ?>
							<div class="inner-content-wrap"> 
								<?php echo $memberDescription; ?>
							</div>
							<?php } ?>    
						</div>
					</div>
				</div>
			</div>
		<?php } }?>
	</section>
</main>
<?php
get_footer();
