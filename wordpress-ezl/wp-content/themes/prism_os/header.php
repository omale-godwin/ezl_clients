<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
   
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <div id="header" class="header-box">
		<div class="header-contact">
			<div class="header-top custom-maxW">
				<div class="header-mail"><img src="https://cdn.electricoctopus.agency/prismos/mail.png" alt="mail">hello@prismos.com</div>
				<div class="contact-num">
					<span>
						<img src="https://cdn.electricoctopus.agency/prismos/usa.png" alt="USA" loading="lazy">
						+1 650-718-1376
					</span>
					<span class="country-flag">
						<img src="https://cdn.electricoctopus.agency/prismos/country.png" alt="USA" loading="lazy">
						<img src="https://cdn.electricoctopus.agency/prismos/london.png" alt="USA" loading="lazy">
						+1650-718-1376
					</span>
								
				</div>
			</div>
		</div>
        <!-- Header content with logo and menu -->
		<div class="header-menu">
			<div class="header-container custom-maxW">
				<a href="<?php echo esc_url( home_url('/') ); ?>" aria-label="PrismOS Home">
					<img src="https://cdn.electricoctopus.agency/prismos/prismos_logo.webp" alt="PrismOS logo" loading="lazy">
				</a>

				<button class="menu-toggle" aria-label="Toggle menu"><span></span><span></span><span></span></button>

				<div class="header-menubttn">
					<?php
						wp_nav_menu(array(
							'theme_location' => 'primary_menu',
							'container' => false,
							'items_wrap' => '<ul>%3$s</ul>',
							'fallback_cb' => false,
							'walker' => new Prismos_Mega_Menu_Walker()
						));
					?>
					<a hre="#" class="talk-xpert-btn">Talk to Expert</a>
				</div>
			</div>
		</div>


	</div>
</div>
