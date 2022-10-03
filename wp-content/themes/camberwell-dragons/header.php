<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package camberwell-dragons
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="loader">
    <svg version="1.1" id="dc-spinner" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width:"38" height:"38" viewBox="0 0 38 38" preserveAspectRatio="xMinYMin meet">
        <text x="14" y="21" font-family="Monaco" font-size="2px" style="letter-spacing:0.6" fill="grey">
            <animate attributeName="opacity" values="0;1;0" dur="1.8s" repeatCount="indefinite" />
        </text>
        <path fill="transparent" d="M20,35c-8.271,0-15-6.729-15-15S11.729,5,20,5s15,6.729,15,15S28.271,35,20,35z M20,5.203
C11.841,5.203,5.203,11.841,5.203,20c0,8.159,6.638,14.797,14.797,14.797S34.797,28.159,34.797,20
C34.797,11.841,28.159,5.203,20,5.203z">
        </path>

        <path fill="transparent" d="M20,33.125c-7.237,0-13.125-5.888-13.125-13.125S12.763,6.875,20,6.875S33.125,12.763,33.125,20
S27.237,33.125,20,33.125z M20,7.078C12.875,7.078,7.078,12.875,7.078,20c0,7.125,5.797,12.922,12.922,12.922
S32.922,27.125,32.922,20C32.922,12.875,27.125,7.078,20,7.078z">
        </path>

        <path fill="#cd4b55" stroke="#cd4b55" stroke-width="0.6027" stroke-miterlimit="10" d="M5.203,20
c0-8.159,6.638-14.797,14.797-14.797V5C11.729,5,5,11.729,5,20s6.729,15,15,15v-0.203C11.841,34.797,5.203,28.159,5.203,20z">
            <animateTransform attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" calcMode="spline" keySplines="0.4, 0, 0.2, 1" keyTimes="0;1" dur="2s" repeatCount="indefinite" />
        </path>

        <path fill="#fff" stroke="#fff" stroke-width="0.2027" stroke-miterlimit="10" d="M7.078,20
c0-7.125,5.797-12.922,12.922-12.922V6.875C12.763,6.875,6.875,12.763,6.875,20S12.763,33.125,20,33.125v-0.203
C12.875,32.922,7.078,27.125,7.078,20z">
            <animateTransform attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="1.8s" repeatCount="indefinite" />
        </path>
    </svg>
</div>
    <?php wp_body_open();

    $mainSiteLogo = get_field('main_site_logo', 'option');
    $mainSiteMobileLogo = get_field('main_site_mobile_logo', 'option'); ?>
    <div class="wrapper">
        <?php
        $headerFixedClass = '';
        if (!is_front_page() && !is_404()) {
            $headerFixedClass = 'header-fixed';
        }
        ?>
        <header class="header <?php echo $headerFixedClass; ?>">
            <div class="container">
                <div class="header-wrap">
                    <a href="<?php echo bloginfo('url'); ?>" title="<?php echo bloginfo('name'); ?>" class="logo">
                        <?php if ($mainSiteLogo) { ?>
                            <img src="<?php echo $mainSiteLogo['url']; ?>" alt="<?php echo bloginfo('name'); ?>" class="desktop-logo">
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/public/images/header-logo.svg" alt="<?php echo bloginfo('name'); ?>" class="desktop-logo">
                        <?php } ?>
                        <?php if ($mainSiteMobileLogo) { ?>
                            <img src="<?php echo $mainSiteMobileLogo['url']; ?>" alt="<?php echo bloginfo('name'); ?>" class="mobile-logo">
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/public/images/footer-logo.svg" alt="<?php echo bloginfo('name'); ?>" class="mobile-logo">
                        <?php } ?>
                    </a>

                    <div class="header-menu-wrap">
                        <?php wp_nav_menu(
                            array(
                                'menu' => 'Header Menu',
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'primary-menu',
                                'container_class' => 'header-menu-list',
                                'walker' => new camberwell_Walker_Nav_Menu()
                            )
                        ); ?>
                        <ul class="search-icon">
                            <li class="menu-item search">
                                <a href="javascript:void(0);" title="Search" class="btn-search">
                                    <i><img src="<?php echo get_template_directory_uri(); ?>/public/images/search.svg" alt="search"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="search-block">
                            <form method="get" role="search" action="<?php echo home_url('/'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter your search" name="s" value="<?php echo get_search_query(); ?>">
                                    <input type="submit" class="btn search-btn" value="SEARCH" title="SEARCH">
                                </div>
                                <button type="button" class="btn close-btn" title="Close">
                                    <img src="<?php echo get_template_directory_uri(); ?>/public/images/close.svg" alt="Close icon">
                                </button>
                            </form>
                        </div>
                        <div class="hamburger" id="hamburger-1">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (is_singular('post') && !is_404()) { ?>
                <div class="title-block">
                    <h1 class="title"><?php echo _e('News', 'camberwell-dragons'); ?></h1>
                </div>
            <?php } elseif (is_singular('event') && !is_404()) { ?>
                <div class="title-block">
                    <h1 class="title"><?php echo _e('Events', 'camberwell-dragons'); ?></h1>
                </div>
            <?php }  elseif (is_search() && !is_404()) { ?>
                <div class="title-block">
                    <h1 class="title"><?php echo _e('Search Results', 'camberwell-dragons'); ?></h1>
                </div>
            <?php } elseif (!is_front_page() && !is_404()) { ?>
                <div class="title-block">
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>
            <?php } ?>
        </header>
      