<?php
/**
 * Daily Stories functions and definitions
 *
 * @subpackage Daily Stories
 * @since      Daily Stories 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 752;
}
/**
 * Daily Stories setup
 *
 */
function dlstrs_setup() {
	load_theme_textdomain( 'daily-stories', get_template_directory() . '/languages' );
	add_theme_support( 'custom-background', apply_filters( 'dlstrs_custom_background_args', array(
		'default-color' => 'fff',
	) ) );
	/**
	 *Adding custom header
	 *
	 */
	$headerdefaults = array(
		'default-image'          => '',
		'width'                  => 3000,
		'height'                 => 300,
		'flex-width'             => false,
		'flex-height'            => false,
		'random-default'         => false,
		'header-text'            => true,
		'default-text-color'     => 'fff',
		'uploads'                => true,
		'wp-head-callback'       => 'dlstrs_header_style',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $headerdefaults );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' ); // Add RSS feed links to <head> for posts and comments.
	add_image_size( 'dlstrs_featured_image', 752, 495 ); // size for posts thumbnail
	add_editor_style();
	add_theme_support( 'title-tag' );
}

/**
 * Register nav_menu
 *
 */
function dlstrs_register_nav_menu() {
	register_nav_menu( 'header-menu', __( 'Header Menu', 'daily-stories' ) );
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function dlstrs_register_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Right sidebar', 'daily-stories' ),
		'id'            => 'right_sidebar',
		'before_widget' => '<aside class="dlstrs-widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer sidebar', 'daily-stories' ),
		'id'            => 'footer_sidebar',
		'before_widget' => '<aside class="dlstrs-widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
}

/**
 * Proper way to enqueue scripts and styles
 *
 */
function dlstrs_style_scripts() {
	wp_enqueue_style( 'dlstrs_style', get_stylesheet_uri() );
	wp_enqueue_script( 'dlstrs_script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), true );
	wp_enqueue_script( 'dlstrs_html5', get_template_directory_uri() . '/js/html5shiv.js', array( 'jquery' ), true );
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	} // including scripts for comments reply
	// array with elements to localize in scripts
	$script_localization = array(
		'choose_file'          => __( 'Choose file', 'daily-stories' ),
		'file_is_not_selected' => __( 'File is not selected.', 'daily-stories' ),
		'dlstrs_home_url'      => esc_url( home_url() ),
	);
	wp_localize_script( 'dlstrs_script', 'script_loc', $script_localization ); // localization in scripts
}

/**
 * Restyling header images
 *
 */
function dlstrs_print_style() {
	$header_src = get_header_image();
	if ( '' != $header_src ) { ?>
		<style>
			.dlstrs-wrapper .dlstrs-site-header {
				background: url('<?php echo $header_src; ?>') repeat-x;
			}
		</style>
	<?php }
}

/**
 * Includes support BREADCRUMBS
 *
 */
function dlstrs_the_breadcrumbs() {
	if ( ( ! is_front_page() ) && ( ! is_404() ) ) { ?>
		<a href="<?php echo esc_url( home_url() ); ?>"><?php echo __( 'Home', 'daily-stories' ) . '&nbsp;&#8211;&nbsp;'; ?></a>
	<?php }
	if ( is_single() ) {
		// display list of categories
		echo '<span>';
		the_category( ',&nbsp;</span><span>' );
		// check if the post belongs to any categories
		if ( has_category() ) {
			echo '</span><span>&nbsp;&#8211;&nbsp;' . get_the_title() . '</span>';
		} elseif ( is_singular( 'portfolio' ) ) {
			echo the_title();
		} elseif ( is_singular( 'gallery' ) ) {
			echo the_title();
		} elseif ( is_attachment() ) {
			echo get_the_title();
		}
	} elseif ( is_category() ) {
		echo single_cat_title( '', false ); ?>
		<div class="dlstrs-breadcrumbs-title"><?php echo __( 'Category Archives:', 'daily-stories' ) . '&nbsp' . single_cat_title( '', false ); ?></div>
	<?php } elseif ( is_page() ) {
		global $post;
		if ( $post->ancestors ) {
			// reverse order of a parent pages array for the current page
			$ancestors = array_reverse( $post->ancestors );
			// display links to parent pages of the current page
			for ( $i = 0; $i < count( $ancestors ); $i ++ ) {
				if ( 0 == $i ) {
					echo '<a href=' . get_permalink( $ancestors[ $i ] ) . '>' . get_the_title( $ancestors[ $i ] ) . '</a>';
				} else {
					echo '&nbsp;&#8211;&nbsp;<a href=' . get_permalink( $ancestors[ $i ] ) . '>' . get_the_title( $ancestors[ $i ] ) . '</a>';
				}
			}
			echo '&nbsp;&#8211;&nbsp;' . get_the_title();
		} else {
			echo get_the_title();
		}
	} elseif ( is_tag() ) { // if it is a tags archive page
		echo single_tag_title( '', false ); ?>
		<div class="dlstrs-breadcrumbs-title"><?php echo __( 'Tag Archives:', 'daily-stories' ) . '&nbsp;' . single_tag_title( '', false ); ?></div>
	<?php } elseif ( is_day() ) {
		echo __( 'Archive', 'daily-stories' ); ?>
		<div class="dlstrs-breadcrumbs-title"><?php echo __( 'Daily Archives:', 'daily-stories' ) . '&nbsp;';
			the_time( 'd M Y' ); ?></div>
	<?php } elseif ( is_month() ) {
		echo __( 'Archive', 'daily-stories' ); ?>
		<div class="dlstrs-breadcrumbs-title"><?php echo __( 'Monthly Archives:', 'daily-stories' ) . '&nbsp;';
			the_time( 'M Y' ); ?></div>
	<?php } elseif ( is_year() ) {
		echo __( 'Archive', 'daily-stories' ); ?>
		<div class="dlstrs-breadcrumbs-title"><?php echo __( 'Yearly Archives:', 'daily-stories' ) . '&nbsp;';
			the_time( 'Y' ); ?></div>
	<?php } elseif ( is_search() ) {
		echo __( 'Search Results', 'daily-stories' ); ?>
		<div class="dlstrs-breadcrumbs-title"><?php echo __( 'Search results for:', 'daily-stories' ) . '&nbsp;' . get_search_query(); ?></div>
	<?php } elseif ( is_404() ) {
		echo __( '404 Page', 'daily-stories' ); ?>
		<div class="dlstrs-breadcrumbs-title"><?php _e( 'Page Not Found', 'daily-stories' ); ?></div>
	<?php } elseif ( is_archive() ) {
		echo single_tag_title();
	}
}

/**
 * Includes support post-thumbnails-caption
 *
 */
function dlstrs_the_post_thumbnail_caption() {
	global $post;
	$thumbnail_id    = get_post_thumbnail_id( $post->ID );
	$thumbnail_image = get_posts( array( 'p' => $thumbnail_id, 'post_type' => 'attachment' ) );
	if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		if ( ( $thumbnail_image[0]->post_excerpt ) != '' ) {
			echo '<p class="wp-caption-text">' . $thumbnail_image[0]->post_excerpt . '</p>';
		}
	}
}

/**
 * Returns a "Continue reading" link for excerpts
 *
 */
function dlstrs_modify_read_more_link() {
	return '<a class="dlstrs-more-link" href="' . get_permalink() . '">' . __( 'read more', 'daily-stories' ) . '</a>';
}

/**
 * Template for comments
 *
 */
function dlstrs_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' : // Display trackbacks differently than normal comments.
			?>
			<li class="dlstrs-pingback" <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<p><?php echo __( 'Pingback:', 'daily-stories' ) . '&nbsp;'; ?><?php comment_author_link(); ?><?php edit_comment_link( '&nbsp;' . '(' . __( 'Edit', 'daily-stories' ) . ')' ); ?></p>
			<?php break;
		default :
			// Proceed with normal comments.
			global $post; ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, '74' ); ?>
					<cite class="fn"><?php echo get_comment_author_link(); ?></cite>
				</div><!-- .comment-author.vcard -->
				<?php if ( '0' == $comment->comment_approved ) {
					__( 'Your comment is awaiting moderation', 'daily-stories' );
				} ?>
				<div class="comment-meta commentmetadata">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( '%1$s' . '&nbsp;' . __( 'in', 'daily-stories' ) . '&nbsp;' . '%2$s', get_comment_date(), get_comment_time() ); ?></a>
					<?php edit_comment_link( __( 'Edit', 'daily-stories' ) ); ?>
				</div><!-- .comment-meta.commentmetadata -->
				<div class="comment-content"><?php comment_text(); ?></div><!-- .comment-content -->
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array(
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
					) ) ); ?>
				</div><!-- .reply -->
			</div><!-- #comment -->
			<?php break;
	}
}

/**
 * Print the attached image with a link to the next attached image.
 *
 */
function dlstrs_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'dlstrs_attachment_size', array(
		810,
		810,
	) ); // Filter the default Daily Stories attachment size.
	$next_attachment_url = wp_get_attachment_url();
	$attachment_ids      = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => - 1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	if ( count( $attachment_ids ) > 1 ) { // If there is more than 1 attachment in a gallery...
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}
		if ( $next_id ) { // get the URL of the next image attachment...
			$next_attachment_url = get_attachment_link( $next_id );
		} else {  // or get the URL of the first image attachment.
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}
	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}

/**
 * Pagination search-template
 *
 */
function dlstrs_search_nav() {
	global $wp_query, $wp_rewrite;
	$max = $wp_query->max_num_pages;
	if ( ! $pagecurrent = get_query_var( 'paged' ) ) {
		$pagecurrent = 1;
	}
	$n = array(
		'base'      => str_replace( 999999, '%#%', get_pagenum_link( 999999 ) ),
		'total'     => $max,
		'current'   => $pagecurrent,
		'mid_size'  => 2, // How many pages before and after current page
		'end_size'  => 0, // How many pages at start and at the end
		'prev_text' => '&larr;',
		'next_text' => '&rarr;',
	);
	if ( $max > 1 ) {
		echo '<div class="dlstrs-page-links">' . paginate_links( $n ) . '</div>';
	}
}

/**
 * Styles the header image and text displayed on the blog
 *
 */
function dlstrs_header_style() {
	$text_color   = get_header_textcolor();
	$display_text = display_header_text();
	if ( HEADER_TEXTCOLOR == $text_color ) { // If no custom options for text are set, return default.
		return;
	}
	/* If optins are set, we use them */ ?>
	<style type="text/css">
		<?php if ( 'blank' != $text_color ) { ?>
		.dlstrs-site-title a,
		.dlstrs-description {
			color: <?php echo '#' . $text_color; ?> !important;
		}

		<?php }
		if ( ! $display_text ) {  // Display text or not ?>
			.dlstrs-site-title,
			.dlstrs-description {
				display: none;
			}
		<?php } ?>
	</style>
<?php }

add_action( 'after_setup_theme', 'dlstrs_setup' );
add_action( 'init', 'dlstrs_register_nav_menu' );
add_action( 'widgets_init', 'dlstrs_register_sidebar' );
add_action( 'wp_enqueue_scripts', 'dlstrs_style_scripts' );
add_action( 'dlstrs_the_breadcrumbs', 'dlstrs_the_breadcrumbs' );
add_action( 'wp_print_styles', 'dlstrs_print_style' );
add_action( 'dlstrs_the_post_thumbnail_caption', 'dlstrs_the_post_thumbnail_caption' );
add_filter( 'the_content_more_link', 'dlstrs_modify_read_more_link' );
add_action( 'dlstrs_the_attached_image', 'dlstrs_the_attached_image' );
add_action( 'dlstrs_search_nav', 'dlstrs_search_nav' );
add_filter( 'allow_dev_auto_core_updates', '__return_false' );
