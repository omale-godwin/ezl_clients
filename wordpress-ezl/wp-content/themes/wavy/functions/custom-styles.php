<?php

/* Custom styles generated from theme options panel */

if( function_exists('epcl_generate_custom_styles') ) return;

function epcl_generate_custom_styles(){
    $epcl_theme = epcl_get_theme_options();

    if( empty($epcl_theme) ) return;

    $css = '';

    $primary_color = '#F43676';
    $secondary_color = '#FED267';
    $third_color = '#AEF3FF';
    $decoration_color = '#F7DFD4';
    $titles_color = '#302d55';
    $text_color = '#002050';
    $border_color = '#E6EDF6';
    $input_bg_color = '#FFFFFF';
    $background_color = '#FFFFFF';
    $boxes_bg_color = '#FFF9F3';
    $boxes_border_color = '#FFE7D2';
    $black = '#002050';
    $white = '#FFFFFF';

    $main_gradient_start_color = '#FC6668';
    $main_gradient_end_color = '#E10489';

    $font_family = 'Be Vietnam Pro';
    $title_font_family = 'Be Vietnam Pro';

    // Demo
    if( isset($_GET['bg']) ){
        $epcl_theme['background_type'] = 2;
    }

	/* @group General Settings */

    if( $epcl_theme['background_type'] == 1 && $epcl_theme['bg_body_pattern']['url'] )
        $css .= 'body:before{ background: url('.$epcl_theme['bg_body_pattern']['url'].') repeat; }';

    if( $epcl_theme['background_type'] == 2  && $epcl_theme['bg_body_color'] != '' && $epcl_theme['bg_body_color'] != $background_color)
        $css .= 'body{ background: '.$epcl_theme['bg_body_color'].'; }';

    if( $epcl_theme['background_type'] == 3 && $epcl_theme['bg_body_full']['url'] )
        $css = 'body:before{ background: url('.$epcl_theme['bg_body_full']['url'].') no-repeat top center !important; }';

    if( $epcl_theme['background_type'] == 4 && $epcl_theme['bg_body_gradient'] )
        $css = 'body:before{
            background: -webkit-linear-gradient(0deg, '.$epcl_theme['bg_body_gradient']['from'].' 30%, '.$epcl_theme['bg_body_gradient']['to'].' 100%);
            background: linear-gradient(90deg, '.$epcl_theme['bg_body_gradient']['from'].' 30%, '.$epcl_theme['bg_body_gradient']['to'].' 100%);
        }';


    if( $epcl_theme['main_wave_color'] != $main_gradient_start_color)
        $css .= '.epcl-wave-color, .epcl-wave-color2{
            fill: '.$epcl_theme['main_wave_color'].';
        }';  
        
    if( isset($epcl_theme['enable_wave_titles']) && $epcl_theme['enable_wave_titles'] == false){
        $css .= '.title.bordered{ padding-left: 0; }'; 
        $css .= '
            .title.bordered svg.decoration{ display: none; }
            @media screen and (max-width: 767px){
                #single section.related, #single #comments{ padding-left: 0; }
            }
                
        '; 
    }        

    // Logo with icons
    if( $epcl_theme['logo_type'] == 2 ){

        $css .= '#header .logo a, #header a.sticky-logo, #footer .logo a{ 
            color: '.$epcl_theme['logo_text_color'].'; }';

        $css .= '#header .logo.text-logo .icon svg, #footer .logo.text-logo .icon svg{ 
            fill: '.$epcl_theme['logo_icon_color'].'; }';

        // Header text logo Icon
        if( isset( $epcl_theme['logo_icon_size'] ) && $epcl_theme['logo_icon_size'] != '30'){
            $css .= '#header .logo.text-logo .icon{ width: '.$epcl_theme['logo_icon_size'].'px; line-height: '.$epcl_theme['logo_icon_size'].'px; }';
        } 

    }
    
    // Primary Color
	if( $epcl_theme['primary_color'] != $primary_color ){  
        $css .= ':root{ --epcl-main-color: '.$epcl_theme['primary_color'].'; }';
    }

    // Main gradient (mainly buttons)
    if( $epcl_theme['main_gradient_color']['from'] != $main_gradient_start_color ){  
        $css .= ':root{ --epcl-gradient-start-color: '.$epcl_theme['main_gradient_color']['from'].'; }';
    }    
    if( $epcl_theme['main_gradient_color']['to'] != $main_gradient_end_color ){  
        $css .= ':root{ --epcl-gradient-end-color: '.$epcl_theme['main_gradient_color']['to'].'; }';
    }

    // Secondary Color (decorations and effects)
    if( $epcl_theme['secondary_color'] != $secondary_color ){  
        $css .= ':root{ --epcl-secondary-color: '.$epcl_theme['secondary_color'].'; }';
    }

    // Third Color (complementary)
    if( $epcl_theme['third_color'] != $third_color ){  
        $css .= ':root{ --epcl-third-color: '.$epcl_theme['third_color'].'; }';
    }

    // Titles Color
    if( $epcl_theme['titles_color'] != $titles_color ){  
        $css .= ':root{ --epcl-titles-color: '.$epcl_theme['titles_color'].'; }';
    }

    // Text Color
    if( $epcl_theme['text_color'] != $text_color ){  
        $css .= ':root{ --epcl-text-color: '.$epcl_theme['text_color'].'; }';
    }

    /* @end */
    
    /* @group Header Colors */

    if( $epcl_theme['header_menu_bg_color'] != 'transparent' ){
        $css .= '#header div.menu-wrapper, nav.mobile.main-nav{ 
            background: '.$epcl_theme['header_menu_bg_color'].'; }';
    }

    // Header menu links
    if( $epcl_theme['header_menu_link_color']['color'] != $black ){

        $css .= '#header nav ul.menu > li > a:not(.epcl-button),
                 #header nav ul.menu li.menu-item-has-children:after{ 
            color: '.$epcl_theme['header_menu_link_color']['color'].'; }';
    }

    if( $epcl_theme['header_menu_link_color']['hover'] != $black ){

        $css .= '#header nav ul.menu > li > a:hover{ 
            color: '.$epcl_theme['header_menu_link_color']['hover'].'; }';
    }

    if( $epcl_theme['header_menu_link_color']['active'] != $primary_color ){

        $css .= '#header nav ul.menu > li.current-menu-ancestor>a, #header nav ul.menu > li.current-menu-item>a{ 
            color: '.$epcl_theme['header_menu_link_color']['active'].'; }';
    }

    // Header submenu links
    if( $epcl_theme['header_submenu_link_color']['color'] != $black ){

        $css .= '.main-nav ul.sub-menu li a{ 
            color: '.$epcl_theme['header_submenu_link_color']['color'].'; }

            @media screen and (max-width: 980px){ #header nav ul.menu>li>a, #header nav ul.menu li.menu-item-has-children:after{ color: '.$epcl_theme['header_submenu_link_color']['color'].'; }}';
    }

    if( $epcl_theme['header_submenu_link_color']['hover'] != $primary_color ){

        $css .= '.main-nav ul.sub-menu li a:hover{ 
            color: '.$epcl_theme['header_submenu_link_color']['hover'].'; }';
    }

    if( $epcl_theme['header_submenu_link_color']['active'] != $primary_color ){
        $css .= '.main-nav ul.sub-menu li.current-menu-item a{ 
            color: '.$epcl_theme['header_submenu_link_color']['active'].'; }';
    }   
    
    if( $epcl_theme['header_submenu_bg_color'] != $white ){
        $css .= '#header nav ul.sub-menu{ 
            background: '.$epcl_theme['header_submenu_bg_color'].' !important; }';
    }

    if( $epcl_theme['header_sticky_bg_color'] != $white ){
        $css .= '#header[data-stuck] div.menu-wrapper{ 
            background-color: '.$epcl_theme['header_sticky_bg_color'].'; }';
    }

    if( $epcl_theme['header_mobile_bg_color'] != $white ){
        $css .= 'nav.mobile.main-nav{ 
            background: '.$epcl_theme['header_mobile_bg_color'].'; }';
    }

	if( $epcl_theme['header_mobile_icon_color'] != $black && $epcl_theme['header_mobile_icon_color'] != '' ){
		$css .= '#header div.menu-mobile svg{ 
            color: '.$epcl_theme['header_mobile_icon_color'].'; }';
	}

    if( $epcl_theme['header_mobile_link_color'] != $black && $epcl_theme['header_mobile_link_color'] != '' ){
		$css .= 'nav.mobile.main-nav ul.menu li a, nav.mobile.main-nav ul.menu li.menu-item-has-children:after{ 
            color: '.$epcl_theme['header_mobile_link_color'].' !important; }';
	}

    /* @end */

    /* @group Content Colors */

    if( isset($epcl_theme['selection_bg_color']) && $epcl_theme['selection_bg_color'] != $text_color ){
        $css .= '::selection{ background-color: '.$epcl_theme['selection_bg_color'].'; }';
    }
    if( isset($epcl_theme['selection_text_color']) && $epcl_theme['selection_text_color'] != $white ){
        $css .= '::selection{ color: '.$epcl_theme['selection_text_color'].'; }';
    }

    if( isset($epcl_theme['content_border_color']) && $epcl_theme['content_border_color'] != $border_color ){  

        $css .= ':root{ --epcl-border-color: '.$epcl_theme['content_border_color'].'; }';
    }

    if( isset($epcl_theme['main_boxes_color']) && $epcl_theme['main_boxes_color'] != $boxes_bg_color ){  
        $css .= ':root{
            --epcl-boxes-background-color: '.$epcl_theme['main_boxes_color'].';
        }';
    }

    if( isset($epcl_theme['main_boxes_border_color']) && $epcl_theme['main_boxes_border_color'] != $boxes_border_color ){  
        $css .= ':root{
            --epcl-boxes-border-color: '.$epcl_theme['main_boxes_border_color'].';
        }';
    }

    /* @end */

    /* @group Buttons Colors */

    // Content links
    if( $epcl_theme['content_link_color']['color'] != $primary_color ){
        $css .= 'div.text a:not([class]), div.text a:not([class]) strong, #single .bottom-tags a
        { 
            color: '.$epcl_theme['content_link_color']['color'].'; }';
    }
    if( $epcl_theme['content_link_color']['hover'] != $black ){
        $css .= 'div.text a:not([class]):hover, div.text a:not([class]):hover strong, #single .bottom-tags a:hover
        { 
            color: '.$epcl_theme['content_link_color']['hover'].'; }';
    }

    // Primary Button
    if( !empty($epcl_theme['primary_button']) && $epcl_theme['primary_button']['gradient_start'] != $main_gradient_start_color && $epcl_theme['primary_button']['gradient_end'] != $main_gradient_end_color )
        $css .= '#single #comments.hosted nav.pagination a.button:before, #single #comments.hosted nav.pagination a:not(.epcl-shortcode):before, .button.gradient-button:before, .epcl-button:not(.epcl-shortcode).gradient-button:before, button[type=submit]:before, input[type=submit], .slick-prev, .slick-next{
            background: linear-gradient(103deg, '.$epcl_theme['primary_button']['gradient_start'].' 0%, '.$epcl_theme['primary_button']['gradient_end'].' 100%);
        }';
    if( $epcl_theme['primary_button']['text_color'] != $white ){

        $css .= '#single #comments.hosted nav.pagination a.button, #single #comments.hosted nav.pagination a:not(.epcl-shortcode), .button.gradient-button, .epcl-button:not(.epcl-shortcode).gradient-button, button[type=submit], input[type=submit], .slick-prev, .slick-next, .epcl-button:not(.epcl-shortcode)
        {
                color: '.$epcl_theme['primary_button']['text_color'].'; }';

    }	

    // Tag color
    if( $epcl_theme['tag_text_color']['color'] != $primary_color ){
        $css .= '#single .bottom-tags a{ 
            color: '.$epcl_theme['tag_text_color']['color'].'; }';
    }
    if( $epcl_theme['tag_text_color']['hover'] != $black ){
        $css .= '#single .bottom-tags a:hover{ 
            color: '.$epcl_theme['tag_text_color']['hover'].' !important; }';
    }

    /* @end */

    /* @group Sidebar Colors */

    if( $epcl_theme['sidebar_bg_color'] != $boxes_bg_color ){
        $css .= '#sidebar .widget{ 
            background-color: '.$epcl_theme['sidebar_bg_color'].'; }';
    }
    
    if( $epcl_theme['sidebar_border_color'] != $boxes_border_color ){
        $css .= '#sidebar .widget{ 
            border-color: '.$epcl_theme['sidebar_border_color'].'; }';
    }

    if( $epcl_theme['sidebar_text_color'] != $text_color && strlen($epcl_theme['sidebar_text_color']) > 2){
        $css .= '#sidebar, #sidebar .widget_rss .rss-date:not(.icon){ 
            color: '.$epcl_theme['sidebar_text_color'].'; }';
    }

    if( $epcl_theme['sidebar_link_color']['color'] != $text_color ){
        $css .= '#sidebar .widget a{ 
            color: '.$epcl_theme['sidebar_link_color']['color'].'; }';
    }

    if( $epcl_theme['sidebar_link_color']['hover'] != $primary_color ){
        $css .= '#sidebar .widget a:hover{ 
            color: '.$epcl_theme['sidebar_link_color']['hover'].'; }';
    }

    if( $epcl_theme['sidebar_title_color'] != $boxes_border_color ){
        $css .= '#sidebar .widget .widget-title, #sidebar .widget .wp-block-heading{ 
            color: '.$epcl_theme['sidebar_title_color'].'; }';
    }

    /* @end */

    /* @group Forms Colors */

    if( $epcl_theme['input_bg_color'] != $input_bg_color ){
        $css .= '.inputbox, input[type=email], input[type=number], input[type=password], input[type=tel], input[type=text], input[type=url], textarea, select{ 
            background: '.$epcl_theme['input_bg_color'].'; }';
    }

    if( $epcl_theme['input_text_color'] != $text_color ){
        $css .= 'input[type=email], input[type=number], input[type=password], input[type=tel], input[type=text], input[type=url], textarea, select{ 
            color: '.$epcl_theme['input_text_color'].'; }';
        $css .= 'input[type=email]::-webkit-input-placeholder, input[type=number]::-webkit-input-placeholder, input[type=password]::-webkit-input-placeholder, input[type=tel]::-webkit-input-placeholder, input[type=text]::-webkit-input-placeholder, input[type=url]::-webkit-input-placeholder, textarea::-webkit-input-placeholder{ 
            color: '.$epcl_theme['input_text_color'].'; }';  
        $css .= 'input[type=email]:-moz-placeholder, input[type=number]:-moz-placeholder, input[type=password]:-moz-placeholder, input[type=tel]:-moz-placeholder, input[type=text]:-moz-placeholder, input[type=url]:-moz-placeholder, textarea:-moz-placeholder{ 
            color: '.$epcl_theme['input_text_color'].'; }';     
        $css .= 'input[type=email]::-moz-placeholder, input[type=number]::-moz-placeholder, input[type=password]::-moz-placeholder, input[type=tel]::-moz-placeholder, input[type=text]::-moz-placeholder, input[type=url]::-moz-placeholder, textarea::-moz-placeholder{ 
            color: '.$epcl_theme['input_text_color'].'; }'; 

        $css .= 'input[type=email]:focus, input[type=number]:focus, input[type=password]:focus, input[type=tel]:focus, input[type=text]:focus, input[type=url]:focus, textarea:focus{ 
            color: '.$epcl_theme['input_text_color'].'; }';
    }

    if( $epcl_theme['label_text_color'] != $text_color ){
        $css .= 'label, .wpcf7 label{ 
            color: '.$epcl_theme['label_text_color'].'; }';
    }

    /* @end */

    /* @group Footer Colors */

    if( $epcl_theme['footer_bg_color'] != $boxes_bg_color ){
        $css .= '#footer{ 
            background-color: '.$epcl_theme['footer_bg_color'].'; }';  
    }

    if( $epcl_theme['footer_text_color'] != $text_color ){
        $css .= '#footer .widgets, #footer .widget_rss .rss-date:not(.icon){ 
            color: '.$epcl_theme['footer_text_color'].'; }';
    }

    if( $epcl_theme['footer_link_color']['color'] != $text_color ){
        $css .= '#footer .widgets a{ 
            color: '.$epcl_theme['footer_link_color']['color'].'; }';
    }

    if( $epcl_theme['footer_link_color']['hover'] != $primary_color ){
        $css .= '#footer .widgets a:hover, #footer .widgets .title a:hover{ 
            color: '.$epcl_theme['footer_link_color']['hover'].'; }';
    }

    if( isset($epcl_theme['footer_title_color']) && $epcl_theme['footer_title_color'] != $titles_color ){
        $css .= '#footer .widget .widget-title, #footer .widget .wp-block-heading{ 
            color: '.$epcl_theme['footer_title_color'].'; }';
    }

    if( $epcl_theme['footer_copyright_color'] != $text_color ){
        $css .= '#footer .published{ 
            color: '.$epcl_theme['footer_copyright_color'].'; }';
    }

    if( $epcl_theme['footer_copyright_link_color'] != $text_color ){
        $css .= '#footer .published a, #footer .published a:hover{ 
            color: '.$epcl_theme['footer_copyright_link_color'].'; }';
    }

    /* @end */

	/* @group Typography */

    // Regular Text
	if( $epcl_theme['body_font']['font-family'] && $epcl_theme['body_font']['font-family'] != $font_family){  
        $css .= ':root{ --epcl-font-family: "'.$epcl_theme['body_font']['font-family'].'"; }';
    }

    if($epcl_theme['body_font']['font-size'] != '' && $epcl_theme['body_font']['font-size'] != '17'){
        $css .= ':root{ --epcl-font-size: '.$epcl_theme['body_font']['font-size'].'px; }';
    }

    // Primary Titles
	if( $epcl_theme['primary_titles_font']['font-family'] && $epcl_theme['primary_titles_font']['font-family'] != $title_font_family){  
        $css .= ':root{ --epcl-title-font-family: "'.$epcl_theme['primary_titles_font']['font-family'].'"; }';
    }

    if( $epcl_theme['primary_titles_font']['font-weight'] && $epcl_theme['primary_titles_font']['font-weight'] != '800'){  
        $css .= ':root{ --epcl-title-font-weight: '.$epcl_theme['primary_titles_font']['font-weight'].'; }';
    }

    // Sidebar Titles
	if( $epcl_theme['sidebar_titles_font']['font-family'] && $epcl_theme['sidebar_titles_font']['font-family'] != $title_font_family){  
        $css .= '.widget .wp-block-heading, aside .widget .widget-title, aside .title, .widget_rss a, .widget_epcl_social div.icons a .name{ font-family: "'.$epcl_theme['sidebar_titles_font']['font-family'].'"; }';
    }

    if( $epcl_theme['sidebar_titles_font']['font-weight'] && $epcl_theme['sidebar_titles_font']['font-weight'] != '800'){  
        $css .= '.widget .wp-block-heading, aside .widget .widget-title, aside .title, .widget_rss a, .widget_epcl_social div.icons a{ font-weight: '.$epcl_theme['sidebar_titles_font']['font-weight'].'; }';
    }

	// Sidebar regular text
	if( $epcl_theme['sidebar_font']['font-family'] && $epcl_theme['sidebar_font']['font-family'] != $font_family )
        $css .= 'aside .widget{ font-family: "'.$epcl_theme['sidebar_font']['font-family'].'"; }';
        
    if( $epcl_theme['sidebar_font']['font-weight'] && $epcl_theme['sidebar_font']['font-weight'] != '400' )
		$css .= 'aside .widget{ font-weight: '.$epcl_theme['sidebar_font']['font-weight'].'; }';

	// Footer Titles
	if( $epcl_theme['footer_titles_font']['font-family'] && $epcl_theme['footer_titles_font']['font-family'] != 'Outfit' )
        $css .= '#footer .widget .widget-title, #footer .title,  #footer .widget_rss a, .widget_epcl_social div.icons a .name{ font-family: "'.$epcl_theme['footer_titles_font']['font-family'].'"; }';
        
    if( $epcl_theme['footer_titles_font']['font-weight'] && $epcl_theme['footer_titles_font']['font-weight'] != '800' )
		$css .= '#footer .widget .widget-title, #footer .title,  #footer .widget_rss a{ font-weight: '.$epcl_theme['footer_titles_font']['font-weight'].'; }';

	// Footer regular text
	if( $epcl_theme['footer_font']['font-family'] && $epcl_theme['footer_font']['font-family'] != 'Jost' )
        $css .= '#footer, #footer .widget{ font-family: "'.$epcl_theme['footer_font']['font-family'].'"; }';

    if( $epcl_theme['footer_font']['font-weight'] && $epcl_theme['footer_font']['font-weight'] != '400' )
		$css .= '#footer, #footer .widget{ font-weight: '.$epcl_theme['footer_font']['font-weight'].'; }';
        
    // Blog single text
    if($epcl_theme['editor_font_size'] != '17')
        $css .= 'div.text{ font-size: '.$epcl_theme['editor_font_size'].'px; }';
        
	if($epcl_theme['h1_font_size'] != '32')
		$css .= 'div.text h1{ font-size: '.$epcl_theme['h1_font_size'].'px; }';
	
	if($epcl_theme['h2_font_size'] != '28')
		$css .= 'div.text h2{ font-size: '.$epcl_theme['h2_font_size'].'px; }';
	
	if($epcl_theme['h3_font_size'] != '24')
		$css .= 'div.text h3{ font-size: '.$epcl_theme['h3_font_size'].'px; }';
	
	if($epcl_theme['h4_font_size'] != '18')
		$css .= 'div.text h4{ font-size: '.$epcl_theme['h4_font_size'].'px; }';
	
	if($epcl_theme['h5_font_size'] != '16')
		$css .= 'div.text h5{ font-size: '.$epcl_theme['h5_font_size'].'px; }';
	
	if($epcl_theme['h6_font_size'] != '14')
        $css .= 'div.text h6{ font-size: '.$epcl_theme['h6_font_size'].'px; }';

    // Mobile Font Sizes
    if(isset($epcl_theme['mobile_body_font_size']) && $epcl_theme['mobile_body_font_size'] != '14')
    $css .= '@media screen and (max-width: 767px){ body{ font-size: '.$epcl_theme['mobile_body_font_size'].'px; } }';

    if(isset($epcl_theme['mobile_single_font_size']) && $epcl_theme['mobile_single_font_size'] != '14')
        $css .= '@media screen and (max-width: 767px){ div.text{ font-size: '.$epcl_theme['mobile_single_font_size'].'px; } }';
        
    // Header text logo
    if( isset( $epcl_theme['logo_font_size_desktop'] ) && $epcl_theme['logo_font_size_desktop'] != '40'){
        $css .= '#header .logo.text-logo .title{ font-size: '.$epcl_theme['logo_font_size_desktop'].'px; }';
        $css .= '#header.is-sticky div.menu-wrapper .text-logo a{ font-size: '.absint($epcl_theme['logo_font_size_desktop'] * 0.6).'px; }';
    }        

    if( isset( $epcl_theme['logo_font_size_mobile'] ) )
        $css .= '@media screen and (max-width: 767px){ #header .logo.text-logo .title, #header[data-stuck] div.menu-wrapper .logo a{ font-size: '.$epcl_theme['logo_font_size_mobile'].'px; } }';

    /* @end */

    // Disable categories globally
    if( isset($epcl_theme['enable_global_category']) && $epcl_theme['enable_global_category'] === '0' ){
        $css .= 'div.tags{ display: none !important; }';
    }

    // Disable date globally
    if( isset($epcl_theme['enable_global_date']) && $epcl_theme['enable_global_date'] === '0' ){
        $css .= 'time{ display: none !important; }';
    }

    // Disable comments globally
    if( isset($epcl_theme['enable_global_comments']) && $epcl_theme['enable_global_comments'] === '0' ){
        $css .= 'div.meta a.comments{ display: none !important; }';
    }

    // Disable featured image globally
    if( isset($epcl_theme['enable_featured_image']) && $epcl_theme['enable_featured_image'] === '0' ){
        $css .= '#single.standard .featured-image{ display: none !important; }';
    }

    /* Content width */

    if( epcl_get_option('grid_container_width') ){
        $css .= '.grid-container{ max-width: '.$epcl_theme['grid_container_width'].'; }';
    }

    if( epcl_get_option('grid_container_large_width') ){
        $css .= '.grid-container.grid-large{ max-width: '.$epcl_theme['grid_container_large_width'].'; }';
    }

    if( epcl_get_option('grid_container_ularge_width') ){
        $css .= '.grid-container.grid-ularge{ max-width: '.$epcl_theme['grid_container_ularge_width'].'; }';
    }

    /* @group AMP CSS */

    if( epcl_is_amp() && $epcl_theme['amp_enable_google_fonts'] != true ){
        // Regular Text
        if( $epcl_theme['amp_body_font']['font-family'] && $epcl_theme['body_font']['font-family'] != $font_family){  
            $css .= ':root{ --epcl-font-family: "'.$epcl_theme['amp_body_font']['font-family'].'"; }';
        }    
        // Primary Titles
        if( $epcl_theme['amp_primary_titles_font']['font-family'] && $epcl_theme['primary_titles_font']['font-family'] != $title_font_family){  
            $css .= ':root{ --epcl-title-font-family: "'.$epcl_theme['amp_primary_titles_font']['font-family'].'"; }';
        }
        if( $epcl_theme['amp_primary_titles_font']['font-weight'] && $epcl_theme['amp_primary_titles_font']['font-weight'] != '800'){  
            $css .= ':root{ --epcl-title-font-weight: '.$epcl_theme['amp_primary_titles_font']['font-weight'].'; }';
        }
    }

    /* @end */

	/* @group Advanced CSS */

	if( !empty($epcl_theme['css_code']) )
		$css .= $epcl_theme['css_code'];

    /* @end */

    $prefix = EPCL_THEMEPREFIX.'_';

	if($css)
		return $css;
}

function epcl_generate_gutenberg_custom_styles(){
    $epcl_theme = epcl_get_theme_options();
    $css = '';

    if( empty($epcl_theme) ) return;

    $primary_color = '#F43676';
    $secondary_color = '#FED267';
    $third_color = '#AEF3FF';
    $decoration_color = '#F7DFD4';
    $titles_color = '#302d55';
    $text_color = '#002050';
    $border_color = '#E6EDF6';
    $input_bg_color = '#FFFFFF';
    $background_color = '#FFFFFF';
    $boxes_bg_color = '#FFF9F3';
    $boxes_border_color = '#FFE7D2';
    $black = '#002050';
    $white = '#FFFFFF';

    $main_gradient_start_color = '#FC6668';
    $main_gradient_end_color = '#E10489';

    $font_family = 'Be Vietnam Pro';
    $title_font_family = 'Be Vietnam Pro';

	/* @group General Settings */

    // Primary Color
	if( $epcl_theme['primary_color'] != $primary_color ){  
        $css .= '.editor-styles-wrapper{ --epcl-main-color: '.$epcl_theme['primary_color'].'; }';
    }

    // Secondary Color (decorations and effects)
    if( $epcl_theme['secondary_color'] != $secondary_color ){  
        $css .= '.editor-styles-wrapper{ --epcl-secondary-color: '.$epcl_theme['secondary_color'].'; }';
    }

    // Third Color (titles)
    if( $epcl_theme['third_color'] != $black ){  
        $css .= '.editor-styles-wrapper{ --epcl-black-color: '.$epcl_theme['third_color'].'; }';
    }

    // Titles Color
    if( $epcl_theme['text_color'] != $text_color ){  
        $css .= '.editor-styles-wrapper{ --epcl-text-color: '.$epcl_theme['text_color'].'; }';
    }

    // Text Color
    if( $epcl_theme['titles_color'] != $titles_color ){  
        $css .= '.editor-styles-wrapper{ --epcl-titles-color: '.$epcl_theme['titles_color'].'; }';
    }

    // Boxes background Color
	if( $epcl_theme['main_boxes_color'] != $boxes_bg_color ){  
        $css .= '.editor-styles-wrapper{ --epcl-content-background-color: '.$epcl_theme['main_boxes_color'].'; }';
    }

    if( isset($epcl_theme['content_border_color']) && $epcl_theme['content_border_color'] != $border_color ){  

        $css .= '.editor-styles-wrapper{ --epcl-border-color: '.$epcl_theme['content_border_color'].'; }';
    }

    // Main gradient (mainly buttons)
    if( $epcl_theme['main_gradient_color']['from'] != $main_gradient_start_color ){  
        $css .= '.editor-styles-wrapper{ --epcl-gradient-start-color: '.$epcl_theme['main_gradient_color']['from'].'; }';
    }    
    if( $epcl_theme['main_gradient_color']['to'] != $main_gradient_end_color ){  
        $css .= '.editor-styles-wrapper{ --epcl-gradient-end-color: '.$epcl_theme['main_gradient_color']['to'].'; }';
    }

    /* @end */

	/* @group Typography */

    // Regular Text
	if( $epcl_theme['body_font']['font-family'] && $epcl_theme['body_font']['font-family'] != $font_family)
		$css .= '.block-editor-block-list__layout{ font-family: "'.$epcl_theme['body_font']['font-family'].'" !important; }';
	
	if( $epcl_theme['body_font']['font-weight'] && $epcl_theme['body_font']['font-weight'] != '400' )
		$css .= '.block-editor-block-list__layout{ font-weight: '.$epcl_theme['body_font']['font-weight'].' !important; }';
        
	// Primary Titles
	if( $epcl_theme['primary_titles_font']['font-family'] && $epcl_theme['primary_titles_font']['font-family'] != $title_font_family )
		$css .= '.block-editor-block-list__layout h1,.block-editor-block-list__layout h2, .block-editor-block-list__layout h3, .block-editor-block-list__layout h4, .block-editor-block-list__layout h5, .block-editor-block-list__layout h6, .editor-post-title__block .editor-post-title__input, .editor-styles-wrapper .editor-post-title__input{ font-family: "'.$epcl_theme['primary_titles_font']['font-family'].'" !important; }';
	
	if( $epcl_theme['primary_titles_font']['font-weight'] )
        $css .= '.block-editor-block-list__layout h1, .block-editor-block-list__layout h2, .block-editor-block-list__layout h3, .block-editor-block-list__layout h4, .block-editor-block-list__layout h5, .block-editor-block-list__layout h6, .editor-styles-wrapper .editor-post-title__input{ font-weight: '.$epcl_theme['primary_titles_font']['font-weight'].' !important; }';
        
    // Blog single text
    if($epcl_theme['editor_font_size'] != '16')
        $css .= '.editor-styles-wrapper .block-editor-block-list__layout{ font-size: '.$epcl_theme['editor_font_size'].'px !important; }';
        
	if($epcl_theme['h1_font_size'] != '32')
		$css .= '.block-editor-block-list__layout h1{ font-size: '.$epcl_theme['h1_font_size'].'px; }';
	
	if($epcl_theme['h2_font_size'] != '28')
		$css .= '.editor-styles-wrapper .block-editor-block-list__layout h2{ font-size: '.$epcl_theme['h2_font_size'].'px !important; }';
	
	if($epcl_theme['h3_font_size'] != '24')
		$css .= '.editor-styles-wrapper .block-editor-block-list__layouth3{ font-size: '.$epcl_theme['h3_font_size'].'px !important; }';
	
	if($epcl_theme['h4_font_size'] != '18')
		$css .= '.editor-styles-wrapper .block-editor-block-list__layout h4{ font-size: '.$epcl_theme['h4_font_size'].'px !important; }';
	
	if($epcl_theme['h5_font_size'] != '16')
		$css .= '.editor-styles-wrapper .block-editor-block-list__layout h5{ font-size: '.$epcl_theme['h5_font_size'].'px !important; }';
	
	if($epcl_theme['h6_font_size'] != '14')
		$css .= '.editor-styles-wrapper .block-editor-block-list__layout h6{ font-size: '.$epcl_theme['h6_font_size'].'px !important; }';

    /* @end */
    
    $prefix = EPCL_THEMEPREFIX.'_';
  
	if($css)
		return $css;
}


if ( ! function_exists( 'epcl_hex2rgba' ) ) {

	function epcl_hex2rgba($color, $opacity = false){
		$default = 'rgb(0,0,0)';
		if(empty($color))
			  return $default;
		if($color[0] == '#'){
			$color = substr($color, 1);
		}
		if(strlen($color) == 6){
			$hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
		}elseif(strlen($color) == 3){
			$hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
		} else {
			return $default;
		}
		$rgb =  array_map('hexdec', $hex);
		if($opacity){
			if(abs($opacity) > 1)
				$opacity = 1.0;
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		}else{
			$output = 'rgb('.implode(",",$rgb).')';
		}
		return $output;
	}
}

function epcl_rgb2hex( $color ){
    if( strpos($color, 'rgb') < 0 ){
        return $color;
    }
    $color_array = explode(",", $color, 3);
    return sprintf( "#%02x%02x%02x", $color_array[0], $color_array[1], $color_array[2] );
}
