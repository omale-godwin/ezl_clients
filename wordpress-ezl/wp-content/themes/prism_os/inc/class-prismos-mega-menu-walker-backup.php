<?php
// inc/class-prismos-mega-menu-walker.php
if ( ! class_exists( 'Prismos_Mega_Menu_Walker' ) ) :

class Prismos_Mega_Menu_Walker extends Walker_Nav_Menu {

    // start each menu item
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = implode(' ', array_map('esc_attr', $classes));

        $output .= '<li class="menu-item ' . $class_names . '">';

        // link
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $output .= '<a href="' . esc_url( $item->url ) . '">' . esc_html( $title ) . '</a>';

        // only for top-level items, output your mega submenu structure if ACF content exists
        if ( $depth === 0 ) {

            // ACF fields on menu item (menu item ID is $item->ID)
            $left_title         = get_field('left_title', $item->ID);
            $individual_title   = get_field('individual_title', $item->ID);
            $individual_text    = get_field('individual_text', $item->ID);
            $institution_title  = get_field('institution_title', $item->ID);
            $institution_text   = get_field('institution_text', $item->ID);

            $menu_cards = get_field('menu_cards', $item->ID); // repeater rows (array) or false
            $bottom_links_left = get_field('bottom_links_left', $item->ID); // repeater
            $bottom_right_text = get_field('bottom_right_text', $item->ID);
            $bottom_right_cta  = get_field('bottom_right_cta', $item->ID); // array: ['url','title']

            // Determine if we should render the submenu block
            $has_submenu_content = $left_title || $individual_title || $menu_cards || $bottom_links_left || $bottom_right_text || $bottom_right_cta;

            if ( $has_submenu_content ) {
                $output .= '<div class="submenu">';
                $output .= '<div class="submenu-inner">';

                // left content
                $output .= '<div class="left-content">';
                $output .= '<h2>' . esc_html( $left_title ) . '</h2>';

                $output .= '<div class="individual-institution d-flex align-items gap-8">';
                // individual
                $output .= '<div class="individual">';
                $output .= '<h3>' . esc_html( $individual_title ) . '</h3>';
                $output .= '<p>' . esc_html( $individual_text ) . '</p>';
                $output .= '</div>';
                // institution
                $output .= '<div class="institution">';
                $output .= '<h3>' . esc_html( $institution_title ) . '</h3>';
                $output .= '<p>' . esc_html( $institution_text ) . '</p>';
                $output .= '</div>';
                $output .= '</div>'; // individual-institution

                $output .= '</div>'; // left-content

                // right-content (cards)
                $output .= '<div class="right-content">';
                if ( $menu_cards && is_array($menu_cards) ) {
                    foreach ( $menu_cards as $index => $card ) {
                        $img    = isset($card['image']) ? $card['image'] : '';
                        $ctitle = isset($card['title']) ? $card['title'] : '';
                        $cdesc1 = isset($card['desc_1']) ? $card['desc_1'] : '';
                        $cdesc2 = isset($card['desc_2']) ? $card['desc_2'] : '';
                        $clink  = isset($card['link']) ? $card['link'] : '';

                        // Auto-generate class from title
                        $generated_class = '';
                        if ( ! empty($ctitle) ) {
                            $generated_class = sanitize_title( $ctitle );
                        }

                        // Card link wrapper (whole card clickable if link exists)
                        if ( $clink && is_array($clink) && ! empty($clink['url']) ) {
                            $output .= '<a href="' . esc_url($clink['url']) . '" class="menu-card-link-wrapper">';
                        }

                        $output .= '<div class="menu-card-block ' . esc_attr($generated_class) . ' card-' . ($index + 1) . '">';

                        // Image
                        if ( $img ) {
                            if ( is_numeric($img) ) {
                                $output .= wp_get_attachment_image( $img, 'medium', false, array('alt'=>esc_attr($ctitle)) );
                            } elseif ( is_array($img) && ! empty($img['url']) ) {
                                $output .= '<img src="' . esc_url($img['url']) . '" alt="' . esc_attr($ctitle) . '">';
                            }
                        }

                        // Title and descriptions
                        $output .= '<h3>' . esc_html( $ctitle ) . '</h3>';
                        $output .= '<p>' . esc_html( $cdesc1 ) . '</p>';
                        $output .= '<p class="menu-card-desc-2">' . esc_html( $cdesc2 ) . '</p>';

                        // Link arrow (optional inside card)
                        if ( $clink && is_array($clink) && ! empty($clink['url']) ) {
                            $link_title = $clink['title'] ? $clink['title'] : 'Read more';
                            $output .= '<span class="menu-card-link">'
                                    . esc_html( $link_title )
                                    . ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">'
                                    . '<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 
                                        4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 1 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>'
                                    . '</svg>'
                                    . '</span>';
                        }

                        $output .= '</div>'; // menu-card-block

                        if ( $clink && is_array($clink) && ! empty($clink['url']) ) {
                            $output .= '</a>'; // close anchor wrapper
                        }
                    }
                }
                $output .= '</div>'; // right-content
                $output .= '</div>'; // submenu-inner

                // submenu-bottom
                $output .= '<div class="submenu-bottom d-flex align-items justify-content">';
                $output .= '<div class="submenu-bottom-left d-flex align-items">';
                if ( $bottom_links_left && is_array($bottom_links_left) ) {
                    foreach ( $bottom_links_left as $b ) {
                        $icon = isset($b['icon']) ? $b['icon'] : '';
                        $link = isset($b['link']) ? $b['link'] : '';
                        if ( $link && is_array($link) ) {
                            $title = esc_html( $link['title'] );
                            $url   = esc_url( $link['url'] );
                            $output .= '<a href="' . $url . '">';
                            if ( $icon ) {
                                if ( is_numeric($icon) ) {
                                    $output .= wp_get_attachment_image( $icon, 'thumbnail', false, array('alt'=>esc_attr($title)) );
                                } elseif ( is_array($icon) && ! empty($icon['url']) ) {
                                    $output .= '<img src="'. esc_url($icon['url']) .'" alt="'. esc_attr($title) .'">';
                                }
                            }
                            $output .= ' ' . $title . '</a>';
                        }
                    }
                }
                $output .= '</div>'; // submenu-bottom-left

                $output .= '<div class="submenu-bottom-right d-flex align-items gap-16">';
                if ( $bottom_right_text ) {
                    $output .= '<span class="bottom-right-text">' . wp_kses_post($bottom_right_text) . '</span>';
                }
                if ( $bottom_right_cta && is_array($bottom_right_cta) && ! empty($bottom_right_cta['url']) ) {
                    $output .= '<a href="' . esc_url($bottom_right_cta['url']) . '" class="newsletter__button">' . esc_html( $bottom_right_cta['title'] ? $bottom_right_cta['title'] : 'Sign up Now') . '</a>';
                }
                $output .= '</div>'; // submenu-bottom-right

                $output .= '</div>'; // submenu-bottom
                $output .= '</div>'; // submenu
            } // end if has content
        } // end if depth 0
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}

endif;
