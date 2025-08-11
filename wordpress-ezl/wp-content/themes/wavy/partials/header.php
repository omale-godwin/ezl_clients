<?php
$epcl_theme = epcl_get_theme_options();
if( function_exists('icl_get_home_url') ) $home = icl_get_home_url();
else $home = home_url('/');
// Just demo purposes
if( isset($_GET['header']) ){
	$header_type = sanitize_text_field( $_GET['header'] );
	switch($header_type){
		default:
			$epcl_theme['header_type'] = 'minimalist';
		break;
		case 'classic':
			$epcl_theme['header_type'] = 'classic';
		break;
		case 'notice':
			$epcl_theme['enable_notice'] = true;
        break;
        case 'advertising':
            $epcl_theme['header_type'] = 'advertising';
		break;
	}
}

// Only if theme options data has been created
$header_class = '';
if( !empty( $epcl_theme ) ){
    $header_class = $epcl_theme['header_type'];
    if( isset( $epcl_theme['enable_sticky_header'] ) && $epcl_theme['enable_sticky_header'] != false ){
        $header_class .=' enable-sticky';
    }
    if( epcl_get_option('enable_sticky_header_mobile', true) == false ){
        $header_class .=' disable-sticky-mobile';
    }
    if( isset($epcl_theme['sticky_logo_image']['url'] ) && $epcl_theme['sticky_logo_image']['url'] ){
        $header_class .=' has-sticky-logo'; 
    }
    if( isset($epcl_theme['enable_search_header']) && $epcl_theme['enable_search_header'] == '1'  ){
        add_filter('wp_nav_menu_items','epcl_search_nav_item', 10, 2);
    }
}else{
    $header_class .= 'minimalist';
}

?>

<?php get_template_part('partials/header/notice-text'); ?>

<!-- start: #header -->
<header id="header" class="<?php echo esc_attr($header_class); ?>">

    <!-- start: .menu-wrapper -->
    <div class="menu-wrapper">
        
        <div class="grid-container">
            <div class="epcl-flex">

                <?php if( has_nav_menu('epcl_header') ): ?>
                    <div class="menu-mobile">
                        <svg class="icon ularge open"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#menu-icon"></use></svg>
                        <svg class="icon ularge close"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#close-icon"></use></svg>
                    </div>
                <?php endif; ?>

                <?php get_template_part('partials/header/site-logo'); ?>
                
                <?php if( !empty($epcl_theme) && $epcl_theme['header_type'] == 'advertising' && function_exists('epcl_render_header_ads') ): ?>
                    <?php epcl_render_header_ads(); ?>
                <?php endif; ?>
                
                <?php get_template_part('partials/header/navigation'); ?>

                <?php if( epcl_get_option('enable_subscribe') == true ): ?>
                    <?php echo epcl_get_subscribe_button('hide-on-mobile hide-on-tablet hide-on-desktop-sm'); ?>
                <?php endif ;?>

                <?php if( epcl_get_option('enable_search_header') == '1' || empty($epcl_theme) ): ?>
                    <a href="#search-lightbox" class="lightbox epcl-search-button epcl-button gradient-button circle mfp-inline" aria-label="<?php esc_attr_e('Search', 'wavy'); ?>"><svg class="icon"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#search-icon"></use></svg></a>
                <?php endif; ?>

                <div class="clear"></div>
            
            </div>		
            
            <div class="clear"></div>
        </div>
        
    </div>
    <!-- end: .menu-wrapper -->

</header>
<!-- end: #header -->

<div class="clear"></div>   

<?php
if( function_exists( 'epcl_render_global_ads' ) ){
	epcl_render_global_ads('below_header');
}
?>

<?php if( epcl_get_option('enable_search_header') == '1' || empty($epcl_theme) ): ?>
    <?php get_template_part('partials/header/search-lightbox'); ?>
<?php endif; ?>