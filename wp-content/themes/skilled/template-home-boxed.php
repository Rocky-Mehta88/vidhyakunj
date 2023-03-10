<?php
/**
 * @package WordPress
 * @subpackage Skilled
 *
 * Template Name: Home Boxed
 */
get_header( 'boxed' );
?>
<div class="<?php echo esc_attr( skilled_class( 'main-wrapper' ) ) ?>">
    <div class="<?php echo esc_attr( skilled_class( 'container_home_content' ) ) ?>">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
<?php get_footer( 'boxed' ); ?>
