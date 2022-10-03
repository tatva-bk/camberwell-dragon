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
$championshipDescription = get_the_content($postId);
$championshipDesktopImage = get_field('championship_detail_desktop_featured_image', $postId);
$championshipTabletImage = get_field('championship_detail_tablet_featured_image', $postId);
$championshipMobileImage = get_field('championship_detail_mobile_featured_image', $postId);
if (!$championshipTabletImage) {
	$championshipTabletImage = $championshipDesktopImage;
}
if (!$championshipMobileImage) {
	$championshipMobileImage = $championshipTabletImage;
}
$championshipContent = get_field('championship_content', $postId);
$level1Heading = get_field('level1_heading', $postId);
$level1Content = get_field('level1_content', $postId);
$level2Content = get_field('level2_content', $postId);
$level2Heading = get_field('level2_heading', $postId);
$helpfulvjblheading = get_field('helpful_vjbl_heading', $postId);
$championshipContentDesktopImage = get_field('content_desktop_image', $postId);
$championshipContentTabletImage = get_field('content_tablet_image', $postId);
$championshipContentMobileImage = get_field('content_mobile_image', $postId);
if (!$championshipContentTabletImage) {
	$championshipContentTabletImage = $championshipContentDesktopImage;
}
if (!$championshipContentMobileImage) {
	$championshipContentMobileImage = $championshipContentTabletImage;
}
$championshipContactInformation = get_field('championship_contact_information', $postId);

?>
<main class="main-wrap fixed-main-wrap">
	<section class="introduction-section">
		<div class="container">
			<div class="content-block">
				<?php if (!empty($championshipDescription)) { ?>
					<?php echo $championshipDescription; ?>
				<?php } ?>
			</div>
		</div>
	</section>
	
	<section class="large-image-section">
		<div class="image-block">
			<?php if ($championshipDesktopImage) { ?>
				<img src="<?php echo $championshipDesktopImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="desktop-img">
			<?php } ?>

			<?php if ($championshipTabletImage) { ?>
				<img src="<?php echo $championshipTabletImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="tablet-img">
			<?php } ?>

			<?php if ($championshipMobileImage) { ?>
				<img src="<?php echo $championshipMobileImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="mobile-img">
			<?php }  ?>
		</div>
	</section>	

	<section class="content-section">
		<div class="container container-small">
		<?php if (!empty($championshipContent)) { ?>
			<div class="content-block">
					<?php echo $championshipContent;?>
			</div>
			<?php } ?>
		</div>
	</section>
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
	  <?php if(have_rows('application_download_section')) {?>
	  <section class="download-section">
        <div class="container container-med">
          <div class="row-wrap">
		  <?php $countView = 1; 
		  		while(have_rows('application_download_section')) {
				the_row();
				if($countView%4 == 1 ) {
					$viewClass = "application";
				} elseif($countView%4 == 2) {
					$viewClass = "fixture";
				} elseif($countView%4 == 3) {
					$viewClass = "result";
				} elseif($countView%4 == 0) {
					$viewClass = "trail";
				} else {
					$viewClass = "";
				}
				$downloadLabel = get_sub_field('download_label');
				$downloadLink = get_sub_field('download_link'); ?>
				<?php if ($downloadLabel && $downloadLink) { ?>
					<div class="column <?php echo $viewClass; ?>">
						<a title="<?php echo $downloadLabel; ?>" class="inner-block" href="<?php echo $downloadLink['url']; ?>" download>
							<h3><?php echo $downloadLabel; ?></h3>
							<i class="download"><img src="<?php echo get_template_directory_uri(); ?>/public/images/download.svg" alt="<?php echo _e('download', 'camberwell-dragons') ?>"></i>
						</a>
					</div>
				<?php } ?>
		  		<?php $countView++; } ?>
          </div>
        </div>
	  </section>
	  <?php } ?>
	<?php if(have_rows('helpful_vjbl_link_section')) {	?>	
	  <section class="link-download-section junior-champ-page">
        <div class="container container-small">
		  <?php if(!empty($helpfulvjblheading)) { ?>	
          <div class="title-block">
            <h4 class="download-title">
				<?php echo $helpfulvjblheading; ?>
            </h4>
		  </div>
		  <?php } ?>
          <div class="content-block">
			<?php while(have_rows('helpful_vjbl_link_section')) {
				the_row();
				$vjblLabel = get_sub_field('vjbl_label');
				$vjblLink = get_sub_field('vjbl_link'); ?>
            <div class="document-name">
              	<a target="_blank" title="Link" class="links" href="<?php echo $vjblLink; ?>"><?php echo $vjblLabel; ?></a>
			</div>
			<?php } ?>
          </div>
        </div>
	  </section>
	<?php } ?>
	  <section class="small-image-section">
        <div class="container">
			<div class="image-block">
				<?php if ($championshipContentDesktopImage) { ?>
						<img src="<?php echo $championshipContentDesktopImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="desktop-img">
				<?php } ?>

				<?php if ($championshipContentTabletImage) { ?>
					<img src="<?php echo $championshipContentTabletImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="tablet-img">
				<?php } ?>

				<?php if ($championshipContentMobileImage) { ?>
					<img src="<?php echo $championshipContentMobileImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="mobile-img">
				<?php } ?>
			</div>
        </div>
	  </section>
	  <?php if (!empty($championshipContactInformation)) { ?>
		<div class="further-info-block junior-champ-page">
			<div class="container container-small">
				<div class="content-block">
					<?php echo $championshipContactInformation; ?>
				</div>
			</div>
		</div>
	  <?php } ?>
</main>
<?php
get_footer(); 
