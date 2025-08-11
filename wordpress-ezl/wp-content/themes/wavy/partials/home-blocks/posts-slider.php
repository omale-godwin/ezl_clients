<?php
$epcl_module = epcl_get_module_options();
if( empty($epcl_module) ) return; // no data from slider module

add_filter( 'excerpt_length', 'epcl_usmall_excerpt_length', 999 );

$prefix = EPCL_THEMEPREFIX.'_';
$args = array(
	'post_type' => 'post',
	'showposts' => $epcl_module['posts_slider_limit'],
	'suppress_filters' => false,
	'meta_key' => '_thumbnail_id'
);
if( isset($epcl_module['featured_categories']) && $epcl_module['featured_categories'] != '' ){
    $args['cat'] = $epcl_module['featured_categories'];
}
if( isset($epcl_module['excluded_categories']) && $epcl_module['excluded_categories'] != '' ){
    $args['category__not_in'] = $epcl_module['excluded_categories'];
}
$slider = get_posts($args);
$thumbnail_size = 'large';

?>

<?php if( !empty($slider) ): ?>
    <section class="epcl-slider grid-container" data-aos="fade" id="epcl-slider">

        <div class="epcl-column-container epcl-flex">
            <!-- start: .slick-slider -->
            <div class="slick-slider grid-60 grid-parent np-mobile" data-show="1" data-rtl="<?php echo is_rtl(); ?>">       
                <?php foreach($slider as $post): setup_postdata($post); ?>
                    <?php                
                        $post_meta = get_post_meta( $post->ID, 'epcl_post', true );
                        $image_id = get_post_thumbnail_id($post->ID);
                        $image_alt = $image_url = '';
                        if($image_id){
                            $thumb = wp_get_attachment_image_src( $image_id, $thumbnail_size );
                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
                            $image_url = $thumb[0];
                        }
                        $optimized_image = '';
                        if( defined('EPCL_PLUGIN_PATH') && !empty($post_meta) ){
                            if( isset( $post_meta['optimized_image_slider'] ) && $post_meta['optimized_image_slider']['url'] != '' ){
                                $optimized_image = $post_meta['optimized_image_slider'];
                            }                    
                            if( isset($optimized_image['alt']) && $optimized_image['alt'] != ''){
                                $image_alt = $optimized_image['alt'];
                            }                         
                            if( !empty($optimized_image) ){
                                $image_url = $optimized_image['url'];
                            }
                        }                
                        if( !$image_alt ){
                            $image_alt = get_the_title();
                        }
                        
                    ?>
                        <div class="item slick-slide">
                            <article>
                                <a href="<?php the_permalink(); ?>" class="thumb epcl-loader">                                        
                                    <img class="fullwidth img" src="<?php echo epcl_placeholder(); ?>" data-lazy="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">                  
                                </a>
                            </article>
                        </div>
                <?php endforeach; wp_reset_postdata(); ?>                       
            </div>
            <!-- end: .slick-slider -->
            <!-- start: .slider-index -->
            <div class="grid-40 slider-index">
                <?php $index = 0; foreach($slider as $post): setup_postdata($post); ?>
                    <article class="item" data-index="<?php echo absint($index); ?>">
                        <span class="count"><?php echo absint($index+1); ?></span>
                        <h2 class="main-title title medium underline-effect"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="toggle">
                            <?php the_excerpt(); ?>
                            <div class="meta">
                                <?php if( $epcl_module['enable_author'] ): ?>
                                    <?php get_template_part('partials/meta-info/author'); ?>
                                <?php endif; ?>
                                <?php if( epcl_get_option('enable_global_date') !== '0' ): ?>
                                    <div class="epcl-inline hide-on-desktop-sm">
                                        <?php get_template_part('partials/meta-info/date'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="full-link"><span class="screen-reader-text"><?php the_title(); ?></span></a>
                    </article>       
                    <div class="border"></div>                     
                <?php $index++; endforeach; wp_reset_postdata(); ?> 
            </div>
            <!-- end: .slider-index -->
            <div class="clear"></div>       
        </div>

    </section>
<?php endif; ?>