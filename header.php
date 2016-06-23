<?php
/**
 * The template for displaying a header
 *
 * @subpackage Daily Stories
 * @since      Daily Stories 1.0
 */
?>
<!DOCTYPE HTML>
<!--[if IE 7]>
<html class="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="dlstrs-wrapper">
	<header class="dlstrs-site-header">
		<div class="dlstrs-shadowheader">
			<div class="dlstrs-container-header">
				<div class="dlstrs-logo-search">
					<div class="dlstrs-logo">
						<h1 class="dlstrs-site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h1>
						<p class="dlstrs-description"><?php bloginfo( 'description' ); ?></p><!--.dlstrs-description-->
					</div> <!-- .dlstrs-logo -->
					<?php get_search_form(); ?>
					<div class="clear"></div><!--.clear-->
				</div> <!-- .dlstrs-logo-search -->
				<nav class="dlstrs-site-navigation main-navigation">
					<button class="dlstrs-assistive-text"><?php _e( 'Menu', 'daily-stories' ); ?></button><!--.dlstrs-assistive-text-->
					<div class="dlstrs-assistive-text skip-link">
						<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'daily-stories' ); ?>"><?php _e( 'Skip to content', 'daily-stories' ); ?></a>
					</div><!-- .dlstrs-assistive-text skip-link -->
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
				</nav><!-- .dlstrs-site-navigation.main-navigation -->
				<div class="clear"></div><!--.clear-->
			</div> <!-- .dlstrs-container-header -->
			<div class="dlstrs-shadowbreadcrumbs">
				<div class="dlstrs-bread-crumbs">
					<?php do_action( 'dlstrs_the_breadcrumbs' ); ?>
				</div><!-- .dlstrs-bread-crumbs -->
			</div> <!-- .dlstrs-shadowbreadcrumbs -->
		</div> <!-- .dlstrs-shadowheader -->
	</header><!-- .dlstrs-site-header -->
	<div class="dlstrs-container">
