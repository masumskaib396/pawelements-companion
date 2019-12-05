<?php 



/**
 * Get Posts
 * 
 * @since 1.0
 * 
 * @return array
 */
if ( ! function_exists( 'pawelements_get_all_pages' ) ) {
    function pawelements_get_all_pages($posttype = 'page')
    {
        $args = array(
            'post_type' => $posttype, 
            'post_status' => 'publish', 
            'posts_per_page' => -1
        );

        $page_list = array();
        if( $data = get_posts($args)){
            foreach($data as $key){
                $page_list[$key->ID] = $key->post_title;
            }
        }
        return  $page_list;
    }
}
/**
 * Meta Output
 * 
 * @since 1.0
 * 
 * @return array
 */
if ( ! function_exists( 'pawelements_get_meta' ) ) {
    function pawelements_get_meta( $data ) {
        global $wp_embed;
        $content = $wp_embed->autoembed( $data );
        $content = $wp_embed->run_shortcode( $content );
        $content = do_shortcode( $content );
        $content = wpautop( $content );
        return $content;
    }
}

if (!function_exists('pawelem_get_profile_names')) {
    function pawelem_get_profile_names() {
        return [
            '500px' => __( '500px', 'pawelem-companion' ),
            'apple' => __( 'Apple', 'pawelem-companion' ),
            'behance' => __( 'Behance', 'pawelem-companion' ),
            'bitbucket' => __( 'BitBucket', 'pawelem-companion' ),
            'codepen' => __( 'CodePen', 'pawelem-companion' ),
            'delicious' => __( 'Delicious', 'pawelem-companion' ),
            'deviantart' => __( 'DeviantArt', 'pawelem-companion' ),
            'digg' => __( 'Digg', 'pawelem-companion' ),
            'dribbble' => __( 'Dribbble', 'pawelem-companion' ),
            'email' => __( 'Email', 'pawelem-companion' ),
            'facebook' => __( 'Facebook', 'pawelem-companion' ),
            'flickr' => __( 'Flicker', 'pawelem-companion' ),
            'foursquare' => __( 'FourSquare', 'pawelem-companion' ),
            'github' => __( 'Github', 'pawelem-companion' ),
            'houzz' => __( 'Houzz', 'pawelem-companion' ),
            'instagram' => __( 'Instagram', 'pawelem-companion' ),
            'jsfiddle' => __( 'JS Fiddle', 'pawelem-companion' ),
            'linkedin' => __( 'LinkedIn', 'pawelem-companion' ),
            'medium' => __( 'Medium', 'pawelem-companion' ),
            'pinterest' => __( 'Pinterest', 'pawelem-companion' ),
            'product-hunt' => __( 'Product Hunt', 'pawelem-companion' ),
            'reddit' => __( 'Reddit', 'pawelem-companion' ),
            'slideshare' => __( 'Slide Share', 'pawelem-companion' ),
            'snapchat' => __( 'Snapchat', 'pawelem-companion' ),
            'soundcloud' => __( 'SoundCloud', 'pawelem-companion' ),
            'spotify' => __( 'Spotify', 'pawelem-companion' ),
            'stack-overflow' => __( 'StackOverflow', 'pawelem-companion' ),
            'tripadvisor' => __( 'TripAdvisor', 'pawelem-companion' ),
            'tumblr' => __( 'Tumblr', 'pawelem-companion' ),
            'twitch' => __( 'Twitch', 'pawelem-companion' ),
            'twitter' => __( 'Twitter', 'pawelem-companion' ),
            'vimeo' => __( 'Vimeo', 'pawelem-companion' ),
            'vk' => __( 'VK', 'pawelem-companion' ),
            'website' => __( 'Website', 'pawelem-companion' ),
            'whatsapp' => __( 'WhatsApp', 'pawelem-companion' ),
            'wordpress' => __( 'WordPress', 'pawelem-companion' ),
            'xing' => __( 'Xing', 'pawelem-companion' ),
            'yelp' => __( 'Yelp', 'pawelem-companion' ),
            'youtube' => __( 'YouTube', 'pawelem-companion' ),
        ];
    }
}



/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
function pawelem_is_elementor_version( $operator = '<', $version = '2.6.0' ) {
    return defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, $version, $operator );
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
function pawelem_render_icon( $settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [] ) {
    // Check if its already migrated
    $migrated = isset( $settings['__fa4_migrated'][ $new_icon_id ] );
    // Check if its a new widget without previously selected icon using the old Icon control
    $is_new = empty( $settings[ $old_icon_id ] );

    $attributes['aria-hidden'] = 'true';

    if ( pawelem_is_elementor_version( '>=', '2.6.0' ) && ( $is_new || $migrated ) ) {
        \Elementor\Icons_Manager::render_icon( $settings[ $new_icon_id ], $attributes );
    } else {
        if ( empty( $attributes['class'] ) ) {
            $attributes['class'] = $settings[ $old_icon_id ];
        } else {
            if ( is_array( $attributes['class'] ) ) {
                $attributes['class'][] = $settings[ $old_icon_id ];
            } else {
                $attributes['class'] .= ' ' . $settings[ $old_icon_id ];
            }
        }
        printf( '<i %s></i>', \Elementor\Utils::render_html_attributes( $attributes ) );
    }
}


