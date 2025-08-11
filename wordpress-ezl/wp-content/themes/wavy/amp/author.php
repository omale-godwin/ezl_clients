<?php get_template_part('amp/header'); ?>
<?php
$layout = epcl_get_option( 'amp_archives_layout', 'classic-posts' );
add_filter('excerpt_length', 'epcl_small_excerpt_length', 999);
$module_class = '';
if( !is_active_sidebar('epcl_sidebar_home') ){
    $module_class .= ' no-active-sidebar';
}
if( !get_the_author_meta('description') ){
    $module_class .= ' content';
}
?>

<!-- start: #archives-->
<main id="archives" class="main">

    <!-- start: .content-wrapper -->
    <div class="content-wrapper <?php echo esc_attr($module_class); ?>">

        <div class="grid-container">
            <?php get_template_part('partials/author-box'); ?>
        </div>

        <div id="post-list">
            <?php get_template_part( 'partials/home-blocks/'.$layout ); ?>
        </div>

    </div>
    <!-- end: .content-wrapper -->

</main>
<!-- end: #archives -->

<?php get_template_part('amp/footer'); ?>