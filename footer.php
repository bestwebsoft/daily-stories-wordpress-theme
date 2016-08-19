<?php
/**
 * The template for displaying a footer
 *
 * @subpackage Daily Stories
 * @since      Daily Stories 1.0
 */
?>
<div class="clear"></div><!--.clear-->
</div> <!-- .dlstrs-container -->
<footer class="dlstrs-site-footer">
	<?php if ( is_active_sidebar( 'footer_sidebar' ) ) { ?>
		<div class="dlstrs-sidebarfooter">
			<div class="dlstrs-containers-of-widgets">
				<?php dynamic_sidebar( 'footer_sidebar' ); ?>
				<div class="clear"></div><!--.clear-->
			</div><!-- .dlstrs-containers-of-widgets -->
		</div><!-- .dlstrs-sidebarfooter -->
	<?php } ?>
	<div class="dlstrs-bottom">
		<div class="dlstrs-copyright">
			<p><?php echo __( 'Designed with love by', 'daily-stories' ) . '&nbsp;'; ?>
				<a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>">BestWebLayout</a><?php echo '&nbsp;' . __( 'and', 'daily-stories' ) . '&nbsp;'; ?>
				<a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" target="_blank">WordPress</a><?php echo '&nbsp;&copy;&nbsp;' . date( 'Y' ) . '&nbsp;'; ?>
				<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></p>
		</div><!-- .dlstrs-copyright -->
	</div><!-- .dlstrs-bottom -->
</footer><!-- .dlstrs-site-footer -->
</div> <!-- .dlstrs-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
