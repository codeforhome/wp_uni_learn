<?php
get_header();
while(have_posts()){
    the_post(); ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> <?php the_title(); ?></h1>
            <div class="page-banner__intro">
                <p> dunt forget to replace me later</p>
            </div>
        </div>
    </div>
    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo site_url('/blog'); ?>"><i class="fa fa-home" aria-hidden="true"></i>Blog Home</a> <span class="metabox__main"></span>
                Posted by <?php  echo the_author_posts_link(); ?> on <?php echo the_time('n-j-y'); ?> in <?php echo get_the_category_list(', ') ?>
            </p>


        </div>


        <div class="generic-content">
            <?php the_content(); ?>
        </div>

    </div>

<!--    <h2>--><?php //the_title(); ?><!-- </h2>-->
<!--    --><?php //the_content();?>


<?php }

get_footer();
?>