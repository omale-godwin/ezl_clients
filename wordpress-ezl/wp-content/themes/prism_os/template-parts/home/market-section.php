<section>
    <div class="custom-maxW financial-tech">
        <div class="header-content">
            <h2 class="text-left">Financial Technology</h2>
            <h3 class="text-left">How We Assist Traders</h3>
        </div>

        <div class="d-flex align-items gap-16 finacial-btns">
            <a href="#request-demo" class="red-button2" aria-label="Request a demo of our financial technology platform">Request a Demo</a>
            <a href="#talk-to-expert" class="transparent-button2" aria-label="Speak with a financial technology expert">Talk to an Expert</a>
        </div>

        <div class="d-flex align-items justify-content gap-24px finacial-container mt-24">
            <div class="financial-left">
                <?php
                $services = [
                    [
                        'heading' => 'Stocks Trading',
                        'text' => 'Trade stocks like it’s your destiny',
                    ],
                    [
                        'heading' => 'Futures Options Trading',
                        'text' => 'Strategy with real-time data feeds across global exchanges',
                    ],
                    [
                        'heading' => 'Advanced Platform',
                        'text' => 'With TradeStation, you’re never alone',
                    ],
                    [
                        'heading' => 'For Large Companies',
                        'text' => '500–20,000+ employees',
                    ],
                ];
                foreach ($services as $service): ?>
                    <div class="fin-market d-flex align-items justify-content">
                        <div>
                            <h3><?php echo esc_html($service['heading']); ?></h3>
                            <p><?php echo esc_html($service['text']); ?></p>
                        </div>
                        <span>
                            <img 
                                src="https://cdn.electricoctopus.agency/prismos/go.png" 
                                alt="<?php echo esc_attr($service['heading']); ?> icon" 
                                loading="lazy"
                                width="60" height="60"
                                decoding="async"
                            >
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="financial-right">
                <picture>
                    
                    <img 
                        src="https://cdn.electricoctopus.agency/prismos/map.webp" 
                        alt="World map showing company presence in offices and countries" 
                        loading="lazy"
                        decoding="async"
                    >
                </picture>
                <div class="map-block">
                    <?php
                    $metrics = [
                        ['value' => '4', 'label' => 'Offices'],
                        ['value' => '4', 'label' => 'Countries'],
                        ['value' => '245+', 'label' => 'Clients'],
                    ];
                    foreach ($metrics as $metric) : ?>
                        <div class="metric-block">
                            <p class="metric-value"><?php echo esc_html($metric['value']); ?></p>
                            <p class="metric-label"><?php echo esc_html($metric['label']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>    
            </div>
        </div>
    </div>
</section>
