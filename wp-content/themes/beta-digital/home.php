<?php
get_header();

$argsCat = array(
	'hide_title_if_empty' => true,
)
?>

<section <?php post_class('blog') ?>>
    <div class="container blog__container">
        <div class="blog__posts">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" class="blog__article">
					<?php if (has_post_thumbnail()) : ?>
					<figure class="blog__image">
						<a class="blog__link" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail() ?>
						</a>
					</figure>
					<?php endif; ?>

					<div class="blog__content">
						<time 
							class="blog__date" 
							datetime="<?php echo get_the_date( 'Y-d-m' ) ?> <?php the_time( 'H:i:s' ) ?>">
							<?php echo get_the_date( 'j M Y' ) ?>
						</time> 
						<a class="blog__link" href="<?php the_permalink(); ?>">
							<h2 class="blog__title"><?php the_title() ?></h2>
							<p class="blog__excerpet"><?php echo getExcerpt(200, $post->ID) ?></p>
						</a>
					</div>
				</article>
			<?php endwhile; endif; ?>
            
        </div>

        <?php get_template_part( 'template-parts/blog/blog-sidebar', null ); ?>
		
    </div>
	<?php
	the_posts_pagination( array(
		'prev_text' => __( '<', 'textdomain' ),
		'next_text' => __( '>', 'textdomain' ),
	) );
	?>
</section>

<?php
get_footer();
?>