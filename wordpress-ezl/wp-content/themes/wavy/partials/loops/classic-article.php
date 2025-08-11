<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

$index = absint( get_query_var('index') );
$post_class = $optimized_image = '';
$post_id = get_the_ID();
$post_meta = get_post_meta( $post_id, 'epcl_post', true );
$post_gallery = get_post_meta( $post_id, 'epcl_post_gallery', true );
$post_meta_audio = get_post_meta( $post_id, 'epcl_post_audio', true );
$post_meta_video = get_post_meta( $post_id, 'epcl_post_video', true );

$loop_post_style = 'small-image'; // Small/Vertical image
if( !empty($post_meta) && isset($post_meta['loop_style']) ){
    if( epcl_get_option('classic_loop_style', 'inherit') !== 'inherit' ){
        $post_meta['loop_style'] = epcl_get_option('classic_loop_style', 'inherit');
    }
}
$post_format = get_post_format();
if( defined('EPCL_PLUGIN_PATH') ){
    if( $post_format == 'gallery' || $post_format == 'video' || $post_format == 'audio' ){
        $post_meta['loop_style'] = 'classic-image'; 
    }
}

if( $post_format == 'gallery' && empty($post_gallery) ){
    $post_class .= ' no-thumb';
}

// Get loop style (small image or standard)
if( !empty($post_meta) && isset($post_meta['loop_style']) && $post_meta['loop_style'] != '' ){
    $loop_post_style = $post_meta['loop_style'];
    $post_class .= 'post-style-'.$post_meta['loop_style'];
} 
if( ($post_format !== 'gallery' ) && !has_post_thumbnail() ){
    $optimized_image = '';
    if( defined('EPCL_PLUGIN_PATH') && !empty($post_meta['optimized_image']['url']) && $post_meta['optimized_image']['url'] != ''  ){
        $optimized_image = $post_meta['optimized_image'];
    }
    if( !$optimized_image ){
        $post_class .= ' no-thumb';
    }    
}

set_query_var( 'epcl_post_style', 'classic' );
$post_class .= ( $index % 2 ) ? ' even' : ' odd';
$reading_time = epcl_reading_time( get_the_content() );
if( epcl_get_option('post_title_layout', 'inside_images') == 'below_images' ){
    $post_class.= ' title-below-images';
}

$author_id = get_the_author_meta('ID');
$user_meta = get_user_meta( $author_id, 'epcl_user', true );
$author_avatar = epcl_get_author_avatar($user_meta, $author_id, 120);
$author_name = get_the_author();
$reading_time = epcl_reading_time( get_the_content() );
$enable_author = true;
if( !is_single() && epcl_get_option('classic_display_author', true) == '0'){
    $enable_author = false;
}
if( is_single() && epcl_get_option('enable_author_top', true) == '0'){
    $enable_author = false;
}

// Primary category (optional)
$post_class = epcl_get_primary_category( $post_class, $post_meta, $post_id );

?>

<article <?php post_class('epcl-flex index-'.$index.' '.$post_class); ?>>
     
    <div class="post-format-wrapper">        
        <?php epcl_display_post_format( get_post_format(), $post_id );  ?>
        <?php if( is_sticky() && has_post_thumbnail() ): ?>
            <a href="<?php the_permalink(); ?>" class="access-icon visibility-paid meta-info tooltip" data-title="<?php echo esc_attr__('Featured Article', 'wavy'); ?>">         
                <svg><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#vip"></use></svg>     
                <span class="screen-reader-text"><?php the_title(); ?></span>
            </a>
        <?php endif; ?>
        <?php
            if( function_exists('epcl_render_views_counter') ){
                epcl_render_views_counter('absolute');
            }  
        ?>
    </div>

    <div class="info"> 
        <header>        
            <h2 class="main-title title underline-effect"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="meta">  
                <?php if( epcl_get_option('classic_display_author') !== '0' ): ?>
                    <?php get_template_part('partials/meta-info/author'); ?>
                <?php endif; ?>                
                <?php get_template_part('partials/meta-info/date'); ?> 
                <?php if( $loop_post_style == 'classic-image' ): ?>
                    <div class="meta-info min-read">
                        <?php get_template_part('partials/meta-info/reading-time'); ?>
                    </div>
                <?php endif; ?> 
                <?php if( is_sticky() && !has_post_thumbnail() ): ?>
                    <span class="sticky-icon meta-info tooltip" data-title="<?php esc_attr_e('Featured Article', 'wavy'); ?>"><svg class="icon dark"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#vip"></use></svg></span>
                <?php endif; ?>           
                <div class="clear"></div>
            </div>
        </header>

        <?php if( empty($epcl_theme) || $epcl_theme['classic_display_excerpt'] !== '0' ): ?>
            <div class="post-excerpt">                    
                <?php the_excerpt(); ?>        
                <div class="clear"></div>              
            </div>  
        <?php else: ?>
            <div class="epcl-spacing"></div>
        <?php endif; ?>

        <footer class="bottom">
            <div class="meta bottom epcl-flex">
                <a href="<?php the_permalink(); ?>" class="continue-reading epcl-button gradient-button wave-button"><?php echo esc_html__('Read More', 'wavy'); ?> <span class="screen-reader-text"><?php the_title(); ?></span></a>
                <?php if( $loop_post_style !== 'classic-image' ): ?>
                    <?php get_template_part('partials/meta-info/reading-time'); ?>
                <?php endif; ?>
            </div>
        </footer>
    </div>

    <div class="clear"></div>

</article>