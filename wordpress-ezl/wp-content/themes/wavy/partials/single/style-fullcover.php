<?php
$post_id = get_the_ID();
$post_format = get_post_format();
$post_meta = get_post_meta( $post_id, 'epcl_post', true );
?>
<div class="fullcover-wrapper">
    
    <?php if( epcl_get_option('enable_breadcrumbs') == '1' && function_exists('epcl_render_breadcrumbs') ): ?>
        <div class="epcl-breadcrumbs">
            <?php epcl_render_breadcrumbs(); ?>
        </div>
    <?php endif; ?>

    <?php echo epcl_display_post_format( $post_format, $post_id, true ); ?>

    <div class="info grid-container grid-small">
        <h1 class="main-title title ularge"><?php the_title(); ?></h1>
        <!-- start: .meta -->
        <div class="meta">
            <?php if( epcl_get_option( 'enable_single_author', true ) ): ?>
                <?php get_template_part('partials/meta-info/author'); ?>
            <?php endif; ?>
            <?php if( epcl_get_option( 'enable_single_meta_data', true ) ): ?>
                <?php get_template_part('partials/meta-info/date'); ?>
                <?php get_template_part('partials/meta-info/reading-time'); ?>
                <?php
                    if( function_exists('epcl_render_views_counter') ){
                        epcl_render_views_counter('meta-info');
                    }  
                ?>
            <?php endif; ?>                 
            <div class="clear"></div>
        </div>
        <!-- end: .meta --> 
    </div>

</div>