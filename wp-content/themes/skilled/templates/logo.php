<?php
$logo_url   = skilled_get_logo_url();
$logo_width = skilled_get_option( 'logo-width-exact', '' );

if ( $logo_width && isset( $logo_width['width'] ) ) {
	$logo_width = (int) $logo_width['width'] ? (int) $logo_width['width'] : '';
}
?>
<?php if ( $logo_url ): ?>
	<div class="<?php echo esc_attr( skilled_class( 'logo' ) ) ?>" style="margin-bottom: 10px;">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img width="<?php echo esc_attr( $logo_width ); ?>" src="http://vidhyakunj.org/wp-content/uploads/2020/05/vidhyakunj-logo2.png" alt="<?php esc_attr_e( 'Logo', 'skilled' ); ?>">
		</a>
	</div>
<?php else: ?>
	<div class="<?php echo esc_attr( skilled_class( 'logo' ) ) ?>">
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</div>
<?php endif; ?>
