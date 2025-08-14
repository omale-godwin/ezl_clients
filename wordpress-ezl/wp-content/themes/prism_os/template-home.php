<?php
/*
Template Name: Home Page
*/
get_header();?>
<div class="main-container">
<?php
get_template_part('template-parts/home/hero-banner');
get_template_part('template-parts/home/testimonial-slider');
get_template_part('template-parts/home/solution-section');
get_template_part('template-parts/home/metrics-section');
get_template_part('template-parts/home/strategy-section');
get_template_part('template-parts/home/market-section');
get_template_part('template-parts/home/how-it-works');
get_template_part('template-parts/home/video-section');
get_template_part('template-parts/home/resources-hub');
get_template_part('template-parts/home/expert-banner');
get_template_part('template-parts/home/customer-review');
get_template_part('template-parts/home/faq-section');
get_template_part('template-parts/home/investment-work-section');
?>
</div>
<?php
get_footer();
?>
