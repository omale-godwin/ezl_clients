<?php

function epcl_render_breadcrumbs(){

    if ( function_exists('yoast_breadcrumb') && epcl_get_option('breadcrumbs_type') == 'yoast' ) {
        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
    } elseif( function_exists('bcn_display') && epcl_get_option('breadcrumbs_type') == 'navxt' ){
        bcn_display();
    } elseif( function_exists('rank_math_the_breadcrumbs') && epcl_get_option('breadcrumbs_type') == 'rankmath' ){
        rank_math_the_breadcrumbs();
    }

}

function epcl_custom_scripts_body() {
    global $epcl_theme;
    if( empty($epcl_theme) || epcl_is_amp() ) return;

    if( isset( $epcl_theme['custom_scripts_body'] ) && $epcl_theme['custom_scripts_body'] ){
        echo $epcl_theme['custom_scripts_body'];
    }
}

add_action('wp_body_open', 'epcl_custom_scripts_body', 1);

function epcl_render_reading_time(){
    $content = get_the_content();
    if( !$content ) return;
    $reading_time = epcl_reading_time( get_the_content() );
?>
    <?php if( epcl_get_option( 'enable_global_reading_time', false ) ): ?>
        <div class="min-read">
            <svg><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#reading-icon"></use></svg> <?php printf( esc_attr__( '%d Min Read', 'wavy' ), $reading_time ); ?>
        </div>
    <?php endif; ?>
<?php
}

function epcl_render_views_counter($extra_classes = ''){
    $views = 0;
    $post_meta = get_post_meta( get_the_ID(), 'epcl_post', true );
    if( isset( $post_meta['views_counter'] ) && $post_meta['views_counter'] > 0 ){
        $views = $post_meta['views_counter'];
    } 
?>
    <?php if( epcl_get_option( 'enable_global_views', false ) ): ?>
        <span class="epcl-views-counter <?php echo esc_attr($extra_classes); ?>" title="<?php echo absint( $views ); ?> <?php esc_attr_e('Views', 'wavy'); ?>"><svg class="icon dark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z"></path></svg> <?php echo absint( $views ); ?></span>  

    <?php endif; ?>
    
<?php
}

// Customs fonts to match Gutenberg with Front-End, only enabled by theme options
add_action('admin_footer', 'epcl_admin_custom_css', 20);
function epcl_admin_custom_css() {
    $custom_css = '';
    if( epcl_get_option('enable_gutenberg_admin', true) ){
        $custom_css = epcl_generate_gutenberg_custom_styles();
    }    
    echo '<style id="epcl-custom-css-admin">.column-epcl_post_image{ width: 120px; }'.$custom_css.'</style>';
}

function epcl_render_theme_author( $class = ''){
    return '<p class="published underline-effect '.esc_attr($class).'"><a href="https://1.envato.market/estudiopatagon-themes" target="_blank">Wavy</a> Theme by <a href="https://1.envato.market/estudiopatagon-themes" target="_blank">EstudioPatagon</a> <span class="dot"></span> Powered by <a href="https://wordpress.org" target="_blank">WordPress</a></p>';
}

// add_action('wp_footer', 'epcl_render_demo_button', 100);
function epcl_render_demo_button(){
    global $wp;
    // $epcl_mode = epcl_get_mode();
    $epcl_mode = '';
    if( epcl_is_amp() ) return;
    $site_url = site_url();
    if( (strpos($site_url, 'estudiopatagon.com') < 1) && (strpos($site_url, 'localhost') < 1) ) return;
    
    $current_url = home_url( $wp->request ) ;
    $current_mode = 0;
    $current_color = 1;
    $new_current_color = 1;
    $new_current_mode = 1;

?>
<div class="epcl-demo-tool hide-on-mobile hide-on-tablet hide-on-desktop-sm">
    <div class="tool"  title="Demo options">
        <svg class="icon ularge" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <g fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 21h-4l-.551-2.48a6.991 6.991 0 0 1-1.819-1.05l-2.424.763l-2-3.464l1.872-1.718a7.055 7.055 0 0 1 0-2.1L3.206 9.232l2-3.464l2.424.763A6.992 6.992 0 0 1 9.45 5.48L10 3h4l.551 2.48a6.992 6.992 0 0 1 1.819 1.05l2.424-.763l2 3.464l-1.872 1.718a7.05 7.05 0 0 1 0 2.1l1.872 1.718l-2 3.464l-2.424-.763a6.99 6.99 0 0 1-1.819 1.052L14 21z"/>
                <circle cx="12" cy="12" r="3"/>
            </g>
        </svg>
    </div>
    <h4 class="title usmall">Change Styling:</h4>
    <span class="link active" data-class="disable-decorations"><span></span>Waves Background</span>
    <label><input type="color" value="#FC6668" data-class=".epcl-wave-color, .epcl-wave-color2" data-attr="fill"> Wave Color</label>
    <label><input type="color" value="#FC6668" data-target="--epcl-gradient-start-color"><input type="color" value="#e10489" data-target="--epcl-gradient-end-color"> Gradient</label>
    <label><input type="color" value="#f43676" data-target="--epcl-main-color"> Links Color</label>
    <label><input type="color" value="#FFFFFF" data-class="body" data-attr="background"> Background Color</label>
    <label><input type="color" value="#ffe7d2" data-target="--epcl-boxes-background-color"> Sidebar Color</label>
    <p style="font-size: 12px; padding-top: 5px;"><b>Note:</b> All these options are included in the WordPress Admin.</p>
</div>
<?php
}