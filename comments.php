<?php
/**
 * The template for displaying Comments
 *
 * @subpackage Daily Stories
 * @since      Daily Stories 1.0
 */
if ( post_password_required() ) {
	return;
} ?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) { ?>
		<h2 class="comments-title">
			<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'daily-stories' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
		</h2><!-- .comments-title -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav class="dlstrs-comment-navigation">
				<div class="dlstrs-older-comm"><?php previous_comments_link( __( 'Previous comments', 'daily-stories' ) ); ?>
				</div><!-- .dlstrs-older-comm -->
				<div class="dlstrs-newer-comm"><?php next_comments_link( __( 'Next comments', 'daily-stories' ) ); ?>
				</div><!-- .dlstrs-newer-comm -->
			</nav><!-- .dlstrs-comment-navigation -->
		<?php } ?>
		<ol class="comment-list">
			<?php wp_list_comments( array( 'callback' => 'dlstrs_comment' ) ); ?>
		</ol><!-- .comment-list -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav class="dlstrs-comment-navigation">
				<div class="dlstrs-older-comm"><?php previous_comments_link( __( 'Previous comments', 'daily-stories' ) ); ?>
				</div><!-- .dlstrs-older-comm -->
				<div class="dlstrs-newer-comm"><?php next_comments_link( __( 'Next comments', 'daily-stories' ) ); ?>
				</div><!-- .dlstrs-newer-comm -->
			</nav><!-- .dlstrs-comment-navigation -->
		<?php }
		if ( ! comments_open() && get_comments_number() ) { ?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'daily-stories' ); ?></p><!-- .no-comments -->
		<?php }
	}
	comment_form(); ?>
</div><!-- #comments -->
