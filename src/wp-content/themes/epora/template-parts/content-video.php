<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package epora
 */

$epora_video_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;

if ( is_single() ): 
?>
    
<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-video mb-60 transition-3' );?>>

    <?php if ( has_post_thumbnail() ): ?>
    <div class="postbox__thumb postbox__video p-relative w-img mb-30">
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </a>
        <?php if(!empty($epora_video_url)) : ?>
        <a href="<?php print esc_url( $epora_video_url );?>" class="play-btn popup-video"><i class="fas fa-play"></i></a>
        <?php endif; ?>
    </div>
    <?php endif;?>
    
    <div class="postbox__content">
        <!-- blog meta -->
        <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

        <h3 class="postbox__title">
            <?php the_title();?>
        </h3>

        <div class="postbox__text">
               <?php the_content();?>
                <?php
                    wp_link_pages( [
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'epora' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ] );
                ?>
        </div>

        <div class="tp-blog-details-tag">
            <?php print epora_get_tag();?>
        </div>

    </div>

</article>

<?php else: ?>
    
<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-video mb-60 transition-3' );?>>

    <?php if ( has_post_thumbnail() ): ?>
    <div class="postbox__thumb postbox__video p-relative w-img mb-30">
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </a>
        <?php if(!empty($epora_video_url)) : ?>
        <a href="<?php print esc_url( $epora_video_url );?>" class="play-btn popup-video"><i class="fas fa-play"></i></a>
        <?php endif; ?>
    </div>
    <?php endif;?>

    <div class="postbox__content">
        <!-- blog meta -->
        <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

        <h3 class="postbox__title">
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
        </h3>

        <div class="postbox__text">
            <?php the_excerpt();?>
        </div>

        <!-- blog btn -->
        <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>

    </div>
    
</article>

<?php
endif;?>


