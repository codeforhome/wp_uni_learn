<?php
get_header();

pageBanner(array(
    'title' => 'Our Campuses',
    'subtitle' => 'We have several conveniently located campuses',

));
?>





    <div class="container container--narrow page-section">
        <div class="acf-map">
        <ul >
            <?php

            while(have_posts()){
                the_post();
                $maplocation = get_field('map_location');
                ?>

                <div data-lat="<?php echo $maplocation['lat']; ?>" data-lng="<?php echo $maplocation['lng']; ?>" class="marker">

                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php echo $maplocation['address']; ?>

                </div>


                <li><a href="<?php the_permalink();?>"> <?php the_title();
                ?></a></li>


            <?php  }  ?>
        </ul>
        </div>
    </div>
<?php get_footer();


?>