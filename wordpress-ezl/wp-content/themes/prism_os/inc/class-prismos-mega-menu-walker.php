<?php
// inc/class-prismos-mega-menu-walker.php
if ( ! class_exists( 'Prismos_Mega_Menu_Walker' ) ) :

class Prismos_Mega_Menu_Walker extends Walker_Nav_Menu {

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes     = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = implode( ' ', array_map( 'esc_attr', $classes ) );

        $output .= '<li class="menu-item ' . $class_names . '">';

        // Link
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $output .= '<a href="' . esc_url( $item->url ) . '">' . esc_html( $title ) . '</a>';

        // Only for top-level menu items
        if ( $depth === 0 ) {

            // ACF fields (pass $item->ID for menu items)
            $left_title        = get_field( 'left_title', $item->ID );
            $menu_cards        = get_field( 'menu_cards', $item->ID );
            $bottom_links_left = get_field( 'bottom_links_left', $item->ID );
            $bottom_right_text = get_field( 'bottom_right_text', $item->ID );
            $bottom_right_cta  = get_field( 'bottom_right_cta', $item->ID );

            $has_submenu_content = $left_title || $menu_cards || $bottom_links_left || $bottom_right_text || $bottom_right_cta || have_rows( 'items', $item->ID );

            if ( $has_submenu_content ) {
                $output .= '<div class="submenu">';
                $output .= '<div class="submenu-inner">';

                // Left content
                $output .= '<div class="left-content">';
                if ( $left_title ) {
                    $output .= '<h2>' . esc_html( $left_title ) . '</h2>';
                }

                // Items repeater
                if ( have_rows( 'items', $item->ID ) ) {
                    $output .= '<div class="individual-institution d-flex align-items gap-8">';
                    while ( have_rows( 'items', $item->ID ) ) {
                        the_row();
                        $title = get_sub_field( 'title' );
                        $text  = get_sub_field( 'text' );

                        $output .= '<div class="individual item">';
                        if ( $title ) {
                            $output .= '<h3>' . esc_html( $title ) . '</h3>';
                        }
                        if ( $text ) {
                            $output .= '<p>' . esc_html( $text ) . '</p>';
                        }
                        $output .= '</div>';
                    }
                    $output .= '</div>'; // close individual-institution
                }

                $output .= '</div>'; // left-content

                // Right content (cards) — show only if $menu_cards has items
                if ( ! empty( $menu_cards ) && is_array( $menu_cards ) ) {
                    $output .= '<div class="right-content">';
                    
                    foreach ( $menu_cards as $index => $card ) {
                        $img    = $card['image'] ?? '';
                        $ctitle = $card['title'] ?? '';
                        $cdesc1 = $card['desc_1'] ?? '';
                        $cdesc2 = $card['desc_2'] ?? '';
                        $clink  = $card['link'] ?? '';

                        // Skip if everything is empty for this card
                        if ( empty( $img ) && empty( $ctitle ) && empty( $cdesc1 ) && empty( $cdesc2 ) && empty( $clink ) ) {
                            continue;
                        }

                        $generated_class = ! empty( $ctitle ) ? sanitize_title( $ctitle ) : '';

                        $output .= '<div class="menu-card-block ' . esc_attr( $generated_class ) . ' card-' . ( $index + 1 ) . '">';

                        if ( $img ) {
                            if ( is_numeric( $img ) ) {
                                $output .= wp_get_attachment_image( $img, 'medium', false, array( 'alt' => esc_attr( $ctitle ) ) );
                            } elseif ( is_array( $img ) && ! empty( $img['url'] ) ) {
                                $output .= '<img src="' . esc_url( $img['url'] ) . '" alt="' . esc_attr( $ctitle ) . '">';
                            }
                        }

                        if ( $ctitle ) {
                            $output .= '<h3>' . esc_html( $ctitle ) . '</h3>';
                        }
                        if ( $cdesc1 ) {
                            $output .= '<p>' . esc_html( $cdesc1 ) . '</p>';
                        }
                        if ( $cdesc2 ) {
                            $output .= '<p class="menu-card-desc-2 mt-8">' . esc_html( $cdesc2 ) . '</p>';
                        }

                        if ( $clink && is_array( $clink ) && ! empty( $clink['url'] ) ) {
                            $link_title = $clink['title'] ?: 'Read more';
                            $output .= '<a href="' . esc_url( $clink['url'] ) . '" class="menu-card-link">'
                                    . esc_html( $link_title )
                                    . ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">'
                                    . '<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 
                                        4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 1 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>'
                                    . '</svg>'
                                    . '</a>';
                        }

                        $output .= '</div>'; // menu-card-block
                    }

                    $output .= '</div>'; // right-content
                }

                // "What's New" section from ACF repeater — only show if it has rows
                if ( have_rows( 'whats_new', $item->ID ) ) {
                    $output .= '<div class="whats-new">';
                    $output .= '<h2 class="whats-title">WHATS NEW</h2>';
                    $output .= '<div class="whats-grid">';

                    while ( have_rows( 'whats_new', $item->ID ) ) {
                        the_row();
                        $tag = get_sub_field( 'add_tag' );
                        $image = get_sub_field( 'image' );
                        $title = get_sub_field( 'title' );
                        $desc  = get_sub_field( 'description' );

                        // Skip empty items
                        if ( empty( $image ) && empty( $title ) && empty( $desc ) ) {
                            continue;
                        }

                        $output .= '<div class="whats-item">';

                        // Image
                        if ( $image ) {
                            if ( is_array( $image ) && ! empty( $image['url'] ) ) {
                                $output .= '<img src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $title ) . '">';
                            } elseif ( is_numeric( $image ) ) {
                                $output .= wp_get_attachment_image( $image, 'medium', false, array( 'alt' => esc_attr( $title ) ) );
                            }
                        }

                        // Content
                        $output .= '<div class="whats-content">';
                        if ( $tag ) {
                            $output .= '<h3>' . esc_html( $title ) . '<span>' . esc_html( $tag ) . '</span></h3>';
                        }
                        if ( $desc ) {
                            $output .= '<p>' . esc_html( $desc ) . '</p>';
                        }
                        $output .= '</div>'; // close whats-content

                        $output .= '</div>'; // close whats-item
                    }

                    $output .= '</div>'; // close whats-grid
                    $output .= '</div>'; // close whats-new
                }



                $output .= '</div>'; // submenu-inner

                // submenu-bottom (static example — could also be ACF-driven)
                $output .= '
                <div class="submenu-bottom d-flex align-items justify-content">
                    <div class="submenu-bottom-left d-flex align-items">
                        <a href="#"><img src="' . esc_url( get_template_directory_uri() . '/assets/images/customer-service.png' ) . '" alt="Talk to Expert"> Talk to Expert</a>
                        <a href="#"><img src="' . esc_url( get_template_directory_uri() . '/assets/images/mac-line.png' ) . '" alt="Request a demo"> Request a demo</a>
                    </div>
                    <div class="submenu-bottom-right d-flex align-items gap-16">
                        <span class="bottom-right-text">SIGN UP FOR OUR RESOURCES</span>
                        <a href="#" class="newsletter__button">Sign up Now</a>
                    </div>
                </div>';

                $output .= '</div>'; // submenu
            }
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}

endif;

