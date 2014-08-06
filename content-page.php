<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Spun
 */
?>

<?php
	// Here we call post_class() and assign the echo into a variable so that we can str replace a styling class in it.
	// Hacky, yes, but we don't want to change functions that are outside of the theme.
	ob_start();
	post_class();
	$post_class = ob_get_clean();
	$post_class = str_replace(' hentry', ' page-hentry', $post_class);
?>

<header id="secondheader" class="site-second-header" role="banner">
	<div class="floater"></div>
	<div class="title">
		<?php the_title(); ?>
	</div>
	<div class="subtitle">
		<?php echo WPSEO_Meta::get_value('metadesc', get_the_ID()); // Requires Yoast's Wordpress SEO?>
	</div>
</header>

<article id="post-<?php the_ID(); ?>" <?php $post_class; ?>>
	<!--
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	--><!-- .entry-header -->
	
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span class="active-link">', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	

	<footer class="entry-meta">
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link">
				<a href="#comments-toggle">
					<span class="tail"></span>
					<?php echo comments_number( __( '+', 'spun' ), __( '1', 'spun' ), __( '%', 'spun' ) ); ?>
				</a>
			</span>
		<?php endif; ?>

		<div class="entry-meta-wrapper">
			<?php edit_post_link( __( 'Edit', 'spun' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
