<?php
get_header();
pageBanner();
while (have_posts()) {
    the_post(); ?>

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i
                            class="fa fa-home" aria-hidden="true"></i>All Campus</a> <span
                        class="metabox__main"><?php the_title(); ?></span>

            </p>


        </div>


        <div class="generic-content">
            <?php the_content(); ?>
        </div>

        <div class="acf-map">
            <ul>
                <?php $maplocation = get_field('map_location'); ?>

                <div data-lat="<?php echo $maplocation['lat']; ?>" data-lng="<?php echo $maplocation['lng']; ?>"
                     class="marker">

                    <h3><?php the_title(); ?></h3>
                    <?php echo $maplocation['address']; ?>

                </div>


                <li><a href="<?php the_permalink(); ?>"> <?php the_title();
                        ?></a></li>


            </ul>
        </div>



        <?php
        //       <!--  display relation professor -->

        $relatedProgram = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'program',
            'orderby' => 'title',
            'order' => 'asc',
            'meta_query' => array(
                //get the relation of program in p
                array(
                    'key' => 'related_campus',
                    'compare' => 'like',
                    // ./Sort by custom file
                    'value' => '"' . get_the_ID() . '"',
                ),
            ),

        ));

        if ($relatedProgram->have_posts()) {


            echo '<hr  class="section-break">';
            echo '<h2 class="headline headline--medium"> Program Available At ' . get_the_title() . '</h2> ';

            echo '<ul class="min-list link-list">';
            while ($relatedProgram->have_posts()) {
                $relatedProgram->the_post(); ?>
                <li >
                        <a  href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>

                   </li>

            <?php }
            echo '</ul>';

        }
        // <!--  ./display relation professor -->


        wp_reset_postdata();


        ?>
        <!--  ./display relation event -->
    </div>

    <!--    <h2>--><?php //the_title();
    ?><!-- </h2>-->
    <!--    --><?php //the_content();
    ?>


<?php }

get_footer();
?>


