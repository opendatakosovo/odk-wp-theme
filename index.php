<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spun
 */

get_header(); ?>

<?php
/*
In the index page we just want to display 'Topic' blogposts.
Watch out, this alters the main query so we are going to have to clean
up after by makin a call to wp_reset_query().

FIXME: This is not the best approach, see: http://codex.wordpress.org/Function_Reference/query_posts
	"It should be noted that using this to replace the main query on a page can increase page loading times,
	in worst case scenarios more than doubling the amount of work needed or more. 
	While easy to use, the function is also prone to confusion and problems later on. 
	For general post queries, use WP_Query or get_posts"
*/
if (is_home() && !is_paged()){
	query_posts( 'cat=4' );
}
?>

		<header id="secondheader" class="site-second-header" role="banner">
			<div class="floater"></div>
			<div class="title">
				The home of Kosovo's open data
			</div>
			<div class="subtitle">
				Hear you will find data and resources to conduct research, develop web and mobile applications, design data visualisation, and more.
			</div>
		</header>

		<!-- Enable this when we finally have lots of datasets --!>
		<!--header id="thirdheader" class="site-third-header" role="banner">
			<div class="title">
				Get Started
			</div>
			<div class="subtitle">
				Search over 1,000 datasets
			</div>
		</header-->

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
			<?php if ( is_home() && ! is_paged() ) : ?>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif; ?>
			<?php if ( have_posts() ) : ?>
				<h5 class="topics-browser-header">Browse Topics</h5>
				<hr/>
				<?php /* Start the Loop */ ?>
	
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'home' );
					?>

				<?php endwhile; ?>

				<?php spun_content_nav( 'nav-below' ); ?>

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php
if (is_home() && !is_paged()){
	// We altered the main query so we are going to have to clean up by making a call to wp_reset_query().
	wp_reset_query();
}
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
