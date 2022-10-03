<?php /*
Template Name: Contact Page
*/
get_header();
$contactPageTitle = get_the_title();
$contactPageContent = get_the_content();
$contactsLabel =  get_field('contact_section_title');
$venueLocationLabel =  get_field('venue_location_title');
$postalLocationLabel =  get_field('postal_location_title');
$postalLocationName =  get_field('postal_location_name');
$postalLocationAddress =  get_field('postal_location_address');
$contactFormShortcode = get_field('contact_form_shortcode');

?>

<main class="main-wrap fixed-main-wrap">
	<?php if (!empty($contactPageContent)) { ?>
		<section class="introduction-section">
			<div class="container">
				<div class="content-block">
					<?php echo $contactPageContent; ?>
				</div>
			</div>
		</section>
	<?php } ?>
	<?php if (have_rows('contacts_fields')) : ?>
		<section class="contacts-section">
			<div class="container">
				<div class="content-wrap">
					<?php if (!empty($contactsLabel)) { ?>
						<div class="contact-title-block">
							<h3 class="contact-title"><?php echo $contactsLabel; ?></h3>
						</div>
					<?php } ?>
					<div class="content-block">
						<?php $countClass = 1;
						while (have_rows('contacts_fields')) : the_row();
							if ($countClass % 3 == 1) {
								$blockClass = 'left-block';
							} elseif ($countClass % 3 == 2) {
								$blockClass = 'middle-block';
							} elseif ($countClass % 3 == 0) {
								$blockClass = 'right-block';
							} else {
								$blockClass = '';
							} ?>
							<div class="<?php echo $blockClass; ?>">
								<?php if (have_rows('contact_block')) :
									$blockCounter = 1;
									while (have_rows('contact_block')) : the_row();
										$contactName = get_sub_field('contact_name');
										$contactEmail = get_sub_field('contact_email');
										if ($blockCounter == 1) {
											$blockClass = 'first-block';
										} elseif ($blockCounter == 2) {
											$blockClass = 'second-block';
										} else {
											$blockClass = '';
										} ?>
										<div class="<?php echo $blockClass; ?>">
											<?php echo $contactName; ?>
											<a href="mailto:<?php echo $contactEmail; ?>" title="Email">
												<?php echo $contactEmail; ?>
											</a>
										</div>
								<?php $blockCounter++;
									endwhile;
								endif; ?>
							</div>
						<?php $countClass++;
						endwhile; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<section class="location-section">
		<div class="container">
			<div class="location-wrapper">
				<div class="venue-block">
					<?php if (!empty($venueLocationLabel)) { ?>
						<div class="contact-title-block">
							<h3 class="contact-title"><?php echo $venueLocationLabel; ?></h3>
						</div>
					<?php } ?>
					<?php if (have_rows('venue_location_fields')) : ?>
						<div class="content-block">
							<?php $countClass = 1;
							while (have_rows('venue_location_fields')) : the_row();
								$locationName = get_sub_field('location_name');
								$locationAddress = get_sub_field('location_address');
								if ($countClass % 3 == 1) {
									$blockClass = 'left-block';
								} elseif ($countClass % 3 == 2) {
									$blockClass = 'middle-block';
								} elseif ($countClass % 3 == 0) {
									$blockClass = 'right-block';
								} else {
									$blockClass = '';
								} ?>
								<div class="<?php echo $blockClass; ?>">
									<?php if (!empty($locationName)) { ?>
										<p><?php echo $locationName; ?></p>
									<?php } ?>
									<?php if (!empty($locationAddress)) { ?>
										<address><?php echo $locationAddress; ?></address>
									<?php } ?>
								</div>
							<?php $countClass++;
							endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
				
				<div class="postal-block">
					<?php if (!empty($postalLocationLabel)) { ?>
						<div class="contact-title-block">
							<h3 class="contact-title">
								<?php echo $postalLocationLabel; ?>
							</h3>
						</div>
					<?php } ?>
					<div class="content-block">
						<?php if (!empty($postalLocationName)) { ?>
							<p><?php echo $postalLocationName; ?></p>
						<?php } ?>
						<?php if (!empty($postalLocationAddress)) { ?>
							<address>
								<ul>
									<li>
										<?php echo $postalLocationAddress; ?>
									</li>
								</ul>
							</address>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php if (!empty($contactFormShortcode)) { ?>
		<section class="dragon-form-section">
			<div class="container container-small">
				<?php $contactFormName = $contactFormShortcode->post_title; ?>
				<div class="dragon-title-block">
					<h3 class="form-title"><?php echo $contactFormName; ?></h3>
				</div>
				<?php $contactFormName = $contactFormShortcode->post_title;
				$contactFormID = $contactFormShortcode->ID;
				echo do_shortcode('[contact-form-7 html_class="dragon-form" id="' . $contactFormID . '" title="' . $contactFormName . '"]'); ?>
				<!-- <form action="" class="dragon-form">
				<div class="row-wrap">
					<div class="column">
						<input type="text" placeholder="First Name*">
						<span class="border-animator"></span>
					</div>
					<div class="column">
						<input type="text" placeholder="Surname">
						<span class="border-animator"></span>
					</div>
					<div class="column">
						<input type="text" placeholder="Email*">
						<span class="border-animator"></span>
					</div>
					<div class="column">
						<input type="text" placeholder="contact Number">
						<span class="border-animator"></span>
					</div>
				</div>
				<a href="#" title="Subscribe" class="btn-white">Subscribe</a>
			</form> -->
			</div>
		</section>
	<?php } ?>
</main>
<?php
get_footer();
?>