<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @subpackage Daily Stories
 * @since Daily Stories 1.0 
 */
get_header(); ?>
	<div class="dlstrs-content">
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'dlstrs-post' ); ?>>
			<header class="entry-header">
				<h1 class="dlstrs-title"><?php _e( 'Nothing Found', 'dlstrs' ); ?></h1><!-- .dlstrs-title -->
			</header><!--.entry-header-->
			<div class="entry-content">
				<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'dlstrs' ); ?></p>
				<?php get_search_form(); ?>
			</div><!--.entry-content-->
		</div><!-- .dlstrs-post -->
	</div><!-- .dlstrs-content -->
<?php get_sidebar();
get_footer();