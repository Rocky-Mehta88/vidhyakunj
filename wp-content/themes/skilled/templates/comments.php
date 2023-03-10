<?php
if ( post_password_required() ) {
	return;
}

if ( have_comments() ) : ?>
	<section id="comments">
		<h3><?php printf( _n( 'One Response to &ldquo;%2$s&rdquo;', '%1$s Responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'skilled' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?></h3>
		<hr class="wh-separator" />
		<ul class="comment-list">
			<?php wp_list_comments( array( 'walker' => new Skilled_Walker_Comment ) ); ?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav>
				<ul class="pager">
					<?php if ( get_previous_comments_link() ) : ?>
						<li class="previous"><?php previous_comments_link( esc_html__( '&larr; Older comments', 'skilled' ) ); ?></li>
					<?php endif; ?>
					<?php if ( get_next_comments_link() ) : ?>
						<li class="next"><?php next_comments_link( esc_html__( 'Newer comments &rarr;', 'skilled' ) ); ?></li>
					<?php endif; ?>
				</ul>
			</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<div class="alert alert-warning">
				<?php esc_html_e( 'Comments are closed.', 'skilled' ); ?>
			</div>
		<?php endif; ?>
	</section><!-- /#comments -->
<?php endif; ?>

<?php if ( ! have_comments() && ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<section id="comments">
		<div class="alert alert-warning">
			<?php esc_html_e( 'Comments are closed.', 'skilled' ); ?>
		</div>
	</section><!-- /#comments -->
<?php endif; ?>

<?php if ( comments_open() ) : ?>
	<?php 
	if ( ! is_user_logged_in() ) {
	    add_filter( 'comment_form_fields', function ( $fields ) {
	        $item = $fields['comment'];
	        unset( $fields['comment'] );
	        array_push( $fields, $item );
	        return $fields;
	    });
	}
	?>
	<?php comment_form(); ?>
<?php endif; ?>