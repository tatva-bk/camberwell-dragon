<?php
/* Template Name: News Template */

get_header();

$bgBannerDeskImage = get_field('background_banner_desktop_image', $post->ID);
$bgBannerTabletImage = get_field('background_banner_tablet_image', $post->ID);
$bgBannerMobileImage = get_field('background_banner_mobile_image', $post->ID);
$newsPageDescription = get_field('news_page_description', $post->ID);

?>
<main class="main-wrap fixed-main-wrap">
    <section class="news-banner-section">
        <div class="container container-small">
            <div class="month-year">
                <dl id='countries' class="dropdown month">
                    <dt>
                        <a href="javascript:void(0);"><span>Month</span></a>
                    </dt>
                    <dd>
                        <ul>
                            <li class="top-arrow arrow disabled" start-value='1' end-value='7'>
                                <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/public/images/right-arrow.svg" alt=""></a>
                            </li>
                            <li value="1"><a href="javascript:void(0);">January</a></li>
                            <li value="2"><a href="javascript:void(0);">February</a></li>
                            <li value="3"><a href="javascript:void(0);">March</a></li>
                            <li value="4" class="active"><a href="javascript:void(0);">April</a></li>
                            <li value="5"><a href="javascript:void(0);">May</a></li>
                            <li value="6"><a href="javascript:void(0);">June</a></li>
                            <li value="7"><a href="javascript:void(0);">July</a></li>
                            <li value="8" style="display: none;"><a href="javascript:void(0);">August</a></li>
                            <li value="9" style="display: none;"><a href="javascript:void(0);">September</a></li>
                            <li value="10" style="display: none;"><a href="javascript:void(0);">October</a></li>
                            <li value="11" style="display: none;"><a href="javascript:void(0);">November</a></li>
                            <li value="12" style="display: none;"><a href="javascript:void(0);">December</a></li>

                            <li class="bottom-arrow arrow" start-value='1' end-value='7'>
                                <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/public/images/right-arrow.svg" alt=""></a>
                            </li>
                        </ul>
                    </dd>
                </dl>
                <dl id='countries' class="dropdown year">
                    <dt>
                        <a href="javascript:void(0)"><span>Year</span></a>
                    </dt>
                    <dd>
                        <ul>
                            <li class="top-arrow arrow">
                                <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/public/images/right-arrow.svg" alt=""></a>
                            </li>
                            <li class="bottom-arrow arrow disabled">
                                <a href="javascript:void(0);"><img src="<?php echo get_template_directory_uri(); ?>/public/images/right-arrow.svg" alt=""></a>
                            </li>
                        </ul>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="news-slider">
            <?php
            $count_posts = wp_count_posts();
            $totalPosts = $count_posts->publish;

            $postsPerPage = 3;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $postsPerPage,
                'post_status' => 'publish'
            );

            $newsPosts = new WP_Query($args);


            $do_not_duplicate_arr = [];

            if ($newsPosts->have_posts()) : while ($newsPosts->have_posts()) : $newsPosts->the_post();
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
            wp_reset_query();
            wp_reset_postdata();
            ?>
        </div>
    </section>
    <section class="article-section inner-article two-articles-section">
        <div class="container container-small">
            <div class="article-block-wrapper">
                <?php
                $postsPerPage = 5;
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $postsPerPage,
                    'post_status' => 'publish',
                    'order' => 'DESC'
                );

                $newsPosts = new WP_Query($args);
                $do_not_duplicate_again_arr = [];

                if ($newsPosts->have_posts()) : while ($newsPosts->have_posts()) : $newsPosts->the_post();
                        $newsPostId = get_the_ID();
                        $do_not_duplicate_again_arr[] = $newsPostId;

                        if (in_array($newsPostId, $do_not_duplicate_arr)) continue;   // skip the first three ids of news post

                        $newsDeskImage = get_field('two_column_news_listing_desktop_device_image', $newsPostId);
                        $newsTabletImage = get_field('two_column_news_listing_tablet_device_image', $newsPostId);
                        $newsMobileImage = get_field('two_column_news_listing_mobile_device_image', $newsPostId);
                        $shareLinkLabel = get_field('share_link_label', $newsPostId);

                        $subject = get_the_title($newsPostId);
                        $body = get_the_permalink($newsPostId);
                        $mailto = '';
                        $shareLink = "mailto:$mailto?subject=$subject&body=$body";
                ?>
                        <div class="article-block">
                            <div class="image-block">
                                <i>
                                    <a href="<?php echo get_the_permalink(); ?>" title="<?Php echo get_the_title(); ?>">
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
                                <!-- <span><?php echo get_the_date('l d M Y', $newsPostId); ?></span> -->
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
                wp_reset_query();
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <section class="article-section inner-article four-articles-section">
        <div class="container container-small">
            <div class="article-block-wrapper">
                <?php
                $postsPerPage = 9;
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $postsPerPage,
                    'post_status' => 'publish',
                    'order' => 'DESC'
                );

                $newsPosts = new WP_Query($args);

                if ($newsPosts->have_posts()) : while ($newsPosts->have_posts()) : $newsPosts->the_post();
                        $newsPostId = get_the_ID();

                        if (in_array($newsPostId, $do_not_duplicate_again_arr)) continue;   // skip the first id of news post
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
                wp_reset_query();
                wp_reset_postdata();
                ?>

            </div>
        </div>
    </section>
    <section>
        <div class="container container-small">
            <div class="view-top-wrap news-template-page">
                <?php if ($totalPosts > $postsPerPage) { ?>
                    <a class="view-more" href="javascript:void(0)" title="<?Php echo _e('View more news', 'camberwell-dragons'); ?>">
                        <span><?Php echo _e('View more news', 'camberwell-dragons'); ?></span>
                        <i><img src="<?php echo get_template_directory_uri(); ?>/public/images/plus-large-red.svg" alt=""></i>
                    </a>
                <?php } ?>

                <div class="custom-total" data-total='<?php echo $totalPosts; ?>'></div>
                <div class="postsCount" data-posts-count='<?Php echo $postsPerPage; ?>'></div>
                <div class="pageNumber" data-page='1'></div>

                <a class="back-to-top" href="javascript:void(0)" title="<?Php echo _e('Back to top', 'camberwell-dragons'); ?>">
                    <i><img src="<?php echo get_template_directory_uri(); ?>/public/images/right_arrow.svg" alt="<?Php echo _e('Totop', 'camberwell-dragons'); ?>"></i>
                    <span><?Php echo _e('Back to top', 'camberwell-dragons'); ?></span>
                </a>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); 