<?php
get_header();

pageBanner(array(
    'title' => ' Past Events',
    'subtitle' => 'A recap of out past events',
));
?>

<!--
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title">
                Past Events

            </h1>
            <div class="page-banner__intro">
                <p>  A recap of out past events </p>
            </div>
        </div>
    </div>
-->

    <div class="container container--narrow page-section">
        <?php

        $today = date('Ymd');
        $pastEvents = new WP_Query(array(
//            'posts_per_page' => 1,
            'paged' => get_query_var('paged',1),
            'post_type' => 'event',
//                    'orderby' => 'rand',
//                    'orderby' => 'tile',

            //Sort by custom file
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',  //meta_value for text
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => '<',
                    'value' => $today,
                    'type' => 'numeric',
                ),
            ),
            // ./Sort by custom file

            'order' => 'asc',
        ));

        while($pastEvents->have_posts()){
            $pastEvents->the_post();
            get_template_part('template-parts/content-event');
            //get content-event.php
        }

        echo paginate_links(array(
            'total' => $pastEvents->max_num_pages,
        ));
        ?>


    </div>
<?php get_footer();


?>