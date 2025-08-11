<?php
$post_id = get_the_ID();
$args = array(
    'posts_per_page' => absint( epcl_get_option('related_posts_limit', 4) ),
    'category__in' => wp_get_post_categories($post_id),
    'post__not_in' => array($post_id),
    'post_type' => 'post',
    'order' => 'DESC',
);
$query_related = new WP_Query( $args );
?>
<?php if( $query_related->have_posts() ): ?>    
    <section class="related medium-section np-bottom" id="epcl-related-stories">
        <h3 class="title medium bordered absolute-border gray-border"><span><?php esc_html_e('Related Articles', 'wavy'); ?></span><svg class="decoration"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#title-decoration"></use></svg></h3>
        <div class="epcl-row epcl-flex">                        
            <?php while( $query_related->have_posts() ): $query_related->the_post(); ?>
                <?php
                    $post_id = get_the_ID();
                    $size = 'medium';
                    $thumb_url = get_the_post_thumbnail_url($post_id, $size);
                ?>
                <article <?php post_class('item epcl-flex'); ?>>
                <?php if( $thumb_url ): ?>
                        <a href="<?php the_permalink(); ?>" class="thumb epcl-loader translate-effect">
                            <span class="screen-reader-text"><?php the_title(); ?></span>
                            <?php if( epcl_is_amp() ): ?>
                                <amp-img class="cover" layout="fill" src="<?php echo esc_url($thumb_url); ?>"></amp-img>
                            <?php else: ?>
                                <?php if( epcl_get_option('enable_lazyload') == '1' ): ?>
                                    <img class="fullimage cover lazy" src="<?php echo epcl_placeholder(); ?>" data-src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title(); ?>">
                                <?php else: ?>
                                    <img class="fullimage cover" src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                    <div class="info">
                        <h4 class="title usmall underline-effect"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="meta small">
                            <time datetime="<?php the_time('Y-m-d'); ?>"><span class="dot small"></span><?php the_time( get_option('date_format') ); ?></time>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>                 
        </div>
        <div class="clear"></div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>