<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package camberwell-dragons
 */
$allsearch = new WP_Query(array('s' => $s,'posts_per_page' => -1 ));
?>
<h4><?php _e("Your search for '".wp_specialchars($s, 1)."' returned ".$allsearch ->found_posts, "camberwell-dragons"); ?>  <?php _e('results', 'camberwell-dragons'); ?></h4>

		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'camberwell-dragons' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p class="not-found"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'camberwell-dragons' ); ?></p>
			<?php
			// get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'camberwell-dragons' ); ?></p>
			<?php
			// get_search_form();

		endif;
		?>
