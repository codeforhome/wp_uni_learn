<?php
get_header();

pageBanner(array(
    'title' => 'Our Campuses',
    'subtitle' => 'We have several conveniently located campuses',

));
?>





    <div class="container container--narrow page-section">
        <ul class="acf-map">
            <?php

            while(have_posts()){
                the_post();
                $maplocation = get_field('map_location');
                ?>

                <div data-lat="<?php echo $maplocation['lat']; ?>" data-lng="<?php echo $maplocation['lng']; ?>" class="marker" ></div>


                <li><a href="<?php the_permalink();?>"> <?php the_title();
                ?></a></li>


            <?php  }

            echo paginate_links();
            ?>
        </ul>

    </div>
<?php get_footer();


?>