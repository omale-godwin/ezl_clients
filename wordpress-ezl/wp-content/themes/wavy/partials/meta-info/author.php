<?php
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
<a href="<?php echo get_author_posts_url($author_id); ?>" class="author">                                        
    <?php if($author_avatar): ?>
        <?php if( epcl_is_amp() || epcl_get_option('enable_lazyload') !== '1' ): ?>
            <img class="author-image cover" loading="lazy" src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">    
        <?php else: ?>
            <img class="author-image cover lazy" src="<?php echo epcl_placeholder(); ?>" data-src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">    
        <?php endif; ?>                       
    <?php endif; ?>                               
    <span class="author-name"><span><?php echo esc_html__('By', 'wavy') ?></span> <?php echo esc_html($author_name); ?></span>
</a>