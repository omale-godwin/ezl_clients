<?php $epcl_theme = epcl_get_theme_options(); ?>
<?php
if( !get_the_author_meta('description') ) return;

$author_id = get_the_author_meta('ID');
$user_meta = get_user_meta( $author_id, 'epcl_user', true );
$author_avatar = epcl_get_author_avatar($user_meta, $author_id, 512);

$author_name = get_the_author();
$author_url = get_author_posts_url($author_id);
$class = $author_position = '';
if($author_avatar) $class .= ' with-avatar'; else $class .= ' no-avatar';
if( !empty($user_meta) && !empty( $user_meta['position']) ){
    $author_position = $user_meta['position'];
}
$website = get_the_author_meta('user_url');

if( is_author() ) $class .= ' grid-container grid-medium bg-box';

if( is_single() ){
    $class .= ' single-author np-bottom';
}

?> 

<!-- start: .author -->
<section id="author" class="author section <?php echo esc_attr($class); ?>">
    <?php if( is_single() ): ?>
        <h3 class="title medium bordered absolute-border gray-border"><span><?php echo esc_html__('About the Author', 'wavy'); ?></span><svg class="decoration"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#title-decoration"></use></svg></h3>
    <?php endif; ?>

    <div class="epcl-flex">
        <?php if($author_avatar): ?>
            <div class="left">
                <a href="<?php echo esc_url( $author_url ); ?>" class="author-avatar translate-effect epcl-loader">
                    <span class="screen-reader-text"><?php echo esc_html( $author_name ); ?></span>
                    <?php if( epcl_is_amp() || epcl_get_option('enable_lazyload') !== '1' ): ?>
                        <img class="author-image cover" src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr( $author_name ); ?>">
                    <?php else: ?>
                        <img class="author-image cover lazy" src="<?php echo epcl_placeholder(); ?>" data-src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr( $author_name ); ?>">
                    <?php endif; ?>
                </a>   
            </div>
        <?php endif; ?>   
        <div class="right">
            <?php if( is_archive() ): ?>
                <h4 class="title bordered author-name">
                    <?php echo esc_html( $author_name ); ?>                    
                    <svg class="decoration"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#title-decoration"></use></svg>
                    <?php if( $author_position ): ?>
                        <span class="location"><?php echo esc_html($author_position); ?></span>
                    <?php endif; ?>
                </h4>
            <?php else: ?>
                <h4 class="title medium author-name underline-effect">
                    <a href="<?php echo esc_attr( $author_url ); ?>"><?php echo esc_html( $author_name ); ?></a>
                    <?php if( $author_position ): ?>
                        <span class="location"><?php echo esc_html($author_position); ?></span>
                    <?php endif; ?>
                </h4>                
            <?php endif; ?>
            <div class="info">
                <p><?php the_author_meta('description'); ?></p>    
            </div> 
            <?php if( !empty($user_meta) && ($user_meta['facebook'] || $user_meta['twitter'] || $website || !empty($user_meta['custom_social']) ) ): ?>
                <div class="social epcl-social-fill-color">                        
                    <?php if($user_meta['twitter']): ?>
                        <a href="<?php echo esc_url($user_meta['twitter']); ?>" class="twitter tooltip" data-title="<?php echo esc_attr__('Follow me on Twitter', 'wavy'); ?>" target="_blank">
                            <svg class="icon"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#twitter-icon"></use></svg><span class="name"><?php echo esc_html__('Twitter', 'wavy'); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if($user_meta['facebook']): ?>
                        <a href="<?php echo esc_url($user_meta['facebook']); ?>" class="facebook tooltip" data-title="<?php echo esc_attr__('Follow me on Facebook', 'wavy'); ?>" target="_blank">
                            <svg class="icon"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#facebook-icon"></use></svg><span class="name"><?php echo esc_html__('Facebook', 'wavy'); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if($website): ?>
                        <a href="<?php echo esc_url($website); ?>" class="website tooltip" data-title="<?php echo esc_attr__('Website', 'wavy'); ?>: <?php echo esc_url($website); ?>" target="_blank">
                            <svg class="icon main-color"><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#website-icon"></use></svg><span class="name"><?php echo esc_html__('Website', 'wavy'); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php
                    if( !empty($user_meta['custom_social']) ){
                        foreach( $user_meta['custom_social'] as $cs ){
                            $cs_id = 'custom-'.sanitize_title($cs['social_name']);
                            if( !empty($cs['social_icon']['url']) ){
                                $id = sanitize_title($cs['social_name']);
                                $icon = '<img src="'.esc_url( $cs['social_icon']['url'] ).'" alt="'.$cs['social_name'].'" loading="lazy">';
                                $url = $cs['social_url'];
                                echo '<a href="'.$url.'" class="custom-social tooltip '.$cs_id.'" target="_blank" rel="nofollow noopener" data-title="'.sprintf( esc_attr__('Follow me on %s', 'wavy'), $cs['social_name'] ).'"><span class="icon '.$cs_id.'">'.$icon.'</span><span class="name">'.esc_html($cs['social_name']).'</span></a>';
                            }
                        }
                    }
                ?>
                </div> 
            <?php endif; ?>
            <?php if( is_single() ): ?>
                <a href="<?php echo esc_attr( $author_url ); ?>" class="epcl-button medium gradient-button icon wave-button">
                    <?php echo esc_html__('View All Posts', 'wavy'); ?>
                </a>           
            <?php else: ?>
                <a href="#post-list" class="epcl-button gradient-button icon wave-button scrollto">
                    <svg><use xlink:href="<?php echo EPCL_THEMEPATH; ?>/assets/images/svg-icons.svg#double-arrow-icon"></use></svg>
                    <?php echo esc_html__('Explore', 'wavy'); ?>
                </a>      
                <svg class="bg-decoration" width="327" height="265" viewBox="0 0 327 265" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_872_366)">
                    <path d="M327 114.469C291.048 114.469 272.813 100.796 255.183 87.5686C238.744 75.2314 223.208 63.5938 191.333 63.5938C159.458 63.5938 143.923 75.2473 127.477 87.5686C109.847 100.796 91.6183 114.469 55.66 114.469C19.7017 114.469 1.47981 100.796 -16.1502 87.5686C-32.5898 75.2314 -48.125 63.5938 -80 63.5938V0C-44.0483 0 -25.8198 13.6727 -8.18977 26.9002C8.24984 39.2373 23.785 50.875 55.66 50.875C87.535 50.875 103.07 39.2214 119.51 26.9002C137.146 13.6727 155.375 0 191.333 0C227.292 0 245.52 13.6727 263.15 26.9002C279.59 39.2373 295.125 50.875 327.007 50.875V114.469H327Z"/>
                    </g>
                    <g clip-path="url(#clip1_872_366)">
                    <path d="M327 228.938C291.048 228.938 272.813 215.265 255.183 202.037C238.744 189.7 223.208 178.062 191.333 178.062C159.458 178.062 143.923 189.716 127.477 202.037C109.847 215.265 91.6183 228.938 55.66 228.938C19.7017 228.938 1.47981 215.265 -16.1502 202.037C-32.5898 189.7 -48.125 178.062 -80 178.062V114.469C-44.0483 114.469 -25.8198 128.141 -8.18977 141.369C8.24984 153.706 23.785 165.344 55.66 165.344C87.535 165.344 103.07 153.69 119.51 141.369C137.146 128.141 155.375 114.469 191.333 114.469C227.292 114.469 245.52 128.141 263.15 141.369C279.59 153.706 295.125 165.344 327.007 165.344V228.938H327Z"/>
                    </g>
                    <g clip-path="url(#clip2_872_366)">
                    <path d="M327 343.406C291.048 343.406 272.813 329.734 255.183 316.506C238.744 304.169 223.208 292.531 191.333 292.531C159.458 292.531 143.923 304.185 127.477 316.506C109.847 329.734 91.6183 343.406 55.66 343.406C19.7017 343.406 1.47981 329.734 -16.1502 316.506C-32.5898 304.169 -48.125 292.531 -80 292.531V228.938C-44.0483 228.938 -25.8198 242.61 -8.18977 255.838C8.24984 268.175 23.785 279.812 55.66 279.812C87.535 279.812 103.07 268.159 119.51 255.838C137.146 242.61 155.375 228.938 191.333 228.938C227.292 228.938 245.52 242.61 263.15 255.838C279.59 268.175 295.125 279.812 327.007 279.812V343.406H327Z"/>
                    </g>
                </svg>                
            <?php endif; ?>
        </div>
    </div>

</section>
<!-- end: .author -->

<div class="clear"></div>
