<?php if( epcl_get_option('enable_global_date') !== '0' ): ?>
    <time class="meta-info" datetime="<?php the_time('Y-m-d'); ?>">
        <span class="dot"></span>
        <?php the_time( get_option('date_format') ); ?>
    </time>  
<?php endif; ?>