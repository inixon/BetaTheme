<?php
add_theme_support( 'post-thumbnails' );

add_image_size( 'single-post-thumb-new', 1280, 720, [ 'center', 'center' ] );
add_image_size( 'single-post-thumb', 1100, 800, [ 'center', 'center' ] );
add_image_size( 'single-post-thumb-850', 850, 500, [ 'center', 'center' ] );
add_image_size( 'single-post-thumb-510', 510, 300, [ 'center', 'center' ] );
add_image_size( 'mini-post-thumb', 925, 550, [ 'center', 'center' ] );
add_image_size( 'mini-post-thumb-550', 550, 350, [ 'center', 'center' ] );
add_image_size( 'mini-post-thumb-350', 350, 200, [ 'center', 'center' ] );
add_image_size( 'sidebar-post-thumb', 450, 300, [ 'center', 'center' ] );
add_image_size( 'sidebar-post-thumb-350', 350, 200, [ 'center', 'center' ] );

/**
 * Add the custom image size to the selectable image sizes in the media library.
 *
 * @param array $sizes An array of image size names that are currently selectable.
 *
 * @return array An updated array of image size names with the custom size added.
 */
function my_custom_sizes( array $sizes ): array {
	$newSizes = [
		'single-post-thumb' => __( 'Single Post Thumb' ),
		'mini-post-thumb' => __( 'Mini Post Thumb' ),
		'sidebar-post-thumb' => __( 'Sidebar Post Thumb' )
	];
	return array_merge( $sizes, $newSizes );
}

add_filter( 'image_size_names_choose', 'my_custom_sizes' );


function register_my_menu() {
  register_nav_menu('about',__( 'About menu' ));
  register_nav_menu('cat',__( 'Cat menu' ));
  register_nav_menu('legal',__( 'Legal menu' ));
}
add_action( 'init', 'register_my_menu' );

//Related post by cat
function related_by_cat($limit = "5",$template = "mini-post") {
    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category( $post_id );

    if(!empty($categories)):
        foreach ($categories as $category):
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);
    $query_args = array(
        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => $limit,
     );

    $related_cats_post = new WP_Query( $query_args );

    if($related_cats_post->have_posts()):
         while($related_cats_post->have_posts()): $related_cats_post->the_post();
            get_template_part( 'parts/content/' . $template );
        endwhile;

        // Restore original Post Data
        wp_reset_postdata();
     endif;

}

function related_by_tag($limit = "5",$template = "mini-post") {
    $post_id = get_the_ID();
    $tags_ids = array();
    $tags = wp_get_post_tags($post_id);

    foreach ($tags as $tag):
      array_push($tags_ids, $tag->term_id);
    endforeach;

    $current_post_type = get_post_type($post_id);
    $query_args = array(
        'tag__in'   => $tags_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => $limit,
     );

    $related_tags_post = new WP_Query( $query_args );

    if($related_tags_post->have_posts()):
         while($related_tags_post->have_posts()): $related_tags_post->the_post();
            get_template_part( 'parts/content/' . $template );
        endwhile;

        // Restore original Post Data
        wp_reset_postdata();
     endif;


    // echo var_dump($tags_ids);

}

function random_posts($limit = "5",$template = "mini-post") {

    $query_args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'orderby' => 'rand',
    );

    $related_tags_post = new WP_Query( $query_args );

    if($related_tags_post->have_posts()):
         while($related_tags_post->have_posts()): $related_tags_post->the_post();
            get_template_part( 'parts/content/' . $template );
        endwhile;
        // Restore original Post Data
        wp_reset_postdata();
    endif;
}

// add_filter( "wpseo_breadcrumb_links", "remove_last_item_in_yoast_breadcrumb" );

// function remove_last_item_in_yoast_breadcrumb( $links ) {
// 	if ( is_single() ) {
// 		array_pop( $links );
// 	}

// 	return $links;
// }

// Make all pages as list item and remove link from last item
function filter_yoast_breadcrumb_items( $link_output, $link ) {
		if(strpos( $link_output, 'breadcrumb_last' ) !== false ) {
			$new_link_output = "<li>" . $link['text'] . "</li>";
		} else {
			$new_link_output = '<li>';
			$new_link_output .= '<a href="' . $link['url'] . '">' . $link['text'] . '</a>';
			$new_link_output .= '</li>';
		}

	return $new_link_output;
}
add_filter( 'wpseo_breadcrumb_single_link', 'filter_yoast_breadcrumb_items', 10, 2 );

function filter_yoast_breadcrumb_output( $output ){

	$from = '<span>';
	$to = '</span>';
	$output = str_replace( $from, $to, $output );

	return $output;
}
add_filter( 'wpseo_breadcrumb_output', 'filter_yoast_breadcrumb_output' );

// function filter_wpseo_breadcrumb_separator($separator) {
//     return '<li>'.$separator.'</li>';
// };
// add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

add_action('wp_enqueue_scripts', 'load_wpcf7_scripts');
function load_wpcf7_scripts() {
  if ( is_page('contacts') ) {
    if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
      wpcf7_enqueue_scripts();
    }
    if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
      wpcf7_enqueue_styles();
    }
  }
}

class custom_comments extends Walker_Comment {

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {

		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body lets-go">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php
						$comment_author_link = get_comment_author_link( $comment );
						$comment_author_url  = get_comment_author_url( $comment );
						$comment_author      = get_comment_author( $comment );
						$avatar              = get_avatar( $comment, $args['avatar_size'] );
						if ( 0 != $args['avatar_size'] ) {
							if ( empty( $comment_author_url ) ) {
								echo $avatar;
							} else {
								printf( '<a href="%s" rel="external nofollow" class="url">', $comment_author_url );
								echo $avatar;
							}
						}
						/*
						 * Using the `check` icon instead of `check_circle`, since we can't add a
						 * fill color to the inner check shape when in circle form.
						 */
						if ( custom_is_comment_by_post_author( $comment ) ) {
							printf( '<span class="post-author-badge" aria-hidden="true">%s</span>', custom_get_icon_svg( 'check', 24 ) );
						}

						/*
						 * Using the `check` icon instead of `check_circle`, since we can't add a
						 * fill color to the inner check shape when in circle form.
						 */
						if ( custom_is_comment_by_post_author( $comment ) ) {
							printf( '<span class="post-author-badge" aria-hidden="true">%s</span>', custom_get_icon_svg( 'check', 24 ) );
						}

						printf(
							/* translators: %s: comment author link */
							wp_kses(
								__( '%s <span class="screen-reader-text says">says:</span>', 'custom' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							'<b class="fn">' . get_comment_author_link( $comment ) . '</b>'
						);

						if ( ! empty( $comment_author_url ) ) {
							echo '</a>';
						}
						?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
							<?php
								/* translators: 1: comment date, 2: comment time */
								$comment_timestamp = sprintf( __( '%1$s at %2$s', 'custom' ), get_comment_date( '', $comment ), get_comment_time() );
							?>
							<time datetime="<?php comment_time( 'c' ); ?>" title="<?php echo $comment_timestamp; ?>">
								<?php echo $comment_timestamp; ?>
							</time>
						</a>
						<?php
							$edit_comment_icon = custom_get_icon_svg( 'edit', 16 );
							edit_comment_link( __( 'Edit', 'custom' ), '<span class="edit-link-sep">&mdash;</span> <span class="edit-link">' . $edit_comment_icon, '</span>' );
						?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'custom' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

			</article><!-- .comment-body -->

			<?php
			comment_reply_link(
				array_merge(
					$args,
					array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="comment-reply">',
						'after'     => '</div>',
					)
				)
			);
			?>
		<?php
	}
}


//Custom Logo

function garden_custom_logo_setup() {
	$defaults = array(
		'height'               => 100,
		'width'                => 100,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true,
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'garden_custom_logo_setup' );


//Theme customization
function theme_customize_register( $wp_customize ) {
   // All our settings will go here
	 // Accent color
    $wp_customize->add_setting( 'accent_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
      'section' => 'colors',
      'label'   => esc_html__( 'Accent color', 'theme' ),
    ) ) );

		// Menu BG Color
     $wp_customize->add_setting( 'menu_bg_color', array(
       'default'   => '',
       'transport' => 'refresh',
       'sanitize_callback' => 'sanitize_hex_color',
     ) );

     $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_bg_color', array(
       'section' => 'colors',
       'label'   => esc_html__( 'Menu BG Color', 'theme' ),
     ) ) );
}

add_action( 'customize_register', 'theme_customize_register' );



function theme_get_customizer_css() {
    ob_start();

    $accent_color = get_theme_mod( 'accent_color', '' );
    $menu_bg_color = get_theme_mod( 'menu_bg_color', '' );
    if ( ! empty( $accent_color ) &&  ! empty( $menu_bg_color ) ) {
      ?>
      :root {
        --accent-color: <?php echo $accent_color; ?>;
        --menu-bg-color: <?php echo $menu_bg_color; ?>;
      }
      <?php
    }

		if ( ! empty( $accent_color ) &&  empty( $menu_bg_color ) ) {
      ?>
      :root {
        --accent-color: <?php echo $accent_color; ?>;
      }
      <?php
    }

		if ( !empty( $menu_bg_color ) && empty( $accent_color )) {
      ?>
      :root {
        --menu-bg-color: <?php echo $menu_bg_color; ?>;
      }
      <?php
    }

    $css = ob_get_clean();
    return $css;
  }

// Modify our styles registration like so:

function theme_enqueue_styles() {
  wp_enqueue_style( 'theme-styles', get_stylesheet_uri() ); // This is where you enqueue your theme's main stylesheet
  $custom_css = theme_get_customizer_css();
  wp_add_inline_style( 'theme-styles', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Register Sidebars
function custom_sidebars() {

	register_sidebar( array(
		'name'          => __( 'Header sidebar', 'text_domain' ),
		'id' => 'sidebar-header',
		'description'   => __( 'Blocks in header', 'text_domain' ),
		'before_title'  => '<div class="sidebar-header">',
		'after_title'   => '</div>',
		'before_widget' => '',
		'after_widget'  => '',
	));

	register_sidebar( array(
		'name'          => __( 'Blog sidebar', 'text_domain' ),
		'id' => 'sidebar-post',
		'description'   => __( 'Blocks in post sidebar', 'text_domain' ),
		'before_title'  => '<div class="sidebar-header">',
		'after_title'   => '</div>',
		'before_widget' => '',
		'after_widget'  => '',
	));

	register_sidebar( array(
		'name'          => __( 'Footer sidebar', 'text_domain' ),
		'id' => 'sidebar-footer',
		'description'   => __( 'Blocks in Footer', 'text_domain' ),
		'before_title'  => '<div class="f-block__header">',
		'after_title'   => '</div>',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	));

	register_sidebar( array(
		'name'          => __( 'Signature sidebar', 'text_domain' ),
		'id' => 'sidebar-signature',
		'description'   => __( 'Signature in footer', 'text_domain' ),
		'before_title'  => '<div class="sidebar-header">',
		'after_title'   => '</div>',
		'before_widget' => '',
		'after_widget'  => '',
	));

}
add_action( 'widgets_init', 'custom_sidebars' );
