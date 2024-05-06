<?php
// Template Name: Single Blog

get_header();
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="single-blog">
        <div class="container">
            <div class="single-blog__container">
                <div class="single-blog__header">
                    <time 
                        class="single-blog__date" 
                        datetime="<?php echo get_the_date( 'Y-d-m' ) ?> <?php the_time( 'H:i:s' ) ?>">
                        <?php echo get_the_date( 'j M Y' ) ?>
                    </time> 

                    <h1 class="title-blog"><?php the_title() ?></h1>
                    <p class="single-blog__subtitle">
                        <?php echo getExcerpt(200, $post->ID) ?>
                    </p>
                </div>
                <div class="single-blog__body">
                    <?php if (has_post_thumbnail()) : ?>
                        <figure class="single-blog__image">
                            <?php the_post_thumbnail() ?>
                        </figure>
                    <?php endif; ?>
                
                    <div class="single-blog__excerpt">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="single-blog__share">
            <div class="container">
                <div class="single-blog__container">
                    <div class="single-blog__category">
                        <span class="single-blog__share-title">Categorias</span>

                        <ul>
                        <?php
                        $post_categories = wp_get_post_categories( get_the_ID() );
                             
                        foreach($post_categories as $c){
                            $cat = get_category( $c );
                            echo '<li><a href="'.get_category_link($c).'">'.$cat->name.'</a></li>';
                        }
                        
                        ?>
                        </ul>
                    </div>

                    <div class="single-blog__shared">
                        <span class="single-blog__share-title">Compartilhe</span>

                        <ul>
                            <li>
                                <a href="<?php echo shareSocial('facebook') ?>">
                                    <?php the_SVG('ico-share-facebook') ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo shareSocial('twitter') ?>">
                                    <?php the_SVG('ico-share-twitter') ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo shareSocial('whatsapp') ?>">
                                    <?php the_SVG('ico-share-whatsapp') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php get_template_part( 'template-parts/blog/more-news', null, array('remove' => get_the_ID()) );  ?>
    </div>
    <?php endwhile; endif;
    get_footer();
    ?>

<?php get_footer(); ?>