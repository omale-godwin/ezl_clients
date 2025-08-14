<section>
    <div class="testimonial-section custom-maxW d-flex justify-content">
        <div class="testimonial-left">
            <div class="user-view-block" aria-label="User avatars">
                <?php
                $avatars = [
                    'user-1.png', 'user-2.png', 'user-3.png', 'user-4.png', 'user-5.png'
                ];
                foreach ($avatars as $i => $avatar) :
                ?>
                    <img src="https://cdn.electricoctopus.agency/prismos/<?= esc_attr($avatar); ?>" 
                        alt="User <?= $i + 1; ?>" 
                        loading="lazy" />
                <?php endforeach; ?>
            </div>
            <h3>So easy it barely needs support, PrismOS Algo, grow your portfolio</h3>
        </div>

        <div class="testimonial-right testimonial-slider">
            <?php
            $testimonials = [
                [
                    'title' => 'No more missed opportunities.',
                    'text' => 'Whether you’re a 20-person scale-up or a 20,000-strong multinational, we can help your B2B company meet ideal clients and close deals faster.',
                    'name' => 'Jason Brown',
                    'role' => 'CTO, Zapier',
                    'user_img' => 'testimonial-user.png'
                ],
                // Duplicate as needed or pull from DB/ACF
                [
                    'title' => 'No more missed opportunities.',
                    'text' => 'Whether you’re a 20-person scale-up or a 20,000-strong multinational, we can help your B2B company meet ideal clients and close deals faster.',
                    'name' => 'Jason Brown',
                    'role' => 'CTO, Zapier',
                    'user_img' => 'testimonial-user.png'
                ],
                [
                    'title' => 'No more missed opportunities.',
                    'text' => 'Whether you’re a 20-person scale-up or a 20,000-strong multinational, we can help your B2B company meet ideal clients and close deals faster.',
                    'name' => 'Jason Brown',
                    'role' => 'CTO, Zapier',
                    'user_img' => 'testimonial-user.png'
                ],
                [
                    'title' => 'No more missed opportunities.',
                    'text' => 'Whether you’re a 20-person scale-up or a 20,000-strong multinational, we can help your B2B company meet ideal clients and close deals faster.',
                    'name' => 'Jason Brown',
                    'role' => 'CTO, Zapier',
                    'user_img' => 'testimonial-user.png'
                ],
                [
                    'title' => 'No more missed opportunities.',
                    'text' => 'Whether you’re a 20-person scale-up or a 20,000-strong multinational, we can help your B2B company meet ideal clients and close deals faster.',
                    'name' => 'Jason Brown',
                    'role' => 'CTO, Zapier',
                    'user_img' => 'testimonial-user.png'
                ],
                [
                    'title' => 'No more missed opportunities.',
                    'text' => 'Whether you’re a 20-person scale-up or a 20,000-strong multinational, we can help your B2B company meet ideal clients and close deals faster.',
                    'name' => 'Jason Brown',
                    'role' => 'CTO, Zapier',
                    'user_img' => 'testimonial-user.png'
                ],
            ];

            foreach ($testimonials as $testimonial) :
            ?>
                <div>
                    <div class="testtimonial-card">
                        <div>
                            <img src="https://cdn.electricoctopus.agency/prismos/QuoteIcon.png" alt="Quote Icon" loading="lazy" decoding="async"/>
                            <h2><?= esc_html($testimonial['title']); ?></h2>
                            <p><?= esc_html($testimonial['text']); ?></p>
                        </div>
                        <div class="testi-user d-flex align-items gap-16">
                            <div class="user-img">
                                <img src="https://cdn.electricoctopus.agency/prismos/<?= esc_attr($testimonial['user_img']); ?>" 
                                    alt="<?= esc_attr($testimonial['name']); ?>" 
                                    loading="lazy" 
                                    decoding="async"/>
                            </div>
                            <div class="user-details">
                                <h3><?= esc_html($testimonial['name']); ?></h3>
                                <p><?= esc_html($testimonial['role']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
