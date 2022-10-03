<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package camberwell-dragons
 */

get_header();
?>

<main class="main-wrap cms-page fixed-main-wrap">
	<section class="page-not-found">
		<div class="banner-content">
			<div class="container">
				<h1><?php _e('404', 'camberwell-dragons'); ?></h1>
			</div>
		</div>
		<div class="container">
			<h2><?php _e('Oops! That page can\'t be found.', 'camberwell-dragons'); ?></h2>
			<p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'camberwell-dragons'); ?></p>
			<p>
				<?php _e('Go to ', 'camberwell-dragons'); ?>
				<a class="btn-white" href="<?php echo bloginfo('url'); ?>" title="<?php _e('Homepage', 'camberwell-dragons'); ?>"><?php _e('Homepage', 'camberwell-dragons'); ?></a>
			</p>
		</div>
	</section>
	<!-- 	 -->
</main>

<?php
get_footer();
