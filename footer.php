</div>
    <!-- /global-wrapper -->
    <!-- footer -->
    <div class="footer">
        <div class="wrapper">
            <div class="f-block f-info">
                <?php get_sidebar( 'footer' ); ?>
                <!-- <div class="sitename"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( 'name' ); ?></a></div> -->
                <p>Developed by <a href="https://listratov.com/beta-theme/" target="_blank">Nikita Listratov</a>.</p>
            </div>
            <div class="f-block f-cat">
                <div class="f-block__header">Hubs</div>
                <?php wp_nav_menu( array(
                    'theme_location' => 'cat',
                    'container' => 'ul',
                    'items_wrap' => '<ul>%3$s</ul>'
                ) ); ?>
            </div>
            <div class="f-block f-about">
                <div class="f-block__header">About</div>
                <?php wp_nav_menu( array(
                    'theme_location' => 'about',
                    'container' => 'ul',
                    'items_wrap' => '<ul>%3$s</ul>'
                ) ); ?>
            </div>
            <div class="f-block f-disclamer">
                <div class="legal-links-block">
                <?php wp_nav_menu( array(
                    'theme_location' => 'legal',
                    'container' => 'ul',
                    'items_wrap' => '<ul>%3$s</ul>'
                ) ); ?>
                </div>
                <?php get_sidebar( 'signature' ); ?>
            </div>
        </div>
    </div>
    <!-- /footer -->
    <div class="mobile-menu__open"><span></span></div>
    <!-- mobileMenu -->
    <div id="mobileMenu">
        <div>
        <div class="mobile-header">
            <div class="sitename"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( 'name' ); ?></a></div>
        </div>
        <?php wp_nav_menu( array(
            'theme_location' => 'cat',
            'container' => 'ul',
            'items_wrap' => '<ul>%3$s</ul>',
            'depth' => 1
        ) ); ?>
        <?php wp_nav_menu( array(
            'theme_location' => 'about',
            'container' => 'ul',
            'items_wrap' => '<ul>%3$s</ul>'
        ) ); ?>
        <?php wp_nav_menu( array(
            'theme_location' => 'legal',
            'container' => 'ul',
            'items_wrap' => '<ul>%3$s</ul>'
        ) ); ?>
        <?php get_template_part( 'parts/content/social-follow'); ?>
        </div>
        <div class="mobile-menu__footer">
            &copy;&nbsp;<?php echo date('Y'); ?>&nbsp;<?php echo get_bloginfo( 'name' ); ?>
        </div>
    </div>
    <!-- /mobileMenu -->
    <?php wp_footer(); ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/go.min.js"></script>
    <?php if (is_single()) { ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/post.min.js?ver=<?php echo rand(1000,1000000)?>"></script>
    <?php } ?>
</body>
</html>
