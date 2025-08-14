<section>
    <div class="custom-maxW">
        <div class="faq-section d-flex">
            <div class="header-content faq-left">
            <h2 class="text-left">FAQ</h2>
            <h3 class="text-left">Got Questions? <br/>We’ve Got Answers</h3>
            <p class="text-left">
            Starting in 2016, we backtested over 150 different optimization models, selecting the strategy with the highest risk-adjusted returns since 2007. After paper trading in 2017, we began live trading with our own capital in 2018. The system now executes with 0.001% precision margin, having processed thousands of trades without error.
            </p>
            <p class="font-w-700 text-left">Still need help? <a href="#">Contact us.</a></p>
        </div>

            <div class="faq-block">
                <?php if (have_rows('faqs')) : ?>
                    <div class="faq-wrapper" role="list">
                        <?php $index = 0; ?>
                        <?php while (have_rows('faqs')) : the_row(); 
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
