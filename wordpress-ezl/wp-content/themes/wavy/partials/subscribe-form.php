<?php if( epcl_get_option('subscribe_url') ): ?>

    <div class="epcl-subscribe">
        <div class="grid-container grid-usmall grid-parent np-mobile textcenter">                
            <form class="subscribe-form" action="<?php echo esc_url( epcl_get_option('subscribe_url') ); ?>" method="<?php echo esc_attr( epcl_get_option_text('subscribe_method', 'POST') ); ?>" target="_blank">
                <?php if( epcl_get_option('subscribe_parameters') && function_exists('epcl_render_subscribe_parameters') ): ?>
                    <?php epcl_render_subscribe_parameters( epcl_get_option('subscribe_parameters') ); ?>
                <?php endif; ?>
                <h2 class="title large white"><?php echo wp_kses_post( epcl_get_option_text('subscribe_title', esc_html__('Subscribe to our Newsletter', 'wavy') ) ); ?></h2>
                <p class="description"><?php echo wp_kses_post( epcl_get_option_text('subscribe_description', esc_html__('Subscribe to our email newsletter to get the latest posts delivered right to your email.', 'wavy') ) ); ?></p>  
                <div class="form-group">
                    <input type="email" name="<?php echo esc_attr( epcl_get_option_text('subscribe_email_field_name', 'MERGE0') ); ?>" class="inputbox large" required placeholder="<?php esc_attr_e('Enter your email address', 'wavy'); ?>">
                    <button class="epcl-button submit absolute wave-button" type="submit"><?php esc_html_e('Get Started', 'wavy'); ?><span class="loader"></span></button>
                </div>    
                <?php wp_nonce_field( 'epcl_subscribe', 'subscribe_nonce' ); ?>              
            </form>
        </div>
        <svg class="epcl-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <g class="epcl-parallax">
                <use xlink:href="#gentle-wave" x="48" y="2" fill="rgba(252, 255, 255,0.1)" />
                <use xlink:href="#gentle-wave" x="48" y="4" fill="rgba(252, 255, 255,0.15)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(252, 255, 255,0.1)" />
            </g>
        </svg>
    </div>
  
<?php endif; ?>