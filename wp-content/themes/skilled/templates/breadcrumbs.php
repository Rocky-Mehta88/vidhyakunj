<?php $is_search_courses = function_exists( 'skilled_is_search_courses' ) && skilled_is_search_courses() ? true : false; ?>

<?php if ( ! $is_search_courses && function_exists( 'breadcrumb_trail' ) ): ?>
	<div class="<?php echo esc_attr( skilled_class( 'breadcrumbs' ) ) ?>">
		<?php breadcrumb_trail( array( 'show_browse' => false ) ); ?>
	</div>
<?php endif; ?>
