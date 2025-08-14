<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package prismOs
 */

?>

<footer id="colophon" class="site-footer" role="contentinfo" aria-label="Footer">
    <div class="footer-section">
        <div class="footer-container">
            <div class="signup-newsletter">
                <h2>Signup to our Newsletter</h2>
                <form id="newsletterForm" class="newsletter__form" action="#" method="post" novalidate>
                    <!-- Honeypot: simple anti-spam - keep hidden visually and from screen readers -->
                    <label class="hidden" for="website">Leave this field empty</label>
                    <input type="text" name="website" id="website" class="hidden" autocomplete="off" tabindex="-1" />

                    <label for="newsletter-email" class="newsletter__label visually-hidden">Enter Email address</label>
                    <div class="newsletter__row">
                        <input
                            id="newsletter-email"
                            name="email"
                            type="email"
                            inputmode="email"
                            placeholder="Enter Email address"
                            required
                            aria-required="true"
                            class="newsletter__input"
                        />

                        <button type="submit" class="newsletter__button" aria-label="Submit newsletter signup">Submit <img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/prismos/Arrowright.png" loading="lazy"></button>
                    </div>
                    <p id="newsletter-status" class="newsletter__status" aria-live="polite" hidden></p>
                </form>
            </div>
            <div class="foo-flex">
                <!-- Left Section (Widget Area) -->
                <div class="footer-left" itemscope itemtype="http://schema.org/Organization">
                    <a href="/" aria-label="PrismOS Home">
                        <img src="https://cdn.electricoctopus.agency/prismos/prismos_logo.webp" alt="PrismOS logo" loading="lazy">
                    </a>    

                    <h2 class="mt-16">Questions?</h2>
                    <h3>We are happy to help</h3>

                    <address class="phone-num mt-16" itemprop="address" style="font-style: normal;">
                        <p class="ph-heading mb-16">Phone Numbers</p>
                        <p class="d-flex align-items gap-16">
                            <span>
                                <img src="https://cdn.electricoctopus.agency/prismos/usa.png" alt="USA" loading="lazy">
                            </span>
                            <a href="tel:+16507181376" itemprop="telephone" class="dial-num">+1 650-718-1376</a>
                        </p>
                        <p class="d-flex align-items gap-16">
                            <span class="country-flag">
                                <img src="https://cdn.electricoctopus.agency/prismos/country.png" alt="USA" loading="lazy">
                                <img src="https://cdn.electricoctopus.agency/prismos/london.png" alt="USA" loading="lazy">
                            </span>
                            <a href="tel:+16507181376" itemprop="telephone" class="dial-num">+1 650-718-1376</a>
                        </p>
                    </address>
                </div>


                <!-- Right Section (Dynamic Menus) -->
                <div class="footer-right d-flex">
                    <?php
                      function render_footer_menu($location, $title, $extra_class = '') {
                          echo '<div' . ($extra_class ? ' class="' . esc_attr($extra_class) . '"' : '') . '>';
                          echo '<h3 class="footer-heading">' . esc_html($title) . '</h3>';
                          wp_nav_menu([
                              'theme_location' => $location,
                              'container' => false,
                              'menu_class' => 'foo-list-item',
                          ]);
                          echo '</div>';
                      }
                      ?>
                        <?php
                          render_footer_menu('footer-services', 'Services');
                          render_footer_menu('footer-platform', 'PLATFORM');
                          render_footer_menu('footer-whyus', 'Why Us');
                          render_footer_menu('footer-resources', 'Resources');
                          render_footer_menu('footer-company', 'Company');
                          ?>      
                </div>
            </div>
            <div class="contact-sect">
                <h2>Contact us</h2>
            </div>
            <div class="copyright-sect d-flex align-items justify-content">
                <p>© 2025 Company Name. All rights reserved.</p>
                <div class="social-widget d-flex align-items gap-16">
                    <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/prismos/linkedin.png" loading="lazy"></a>
                    <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/prismos/facebook.png" loading="lazy"></a>
                    <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/prismos/glob.png" loading="lazy"></a>
                    <a href="#"><img decoding="async" alt="icon" src="https://cdn.electricoctopus.agency/prismos/x.png" loading="lazy"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const steps = document.querySelectorAll(".step");
    const images = ["https://cdn.electricoctopus.agency/prismos/slide1.webp", "https://cdn.electricoctopus.agency/prismos/slide2.webp", "https://cdn.electricoctopus.agency/prismos/slide3.webp"];
    const stepImage = document.getElementById("step-image");

    let currentStep = 0;

    function showStep(index) {
        steps.forEach((step, i) => {
            step.classList.toggle("active", i === index);
        });
        stepImage.src = images[index];
    }

    setInterval(() => {
        currentStep = (currentStep + 1) % steps.length;
        showStep(currentStep);
    }, 3000);

    showStep(currentStep);
});
</script>
<script>
    document.querySelector('.mobile-toggle').addEventListener('click', function(){
    document.querySelector('.header-menubttn ul').classList.toggle('open');
});

</script>
</body>
</html>
