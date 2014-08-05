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

<?php get_sidebar(); ?>
<?php get_footer(); ?>
