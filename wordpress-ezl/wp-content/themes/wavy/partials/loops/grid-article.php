<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

$index = absint( get_query_var('index') );

$column_class = 'grid-33';
$grid_posts_column = 3;
$post_class = $thumb_url = '';

$post_id = get_the_ID();

if( !get_post_format() && !has_post_thumbnail() ){
    $post_class .= ' no-thumb';
}

$column_class = get_query_var('epcl_column_class');

if( !empty($epcl_theme) && $epcl_theme['grid_display_author'] == '0'){
	$post_class .= ' no-author';
}
set_query_var( 'epcl_post_style', 'grid' );
if( isset($_GET['ads']) ){
    $epcl_theme['ads_enabled_grid_loop'] = '1';
}
// Ads integration
if( !empty($epcl_theme) && function_exists( 'epcl_render_global_ads' ) && $epcl_theme['ads_enabled_grid_loop'] == '1' && $index == ( absint($epcl_theme['ads_position_grid_loop']) - 1  ) ){
    if( $epcl_theme['ads_mobile_grid_loop'] == '0' && wp_is_mobile() ){

    }else{
        echo '<article class="index-'.esc_attr($index).' '.esc_attr($column_class).' tablet-grid-50 np-mobile">';
            epcl_render_global_ads('grid_loop');
        echo '</article>';
        $index++;
    }
}

if( !has_post_thumbnail() && !empty($optimized_image) && !$optimized_image['url'] ){
    $post_class .= ' no-thumb';
}

?>

<article <?php post_class('default index-'.$index.' '.$column_class.$post_class.' tablet-grid-50 mobile-grid-100 np-mobile'); ?>>
    <header>

        <div class="post-format-wrapper">
            <?php epcl_display_post_format( get_post_format(), $post_id );  ?> 
            <?php if( is_sticky() ): ?>
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
            <h2 class="main-title title underline-effect"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <!-- start: .meta -->
            <div class="meta">
                <?php if( epcl_get_option('grid_display_author') !== '0' ): ?>
                    <?php get_template_part('partials/meta-info/author'); ?>
                <?php endif; ?> 
                <?php get_template_part('partials/meta-info/date'); ?>
                <div class="clear"></div>
            </div>
            <!-- end: .meta -->
        </div>

    </header>

    <?php if( epcl_get_option('grid_display_excerpt') !== '0'): ?>
        <div class="post-excerpt">                
            <?php the_excerpt(); ?>               
            <div class="clear"></div>
        </div>  
    <?php endif; ?>
    <div class="clear"></div>
    
    <footer class="bottom">
        <div class="meta bottom epcl-flex">
        <a href="<?php the_permalink(); ?>" class="continue-reading epcl-button gradient-button wave-button"><?php echo esc_html__('Read More', 'wavy'); ?> <span class="screen-reader-text"><?php the_title(); ?></span></a>
            <?php get_template_part('partials/meta-info/reading-time'); ?>
        </div>
    </footer>

    <div class="clear"></div>

</article>

<?php $index++; set_query_var('index', $index); ?>
