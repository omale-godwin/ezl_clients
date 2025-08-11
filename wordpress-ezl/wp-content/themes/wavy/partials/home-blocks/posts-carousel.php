<?php
$epcl_module = epcl_get_module_options();
if( empty($epcl_module) ) return; // no data from carousel module
$prefix = EPCL_THEMEPREFIX.'_';
$args = array(
	'post_type' => 'post',
	'showposts' => $epcl_module['posts_carousel_limit'],
	'suppress_filters' => false,
    'meta_key' => '_thumbnail_id'
);

if( !empty($epcl_module) ){
    // Categories filters
    if( isset($epcl_module['featured_categories']) && $epcl_module['featured_categories'] != '' ){
        $args['cat'] = $epcl_module['featured_categories'];
    }
    if( isset($epcl_module['excluded_categories']) && $epcl_module['excluded_categories'] != '' ){
        $args['category__not_in'] = $epcl_module['excluded_categories'];
    }
    // Order by: Date, Views, Name
    if( isset($epcl_module['orderby']) && $epcl_module['orderby'] != '' ){
        $args['orderby'] = $epcl_module['orderby'];
        if( $epcl_module['orderby'] == 'views' ){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'views_counter';
        }
    }
    // Posts order: ASC, DESC
    if( isset($epcl_module['posts_order']) && $epcl_module['posts_order'] != '' ){
        $args['order'] = $epcl_module['posts_order'];
    }
    // Filter by date (year, month, etc)
    if( isset($epcl_module['date']) && $epcl_module['date'] != 'alltime' ){
        $year = date('Y');
        $month = absint( date('m') );
        $week = absint( date('W') );
    
        $args['year'] = $year;
    
        if( $epcl_module['date'] == 'pastmonth' ){
            $args['monthnum'] = $month - 1;
        }
        if( $epcl_module['date'] == 'pastweek' ){
            $args['w'] = $week - 1;
        }
        if( $epcl_module['date'] == 'pastyear' ){
            unset( $args['year'] );
            $today = getdate();
            $args['date_query'] = array(
                array(
                    'after' => $today[ 'month' ] . ' 1st, ' . ($today[ 'year' ] - 2)
                )
            );
        }
    }
}

$carousel = get_posts($args);
$thumbnail_size = 'epcl_classic';
?>

<?php if( !empty($carousel) ): ?>
    <div class="grid-container grid-ularge np-mobile np-tablet" data-aos="fade">
        <?php if( isset($epcl_module['module_title']) && $epcl_module['module_title'] != '' ): ?>
            <h2 class="title bordered large section-title carousel-title"><?php echo esc_html( $epcl_module['module_title'] ); ?><svg class="decoration"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#title-decoration"></use></svg></h2>
        <?php endif; ?>
        <!-- start: .carousel -->
        <div class="epcl-carousel epcl-posts-carousel slick-slider outer-arrows slides-<?php echo intval( $epcl_module['posts_carousel_show_limit'] ); ?>" data-show="<?php echo intval( $epcl_module['posts_carousel_show_limit'] ); ?>" data-rtl="<?php echo is_rtl(); ?>" id="<?php echo wp_unique_id('epcl-post-carousel-'); ?>" data-fade="false" data-dots="true">
            <?php foreach($carousel as $post): setup_postdata($post); ?>
                <?php
                    $image_id = get_post_thumbnail_id($post->ID);
                    $post_meta = get_post_meta( $post->ID, 'epcl_post', true );
                    $thumb = wp_get_attachment_image_src( $image_id, $thumbnail_size );
                    $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
                    $image_url = '';
                    if( !empty($thumb) ){
                        $image_url = $thumb[0];
                    }
                    if( defined('EPCL_PLUGIN_PATH') && !empty($post_meta) ){
                        if( isset( $post_meta['optimized_image'] ) && $post_meta['optimized_image']['url'] != '' ){
                            $optimized_image = $post_meta['optimized_image_slider'];
                        }                    
                        if( isset($optimized_image['alt']) && $optimized_image['alt'] != ''){
                            $image_alt = $optimized_image['alt'];
                        }                    
                        if( !empty($optimized_image) ){
                            $image_url = $optimized_image['url'];
                        }
                    }               
                    if( !$image_alt ){
                        $image_alt = get_the_title();
                    }
                    $author_id = get_the_author_meta('ID');
                    $user_meta = get_user_meta( $author_id, 'epcl_user', true );
                    // if( !empty($user_meta) && !empty( $user_meta['avatar']) && $user_meta['avatar']['url'] != '' ){
                    //     $author_avatar = $user_meta['avatar']['url'];
                    // }else{
                    //     $author_avatar = get_avatar_url( get_the_author_meta('email'), array( 'size' => 120 ));
                    // }
                    $author_avatar = epcl_get_author_avatar($user_meta, $author_id, 120);
                    $author_name = get_the_author();
                ?>
                <div class="item">
                    <article class="bg-white">
                        
                        <?php if( $image_url ): ?>
                            <div class="epcl-loader">
                                <?php if( epcl_get_option('enable_lazyload') == '1' ): ?>
                                    <img class="img cover" src="<?php echo epcl_placeholder(); ?>" data-lazy="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                <?php else: ?>
                                    <img class="img cover" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- start: .info -->
                        <div class="info">                     
                            <h3 class="post-title title medium no-margin textcenter">
                                <a href="<?php the_permalink(); ?>" class=""><?php the_title(); ?></a>
                            </h3>  
                            <div class="meta small">
                                <a href="<?php echo get_author_posts_url($author_id); ?>" class="author">                                        
                                    <?php if($author_avatar): ?>
                                        <img class="author-image cover small" loading="lazy" src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">                   
                                    <?php endif; ?>                               
                                    <span class="author-name"><?php echo esc_html($author_name); ?></span>
                                </a>                                  
                                <?php get_template_part('partials/meta-info/date'); ?>      
                            </div>             
                        </div>
                        <!-- end: .info --> 

                        <div class="clear"></div>

                        <a href="<?php the_permalink(); ?>" class="full-link" aria-label="<?php the_title(); ?>"><span class="screen-reader-text"><?php the_title(); ?></span></a>
                    </article>
                </div>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <!-- end: .carousel -->
    </div>
<?php endif; ?>