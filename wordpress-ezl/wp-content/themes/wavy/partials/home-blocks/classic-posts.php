<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

$args = array('post_type' => 'post', 'paged' => get_query_var('paged') );

// ACF custom builder
if( is_page_template('page-templates/home.php') ){

    $var = is_front_page() ? 'page' : 'paged';
    $paged = ( get_query_var($var) ) ? get_query_var($var) : 1;
    // Fix AMP v2.0 and higher
    if( epcl_is_amp() && isset($_GET['amp']) ){
        $paged = get_query_var('paged');
    }    
    $args['paged'] = $paged;

    // Check common arguments from EPCL Module
    $extra_args = epcl_posts_lists_args( $epcl_module );

    if( !empty($extra_args) ){
        $args = array_merge( $args, $extra_args );
    } 
	
}

$custom_query = new WP_Query($args);
$custom_query = epcl_calculate_offset_pages($custom_query, $epcl_module);

if( !is_page_template('page-templates/home.php') ){
    $custom_query = $wp_query;
}

if( !wp_is_mobile() ){
    add_filter( 'excerpt_length', 'epcl_large_excerpt_length', 999 );
}
add_filter( 'the_title', 'epcl_classic_title_length', 999, 2 );
$module_class = '';
if( !is_active_sidebar('epcl_sidebar_home') ){
    $module_class .= ' no-active-sidebar';
}
$index = 0;

$posts_per_page = get_option('posts_per_page');
if( isset($epcl_module['posts_per_page']) && $epcl_module['posts_per_page'] != '' ){
    $posts_per_page = $epcl_module['posts_per_page'];
}
$subscribe_index = absint( $posts_per_page ) / 2;

set_query_var('epcl_module_style', 'classic');
set_query_var('index', $index);
?>

<div class="module-wrapper grid-container <?php echo esc_attr($module_class); ?>" id="<?php echo wp_unique_id('epcl-classic-posts-'); ?>">
    
    <!-- start: .content-wrapper -->
    <div class="content-wrapper classic no-sidebar content">

        <!-- start: .center -->
        <div class="center left-content">

            <?php if( isset($epcl_module['module_title']) && $epcl_module['module_title'] != '' ): ?>
                <h2 class="title bordered large section-title"><?php echo esc_html( $epcl_module['module_title'] ); ?><svg class="decoration"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#title-decoration"></use></svg></h2>
            <?php endif; ?>

            <?php if( $custom_query->have_posts() ): ?>
                <!-- start: .articles -->
                <div class="articles classic">
                    <?php while( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                        <?php if( $index == $subscribe_index && epcl_get_option('loop_classic_enable_subscribe', true) ): ?>
                            <?php get_template_part('partials/subscribe-form'); ?>
                        <?php endif; ?>
                        <?php get_template_part('partials/loops/classic-article'); ?>
                    <?php $index++; set_query_var('index', $index); endwhile; ?>
                </div>
                <!-- end: .articles -->
                <?php epcl_pagination($custom_query); ?>

                <?php wp_reset_postdata(); ?>                    

            <?php else: ?>
                <?php get_template_part('partials/no-results'); ?>
            <?php endif; ?>

        </div>
        <!-- end: .center -->

    </div>
    <!-- end: .content-wrapper -->

    <div class="clear"></div>
</div>            