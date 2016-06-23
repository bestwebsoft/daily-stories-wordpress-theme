<?php
/**
 * The template file index
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
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h1><!--.dlstrs-title-->
					<div class="dlstrs-data-categ">
						<div class="dlstrs-data">
							<a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
						</div><!--.dlstrs-data-->
						<?php if ( has_category() ) { ?>
							<div class="dlstrs-category"><em><?php printf( __( 'in', 'daily-stories' ) . '&nbsp;' );
									the_category( ', ' ); ?></em></div><!--.dlstrs-category-->
						<?php } ?>
					</div><!--.dlstrs-data-categ-->
					<?php edit_post_link( __( 'Edit', 'daily-stories' ), '<div class="dlstrs-edit-link">', '</div>' );
					if ( has_post_thumbnail() ) { ?>
						<div class="wp-caption alignnone">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dlstrs_featured_image' ); ?></a>
							<?php do_action( 'dlstrs_the_post_thumbnail_caption' ); ?>
						</div><!-- .wp-caption alignnone-->
					<?php }
					the_content();
					wp_link_pages( array(
						'before'      => '<div class="dlstrs-page-links"><span class="dlstrs-page-links-title">' . __( 'Pages:', 'daily-stories' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
					if ( has_tag() ) { ?>
						<div class="dlstrs-container-tags">
							<div class="dlstrs-tag-box">
								<em><?php echo get_the_tag_list(); ?></em>
							</div><!--.dlstrs-tag-box-->
						</div><!--.dlstrs-container-tags-->
					<?php } ?>
					<div class="clear"></div><!--.clear-->
				</div><!-- .dlstrs-post -->
			<?php } ?>
			<div class="dlstrs-navigation">
				<div class="dlstrs-older-posts">
					<?php next_posts_link( __( 'Previous posts', 'daily-stories' ) ); ?>
				</div><!-- .dlstrs-older-posts -->
				<div class="dlstrs-newer-posts">
					<?php previous_posts_link( __( 'Next posts', 'daily-stories' ) ); ?>
				</div><!-- .dlstrs-newer-posts -->
			</div><!-- .dlstrs-navigation -->
		<?php } else { ?>
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
