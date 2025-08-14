<section>
    <div class="custom-maxW">
        <div class="header-content matric-header">
            <h2>Header</h2>
            <h3>Proven Results Backed <br>by Measurable Achievements</h3>
            <p>We can’t predict the future, but our 10+ years of experience can give a confident estimate.</p>

            <div class="d-flex align-items gap-16 mt-24 matric-btn">
                <a href="#try-90-days" class="red-button2" aria-label="Try our service free for 90 days">Try it for 90 Days</a>
                <a href="#try-90-days" class="transparent-button2" aria-label="Try our service free for 90 days alternative button">Try it for 90 Days</a>
            </div>    
        </div>

        <div class="d-flex justify-content metrics-container mt-48">
            <?php
            $impact_stats = [
                [
                    'image'   => 'https://cdn.electricoctopus.agency/prismos/pace.png',
                    'heading' => 'Time Back',
                    'value'   => '150+',
                    'text'    => 'Hours Saved',
                    'subtext' => 'Algorithm Iterations Tested'
                ],
                [
                    'image'   => 'https://cdn.electricoctopus.agency/prismos/savings.png',
                    'heading' => 'Cost Saving',
                    'value'   => '75%',
                    'text'    => 'Reduction in Operational Costs',
                    'subtext' => 'Algorithm Iterations Tested'
                ],
                [
                    'image'   => 'https://cdn.electricoctopus.agency/prismos/swap_driving_apps_wheel.png',
                    'heading' => 'Visibility & Control',
                    'value'   => '25M',
                    'text'    => 'Data Points Processed',
                    'subtext' => 'Algorithm Iterations Tested'
                ],
            ];

            foreach ( $impact_stats as $impact ) : ?>
                <div class="impact-stat-block">
                    <h3 class="impact-heading d-flex align-items gap-8">
                        <img 
                            src="<?php echo esc_url( $impact['image'] ); ?>" 
                            alt="<?php echo esc_attr( $impact['heading'] . ' Icon' ); ?>" 
                            loading="lazy"
                            decoding="async"
                        >
                        <?php echo esc_html( $impact['heading'] ); ?>
                    </h3>
                    <p class="impact-value"><?php echo esc_html( $impact['value'] ); ?></p>
                    <p class="impact-text"><?php echo esc_html( $impact['text'] ); ?></p>
                    <p class="impact-subtext"><?php echo esc_html( $impact['subtext'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
