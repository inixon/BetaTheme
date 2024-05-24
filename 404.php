<?php get_header(); ?>
        <!-- hub-header -->
        <div class="hub-header">
            <div class="wrapper">
                <h1>Error 404</h1>
                <?php get_template_part( 'parts/content/breadcrumbs'); ?>
            </div>
        </div>
        <!-- /hub-header -->
        <!-- posts -->
        <div class="posts">
            <div class="wrapper">
                <?php random_posts(12);?>
            </div>
        </div>
        <!-- /posts -->
<?php get_footer(); ?>