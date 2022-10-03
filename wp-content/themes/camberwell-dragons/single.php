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
$newsContent = get_field('news_detail_page_content_copy', $postId);
$newsDescription = get_the_content($postId);
$newsDeskImage = get_field('news_detail_page_desktop_device_image', $postId);
$newsTabletImage = get_field('news_detail_page_tablet_device_image', $postId);
$newsMobileImage = get_field('news_detail_page_mobile_device_image', $postId);
if (!$newsTabletImage) {
	$newsTabletImage = $newsDeskImage;
}
if (!$newsMobileImage) {
	$newsMobileImage = $newsTabletImage;
}

$introDesktopText = get_field('news_detail_introduction_desktop_text', $postId);
$introMobileText = get_field('news_detail_introduction_mobile_text', $postId);

$blockquoteDesktopText = get_field('blockquote_desktop_text', $postId);

$conclusionDesktopText = get_field('news_detail_conclusion_desktop_text', $postId);
$conclusionMobileText = get_field('news_detail_conclusion_mobile_text', $postId);

$shareLinkLabel = get_field('share_link_label', $postId);

$subject = get_the_title($postId);
$body = get_the_permalink($postId);
$mailto = '';
$shareLink = "mailto:$mailto?subject=$subject&body=$body";

?>
<main class="main-wrap fixed-main-wrap">
	<section class="news-article-section">
		<div class="container container-small">
			<div class="news-share">
				<h2><?php echo get_the_title(); ?></h2>
				<!-- <p><span><?php echo get_the_date('l d F Y'); ?></span> -->
				<p><span><?php echo get_the_date('D d M Y'); ?></span>				
					<?Php if ($shareLinkLabel && $shareLink) { ?>
						<a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
							<span><?php echo $shareLinkLabel; ?></span>
							<i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt="<?php echo _e('share', 'camberwell-dragons') ?>"></i>
						</a>
					<?php } ?>

				</p>
			</div>
			<?php if (!empty($newsContent)) { ?>
				<?php echo $newsContent; ?>
			<?php } ?>
		</div>

	</section>
	<section class="image-and-content-section">
		<div class="container-fluid">
			<div class="image-block">
				<?php if ($newsDeskImage) { ?>
					<img src="<?php echo $newsDeskImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="desktop-img">
				<?php } ?>

				<?php  if ($newsTabletImage) { ?>
					<img src="<?php echo $newsTabletImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="tablet-img">
				<?php }    ?>

				<?php if ($newsMobileImage) { ?>
					<img src="<?php echo $newsMobileImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="mobile-img">
				<?php }  ?>
			</div>
			<div class="container container-small">
				<div class="first-block">
					<?php if (!empty($introDesktopText)) { ?>
						<div class="desktop-text"><?php echo $introDesktopText; ?></div>
					<?php } ?>

					<?php if (!empty($introDesktopText) || !empty($introMobileText)) { ?>
						<div class="mobile-text">
							<?php if (empty($introMobileText)) {
								echo $introDesktopText;
							} else {
								echo $introMobileText;
							} ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php if (!empty($blockquoteDesktopText)) { ?>
				<blockquote>
					<?php echo ($blockquoteDesktopText); ?>
				</blockquote>
			<?php } ?>

			<div class="container container-small">
				<div class="third-block">
					<?php if (!empty($conclusionDesktopText)) { ?>
						<div class="desktop-text"><?php echo $conclusionDesktopText; ?></div>
					<?php } ?>
					<?php if (!empty($conclusionMobileText) || !empty($conclusionDesktopText)) { ?>
						<div class="mobile-text">
							<?php if (empty($conclusionMobileText)) {
								echo $conclusionDesktopText;
							} else {
								echo $conclusionMobileText;
							} ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<section class="images-section">
		<div class="container container-small mobile-full-width-container">
			<?php if (have_rows('news_detail_page_images')) { ?>
				<div class="images-wrapper">
					<?php while (have_rows('news_detail_page_images')) {
						the_row();
						$desktopImage = get_sub_field('detail_page_desktop_device_image');
						$tabletImage = get_sub_field('detail_page_tablet_device_image');
						$mobileImage = get_sub_field('detail_page_mobile_device_image');
						if (!$tabletImage) {
                            $tabletImage = $desktopImage;
                        }
                        if (!$mobileImage) {
                            $mobileImage = $tabletImage;
                        }
					?>
						<div class="image-block">
							<?php if ($desktopImage) { ?>
								<img src="<?php echo $desktopImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="desktop-img">
							<?php } ?>

							<?php  if ($tabletImage) { ?>
								<img src="<?php echo $tabletImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="tablet-img">
							<?php }  ?>

							<?php if ($mobileImage) { ?>
								<img src="<?php echo $mobileImage['url']; ?>" alt="<?php echo get_the_title(); ?>" class="mobile-img">
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</section>
	<section class="article-section inner-article four-articles-section article-with-heading">
		<div class="container container-small">
			<div class="title-block">
				<h3 class="white-border news-title"><?php echo _e('Other News', 'camberwell-dragons'); ?></h3>
			</div>
			<div class="article-block-wrapper">
				<?php
				$count_posts = wp_count_posts();
				$totalPosts = $count_posts->publish;

				$otherNewsPerPage = 4;
				$device_name = camberwell_dragon_detect_device();
				if ($device_name == 'mobile') {
					$otherNewsPerPage = 2;
				}
				$queryOtherNews = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'order' => 'DESC', 'posts_per_page' => $otherNewsPerPage, 'post__not_in' => array($postId)));
				if ($queryOtherNews->have_posts()) {
					while ($queryOtherNews->have_posts()) {
						$queryOtherNews->the_post();

						$newsDeskImage = get_field('four_column_news_listing_desktop_device_image');
						$newsTabletImage = get_field('four_column_news_listing_tablet_device_image');
						$newsMobileImage = get_field('four_column_news_listing_mobile_device_image');
						if (!$newsTabletImage) {
                            $newsTabletImage = $newsDeskImage;
                        }
                        if (!$newsMobileImage) {
                            $newsMobileImage = $newsTabletImage;
                        }
						$shareLinkLabel = get_field('share_link_label');

						$subject = get_the_title();
						$body = get_the_permalink();
						$mailto = '';
						$shareLink = "mailto:$mailto?subject=$subject&body=$body";
				?>
						<div class="article-block">
							<div class="image-block">
								<i>
									<a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">

										<?php if ($newsDeskImage) { ?>
											<img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="desktop-img">
										<?php } ?>

										<?php  if ($newsTabletImage) { ?>
											<img src="<?php echo $newsTabletImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="tablet-img">
										<?php }  ?>

										<?php if ($newsMobileImage) { ?>
											<img src="<?php echo $newsMobileImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="mobile-img">
										<?php } ?>
									</a>
								</i>

							</div>
							<div class="article-detail">
								<h4 class="white-border"><?php the_title(); ?></h4>
								<!-- <span><?php echo get_the_date('l d F Y'); ?></span> -->
								<span><?php echo get_the_date('D d M Y'); ?></span>								

								<?php $excerptContent = get_the_excerpt();
								$excerptContent = (strlen($excerptContent) > 157) ? substr($excerptContent, 0, 157) . '...' : $excerptContent; ?>
								<p><?php echo $excerptContent; ?></p>

								<div class="article-btns">
									<a href="<?php the_permalink(); ?>" class="btn-white" title="<?php echo _e('View', 'camberwell-dragons') ?>">View</a>
									<?Php if ($shareLinkLabel && $shareLink) { ?>
										<a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
											<span><?php echo $shareLinkLabel; ?></span>
											<i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt="<?php echo _e('share', 'camberwell-dragons') ?>"></i>
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
				<?php
					}
				}
				wp_reset_query();
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>

	<section class="view-more-section">
		<div class="container container-small">
			<div class="view-top-wrap">
				<a class="view-more-detail" href="javascript:void(0)" title="<?Php echo _e('View more news', 'camberwell-dragons'); ?>">
					<span><?Php echo _e('View more news', 'camberwell-dragons'); ?></span>
					<i><img src="<?php echo get_template_directory_uri(); ?>/public/images/plus-large-red.svg" alt="<?php echo _e('plus-red', 'camberwell-dragons') ?>"></i>
				</a>
			</div>
			<div class="custom-total" data-total='<?php echo $totalPosts; ?>'></div>
			<div class="postsCount" data-posts-count='<?Php echo $otherNewsPerPage; ?>'></div>
			<div class="pageNumber" data-page='1'></div>
			<div class="exclude-post" data-id="<?php echo $postId; ?>"></div>
		</div>
	</section>

</main>
<?php
get_footer();
?>
<script>
	$(document).ready(function() {
		$('.menu-item-community').addClass('active');
	});
</script>