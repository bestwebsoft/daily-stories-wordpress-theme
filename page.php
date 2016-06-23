<?php
/**
 * The template page
 *
 * @subpackage Daily Stories
 * @since      Daily Stories 1.0
 */
get_header(); ?>
	<div class="dlstrs-content">
		<?php if ( have_posts() ) {
			the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class( 'dlstrs-post' ); ?>>
				<header class="entry-header">
					<h1 class="dlstrs-title">
						<?php if ( ! is_singular() ) { ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php } else {
							the_title();
						} ?>
					</h1><!--.dlstrs-title-->
				</header><!--.entry-header-->
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!--.entry-content-->
				<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'daily-stories' ), '<span class="dlstrs-edit-link">', '</span>' ); ?>
				</footer><!--.entry-meta-->
				<?php wp_link_pages( array(
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
			<div class="dlstrs-comments">
				<?php comments_template(); ?>
			</div><!-- .dlstrs-comments -->
		<?php } ?>
	</div><!-- .dlstrs-content -->
<?php get_sidebar();
get_footer();
