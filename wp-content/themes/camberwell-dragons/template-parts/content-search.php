<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package camberwell-dragons
 */

?>

<li id="post-<?php the_ID(); ?>" <?php post_class('result'); ?>>
<?php
	$search_link = get_the_permalink();
	
	?>
	<a class="result-name" target="_blank" href="<?php echo $search_link; ?>" post_type="<?php echo $post->post_type; ?>" title="<?php the_title(); ?>">
		<span>
			<?php the_title(); ?>
		</span>
		<i class="result-icon"><img src="<?php echo get_template_directory_uri(); ?>/public/images/learn-more-small.svg" alt="learn-more"></i>
	</a>
</li><!-- #post-<?php the_ID(); ?> -->
