<?php
if ( ! function_exists( 'Sensei' ) ) {
	return;
}
?>
<form action="<?php echo esc_url( site_url( '/' ) ); ?>" method="get" id="searchform" class="course-searchfrom-small input-only">
	<input type="text" value="<?php if ( skilled_is_search_courses() ) { echo esc_attr( get_search_query() ); } ?>" name="s" placeholder="<?php esc_html_e( 'Search Courses', 'skilled' ); ?>"/>
	<input type="hidden" name="search-type" value="courses"/>
</form>
