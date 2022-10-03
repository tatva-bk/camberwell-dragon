<?php
require_once("../../../wp-blog-header.php");
header("HTTP/1.1 200 OK");

$args = array(
    'post_type' => 'event',
    'posts_per_page' => -1,
    'post_status' => 'publish',   
);

$allEvents = new WP_Query($args);

$data = array();

if ($allEvents->have_posts()) : while ($allEvents->have_posts()) : $allEvents->the_post();

        array_push($data, array(
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'start' => date('Y-m-d', strtotime(get_field('event_start_date', get_the_ID()))),
            'url' => get_the_permalink()
        ));
    endwhile;
endif;

echo json_encode($data);
