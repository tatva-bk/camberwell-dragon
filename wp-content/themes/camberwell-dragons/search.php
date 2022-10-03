<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package camberwell-dragons
 */

get_header();
?>

		<main class="main-wrap fixed-main-wrap">
            <section class="search-result-section">
                <div class="container container-small">
				<div class="content-block">    
				<?php 
				$allsearch = new WP_Query(array('s' => $s, 'posts_per_page' => -1));
				if ($allsearch->have_posts()) { ?>
					<h4><?php _e("Your search for '" . wp_specialchars($s, 1) . "' returned " . $allsearch->found_posts . " results", "camberwell-dragons"); ?></h4>
					<ul class="search-listing">
					<?php
					/* Start the Loop */
					while ($allsearch->have_posts()) {
						$allsearch->the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					} ?>
					</ul>
				<?php
				} else {

					get_template_part( 'template-parts/content', 'none' );

				}
				?>
			</div>	
			</div>
		</section>
	</main>

<?php
get_footer();
