<?php
/**
 * The template for displaying Search Results pages
 *
 * @subpackage Daily Stories
 * @since      Daily Stories 1.0
 */
get_header(); ?>
	<div class="dlstrs-content">
		<?php if ( have_posts() ) {
			while ( have_posts() ) {
				the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class( 'dlstrs-post' ); ?>>
					<h1 class="dlstrs-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h1><!--.dlstrs-title-->
					<?php if ( get_post_type( get_the_ID() ) != 'page' ) { ?>
						<div class="dlstrs-data-categ">
							<div class="dlstrs-data">
								<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a>
							</div><!--.dlstrs-data-->
							<?php if ( has_category() ) { ?>
								<div class="dlstrs-category">
									<em><?php echo __( 'in', 'daily-stories' ) . '&nbsp;';
										the_category( ', ' ); ?></em>
								</div><!--.dlstrs-category-->
							<?php } ?>
						</div><!--.dlstrs-data-categ-->
					<?php }
					edit_post_link( __( 'Edit', 'daily-stories' ), '<div class="dlstrs-edit-link">', '</div>' );
					if ( has_post_thumbnail() ) { ?>
						<div class="wp-caption alignnone">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dlstrs_featured_image' ); ?></a>
							<?php do_action( 'dlstrs_the_post_thumbnail_caption' ); ?>
						</div><!-- .wp-caption alignnone-->
					<?php }
					the_excerpt(); ?>
					<div class="clear"></div><!--.clear-->
				</div><!-- .dlstrs-post -->
			<?php }
			do_action( 'dlstrs_search_nav' );
		} else { ?>
			<div class="dlstrs-no-content">
				<h1 class="dlstrs-title">
					<?php _e( 'Nothing Found', 'daily-stories' ); ?>
				</h1><!--.dlstrs-title-->
				<?php get_search_form(); ?>
			</div><!-- dlstrs-no-content -->
		<?php } ?>
	</div><!-- .dlstrs-content -->
<?php get_sidebar();
get_footer();
