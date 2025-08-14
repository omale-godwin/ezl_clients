<section>
    <div class="stategy-section">
        <div class="custom-maxW">
            <div class="strategy-slide">
                <div>
                    <div class="dataset-container gap-8">
                        <div class="dataset-left">
                            <p class="d-flex align-items yellow-color gap-8 head-tag">
                                <img 
                                    src="https://cdn.electricoctopus.agency/prismos/y_check_circle.png" 
                                    alt="Datasets Check Icon" 
                                    width="20" height="20" 
                                    loading="lazy" 
                                    decoding="async"
                                >
                                DATASETS
                            </p>
                            
                            <h2>Innovative Strategies for Unmatched Results</h2>
                            
                            <p>
                                With over <strong>15 years of experience</strong>, we accurately model multi-asset portfolio strategies, 
                                track real-time strategy equity across complex portfolios in both backtesting and live trading. 
                                Easily access your strategy's remaining margin and size positions to optimize cash usage.
                            </p>

                            <div class="tab-buttons" role="tablist" aria-label="Strategy Features">
                                <button role="tab" aria-selected="true" data-img="https://cdn.electricoctopus.agency/prismos/dataset.webp" class="active">
                                    Backtesting
                                </button>
                                <button role="tab" aria-selected="false" data-img="https://cdn.electricoctopus.agency/prismos/dataset.webp">
                                    Parameter Optimization
                                </button>
                                <button role="tab" aria-selected="false" data-img="https://cdn.electricoctopus.agency/prismos/dataset.webp">
                                    Institutional-Grade Live Trading
                                </button>
                            </div>

                            <div class="mt-24">
                                <a href="#prismos-demo" class="white-button" aria-label="See PrismOS in action">See PrismOS in Action</a>
                            </div>
                        </div>

                        <div class="tab-content dataset-right">
                            <div class="tab-image">
                                <img 
                                    id="strategy-image" 
                                    src="https://cdn.electricoctopus.agency/prismos/dataset.webp" 
                                    alt="Backtesting data visualization from PrismOS" 
                                    loading="lazy" 
                                    decoding="async" 
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="dataset-container gap-8">
                        <div class="dataset-left">
                            <p class="d-flex align-items yellow-color gap-8 head-tag">
                                <img 
                                    src="https://cdn.electricoctopus.agency/prismos/y_check_circle.png" 
                                    alt="Datasets Check Icon" 
                                    width="20" height="20" 
                                    loading="lazy" 
                                    decoding="async"
                                >
                                ROI calculator
                            </p>
                            
                            <h2>Proof is in the Profit</h2>
                            
                            <p>
                                We can’t predict the future, but our 10+ years experience can give a confident estimate.
                            </p>

                            <div class="tab-buttons" role="tablist" aria-label="Strategy Features">
                                <button role="tab" aria-selected="true" data-img="https://cdn.electricoctopus.agency/prismos/dataset.webp" class="active">
                                    Codebase-Syncing
                                </button>
                                <button role="tab" aria-selected="false" data-img="https://cdn.electricoctopus.agency/prismos/dataset.webp">
                                    Web Editor
                                </button>
                                <button role="tab" aria-selected="false" data-img="https://cdn.electricoctopus.agency/prismos/dataset.webp">
                                    Preview Deployment
                                </button>
                            </div>

                            <div class="mt-24">
                                <a href="#prismos-demo" class="white-button" aria-label="See PrismOS in action">See PrismOS in Action</a>
                            </div>
                        </div>

                        <div class="tab-content dataset-right">
                            <div class="tab-image">
                                <img 
                                    id="strategy-image" 
                                    src="https://cdn.electricoctopus.agency/prismos/dataset.webp" 
                                    alt="Backtesting data visualization from PrismOS" 
                                    loading="lazy" 
                                    decoding="async" 
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="api-plyground d-flex align-items justify-content">
                <?php
                    $api_playgrounds = [
                        [
                            'title' => 'API Playground',
                            'desc'  => 'Experiment with real-time market data using our developer-friendly API.'
                        ],
                        [
                            'title' => 'Custom Integration',
                            'desc'  => 'Seamlessly integrate trading strategies into your existing systems.'
                        ],
                        [
                            'title' => 'Scalable Solutions',
                            'desc'  => 'From small teams to enterprise, scale your trading operations effortlessly.'
                        ],
                        [
                            'title' => 'Secure Access',
                            'desc'  => 'Trade confidently with encrypted and secure API endpoints.'
                        ]
                    ];

                    foreach ($api_playgrounds as $playground) : ?>
                        <div class="api-playground-item">
                            <h3><?php echo esc_html($playground['title']); ?></h3>
                            <p><?php echo esc_html($playground['desc']); ?></p>
                        </div>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
