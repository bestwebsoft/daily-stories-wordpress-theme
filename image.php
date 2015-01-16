<?php
/**
 * The template for displaying image attachments
 *
 * @subpackage Daily Stories
 * @since Daily Stories 1.0
 */
$metadata = wp_get_attachment_metadata(); // Retrieve attachment metadata.
get_header(); ?> 
	<div class="dlstrs-content">
		<?php if ( have_posts() ) { the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class( 'dlstrs-post' ); ?>>
				<h1 class="dlstrs-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h1><!--.dlstrs-title-->
				<div class="dlstrs-image-meta">
					<span class="dlstrs-image-data"><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span><!--.dlstrs-image-data-->
					<span class="dlstrs-full-size-link"><a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" target="_blank"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a></span><!--.dlstrs-full-size-link-->
					<span class="dlstrs-parent-post-link"><a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span><!--.dlstrs-parent-post-link-->
					<?php edit_post_link( __( 'Edit', 'dlstrs' ), '<span class="dlstrs-edit-link">', '</span>' ); ?>
				</div><!-- .dlstrs-image-meta -->
				<div class="dlstrs-image-attachment">
					<div class="dlstrs-attachment">
						<?php do_action( 'dlstrs_the_attached_image' ); ?>
					</div><!-- .dlstrs-attachment -->
					<?php if ( has_excerpt() ) : ?>
						<div class="dlstrs-caption">
							<?php the_excerpt(); ?>
						</div><!-- .dlstrs-caption -->
					<?php endif; ?>
				</div><!-- .dlstrs-image-attachment -->
				<div class="clear"></div><!--.clear-->
				<?php the_content();
				wp_link_pages( array(
					'before'      => '<div class="dlstrs-page-links"><span class="dlstrs-page-links-title">' . __( 'Pages:', 'dlstrs' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) ); ?>
				<div class="clear"></div><!--.clear-->
				<div class="dlstrs-navigation">
					<div class="dlstrs-older-image"><?php previous_image_link( false, '' . __( 'Previous', 'dlstrs' ) . '' ); ?></div>
					<div class="dlstrs-newer-image"><?php next_image_link( false, '' . __( 'Next', 'dlstrs' ) . '' ); ?></div>
				</div><!--.dlstrs-navigation-->
				<div class="clear"></div><!--.clear-->
			</div><!-- .dlstrs-post -->
			<div class="dlstrs-comments">
				<?php comments_template(); ?>
			</div><!-- .dlstrs-comments -->
		<?php } ?>
	</div><!-- .dlstrs-content -->
<?php get_sidebar();
get_footer();