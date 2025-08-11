<!-- start: .mobile.main-nav -->
<nav class="mobile main-nav hide-on-desktop-lg">

    <?php get_template_part('partials/header/site-logo'); ?>
    
    <?php
    $args = array( 'theme_location' => 'epcl_header', 'container' => false );
    if( has_nav_menu('epcl_header') ){
        wp_nav_menu( $args );
    } 
    ?>  
    <?php if( epcl_get_option('enable_subscribe') == true ): ?>
        <div class="epcl-buttons">
            <?php echo epcl_get_subscribe_button(); ?> 
        </div>
    <?php endif ;?>   
</nav>
<!-- end: .mobile.main-nav -->
<div class="menu-overlay hide-on-desktop-lg"></div>