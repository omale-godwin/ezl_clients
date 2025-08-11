<!-- start: #footer -->
<footer id="footer" class="grid-container no-background">

    <div class="textcenter">
        <?php get_template_part('partials/header/site-logo'); ?>
    </div>

    <?php if( epcl_get_option('copyright_text') ): ?>
        <div class="published underline-effect">
            <?php echo wp_kses_post( do_shortcode($epcl_theme['copyright_text']) ); ?>
        </div>
    <?php endif; ?>

    <?php if( epcl_get_option('copyright_theme_author', true) && function_exists('epcl_render_theme_author') ): ?>
        <?php 
        $class = '';
        if( !epcl_get_option('copyright_text') ) $class = 'no-margin-top';
        ?>
        <?php echo epcl_render_theme_author( $class ); ?>
    <?php endif; ?>

    <div class="clear"></div>

</footer>
<!-- end: #footer -->