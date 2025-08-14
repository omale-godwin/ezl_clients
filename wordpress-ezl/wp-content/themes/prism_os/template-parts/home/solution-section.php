<section>
    <div class="custom-maxW">
        <div class="header-content">
            <h2>HEADEr</h2>
            <h3>Comprehensive Solutions Tailored to Your Needs</h3>
            <p>
            Our data-driven approach combines 20+ years of financial expertise with cutting-edge technology. Every decision is backed by rigorous backtesting of 150+ algorithm iterations, ensuring your portfolio benefits from proven, systematic excellence.
            </p>
        </div>

        <div class="solution-section d-flex align-items">
            <div>
                <img 
                    src="https://cdn.electricoctopus.agency/prismos/solution-img.webp" 
                    alt="Illustration of tailored financial solutions" 
                    width="600" height="400" 
                    loading="lazy" 
                    decoding="async"
                >
            </div>

            <div class="faq-block">
                <?php if (have_rows('solution_faqs')) : ?>
                    <div class="faq-wrapper" role="list">
                        <?php $index = 0; ?>
                        <?php while (have_rows('solution_faqs')) : the_row(); 
                            $question = get_sub_field('question');
                            $answer   = get_sub_field('answer'); 
                            $is_first = ($index === 0);
                        ?>
                            <div class="faq-item" role="listitem">
                                <button 
                                    class="faq-question" 
                                    aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>" 
                                    aria-controls="faq-answer-<?php echo $index; ?>" 
                                    id="faq-question-<?php echo $index; ?>" 
                                    type="button"
                                >
                                    <?php echo esc_html($question); ?>
                                    <span class="faq-icon" aria-hidden="true"></span>
                                </button>

                                <div 
                                    id="faq-answer-<?php echo $index; ?>" 
                                    class="faq-answer" 
                                    role="region" 
                                    aria-labelledby="faq-question-<?php echo $index; ?>" 
                                    <?php echo !$is_first ? 'hidden' : ''; ?>
                                >
                                    <?php echo wp_kses_post($answer); ?>

                                    <div class="d-flex align-items gap-16 mt-24">
                                        <a href="#trial-offer" class="red-button2">Try It for 90 Days</a>
                                        <a href="#trial-offer" class="transparent-button2">Learn More</a>
                                    </div>
                                </div>
                            </div>
                            <?php $index++; ?>
                        <?php endwhile; ?>
                    </div>          
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
