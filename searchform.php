<?php 
/**
 * The template for displaying search forms in Daily Stories
 *
 * @subpackage Daily Stories
 * @since Daily Stories 1.0
 */ 
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
	<div class="clear"></div><!--.clear-->
</form><!-- #searchform -->