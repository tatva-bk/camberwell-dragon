<?php /*
Template Name: Available Positions Page
*/
get_header();

$availablePositionsPageContent = get_the_content();
$availablePositionDesktopImage = get_field('available_position_desktop_image');
$availablePositionTabletImage = get_field('available_position_tablet_image');
$availablePositionMobileImage = get_field('available_position_mobile_image');
if (!$availablePositionTabletImage) {
	$availablePositionTabletImage = $availablePositionDesktopImage;
}
if (!$availablePositionMobileImage) {
	$availablePositionMobileImage = $availablePositionTabletImage;
}
$availableCurrentlyPotitionLabel = get_field('available_currently_position_label');
$policyContactInformationContentCopy = get_field('policy_contact_information_content_copy');
$noAvailableMessage = get_field('no_available_position_message');

?>
<main class="main-wrap fixed-main-wrap">
	<?php if($availablePositionsPageContent){?>	
	<section class="introduction-section">
	<div class="container">
		<div class="content-block">
		<?php echo $availablePositionsPageContent; ?>
		</div>
	</div>
	</section>
	<?php } ?>
	<section class="large-image-section">
	<div class="image-block">
		<?php if ($availablePositionDesktopImage) { ?>
			<img src="<?php echo $availablePositionDesktopImage['url']; ?>" alt="<?php echo _e('event', 'camberwell-dragons') ?>" class="desktop-img">
		<?php } ?>

		<?php if ($availablePositionTabletImage) { ?>
			<img src="<?php echo $availablePositionTabletImage['url']; ?>" alt="<?php echo _e('event', 'camberwell-dragons') ?>" class="tablet-img">
		<?php } ?>

		<?php if ($availablePositionMobileImage) { ?>
			<img src="<?php echo $availablePositionMobileImage['url']; ?>" alt="<?php echo _e('event', 'camberwell-dragons') ?>" class="mobile-img">
		<?php } ?>
	</div>
	</section>
	<?php if( have_rows('available_currently_position_section') ) {?>
	<section class="link-download-section position-available-section">
		<div class="container container-small">
			<?php if (!empty($availableCurrentlyPotitionLabel)) { ?>
			<div class="title-block">
				<h4 class="download-title">
				<?php echo $availableCurrentlyPotitionLabel; ?>
				</h4>
			</div>
			<?php } ?>
			<div class="content-block">
				<?php while( have_rows('available_currently_position_section') ) { the_row();
				$policyName = get_sub_field('policy_name');
				$policyurl = get_sub_field('policy_link'); ?>
				<div class="document-name">
					<?php if(!empty($policyName) && !empty($policyurl)) { ?><p><?php echo $policyName; ?></p>
					<a target="_blank" class="share-btn" href="<?php echo $policyurl; ?>" title="Apply">
						<span>Apply</span>
					</a>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<?php } else { ?>
		<div class="container container-small position-msg">
			<p><?php echo $noAvailableMessage; ?></p>
		</div>	
	<?php } ?>
	<?php if(!empty($policyContactInformationContentCopy)) { ?>
	<div class="further-info-block available-position-page">
	<div class="container container-small">
		<div class="content-block">
		<?php echo $policyContactInformationContentCopy; ?>
		</div>
	</div>
	</div>
	<?php } ?>
</main>

<?php
get_footer();
?>