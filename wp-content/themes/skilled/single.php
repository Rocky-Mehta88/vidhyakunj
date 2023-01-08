<?php
/**
 * @package WordPress
 * @subpackage Skilled
 */
$blog_single_layout       = apply_filters( 'skilled_filter_single_is_boxed', skilled_get_option( 'blog-single-layout', 'default' ) );
$blog_single_is_boxed     = $blog_single_layout == 'boxed' || $blog_single_layout == 'boxed-fullwidth';

$blog_single_is_fullwidth = $blog_single_layout == 'fullwidth' 
								|| $blog_single_layout == 'boxed-fullwidth'
								|| ! is_active_sidebar( 'wheels-sidebar-primary' );

$content_class = $blog_single_is_fullwidth ? 'content-fullwidth' : 'content';
$boxed         = $blog_single_is_boxed ? 'boxed' : null;

$blog_sidebar_left = skilled_get_option( 'single-post-sidebar-left', false );

get_header( $boxed );
?>
<?php get_template_part( 'templates/title' ); ?>
<div class="<?php echo esc_attr( skilled_class( 'main-wrapper' ) ) ?>">
	<div class="<?php echo esc_attr( skilled_class( 'container' ) ) ?>">
		<?php if ( $blog_sidebar_left ): ?>
			<?php if ( ! $blog_single_is_fullwidth ) : ?>
				<div class="<?php echo esc_attr( skilled_class( 'sidebar' ) ) ?>">
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
			<div class="<?php echo esc_attr( skilled_class( $content_class ) ) ?>">
				<?php get_template_part( 'templates/content-single' ); ?>
			</div>
		<?php else: ?>
			<div class="<?php echo esc_attr( skilled_class( $content_class ) ) ?>">
				<?php get_template_part( 'templates/content-single' ); ?>
			</div>
			<?php if ( ! $blog_single_is_fullwidth ) : ?>
				<div class="<?php echo esc_attr( skilled_class( 'sidebar' ) ) ?>">
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>
<?php get_footer( $boxed ); ?>
