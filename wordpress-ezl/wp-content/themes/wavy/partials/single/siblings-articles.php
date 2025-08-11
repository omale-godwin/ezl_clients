<?php
$next_post = get_next_post();
$prev_post = get_previous_post();
if( empty($next_post) && empty($prev_post) ) return;
$thumb_size = 'medium_large';
?>
<section class="siblings" id="epcl-other-stories">
    <?php    
    if( !empty($prev_post) ){
        $prev_url = get_the_permalink($prev_post->ID);
        $prev_thumb = get_the_post_thumbnail_url($prev_post->ID, $thumb_size);
        $prev_post_meta = get_post_meta( $prev_post->ID, 'epcl_post', true );
        $post_class = epcl_get_primary_category( '', $prev_post_meta, $prev_post->ID );
    }
    ?>
    <?php if( !empty($prev_post) ): ?>
        <a href="<?php echo esc_url($prev_url); ?>" class="epcl-button gradient-button wave-button">
            <?php echo esc_html__('Previous Article', 'wavy'); ?>
        </a>
    <?php endif; ?>

    <?php
    if( !empty($next_post) ){
        $next_url = get_the_permalink($next_post->ID);
        $next_thumb = get_the_post_thumbnail_url($next_post->ID, $thumb_size);
        $next_post_meta = get_post_meta( $next_post->ID, 'epcl_post', true );
        $post_class = epcl_get_primary_category( '', $next_post_meta, $next_post->ID );
    }
    ?>

    <?php if( !empty($next_post) ): ?>
        <a href="<?php echo esc_url($next_url); ?>" class="epcl-button gradient-button wave-button alignright">
            <?php echo esc_html__('Next Article', 'wavy'); ?>
        </a>
    <?php endif; ?>

    <div class="clear"></div>

</section>