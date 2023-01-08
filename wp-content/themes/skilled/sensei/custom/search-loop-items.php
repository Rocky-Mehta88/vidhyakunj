<?php while ( $results->have_posts() ) : $results->the_post(); ?>
	<?php $category_output = get_the_term_list( get_the_ID(), 'course-category', '', ', ', '' ); ?>
	<article class="course type-course">
		<?php echo wp_kses_post( skilled_get_thumbnail( array( 'thumbnail' => 'wh-course-search-thumb', 'link' => true ) ) ); ?>
		<header>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry">
			<p class="sensei-course-meta">
				<span class="course-author"><?php esc_html_e( 'by', 'skilled' ); ?> <?php echo get_the_author(); ?></span>
				<span class="course-lesson-count"><?php echo (int) $woothemes_sensei->post_types->course->course_lesson_count( get_the_ID() ); ?> <?php esc_html_e( 'lessons', 'skilled' ); ?></span>
				<?php if ( '' != $category_output ) : ?>
					<span class="course-category"><?php echo wp_kses_post( $category_output ); ?></span>
				<?php endif; ?>
				<?php $course_price = skilled_sensei_simple_course_price( get_the_ID() ); ?>
				<?php if ( $course_price ): ?>
					<?php echo wp_kses_post( $course_price ); ?>
				<?php endif; ?>
			</p>
			<?php if ( function_exists( 'skilled_course_print_stars' ) ) : ?>
				<?php global $post; $wc_post_id = get_post_meta( intval( $post->ID ), '_course_woocommerce_product', true ); ?>
				<p class="rating">
					<?php echo wp_kses_post( skilled_course_print_stars( $wc_post_id, true ) ); ?>
				</p>
			<?php endif ?>
			<p class="course-excerpt"><?php echo wp_kses_post( str_replace( array( '<p>', '</p>' ), '',  get_the_excerpt() ) ); ?></p>
		</div>
	</article>
<?php endwhile; ?>
