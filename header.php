<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Spun
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<?php
	/**
	 * Print out a sub header.
	 * The sub header displays the title of the page/post and the meta description.
	 **/
	function render_sub_header(){
	
		$meta_description = WPSEO_Meta::get_value('metadesc', get_the_ID());

		$output = '<header id="secondheader" class="site-second-header" role="banner">';
		$output .= 	'<div class="floater"></div>';
		$output .=	'<div class="title">';
		$output .=		get_the_title();
		$output .=	'</div>';
		$output .=	'<div class="subtitle">';
		$output .=		$meta_description;
		$output .=	'</div>';
		$output .= '</header>';

		echo $output;
	}
?>

<?php
	// Here we call body_class() and assign the echo into a variable so that we can str replace a styling class in it.
	// Hacky, yes, but we don't want to change functions that are outside of the theme.
	ob_start();
	body_class();
	$body_class = ob_get_clean();
	$body_class = str_replace('page ', 'home ', $body_class);
?>

<body <?php echo $body_class; ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrapper">
			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
				</a>
			<?php } // if ( ! empty( $header_image ) ) ?>
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
		</div>
		<nav role="navigation" class="site-navigation main-navigation">
			<h1 class="screen-reader-text"><?php _e( 'Menu', 'spun' ); ?></h1>
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'spun' ); ?>"><?php _e( 'Skip to content', 'spun' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- .site-navigation .main-navigation -->
	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">
