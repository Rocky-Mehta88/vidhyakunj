<?php
$top_bar_additional_text = skilled_get_option( 'top-bar-additional-text', '' );
$logo_location           = skilled_get_option( 'logo-location', 'main_menu' );
$use_logo                = $logo_location == 'top_bar_additional' ? true : false;
 ?>
<div class="<?php echo esc_attr( skilled_class( 'top-bar-additional' ) ) ?>">
	<div class="<?php echo esc_attr( skilled_class( 'container' ) ) ?>">
		<?php if ( $use_logo ): ?>
			<div class="<?php echo esc_attr( skilled_class( 'logo-wrapper' ) ) ?>">
				<?php get_template_part( 'templates/logo' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( $top_bar_additional_text ): ?>
			<div class="<?php echo esc_attr( skilled_class( 'top-bar-additional-text' ) ) ?>">
				<?php echo do_shortcode( $top_bar_additional_text ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
