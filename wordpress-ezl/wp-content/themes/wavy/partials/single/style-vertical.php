<?php 
$post_id = get_the_ID();
$post_meta = get_post_meta( get_the_ID(), 'epcl_post', true );
$single_size = 'epcl_classic';
?>
<header>

    <?php if( has_post_thumbnail() ): ?>
        <div class="featured-image epcl-loader">
            <?php if( epcl_is_amp() ): ?>
                <?php the_post_thumbnail( $single_size, array('data-lazy' => 'false') ); ?>
            <?php else: ?>
                <?php the_post_thumbnail( $single_size, array('data-lazy' => 'false', 'loading' => 'eager') ); ?>
            <?php endif; ?>
            <?php
                if( function_exists('epcl_render_views_counter') ){
                    epcl_render_views_counter('absolute');
                }  
            ?>     
        </div>
    <?php endif; ?>
    
    <div class="info <?php if( has_post_thumbnail() ) echo 'epcl-flex'; ?>">     
        <?php if( get_the_title() ): ?>
            <h1 class="main-title title ularge"><?php the_title(); ?></h1>
        <?php endif; ?>
        <!-- start: .meta -->
        <div class="meta">
            <?php if( epcl_get_option( 'enable_single_author', true ) ): ?>
                <?php get_template_part('partials/meta-info/author'); ?>
            <?php endif; ?>
            <?php if( epcl_get_option( 'enable_single_meta_data', true ) ): ?>
                <?php get_template_part('partials/meta-info/date'); ?>
                <?php get_template_part('partials/meta-info/reading-time'); ?>
            <?php endif; ?>
        </div>
        <!-- end: .meta -->             
    </div>

	<div class="clear"></div>

</header>