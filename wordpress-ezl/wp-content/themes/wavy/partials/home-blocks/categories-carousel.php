<?php
$epcl_module = epcl_get_module_options();
if( empty($epcl_module) ) return; // no data from carousel module
$prefix = EPCL_THEMEPREFIX.'_';
$args = array(
	'taxonomy' => 'category',
    'orderby' => 'count',
    'order' => 'DESC'
);

if( !empty($epcl_module) ){
    // Categories filters
    if( isset($epcl_module['featured_categories']) && $epcl_module['featured_categories'] != '' ){
        $args['term_taxonomy_id'] = $epcl_module['featured_categories'];
    }
    if( isset($epcl_module['excluded_categories']) && $epcl_module['excluded_categories'] != '' ){
        $args['exclude'] = $epcl_module['excluded_categories'];
    }
    if( isset($epcl_module['categories_carousel_limit']) && $epcl_module['categories_carousel_limit'] != '' ){
        $args['number'] = $epcl_module['categories_carousel_limit'];
    }
}
$carousel = get_terms($args);

?>

<?php if( !empty($carousel) ): ?>
	<!-- start: .carousel -->
    <section class="epcl-popular-categories grid-container grid-ularge" id="<?php echo wp_unique_id('epcl-category-carousel-'); ?>">
        <div class="slick-slider outer-arrows slides-<?php echo intval( $epcl_module['categories_carousel_show_limit'] ); ?>" data-show="<?php echo intval( $epcl_module['categories_carousel_show_limit'] ); ?>" data-rtl="<?php echo is_rtl(); ?>" data-aos="fade">
            <?php foreach($carousel as $term): ?>
                <?php
                    $term_meta = '';
                    if( defined('EPCL_PLUGIN_PATH') && !empty($term) ){
                        $term_meta = get_term_meta( $term->term_id, 'epcl_post_categories', true );                  
                    }
                ?>
                <div class="slick-item tag ">
                    <div class="item bg-box shadow-effect primary-cat-<?php echo esc_attr($term->term_id); ?>">
                        <h4 class="title medium fw-bold no-margin ctag ctag-<?php echo esc_attr($term->term_id); ?>"><svg><use xlink:href="#tag-decoration"></use></svg><?php echo esc_html($term->name); ?></h4>
                        <div class="info">                            
                            <?php if( $term->description ): ?>    
                                <div class="description"><?php echo esc_html( wp_trim_words($term->description, 22) ); ?></div>
                            <?php endif; ?>
                            <p class="amount"><?php esc_html( printf( _n( '%1$s <span class="dot"></span> Article', '%1$s &nbsp;<span class="dot"></span> Articles', $term->count, 'wavy'), number_format_i18n( $term->count ) ) ); ?></p>         
                        </div>    
                        <a href="<?php echo get_term_link($term); ?>" class="full-link"></a>
                        <div class="epcl-category-overlay"></div>
                    </div>  
                </div>

            <?php endforeach; ?>
        </div>
	</section>
	<!-- end: .carousel -->
<?php endif; ?>
