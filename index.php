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
In the index page we just want to display 'Apps' blogposts.
Watch out, this alters the main query so we are going to have to clean
up after by makin a call to wp_reset_query().

FIXME: This is not the best approach, see: http://codex.wordpress.org/Function_Reference/query_posts
	"It should be noted that using this to replace the main query on a page can increase page loading times,
	in worst case scenarios more than doubling the amount of work needed or more. 
	While easy to use, the function is also prone to confusion and problems later on. 
	For general post queries, use WP_Query or get_posts"
*/
if (is_home() && !is_paged()){
	query_posts( array( 'category__in' => array(5,15), 'posts_per_page' => 1, 'showposts' => -1 ) );
}
?>

		<header id="secondheader" class="site-second-header" role="banner">
			<div class="floater"></div>
			<div class="title">
				The home of Kosovo's open data
			</div>
			<div class="subtitle">
				Here you will find data and resources to conduct research, develop web and mobile applications, design data visualisation, and more.
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
				<h5 class="topics-browser-header">Browse Apps</h5>
				<hr/>
				<?php /* Start the Loop */ ?>
				<div class="topic-container">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if( in_category( '5') ) : ?>
						<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */

							get_template_part( 'content', 'home' );
						?>
					<?php endif; ?>
				<?php endwhile; ?>
				</div>
				<?php /* Now let's show the blogpost/article posts */ ?>
				<?php if ( have_posts() ) : ?>
				<h5 class="topics-browser-header" style="padding-top:100px">Browse Articles</h5>
				<hr/>
				<?php /* Start the Loop */ ?>
				<div class="topic-container">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if( in_category( '15') ) : ?>
						<?php
							/* Include the Post-Format-specific template for the content.
						 	* If you want to overload this in a child theme then include a file
						 	* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 	*/
							get_template_part( 'content', 'home' );
						?>
					<?php endif; ?>
				<?php endwhile; ?>
				</div>
				<?php spun_content_nav( 'nav-below' ); ?>

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

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
