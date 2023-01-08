<?php
/**
 */
$boxed = skilled_get_option( 'single-post-is-boxed', false ) ? 'boxed' : null;

get_header( $boxed );
?>
<?php get_template_part( 'templates/title' ); ?>
<div class="<?php echo esc_attr( skilled_class('main-wrapper') ) ?>">
	<div class="<?php echo esc_attr( skilled_class('container') ) ?>">
		<div class="<?php echo esc_attr( skilled_class('content-fullwidth') ) ?>">
			<?php get_template_part( 'templates/content-single-teacher' ); ?>
		</div>
	</div>
</div>
<?php get_footer( $boxed ); ?>
