<?php get_header(); ?>
        <!-- hub-header -->
        <div class="hub-header">
            <div class="wrapper">
                <h1><?php single_cat_title(); ?></h1>
                <?php get_template_part( 'parts/content/breadcrumbs'); ?>
            </div>
        </div>
        <!-- /hub-header -->
        <!-- posts -->
        <div class="posts">
            <div class="wrapper">
                <?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            get_template_part( 'parts/content/mini-post');
                        } // end while
                    } // end if
                ?>
            </div>
        </div>
        <!-- /posts -->
        <?php get_template_part('parts/pagination'); ?>
<?php get_footer(); ?>
