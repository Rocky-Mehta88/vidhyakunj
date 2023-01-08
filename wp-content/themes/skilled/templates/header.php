<?php 
$header_layout_block = skilled_get_layout_block_content( 'header-layout-block' );
 ?>
<?php if ( $header_layout_block ): ?>
	<div class="<?php echo esc_attr( skilled_class( 'header' ) ) ?>">
		<?php echo do_shortcode( $header_layout_block ); ?>
	</div>
	
<?php else: ?>

	<?php
		$use_top_bar            = skilled_get_option( 'top-bar-use', false );
		$use_top_bar_additional = skilled_get_option( 'top-bar-additional-use', false );
		$logo_location          = skilled_get_option( 'logo-location', 'main_menu' );
		$use_logo               = $logo_location == 'main_menu' ? true : false;
	?>
	<header class="<?php echo esc_attr( skilled_class( 'header' ) ) ?>">
		<?php if ( $use_top_bar ): ?>
			<?php get_template_part( 'templates/top-bar' ); ?>
		<?php endif; ?>
		<?php if ( $use_top_bar_additional ): ?>
			<?php get_template_part( 'templates/top-bar-additional' ); ?>
		<?php endif; ?>
		<div class="<?php echo esc_attr( skilled_class( 'main-menu-bar-wrapper' ) ) ?>">
			<div class="<?php echo esc_attr( skilled_class( 'container' ) ) ?>">
				<?php if ( $use_logo ): ?>
					<div class="<?php echo esc_attr( skilled_class( 'logo-wrapper' ) ) ?>">
						<?php get_template_part( 'templates/logo' ); ?>
					</div>
				<?php endif; ?>
				<?php get_template_part( 'templates/logo-sticky' ); ?>
				<div class="<?php echo esc_attr( skilled_class( 'main-menu-wrapper' ) ) ?>">
					<?php get_template_part( 'templates/menu-main' ); ?>
				</div>
			</div>
		</div>
	</header>

<?php endif; ?>
