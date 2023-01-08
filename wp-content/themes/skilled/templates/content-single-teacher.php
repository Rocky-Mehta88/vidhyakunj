<?php while ( have_posts() ) : the_post(); ?>
	<div <?php post_class(); ?>>
		<?php the_content(); ?>
	</div>
<?php endwhile; ?>
