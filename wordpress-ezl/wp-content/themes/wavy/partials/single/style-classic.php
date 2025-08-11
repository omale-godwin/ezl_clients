<header>

    <?php echo epcl_display_post_format( get_post_format(), get_the_ID(), true ); ?>

    <div class="info textcenter">    
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

	<div class="clear"></div>

</header>