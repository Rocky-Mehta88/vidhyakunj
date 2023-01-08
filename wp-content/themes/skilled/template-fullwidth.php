<?php
/**
 * @package WordPress
 * @subpackage Skilled
 *
 * Template Name: Full Width
 */
get_header();
?>
<?php get_template_part( 'templates/title' ); ?>
<div class="<?php echo esc_attr( skilled_class( 'main-wrapper' ) ) ?>">
	<div class="<?php echo esc_attr( skilled_class( 'container' ) ) ?>">
		<div class="<?php echo esc_attr( skilled_class( 'content-fullwidth' ) ) ?>">
			<?php get_template_part( 'templates/content-page' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
