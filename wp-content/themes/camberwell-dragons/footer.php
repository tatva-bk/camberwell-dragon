<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package camberwell-dragons
 */

?>
<?php

$footerLogo = get_field('footer_logo', 'option');
$copyrightText = get_field('copyright_text', 'option');
$contactVjblHeading = get_field('contact_vjbl_heading', 'option');
$contactVjblDetails = get_field('contact_vjbl_details', 'option');
$contactVjblPerson = get_field('contact_vjbl_person', 'option');
$contactBijvHeading = get_field('contact_bijv_heading', 'option');
$contactBijvDetails = get_field('contact_bijv_details', 'option');
$contactBijvPerson = get_field('contact_bijv_person', 'option');
$contactSecretaryHeading = get_field('contact_secretary_heading', 'option');
$contactSecretaryDetails = get_field('contact_secretary_details', 'option');
$contactSecretaryPerson = get_field('contact_secretary_person', 'option');
$contactTreasurerHeading = get_field('contact_treasurer_heading', 'option');
$contactTreasurerDetails = get_field('contact_treasurer_details', 'option');
$contactTreasurerPerson = get_field('contact_treasurer_person', 'option');

?>
</div>
  <footer class="footer">
        <div class="container">
            <div class="footer-wrap">
                <div class="image-block">
                    <a href="<?php echo site_url(); ?>" title="Logo">
                        <img src="<?php echo $footerLogo['url']; ?>" alt="Footer logo">
                    </a>
                </div>
                <div class="quick-links-block">
                    <div class="primary-title block-title">Quick links</div>
                    <?php
						wp_nav_menu(
							array(
								'menu' => 'Footer Menu',
								'menu_id' => 'footer-menu',
                                'theme_location' => 'footer_menu',
                                'menu_class' => 'quick-link-list',
							)
						);
						?>
                </div>
                <div class="contact-block">
                    <div class="primary-title block-title">CONTACT US</div>
                    <div class="contact-wrapper">
                        <?php if(!empty($contactVjblHeading) || !empty($contactBijvHeading)) { ?>
                        <div class="left-block">
                            <div class="vjbl-block">
                                <?php if(!empty($contactVjblHeading)) { ?>
                                <p class="contact-title"><?php echo $contactVjblHeading; ?></p>
                                <?php } ?>
                                <?php if(!empty($contactVjblPerson)) { ?>
                                <p class="contact-person"><?php echo $contactVjblPerson; ?></p>
                                <?php } ?>
                                <?php if(!empty($contactVjblDetails)) { ?>
                                <a href="mailto:<?php echo $contactVjblDetails; ?>" class="contact-mail" title="<?php echo $contactVjblDetails; ?>"><?php echo $contactVjblDetails; ?></a>
                                <?php } ?>
                            </div>
                            <div class="bigv-block">
                                <?php if(!empty($contactBijvHeading)) { ?>
                                <p class="contact-title"><?php echo $contactBijvHeading; ?></p>
                                <?php } ?>
                                <?php if(!empty($contactBijvPerson)) { ?>
                                <p class="contact-person"><?php echo $contactBijvPerson; ?></p>
                                <?php } ?>
                                <?php if(!empty($contactBijvDetails)) { ?>
                                <a href="mailto:<?php echo $contactBijvDetails; ?>" class="contact-mail" title="<?php echo $contactBijvDetails; ?>"><?php echo $contactBijvDetails; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="right-block">
                            <div class="secretary-block">
                                <?php if(!empty($contactSecretaryHeading)) { ?>
                                <p class="contact-title"><?php echo $contactSecretaryHeading; ?></p>
                                <?php } ?>
                                <?php if(!empty($contactSecretaryPerson)) { ?>
                                <p class="contact-person"><?php echo $contactSecretaryPerson; ?></p>
                                <?php } ?>
                                <?php if(!empty($contactSecretaryDetails)) { ?>
                                <a href="mailto:<?php echo $contactSecretaryDetails; ?>" class="contact-mail" title="<?php echo $contactSecretaryDetails; ?>"><?php echo $contactSecretaryDetails; ?></a>
                                <?php } ?>
                            </div>
                            <div class="treasurer-block">
                                <?php if(!empty($contactTreasurerHeading)) { ?>
                                <p class="contact-title"><?php echo $contactTreasurerHeading; ?></p>
                                <?php } ?>
                                <?php if(!empty($contactTreasurerPerson)) { ?>
                                <p class="contact-person"><?php echo $contactTreasurerPerson; ?></p>
                                <?php } ?>
                                <?php if(!empty($contactTreasurerDetails)) { ?>
                                <a href="mailto:<?php echo $contactTreasurerDetails; ?>" class="contact-mail" title="<?php echo $contactTreasurerDetails; ?>"><?php echo $contactTreasurerDetails; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="follow-block">
                    <div class="social-icons-block">
                        <div class="primary-title block-title">FOLLOW US</div>
                        <?php if (have_rows('social_links', 'option')): ?>
                            <div class="social-icon-wrapper">
                                <ul class="social-container">
                                    <?php
                                    while (have_rows('social_links', 'option')): the_row();
                                        $image = get_sub_field('social_icon', 'option');
                                        $socialLink = get_sub_field('socail_link', 'option');
                                        ?>
                                        <li>
                                            <a target="_blank" href="<?php echo $socialLink; ?>" title="<?php echo $image['title']; ?>">
                                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="normal">								
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="copyright-block">
                        <?php if(!empty($copyrightText)) {?><p><?php echo $copyrightText; ?></p><?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>