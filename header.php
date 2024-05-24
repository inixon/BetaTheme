<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?ver=<?php echo rand(1000,1000000); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- global-wrapper -->
    <div class="global-wrapper">

        <!-- header -->
        <div class="header">
            <div class="wrapper">
                <?php
                    if (function_exists( 'the_custom_logo' )) {
                      $custom_logo_id = get_theme_mod( 'custom_logo' );
                      $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    }
                ?>
                <?php if (is_home()) { ?>
                  <h1 class="sitename"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php if ( $logo[0] != "" ) { echo '<img src="' . esc_url( $logo[0] ) . '" class="logo" alt="' . get_bloginfo( 'name' ) . '">'; } ?><?php echo get_bloginfo( 'name' ); ?></a></h1>
                <?php } else { ?>
                  <div class="sitename"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php if ( $logo[0] != "" ) { echo '<img src="' . esc_url( $logo[0] ) . '" class="logo" alt="' . get_bloginfo( 'name' ) . '">'; } ?><?php echo get_bloginfo( 'name' ); ?></a></div>
                <?php } ?>
                <?php get_sidebar( 'header' ); ?>
            </div>
        </div>
        <!-- /header -->
        <!-- nav-bar -->
        <div class="nav-bar dropdown">
                <nav class="wrapper">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'cat',
                        'container' => 'ul',
                        'items_wrap' => '<ul>%3$s</ul>'
                    ) ); ?>
                </nav>
        </div>
        <!-- /nav-bar -->
