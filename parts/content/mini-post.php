                <div id="post-<?php the_ID(); ?>" <?php post_class('mini-post'); ?>>
                    <a href="<?php the_permalink(); ?>">
                        <picture>
                            <source media="(max-width: 550px)" srcset="<?php the_post_thumbnail_url('mini-post-thumb-350'); ?>" />
                            <source media="(max-width: 800px)" srcset="<?php the_post_thumbnail_url('mini-post-thumb-550'); ?>" />
                            <img src="<?php the_post_thumbnail_url('mini-post-thumb'); ?>" width="925" height="550" loading="lazy" decoding="async" alt="<?php the_title(); ?>" />
                        </picture>
                    </a>
                    <div class="mini-post__meta">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <span class="mini-post__meta__cat"><?php foreach((get_the_category()) as $category) { echo $category->cat_name; } ?></span>
                    </div>
                </div>
