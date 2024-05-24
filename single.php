<?php get_header(); ?>
<main class="wrapper article-wrapper">
            <article class="post">
                    <?php get_template_part( 'parts/content/breadcrumbs'); ?>
                    <h1><?php the_title();?></h1>
                    <!-- post-meta__author -->
                    <div class="post-meta__author">
                        <div class="post-meta__author__image">
                            <?php
                                $author_id = get_the_author_meta('ID');
                                $avatar = get_avatar_url($author_id);
                            ?>

                                <?php if ($avatar) { ?>
                                    <img src="<?php echo $avatar; ?>" alt="<?php echo get_the_author_meta('display_name'); ?>" title="<?php echo get_the_author_meta('display_name'); ?>" width="100px" height="100px" />
                                <?php } else { ?>
                                    <img src="#" alt="" title="" width="100px" height="100px" />
                                <?php } ?>

                        </div>
                        <div>
                            <div class="post-meta__author__name"><?php echo get_the_author_meta('display_name'); ?></div>
                            <div class="post-meta__article-date">
                                <?php
                                $post_time = get_the_time( 'U' );
                                $mod_time = get_the_modified_time( 'U' );

                                if ( $mod_time >= $post_time + 2592000 ) { ?>
                                Updated: <time datetime="<?php echo get_the_modified_date('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_date(); ?></time>
                                <?php } else { ?>
                                <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /post-meta__author -->
                    <?php if ( has_excerpt() ) { ?>
                    <p class="post-excerpt"><?php echo get_the_excerpt(); ?></p>
                    <?php } ?>
                    <picture class="article-image">
                        <source media="(max-width: 550px)" srcset="<?php the_post_thumbnail_url('single-post-thumb-510'); ?>" />
                        <source media="(max-width: 890px)" srcset="<?php the_post_thumbnail_url('single-post-thumb-850'); ?>" />
                        <img src="<?php the_post_thumbnail_url('single-post-thumb-new'); ?>" width="1280" height="720" decoding="async" alt="<?php the_title(); ?>" />
                        <figcaption><?php the_post_thumbnail_caption();?></figcaption>
                    </picture>
                    <?php the_content(); ?>
                    <!-- author-info-block -->
                    <div class="author-info-block">
                      <img src="<?php echo $avatar; ?>" alt="<?php echo get_the_author_meta('display_name'); ?>" title="<?php echo get_the_author_meta('display_name'); ?>" width="96px" height="96px" />
                      <div class="author-info-block__text">
                        <p>Author: <strong><?php echo get_the_author_meta('display_name'); ?></strong></p>
                        <p><?php echo get_the_author_meta('description'); ?></p>
                      </div>
                    </div>
                    <!-- /author-info-block -->
                    <?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>

            </article>
            <div class="sidebar">
                <?php get_sidebar( 'post' ); ?>
                <div class="sidebar-header">Related</div>
                <div class="sidebar-posts">
                    <?php related_by_cat(4, "sidebar-post"); ?>
                </div>
            </div>
            <progress class="reading-progress" value="0" max="100" aria-label="Reading progress"></progress>
        </main>
        <!-- posts -->
        <div class="posts">
            <div class="wrapper">
                <div class="same-posts__header">Popular</div>
            </div>
            <div class="wrapper">
                <?php related_by_tag(9,"similar-post"); ?>
            </div>
        </div>
        <!-- /posts -->
<?php get_footer(); ?>
