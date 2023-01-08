<?php global $post_id; ?>
<?php $post_class = skilled_class( 'post-item' ); ?>
<div <?php echo post_class( $post_class ) ?>>
	<div class="one whole">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <hr class="wh-separator"/>
        <?php if ( has_post_thumbnail() ): ?>
			<div class="thumbnail">
				<?php echo wp_kses_post( skilled_get_thumbnail( array( 'thumbnail' => 'wh-featured-image', 'link' => true ) ) ); ?>
			</div>
        <?php endif ?>
	</div>
	<div class="item one whole">
		<?php get_template_part( 'templates/entry-meta' ); ?>
		<div class="entry-summary"><?php echo wp_kses_post( strip_shortcodes( get_the_excerpt() ) ); ?></div>
		<a class="wh-button read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'read more', 'skilled' ); ?></a>
	</div>
</div>
