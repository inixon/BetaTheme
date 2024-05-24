<?php get_header(); ?>
<main class="wrapper article-wrapper">
            <article class="post">
                    <?php get_template_part( 'parts/content/breadcrumbs'); ?>
                    <h1><?php the_title();?></h1>
                    <?php if ( has_excerpt() ) { ?>
                    <p class="post-excerpt"><?php echo get_the_excerpt(); ?></p>
                    <?php } ?>
                    <?php if ( has_post_thumbnail()) { ?>
                    <picture class="article-image">
                        <?php the_post_thumbnail(); ?>
                        <figcaption><?php the_title();?></figcaption>
                    </picture>
                    <?php } ?>
                    <?php the_content(); ?>
                    <?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>
            </article>
            <div class="sidebar">
              <div class="sidebar-header">Follow me</div>
                <?php get_template_part( 'parts/content/social-follow'); ?>
                <div class="sidebar-header">Popular posts</div>
                <div class="sidebar-posts">
                    <?php random_posts(3, "sidebar-post"); ?>
                </div>
            </div>
            <progress class="reading-progress" value="0" max="100" aria-label="Reading progress"></progress>
        </main>
<?php get_footer(); ?>
