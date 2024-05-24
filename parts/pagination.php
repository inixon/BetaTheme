        <!-- pagination -->
        <div class="pagination">
            <div class="wrapper">
                <?php the_posts_pagination(array(
                    'mid_size'  => 5,
                    'prev_text' => __( '&larr;', 'textdomain' ),
                    'next_text' => __( '&rarr;', 'textdomain' ),
                )); ?>
            </div>
        </div>
        <!-- /pagination -->