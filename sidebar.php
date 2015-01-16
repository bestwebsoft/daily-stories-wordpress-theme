<?php 
/**
 * The template for displaying a sidebar
 *
 * @subpackage Daily Stories
 * @since Daily Stories 1.0
 */ 
?>
<div class="dlstrs-right-sidebar">
	<?php $args = array(
		'before_widget'	=> '<aside class="dlstrs-widget">',
		'after_widget'	=> '</aside>',
	);
	if ( is_active_sidebar( 'right_sidebar' ) ) { 
			dynamic_sidebar( 'right_sidebar' ); 
		} 
	else {
		the_widget( 'WP_Widget_Recent_Posts', false, $args );
		the_widget( 'WP_Widget_Recent_Comments', false, $args );
		the_widget( 'WP_Widget_Archives', false, $args );
	} ?>
</div><!-- .dlstrs-right-sidebar --> 