<!-- start: .meta -->
<div class="meta">

    <?php if( epcl_get_option('enable_global_date') !== '0' ): ?>
        <time class="meta-info" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option('date_format') ); ?></time>  
    <?php endif; ?>

    <?php
        if( function_exists('epcl_render_reading_time') ){
            epcl_render_reading_time();
        }  
    ?>  

    <?php if( is_sticky() ): ?>
        <span class="sticky-icon meta-info icon" title="<?php esc_attr_e('Featured', 'wavy'); ?>"><svg class="icon main-color"><use xlink:href="#star-icon"></use></svg></span>
    <?php endif; ?>
    
    <div class="clear"></div>
</div>
<!-- end: .meta -->