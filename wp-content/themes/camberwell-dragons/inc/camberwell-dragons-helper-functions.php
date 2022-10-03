<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ad1holdings
 */

/**
 * Allow SVG file Upload in Media Uploader
 */
add_filter('upload_mimes', 'camberwell_dragons_allow_mime_types_upload');
if (!function_exists('camberwell_dragons_allow_mime_types_upload')) :
  function camberwell_dragons_allow_mime_types_upload($mimes)
  {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['ico'] = 'image/x-icon';
    return $mimes;
  }
endif;

/**
 * Creating Theme Option Page 
 */
if (function_exists('acf_add_options_page')) {
  acf_add_options_page('Theme Settings');
}

/**
 * Hide wordpress version 
 */
add_filter('the_generator', 'camberwell_remove_wordpress_version');
if (!function_exists('camberwell_remove_wordpress_version')) {
  function camberwell_remove_wordpress_version()
  {
    return '';
  }
}

/**
 * Custom admin login header logo
 */
add_action('login_enqueue_scripts', 'camberwell_change_admin_login_logo');
if (!function_exists('camberwell_change_admin_login_logo')) {
  function camberwell_change_admin_login_logo()
  {
?>
    <style type="text/css">
      body.login div#login h1 a {
        background-image: url(<?php echo get_template_directory_uri(); ?>/public/images/header-logo.svg);
        height: 5.3rem;
        width: 13.3rem;
        background-size: 13.3rem;
      }

      body.login {
        background: #0B0F18;
      }

      body.login div#login #nav a,
      body.login div#login #backtoblog a {
        color: #ffffff;
      }
    </style>
  <?php
  }
}

/**
 * Custom admin login URL
 */
add_filter('login_headerurl', 'camberwell_change_adminlogin_url');
if (!function_exists('camberwell_change_adminlogin_url')) {
  function camberwell_change_adminlogin_url()
  {
    return home_url();
  }
}

/**
 * Redirect event post page
 */
add_action('template_redirect', 'archive_to_custom_archive');
if (!function_exists('archive_to_custom_archive')) {
  function archive_to_custom_archive()
  {
    if (is_post_type_archive('event')) {
      wp_redirect(home_url('/events/'), 301);
      exit();
    }
  }
}


/**
 * Redirect program post page
 */
add_action('template_redirect', 'archive_program_to_custom_archive');
if (!function_exists('archive_program_to_custom_archive')) {
  function archive_program_to_custom_archive()
  {
    if (is_post_type_archive('program')) {
      wp_redirect(home_url('/programs/'), 301);
      exit();
    }
  }
}

/**
 * Redirect championship post page
 */
add_action('template_redirect', 'archive_championship_to_custom_archive');
if (!function_exists('archive_championship_to_custom_archive')) {
  function archive_championship_to_custom_archive()
  {
    if (is_post_type_archive('championship')) {
      wp_redirect(home_url('/championships/'), 301);
      exit();
    }
  }
}

/**
 * Add class for sub menu
 */
class camberwell_Walker_Nav_Menu extends Walker_Nav_Menu
{

  function start_lvl(&$output, $depth = 0, $args = array())
  {

    $indent = str_repeat("\t", $depth);

    $output .= "\n$indent<ul class=\"sub-menu-list\">\n";
  }
}

/**
 * Add event start date column in backend event listing post
 */
function add_custom_event_start_date_post_columns($columns)
{
  $columns['event_start_date'] = __('Event Start Date');

  return $columns;
}

function set_value_for_custom_event_start_date_post_column($column, $post_id)
{
  switch ($column) {

    case 'event_start_date':
      $eventStartDate = get_field('event_start_date', $post_id);
      if (!empty($eventStartDate)) {
        echo $eventStartDate;
      } else {
        echo '-';
      }
      break;
  }
}

add_filter('manage_event_posts_columns', 'add_custom_event_start_date_post_columns');
add_action('manage_event_posts_custom_column', 'set_value_for_custom_event_start_date_post_column', 10, 2);
/**
 * Adding 'active' class to li tag of primary-menu
 */
add_filter('nav_menu_css_class', 'camberwell_dragons_add_class_to_li_nav_menu', 10, 2);

function camberwell_dragons_add_class_to_li_nav_menu($classes, $item)
{
  if (in_array('has-submenu', $classes) && in_array('current-menu-parent', $classes) || in_array('current-menu-item', $classes)) {
    $classes[] = 'active ';
  }
  return $classes;
}

/**
 * Load more news posts on click of view more link
 */
add_action('wp_ajax_nopriv_load_more_news_post_ajax', 'camberwell_dragons_load_more_news_post_ajax');
add_action('wp_ajax_load_more_news_post_ajax', 'camberwell_dragons_load_more_news_post_ajax');
if (!function_exists('camberwell_dragons_load_more_news_post_ajax')) :
  function camberwell_dragons_load_more_news_post_ajax()
  {
    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 4;    // posts per page
    // $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 1;
    $offset = (isset($_POST['offset'])) ? $_POST['offset'] : 0;


    //Search post According to Year Selection
    if (isset($_POST['year_selected']) && !empty($_POST['year_selected'])) {
      $temp = sanitize_text_field(($_POST['year_selected']));
      $year_selected = intval($temp);
    } /* else {
    $year_selected = date('Y');
  } */

    //Search post According to month Selection
    if (isset($_POST['month_selected']) && !empty($_POST['month_selected'])) {
      $temp = sanitize_text_field(($_POST['month_selected']));
      $month_selected = date("m", strtotime($temp));
    }

    $date_query_array = array(
      'year' => $year_selected,
      'month' => $month_selected
    );

    header("Content-Type: text/html");

    $args = array(
      'suppress_filters' => true,
      'post_type' => 'post',
      'posts_per_page' => $ppp,
      // 'paged'    => $page,
      'offset'  => $offset,
      'date_query' => $date_query_array,
      'post_status' => 'publish'
    );

    $loop = new WP_Query($args);
    ob_start();
  ?>
    <div class="article-block-wrapper">
      <?php

      if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
          $newsPostId = get_the_ID();

          $newsDeskImage = get_field('four_column_news_listing_desktop_device_image', $newsPostId);
          $newsTabletImage = get_field('four_column_news_listing_tablet_device_image', $newsPostId);
          $newsMobileImage = get_field('four_column_news_listing_mobile_device_image', $newsPostId);
          $shareLinkLabel = get_field('share_link_label', $newsPostId);

          $subject = get_the_title($newsPostId);
          $body = get_the_permalink($newsPostId);
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

                  <?php if ($newsTabletImage) { ?>
                    <img src="<?php echo $newsTabletImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="tablet-img">
                  <?php } else { ?>
                    <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="tablet-img">
                  <?php } ?>

                  <?php if ($newsMobileImage) { ?>
                    <img src="<?php echo $newsMobileImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="mobile-img">
                  <?php } else { ?>
                    <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="mobile-img">
                  <?php } ?>
                </a>
              </i>
            </div>
            <div class="article-detail">
              <h4 class="white-border"><?php echo get_the_title($newsPostId); ?></h4>
              <!-- <span><?php echo get_the_date('d M Y', $newsPostId); ?></span> -->
              <span><?php echo get_the_date('D d M Y', $newsPostId); ?></span>
              <?php
              $excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $newsPostId));
              echo $excerpt;
              ?>
              <div class="article-btns">
                <a href="<?php echo get_the_permalink(); ?>" class="btn-white" title="<?php echo _e('View', 'camberwell-dragons') ?>">View</a>
                <?Php if ($shareLinkLabel && $shareLink) { ?>
                  <a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
                    <span><?php echo $shareLinkLabel; ?></span>
                    <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt=""></i>
                  </a>
                <?php } ?>
              </div>
            </div>
          </div>
      <?php
        endwhile;
      endif;
      ?>
    </div>
  <?php
    $html = ob_get_contents();
    ob_end_clean();
    wp_reset_postdata();
    echo $html;
    die();
  }
endif;

/**
 * Load more news posts on click of view more link
 */
add_action('wp_ajax_nopriv_load_more_events_post_ajax', 'camberwell_dragons_load_more_events_post_ajax');
add_action('wp_ajax_load_more_events_post_ajax', 'camberwell_dragons_load_more_events_post_ajax');
if (!function_exists('camberwell_dragons_load_more_events_post_ajax')) :
  function camberwell_dragons_load_more_events_post_ajax()
  {
    // $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 6;    // posts per page
    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;    // posts per page
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 1;
    $offset = (isset($_POST['offset'])) ? $_POST['offset'] : 0;


    //Search post According to Year Selection
    if (isset($_POST['year_selected']) && is_numeric($_POST['year_selected'])) {
      $temp = sanitize_text_field(($_POST['year_selected']));
      $year_selected = intval($temp);
    } else {
      $year_selected = date('Y');
    }

    //Search post According to month Selection
    if (isset($_POST['month_selected']) && !empty($_POST['month_selected'])) {
      $temp = sanitize_text_field(($_POST['month_selected']));
      $month_selected = date("m", strtotime($temp));
    }

    header("Content-Type: text/html");

    $args = array(
      'post_type' => 'event',
      'posts_per_page' => $ppp,
      'post_status' => 'publish',
      // 'paged' => $page,
      'offset'  => $offset,
      'order' => 'ASC',
      'orderby' => 'meta_value',
    );

    if ((isset($_POST['month_selected']) && empty($_POST['month_selected'])) &&  isset($_POST['year_selected']) && empty($_POST['year_selected'])) {
      $current_month_start_date = date("Y-m-d", strtotime(date('m') . '/01/' . date('Y')));
      $current_month_end_date = date("Y-m-d", strtotime(date('m') . '/31/' . date('Y')));

      $args['meta_query'] = array( // WordPress has all the results, now, return only the events after today's date
        'relation' => 'AND',
        array(
          'key' => 'event_start_date',
          'value' => date("Y-m-d"), // Set today's date (note the similar format)
          'compare' => '>=', // Return the ones greater than today's date
          'type' => 'DATE' // Let WordPress know we're working with date
        ),
        array(
          'key' => 'event_start_date',
          'value' => array($current_month_start_date, $current_month_end_date),
          'compare' => 'BETWEEN',
          'type' => 'DATE',
        ),
      );
    } else {
      $args['meta_query'] = array(
        'relation' => 'AND',
        array(
          'key' => 'event_start_date',
          'value' => $year_selected . $month_selected . '01',
          'compare' => '>=',
        ),
        array(
          'key' => 'event_start_date',
          'value' => $year_selected . $month_selected . '31',
          'compare' => '<=',
        ),
      );
    }

    $loop = new WP_Query($args);
    ob_start();
  ?>
    <div class="article-block-wrapper">
      <?php

      if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
          $eventPostId = get_the_ID();

          $eventDeskImage = get_field('event_section_desktop_device_image', $eventPostId);
          $eventTabletImage = get_field('event_section_tablet_device_image', $eventPostId);
          $eventMobileImage = get_field('event_section_mobile_device_image', $eventPostId);

          $eventStartDate = get_field('event_start_date', $eventPostId);
          $shareLinkLabel = get_field('share_link_label', $eventPostId);
          $eventTime = get_field('event_time', $eventPostId);
          $eventLocation = get_field('event_location', $eventPostId);
      ?>
          <div class="article-block">
            <div class="image-block">
              <i>
                <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                  <?php if ($eventDeskImage) { ?>
                    <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="desktop-img">
                  <?php } ?>

                  <?php if ($eventTabletImage) { ?>
                    <img src="<?php echo $eventTabletImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="tablet-img">
                  <?php } else { ?>
                    <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="tablet-img">
                  <?php } ?>

                  <?php if ($eventMobileImage) { ?>
                    <img src="<?php echo $eventMobileImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="mobile-img">
                  <?php } else { ?>
                    <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="mobile-img">
                  <?php } ?>
                </a>
              </i>
            </div>
            <div class="article-detail">
              <h4 class="white-border secondary-title"><?php echo get_the_title(); ?></h4>

              <?php if ($eventStartDate) { ?>
                <span><?php echo $eventStartDate; ?></span>
              <?php } ?>

              <?php
              $excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $eventPostId));
              echo $excerpt;
              ?>

              <div class="article-btns">
                <a href="<?php echo get_the_permalink(); ?>" class="btn-white" title="<?php echo _e('view', 'camberwell-dragons') ?>"><?php echo _e('View', 'camberwell-dragons') ?></a>
                <?php
                $subject = get_the_title($eventPostId);
                $body = get_the_permalink($eventPostId);
                $mailto = '';
                $shareLink = "mailto:$mailto?subject=$subject&body=$body";

                if ($shareLinkLabel && $shareLink) { ?>
                  <a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
                    <span><?php echo $shareLinkLabel; ?></span>
                    <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt=""></i>
                  </a>
                <?php } ?>

                <a href="javascript:void(0);" class="share-btn add-to-cal" title="<?php echo _e('Add', 'camberwell-dragons') ?>" data-title="<?php echo get_the_title(); ?>" data-date="<?php echo $eventStartDate; ?>" data-time="<?php echo $eventTime; ?>" data-location="<?php echo $eventLocation; ?>" data-excerpt="<?php echo get_the_excerpt(); ?>">
                  <span><?php echo _e('Add', 'camberwell-dragons') ?></span>
                  <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/plus.svg" alt=""></i>
                </a>
                <div class="add-to-calendar-btn-wrap"></div>
              </div>
            </div>
          </div>
      <?php
        endwhile;
      endif;
      ?>
    </div>
  <?php
    $html = ob_get_contents();
    ob_end_clean();
    wp_reset_postdata();
    echo $html;
    die();
  }
endif;

/**
 * Load more and Filter announcement posts by year 
 */
add_action('wp_ajax_nopriv_load_more_other_news_post_for_detail_page', 'camberwell_dragons_load_more_other_news_post_for_detail_page');
add_action('wp_ajax_load_more_other_news_post_for_detail_page', 'camberwell_dragons_load_more_other_news_post_for_detail_page');
if (!function_exists('camberwell_dragons_load_more_other_news_post_for_detail_page')) :
  function camberwell_dragons_load_more_other_news_post_for_detail_page()
  {
    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 4;    // posts per page
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 2;
    $exclude_post_id = $_POST['exclude_post_id'];

    header("Content-Type: text/html");

    $args = array(
      'suppress_filters' => true,
      'post_type' => 'post',
      'posts_per_page' => $ppp,
      'paged'    => $page,
      'post_status' => 'publish',
      'post__not_in' => [$exclude_post_id]
    );

    $loop = new WP_Query($args);
    ob_start();
  ?>
    <div class="article-block-wrapper">
      <?php

      if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
          $newsPostId = get_the_ID();

          $newsDeskImage = get_field('four_column_news_listing_desktop_device_image', $newsPostId);
          $newsTabletImage = get_field('four_column_news_listing_tablet_device_image', $newsPostId);
          $newsMobileImage = get_field('four_column_news_listing_mobile_device_image', $newsPostId);
          $shareLinkLabel = get_field('share_link_label', $newsPostId);

          $subject = get_the_title($newsPostId);
          $body = get_the_permalink($newsPostId);
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

                  <?php if ($newsTabletImage) { ?>
                    <img src="<?php echo $newsTabletImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="tablet-img">
                  <?php } else { ?>
                    <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="tablet-img">
                  <?php } ?>

                  <?php if ($newsMobileImage) { ?>
                    <img src="<?php echo $newsMobileImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="mobile-img">
                  <?php } else { ?>
                    <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="mobile-img">
                  <?php } ?>
                </a>
              </i>
            </div>
            <div class="article-detail">
              <h4 class="white-border"><?php echo get_the_title($newsPostId); ?></h4>
              <!-- <span><?php echo get_the_date('d M Y', $newsPostId); ?></span> -->
              <span><?php echo get_the_date('D d M Y', $newsPostId); ?></span>
              <?php
              $excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $newsPostId));
              echo $excerpt;
              ?>
              <div class="article-btns">
                <a href="<?php echo get_the_permalink(); ?>" class="btn-white" title="<?php echo _e('View', 'camberwell-dragons') ?>">View</a>
                <?Php if ($shareLinkLabel && $shareLink) { ?>
                  <a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
                    <span><?php echo $shareLinkLabel; ?></span>
                    <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt=""></i>
                  </a>
                <?php } ?>
              </div>
            </div>
          </div>
      <?php
        endwhile;
      endif;
      ?>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    wp_reset_postdata();
    echo $html;
    die();
  }
endif;

/**
 * Filter news posts by month and year
 */
add_action('wp_ajax_nopriv_filter_news_post', 'camberwell_dragons_filter_news_post');
add_action('wp_ajax_filter_news_post', 'camberwell_dragons_filter_news_post');
if (!function_exists('camberwell_dragons_filter_news_post')) :
  function camberwell_dragons_filter_news_post()
  {
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 1;

    //Search post According to Year Selection
    if (isset($_POST['year_selected'])) {
      $temp = sanitize_text_field(($_POST['year_selected']));
      $year_selected = intval($temp);
    } else {
      $year_selected = date('Y');
    }

    //Search post According to month Selection
    if (isset($_POST['month_selected']) && !empty($_POST['month_selected'])) {
      $temp = sanitize_text_field(($_POST['month_selected']));
      $month_selected = date("m", strtotime($temp));
    }

    $date_query_array = array(
      'year' => $year_selected,
      'month' => $month_selected
    );

    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 3,
      'date_query' => $date_query_array,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish'
    );

    $sliderNewsPost = new WP_Query($args);
    ob_start();

    $do_not_duplicate_arr = [];

    if ($sliderNewsPost->have_posts()) : while ($sliderNewsPost->have_posts()) : $sliderNewsPost->the_post();
        $newsPostId = get_the_ID();
        $do_not_duplicate_arr[] = $newsPostId;

        $sliderDeskImage = get_field('news_slider_desktop_device_image', $newsPostId);
        $sliderTabletImage = get_field('news_slider_tablet_device_image', $newsPostId);
        $sliderMobileImage = get_field('news_slider_mobile_device_image', $newsPostId);

        $sliderSectionDescription = get_field('news_slider_section_description', $newsPostId);
        $shareLinkLabel = get_field('share_link_label', $newsPostId);

        $subject = get_the_title($newsPostId);
        $body = get_the_permalink($newsPostId);
        $mailto = '';
        $shareLink = "mailto:$mailto?subject=$subject&body=$body";

    ?>
        <div class="banner-img">
          <?php if ($sliderDeskImage) { ?>
            <div class="desktop-img bg-image" style="background-image: url(<?php echo $sliderDeskImage['url']; ?>)"></div>
          <?php } ?>

          <?php if ($sliderTabletImage) { ?>
            <div class="tablet-img bg-image" style="background-image: url(<?php echo $sliderTabletImage['url']; ?>)"></div>
          <?php } else { ?>
            <div class="tablet-img bg-image" style="background-image: url(<?php echo $sliderDeskImage['url']; ?>)"></div>
          <?php } ?>

          <?php if ($sliderMobileImage) { ?>
            <img class="mobile-img" src="<?php echo $sliderMobileImage['url']; ?>" alt="<?php echo get_the_title(); ?>">
          <?php } else { ?>
            <img class="mobile-img" src="<?php echo $sliderDeskImage['url']; ?>" alt="<?php echo get_the_title(); ?>">
          <?php } ?>

          <div class="container container-small">
            <div class="news-article-block">
              <div class="content-wrap">
                <h2><?php echo get_the_title($newsPostId); ?></h2>
                <!-- <p class="news-date"><?php echo get_the_date('l d M Y', $newsPostId) ?></p> -->
                <p class="news-date"><?php echo get_the_date('D d M Y', $newsPostId) ?></p>
                <?php if ($sliderSectionDescription) { ?>
                  <div class="content-block">
                    <?php echo $sliderSectionDescription; ?>
                  </div>
                <?php } ?>
                <div class="view-and-share">
                  <a href="<?php the_permalink(); ?>" class="btn-white" title="<?php echo _e('View', 'camberwell-dragons') ?>">View</a>
                  <?Php if ($shareLinkLabel && $shareLink) { ?>
                    <a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
                      <span><?php echo $shareLinkLabel; ?></span>
                      <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt=""></i>
                    </a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      endwhile;
    endif;
    $sliderSectionHtml = ob_get_clean();
    // ob_end_clean();

    wp_reset_query();
    wp_reset_postdata();

    $postsPerPage = 5;
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => $postsPerPage,
      'date_query' => $date_query_array,
      'paged' => $page,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish'
    );

    $twoColumnNewsPosts = new WP_Query($args);

    ob_start();

    $do_not_duplicate_again_arr = [];

    if ($twoColumnNewsPosts->have_posts()) :
      while ($twoColumnNewsPosts->have_posts()) : $twoColumnNewsPosts->the_post();
        $postId = get_the_ID();

        $do_not_duplicate_again_arr[] = $postId;
        if (in_array($postId, $do_not_duplicate_arr)) continue;   // skip the first id of news post

        $newsDeskImage = get_field('two_column_news_listing_desktop_device_image', $postId);
        $newsTabletImage = get_field('two_column_news_listing_tablet_device_image', $postId);
        $newsMobileImage = get_field('two_column_news_listing_mobile_device_image', $postId);

        $shareLinkLabel = get_field('share_link_label', $postId);

      ?>
        <div class="article-block">
          <div class="image-block">
            <i>
              <a href="<?php echo get_the_permalink($postId); ?>" title="<?Php echo get_the_title($postId); ?>">
                <?php if ($newsDeskImage) { ?>
                  <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="desktop-img">
                <?php } ?>

                <?php if ($newsTabletImage) { ?>
                  <img src="<?php echo $newsTabletImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="tablet-img">
                <?php } else { ?>
                  <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="tablet-img">
                <?php } ?>

                <?php if ($newsMobileImage) { ?>
                  <img src="<?php echo $newsMobileImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="mobile-img">
                <?php } else { ?>
                  <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="mobile-img">
                <?php } ?>
              </a>
            </i>
          </div>
          <div class="article-detail">
            <h4 class="white-border"><?php echo get_the_title($postId); ?></h4>
            <!-- <span><?php echo get_the_date('l d M Y', $postId); ?></span> -->
            <span><?php echo get_the_date('D d M Y', $postId); ?></span>
            <?php
            $excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $postId));
            echo $excerpt;
            ?>
            <div class="article-btns">
              <a href="<?php echo get_the_permalink(); ?>" class="btn-white" title="<?php echo _e('View', 'camberwell-dragons') ?>">View</a>
              <?Php if ($shareLinkLabel && $shareLink) { ?>
                <a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
                  <span><?php echo $shareLinkLabel; ?></span>
                  <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt=""></i>
                </a>
              <?php } ?>

            </div>
          </div>
        </div>
      <?php
      endwhile;
    endif;
    $twoColumnSectionHtml = ob_get_clean();
    // ob_end_clean();    
    wp_reset_query();
    wp_reset_postdata();

    $postsPerPage = 9;
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => $postsPerPage,
      'date_query' => $date_query_array,
      'paged' => $page,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish'
    );

    $fourColumnNewsPosts = new WP_Query($args);
    ob_start();

    if ($fourColumnNewsPosts->have_posts()) :
      while ($fourColumnNewsPosts->have_posts()) : $fourColumnNewsPosts->the_post();
        $postId = get_the_ID();

        if (in_array($postId, $do_not_duplicate_again_arr)) continue;   // skip the ids of news post

        $newsDeskImage = get_field('four_column_news_listing_desktop_device_image', $postId);
        $newsTabletImage = get_field('four_column_news_listing_tablet_device_image', $postId);
        $newsMobileImage = get_field('four_column_news_listing_mobile_device_image', $postId);

        $shareLinkLabel = get_field('share_link_label', $postId);

      ?>
        <div class="article-block">
          <div class="image-block">
            <i>
              <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                <?php if ($newsDeskImage) { ?>
                  <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="desktop-img">
                <?php } ?>

                <?php if ($newsTabletImage) { ?>
                  <img src="<?php echo $newsTabletImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="tablet-img">
                <?php } else { ?>
                  <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="tablet-img">
                <?php } ?>

                <?php if ($newsMobileImage) { ?>
                  <img src="<?php echo $newsMobileImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="mobile-img">
                <?php } else { ?>
                  <img src="<?php echo $newsDeskImage['url']; ?>" alt="<?Php echo _e('News Image', 'camberwell-dragons'); ?>" class="mobile-img">
                <?php } ?>
              </a>
            </i>

          </div>
          <div class="article-detail">
            <h4 class="white-border"><?php echo get_the_title($postId); ?></h4>
            <!-- <span><?php echo get_the_date('d M Y', $postId); ?></span> -->
            <span><?php echo get_the_date('D d M Y', $postId); ?></span>
            <?php
            $excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $postId));
            echo $excerpt;
            ?>
            <div class="article-btns">
              <a href="<?php echo get_the_permalink(); ?>" class="btn-white" title="<?php echo _e('View', 'camberwell-dragons') ?>">View</a>
              <?Php if ($shareLinkLabel && $shareLink) { ?>
                <a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
                  <span><?php echo $shareLinkLabel; ?></span>
                  <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt=""></i>
                </a>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php
      endwhile;
    endif;
    $fourColumnSectionHtml = ob_get_clean();

    // ob_end_clean();
    wp_reset_query();
    wp_reset_postdata();

    $args = array(
      'post_type' => 'post',
      'posts_per_page' => -1,
      'date_query' => $date_query_array,
      'paged' => $page,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish'
    );

    $allNewsPost = new WP_Query($args);
    $totalNewsPosts = $allNewsPost->post_count;

    $viewMoreBtn = false;
    if ($totalNewsPosts > $postsPerPage) {
      $viewMoreBtn = true;
    }
    wp_reset_query();
    wp_reset_postdata();

    echo json_encode(['sliderSectionHtml' => $sliderSectionHtml, 'twoColumnSectionHtml' => $twoColumnSectionHtml, 'fourColumnSectionHtml' => $fourColumnSectionHtml, 'viewMoreBtn' => $viewMoreBtn, 'totalNewsPosts' => $totalNewsPosts, 'foundPosts' => $fourColumnNewsPosts->post_count]);

    die;
  }
endif;

/**
 * Filter events posts by month and year
 */
add_action('wp_ajax_nopriv_filter_events_post', 'camberwell_dragons_filter_events_post');
add_action('wp_ajax_filter_events_post', 'camberwell_dragons_filter_events_post');
if (!function_exists('camberwell_dragons_filter_events_post')) :
  function camberwell_dragons_filter_events_post()
  {
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 1;

    //Search post According to Year Selection
    if (isset($_POST['year_selected']) && is_numeric($_POST['year_selected'])) {
      $temp = sanitize_text_field(($_POST['year_selected']));
      $year_selected = intval($temp);
    } else {
      $year_selected = date('Y');
    }

    //Search post According to month Selection
    if (isset($_POST['month_selected']) && !empty($_POST['month_selected'])) {
      $temp = sanitize_text_field(($_POST['month_selected']));
      $month_selected = date("m", strtotime($temp));
    }

    $postsPerPage = 3;
    /** Get events of selected month and year */
    $args = array(
      'post_type' => 'event',
      'posts_per_page' => $postsPerPage,
      'post_status' => 'publish',
      'order' => 'ASC',
      'paged' => $page,
      'orderby' => 'meta_value',
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key' => 'event_start_date',
          'value' => $year_selected . $month_selected . '01',
          'compare' => '>=',
        ),
        array(
          'key' => 'event_start_date',
          'value' => $year_selected . $month_selected . '31',
          'compare' => '<=',
        ),
      ),
    );

    $sliderEventsPost = new WP_Query($args);
    ob_start();

    $do_not_duplicate_arr = [];

    if ($sliderEventsPost->have_posts()) : while ($sliderEventsPost->have_posts()) : $sliderEventsPost->the_post();
        $eventPostId = get_the_ID();
        $do_not_duplicate_arr[] = $eventPostId;

        $sliderDeskImage = get_field('slider_section_desktop_device_image', $eventPostId);
        $sliderTabletImage = get_field('slider_section_tablet_device_image', $eventPostId);
        $sliderMobileImage = get_field('slider_section_mobile_device_image', $eventPostId);

        $sliderSectionDescription = get_field('slider_section_description', $eventPostId);
        $shareLinkLabel = get_field('share_link_label', $eventPostId);
        $eventStartDate = get_field('event_start_date', $eventPostId);
        $eventTime = get_field('event_time', $eventPostId);
        $eventLocation = get_field('event_location', $eventPostId);

      ?>
        <div class="slide-item">
          <div class="event-wrapper">
            <div class="event-img-block" style="background-image: url(<?php echo $sliderDeskImage['url']; ?>)">
              <div class="feature-event-block">
                <h2 class="block-title primary-title"><?php echo get_the_title(); ?></h2>

                <?php if ($eventStartDate) { ?>
                  <p class="date"><?php echo $eventStartDate; ?></p>
                <?php } ?>

                <?php if (!empty($sliderSectionDescription)) {
                  echo $sliderSectionDescription;
                } ?>

                <div class="view-and-share">

                  <a href="<?php echo get_the_permalink(); ?>" class="btn-white" title="<?php echo _e('view', 'camberwell-dragons') ?>"><?php echo _e('View', 'camberwell-dragons') ?></a>

                  <?php
                  $subject = get_the_title($eventPostId);
                  $body = get_the_permalink($eventPostId);
                  $mailto = '';
                  $shareLink = "mailto:$mailto?subject=$subject&body=$body";

                  if ($shareLinkLabel && $shareLink) { ?>
                    <a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
                      <span><?php echo $shareLinkLabel; ?></span>
                      <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt=""></i>
                    </a>
                  <?php } ?>

                  <a href="javascript:void(0);" class="share-btn add-to-cal" title="<?php echo _e('Add', 'camberwell-dragons') ?>" data-title="<?php echo get_the_title(); ?>" data-date="<?php echo $eventStartDate; ?>" data-time="<?php echo $eventTime; ?>" data-location="<?php echo $eventLocation; ?>" data-excerpt="<?php echo get_the_excerpt(); ?>">
                    <span><?php echo _e('Add', 'camberwell-dragons') ?></span>
                    <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/plus.svg" alt=""></i>
                  </a>
                  <div class="add-to-calendar-btn-wrap"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      endwhile;
    endif;
    $sliderSectionHtml = ob_get_clean();

    wp_reset_query();
    wp_reset_postdata();

    $postsPerPage = 6;
    /** Get events of selected month and year */
    $args = array(
      'post_type' => 'event',
      'posts_per_page' => $postsPerPage,
      'post_status' => 'publish',
      'order' => 'ASC',
      'paged' => $page,
      'orderby' => 'meta_value',
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key' => 'event_start_date',
          'value' => $year_selected . $month_selected . '01',
          'compare' => '>=',
        ),
        array(
          'key' => 'event_start_date',
          'value' => $year_selected . $month_selected . '31',
          'compare' => '<=',
        ),
      ),
    );

    $eventPosts = new WP_Query($args);
    ob_start();

    if ($eventPosts->have_posts()) : while ($eventPosts->have_posts()) : $eventPosts->the_post();
        $eventPostId = get_the_ID();

        if (in_array($eventPostId, $do_not_duplicate_arr)) continue;   // skip the first three ids of news post

        $eventDeskImage = get_field('event_section_desktop_device_image', $eventPostId);
        $eventTabletImage = get_field('event_section_tablet_device_image', $eventPostId);
        $eventMobileImage = get_field('event_section_mobile_device_image', $eventPostId);

        $eventStartDate = get_field('event_start_date', $eventPostId);
        $shareLinkLabel = get_field('share_link_label', $eventPostId);
        $eventTime = get_field('event_time', $eventPostId);
        $eventLocation = get_field('event_location', $eventPostId);

      ?>
        <div class="article-block">
          <div class="image-block">
            <i>
              <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                <?php if ($eventDeskImage) { ?>
                  <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="desktop-img">
                <?php } ?>

                <?php if ($eventTabletImage) { ?>
                  <img src="<?php echo $eventTabletImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="tablet-img">
                <?php } else { ?>
                  <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="tablet-img">
                <?php } ?>

                <?php if ($eventMobileImage) { ?>
                  <img src="<?php echo $eventMobileImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="mobile-img">
                <?php } else { ?>
                  <img src="<?php echo $eventDeskImage['url']; ?>" alt="<?php echo _e('Event', 'camberwell-dragon'); ?>" class="mobile-img">
                <?php } ?>
              </a>
            </i>
          </div>
          <div class="article-detail">
            <h4 class="white-border secondary-title"><?php echo get_the_title(); ?></h4>

            <?php if ($eventStartDate) { ?>
              <span><?php echo $eventStartDate; ?></span>
            <?php } ?>

            <?php
            $excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $eventPostId));
            echo $excerpt;
            ?>

            <div class="article-btns">
              <a href="<?php echo get_the_permalink(); ?>" class="btn-white" title="<?php echo _e('view', 'camberwell-dragons') ?>"><?php echo _e('View', 'camberwell-dragons') ?></a>
              <?php
              $subject = get_the_title($eventPostId);
              $body = get_the_permalink($eventPostId);
              $mailto = '';
              $shareLink = "mailto:$mailto?subject=$subject&body=$body";

              if ($shareLinkLabel && $shareLink) { ?>
                <a href="<?php echo $shareLink; ?>" class="share-btn" title="<?php echo $shareLinkLabel; ?>">
                  <span><?php echo $shareLinkLabel; ?></span>
                  <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/share.svg" alt=""></i>
                </a>
              <?php } ?>

              <a href="javascript:void(0);" class="share-btn add-to-cal" title="<?php echo _e('Add', 'camberwell-dragons') ?>" data-title="<?php echo get_the_title(); ?>" data-date="<?php echo $eventStartDate; ?>" data-time="<?php echo $eventTime; ?>" data-location="<?php echo $eventLocation; ?>" data-excerpt="<?php echo get_the_excerpt(); ?>">
                <span><?php echo _e('Add', 'camberwell-dragons') ?></span>
                <i class="share-link"><img src="<?php echo get_template_directory_uri(); ?>/public/images/plus.svg" alt=""></i>
              </a>
              <div class="add-to-calendar-btn-wrap"></div>
            </div>
          </div>
        </div>
<?php
      endwhile;
    endif;
    $threeColumnSectionHtml = ob_get_clean();

    wp_reset_query();
    wp_reset_postdata();

    /** Get all events of selected month and year */
    $args = array(
      'post_type' => 'event',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'order' => 'ASC',
      'orderby' => 'meta_value',
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key' => 'event_start_date',
          'value' => $year_selected . $month_selected . '01',
          'compare' => '>=',
        ),
        array(
          'key' => 'event_start_date',
          'value' => $year_selected . $month_selected . '31',
          'compare' => '<=',
        ),
      ),
    );

    $allEventPosts = new WP_Query($args);
    $totalNewsPosts = $allEventPosts->post_count;

    $viewMoreBtn = false;
    if ($totalNewsPosts > $postsPerPage) {
      $viewMoreBtn = true;
    }
    wp_reset_query();
    wp_reset_postdata();

    echo json_encode(['sliderSectionHtml' => $sliderSectionHtml, 'threeColumnSectionHtml' => $threeColumnSectionHtml, 'viewMoreBtn' => $viewMoreBtn, 'totalNewsPosts' => $totalNewsPosts, 'foundPosts' => $eventPosts->post_count]);

    die;
  }
endif;

/**
 * Detect device for displaying different posts per page for all devices
 */
function camberwell_dragon_detect_device()
{
  $tablet_browser = 0;
  $mobile_browser = 0;

  if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $tablet_browser++;
  }

  if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
  }

  if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
  }

  $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
  $mobile_agents = array(
    'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
    'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
    'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
    'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
    'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
    'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
    'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
    'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
    'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'
  );

  if (in_array($mobile_ua, $mobile_agents)) {
    $mobile_browser++;
  }

  if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
    $mobile_browser++;
    //Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
      $tablet_browser++;
    }
  }

  if ($tablet_browser > 0) {
    return 'tablet';
  } else if ($mobile_browser > 0) {
    return 'mobile';
  } else {
    return 'desktop';
  }
}
