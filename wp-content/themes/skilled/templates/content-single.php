<?php while ( have_posts() ) : the_post(); ?>
	<div <?php post_class(); ?>>
		<?php get_template_part( 'templates/entry-meta' ); ?>
		<div class="thumbnail">
			<?php echo wp_kses_post( skilled_get_thumbnail( array( 'thumbnail' => 'wh-featured-image' ) ) ); ?>
		</div>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<div>
			<?php wp_link_pages( array(
				'before' => '<nav class="page-nav"><p>' . esc_html__( 'Pages:', 'skilled' ),
				'after'  => '</p></nav>'
			) ); ?>
			<div class="prev-next-item">
				<div class="left-cell">
					<p class="label"><?php esc_html_e( 'Previous', 'skilled' ) ?></p>
					<?php previous_post_link( '<i class="'. esc_attr( apply_filters( 'skilled_icon_class', 'previous_post_link' ) ) .'"></i> %link ', '%title', false ); ?>
				</div>
				<div class="right-cell">
					<p class="label"><?php esc_html_e( 'Next', 'skilled' ) ?></p>
					<?php next_post_link( '%link <i class="'. esc_attr( apply_filters( 'skilled_icon_class', 'next_post_link' ) ) .'"></i> ', '%title', false ); ?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<?php if ( skilled_get_option( 'archive-single-use-share-this', false ) ): ?>
			<?php do_action( 'social_share_icons' ); ?>
		<?php endif; ?>
		
		<?php comments_template( '/templates/comments.php' ); ?>
	</div>
<?php endwhile; ?>
