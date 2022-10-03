<?php /*
Template Name: Our Policies Page
*/
get_header();
$ourPoliciesPageTitle = get_the_title();
$ourPoliciesPageContent = get_the_content();
$camberwellDistrictBasketballAssociationConstitutionTitle = get_field('camberwell_district_basketball_association_constitution_title');
$camberwellDistrictBasketballAssociationConstitutionFile = get_field('camberwell_district_basketball_association_constitution_file');
$camberwellDragonsPoliciesHeading = get_field('camberwell_dragons_policies_heading');
$policyContactInformationContentCopy = get_field('policy_contact_information_content_copy');
$basketballVictoriaSectionTitle = get_field('basketball_victoria_section_title');
$vjblSectionTitle = get_field('vjbl_section_title');

?>

<main class="main-wrap fixed-main-wrap">
	<?php if (!empty($ourPoliciesPageContent)) { ?>
		<section class="introduction-section">
			<div class="container">
				<div class="content-block">
					<?php echo $ourPoliciesPageContent; ?>
				</div>
			</div>
		</section>
	<?php } ?>

	<section class="link-download-section our-policies-page">
		<div class="container container-small">
			<?php if (!empty($camberwellDistrictBasketballAssociationConstitutionTitle) && !empty($camberwellDistrictBasketballAssociationConstitutionFile)) { ?>
				<div class="document-name">
					<p>
						<?php echo $camberwellDistrictBasketballAssociationConstitutionTitle; ?>
					</p>
					<a class="share-btn" target="_blank" href="<?php echo $camberwellDistrictBasketballAssociationConstitutionFile['url']; ?>" title="<?php echo _e('view', 'camberwell-dragons') ?>">
						<span><?php echo _e('view', 'camberwell-dragons') ?></span>
						<i class="share-link">
							<img src="<?php echo get_template_directory_uri(); ?>/public/images/pdf.svg" alt="<?php echo _e('view', 'camberwell-dragons') ?>">
						</i>
					</a>
				</div>
			<?php } ?>

			<?php if (have_rows('camberwell_dragons_policies_section')) : ?>
				<?php if (!empty($camberwellDragonsPoliciesHeading)) { ?>
					<div class="title-block">
						<h4 class="download-title"><?php echo $camberwellDragonsPoliciesHeading; ?></h4>
					</div>
				<?php } ?>
				<div class="content-block">
					<?php while (have_rows('camberwell_dragons_policies_section')) : the_row();
						$policyName = get_sub_field('policy_name');
						$policyFile = get_sub_field('policy_file');
						if (!empty($policyName) && !empty($policyFile)) {
					?>
							<div class="document-name">
								<p><?php echo $policyName; ?></p>
								<a class="share-btn" target="_blank" href="<?php echo $policyFile['url']; ?>" title="<?php echo _e('view', 'camberwell-dragons') ?>">
									<span><?php echo _e('view', 'camberwell-dragons') ?></span>
									<i class="share-link">
										<img src="<?php echo get_template_directory_uri(); ?>/public/images/pdf.svg" alt="<?php echo _e('view', 'camberwell-dragons') ?>">
									</i>
								</a>
							</div>
					<?php }
					endwhile; ?>

				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php if (!empty($policyContactInformationContentCopy)) { ?>
		<div class="further-info-block our-policies-page">
			<div class="container container-small">
				<div class="content-block">
					<?php echo $policyContactInformationContentCopy; ?>
				</div>
			</div>
		</div>
	<?php } ?>
	<section class="basketball-vjbl-section">
		<div class="container container-small">
			<div class="wrap">
				<?php if (have_rows('basketball_victoria_policies')) : ?>
					<div class="left-block">
						<?php if (!empty($basketballVictoriaSectionTitle)) { ?>
							<div class="title-block">
								<h5 class="basketball-title"><?php echo $basketballVictoriaSectionTitle; ?></h5>
							</div>
						<?php } ?>
						<ul>
							<?php while (have_rows('basketball_victoria_policies')) : the_row();
								$policyName = get_sub_field('policy_name');
								$policyUrl = get_sub_field('policy_url');
								if (!empty($policyName) && !empty($policyUrl)) {
							?>
									<li>
										<a href="<?php echo $policyUrl; ?>" target="_blank" title="<?php echo $policyName; ?>"><?php echo $policyName; ?></a>
									</li>
							<?php }
							endwhile; ?>
						</ul>
					</div>
				<?php endif; ?>
				<?php if (have_rows('vjbl_policies')) : ?>
					<div class="right-block">
						<?php if (!empty($vjblSectionTitle)) { ?>
							<div class="title-block">
								<h5 class="basketball-title"><?php echo $vjblSectionTitle; ?></h5>
							</div>
						<?php } ?>
						<ul>
							<?php while (have_rows('vjbl_policies')) : the_row();
								$policyName = get_sub_field('policy_name');
								$policyUrl = get_sub_field('policy_url');
								if (!empty($policyName) && !empty($policyUrl)) {
							?>
									<li>
										<a href="<?php echo $policyUrl; ?>" target="_blank" title="<?php echo $policyName; ?>"><?php echo $policyName; ?></a>
									</li>
							<?php }
							endwhile; ?>

						</ul>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
?>