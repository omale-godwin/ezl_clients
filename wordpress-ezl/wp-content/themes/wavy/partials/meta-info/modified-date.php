<?php if( epcl_get_option( 'enable_global_modified_date', true ) ): ?>
    <p class="last-update"><span class="dot small"></span> <strong><?php esc_html_e('Last Update:', 'wavy'); ?></strong> <?php echo get_the_modified_time( get_option('date_format') ); ?></p>
<?php endif; ?>