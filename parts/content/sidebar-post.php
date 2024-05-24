                <article id="post-<?php the_ID(); ?>" <?php post_class('sidebar-item sidebar-post'); ?>>
                    <a href="<?php the_permalink(); ?>">
                        <picture>
                            <source media="(max-width: 890px)" srcset="<?php the_post_thumbnail_url('sidebar-post-thumb-350'); ?>" />
                            <img src="<?php the_post_thumbnail_url('sidebar-post-thumb'); ?>" width="450" height="300" loading="lazy" decoding="async" alt="<?php the_title(); ?>" />
                        </picture>
                    </a>
                        <div class="sidebar-post__header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                </article>