<?php get_header(); ?>
        <!-- posts -->
        <?php if (is_paged()) { ?>
          <div class="posts">
        <?php } else { ?>
          <div class="posts index-posts">
        <?php } ?>
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
        <?php get_template_part( 'parts/pagination'); ?>
<?php get_footer(); ?>
