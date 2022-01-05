<?php
get_header(); ?>


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
            $pastEvents->the_post(); ?>

            <div class="event-summary">
                <a class="event-summary__date t-center" href="#">
                        <span class="event-summary__month"><?php
                            $evenDate =  new DateTime(get_field('event_date'));
                            echo $evenDate->format('M');

                            ?></span>
                    <span class="event-summary__day"><?php
                        $evenDate =  new DateTime(get_field('event_date'));
                        echo $evenDate->format('d');
                        ?></span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <p><?php
                        //echo wp_trim_words(get_the_content(),18);
                        if(has_excerpt()){
                            echo get_the_excerpt();
                        }else{
                            echo wp_trim_words(get_the_content(),18);
                        }

                        ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
                </div>
            </div>


        <?php  }

        echo paginate_links(array(
            'total' => $pastEvents->max_num_pages,
        ));
        ?>


    </div>
<?php get_footer();


?>