<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php if ( function_exists( 'get_sensei_header' ) ): ?>
	<?php get_sensei_header(); ?>
<?php endif ?>
<article <?php post_class( array( 'course', 'post' ) ); ?>>
    <section class="course-content">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
    </section>
	<div class="modules-and-lessons">
    	<?php do_action( 'sensei_single_course_content_inside_after', get_the_ID() ); ?>
	</div>
</article>
<?php if ( function_exists( 'get_sensei_footer' ) ): ?>
	<?php get_sensei_footer();  // has to be printed last ?>
<?php endif ?>
