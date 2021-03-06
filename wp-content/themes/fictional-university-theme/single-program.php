<?php
get_header();
pageBanner();
while(have_posts()){
    the_post(); ?>

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i>All Programs</a> <span class="metabox__main"><?php the_title();?></span>

            </p>


        </div>


        <div class="generic-content">
            <?php //the_content();  //change after disable default editor
                the_field('main_body_content');
            ?>
        </div>






        <?php
    //       <!--  display relation professor -->

    $relatedProfessor = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => 'professor',
        'orderby' => 'title',
        'order' => 'asc',
        'meta_query' => array(
            //get the relation of program in p
            array(
                'key' => 'related_programs',
                'compare' => 'like',
                // ./Sort by custom file
                'value' =>'"'. get_the_ID().'"',
            ),
        ),

    ));

    if($relatedProfessor->have_posts()){


        echo '<hr  class="section-break">';
        echo '<h2 class="headline headline--medium"> '. get_the_title() .' Professors</h2> ';

        echo '<ul class="professor-cards">';
        while($relatedProfessor->have_posts()){
            $relatedProfessor->the_post(); ?>
           <li class="professor-card__list-item"><a class="professor-card" href="<?php the_permalink(); ?>">
                   <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>">
                   <span class="professor-card__name"> <?php the_title(); ?></span>

               </a></li>

        <?php }
        echo '</ul>';

    }
   // <!--  ./display relation professor -->



        wp_reset_postdata();



        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
            'posts_per_page' =>2,
            'post_type' => 'event',
//                    'orderby' => 'rand',
//                    'orderby' => 'tile',

            //Sort by custom file
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',  //meta_value for text
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric',
                ),
                //get the relation of program in p
                array(
                    'key' => 'related_programs',
                    'compare' => 'like',
                    'value' =>'"'. get_the_ID().'"',
                ),
            ),
            // ./Sort by custom file

            'order' => 'asc',
        ));

        if($homepageEvents->have_posts()){


        echo '<hr  class="section-break">';
        echo '<h2 class="headline headline--medium">Upcoming '. get_the_title() .' Events</h2> ';

        while($homepageEvents->have_posts()){
            $homepageEvents->the_post();

        get_template_part('template-parts/content-event');

        }
        }


        //get campus info
        wp_reset_postdata();
        $relatedCampuses = get_field('related_campus');

        if($relatedCampuses){
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium"> '. get_the_title().' is Available At These Campuses: </h2>';

            echo '<ul class="min-list link-list">';
//            print_r($relatedCampuses);
            foreach ($relatedCampuses as $campus){ ?>

            <li><a href="<?php echo get_the_permalink($campus); ?>"><?php echo get_the_title($campus); ?></a></li>

           <?php }
echo '</ul>';

        }



        ?>
        <!--  ./display relation event -->
    </div>

    <!--    <h2>--><?php //the_title(); ?><!-- </h2>-->
    <!--    --><?php //the_content();?>


<?php }

get_footer();
?>


