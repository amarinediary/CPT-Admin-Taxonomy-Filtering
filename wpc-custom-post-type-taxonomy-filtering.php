<?php

if ( ! defined( 'ABSPATH' ) ) {

    exit;

};

/**
 * Plugin Name: WPC-Custom-Post-Type-Taxonomy-Filtering
 * Text Domain: wpc-custom-post-type-taxonomy-filtering
 * Plugin URI: https://github.com/amarinediary/WPC-Custom-Post-Type-Taxonomy-Filtering
 * Description: WPC-Custom-Post-Type-Taxonomy-Filtering. A non-invasive, lightweight WordPress plugin adding custom post type taxonomy filtering support. Latest version 1.0.0.
 * Version: 1.0.0
 * Requires at least: 4.8.0
 * Requires PHP: 4.0
 * Tested up to: 5.7.1
 * Author: amarinediary
 * Author URI: https://github.com/amarinediary
 * License: CC0 1.0 Universal (CC0 1.0) Public Domain Dedication
 * License URI: https://github.com/amarinediary/WPC-Custom-Post-Type-Taxonomy-Filtering/blob/main/LICENSE
 * GitHub Plugin URI: https://github.com/amarinediary/WPC-Custom-Post-Type-Taxonomy-Filtering
 * GitHub Branch: main
 */
add_action( 'restrict_manage_posts', 'wpc_custom_post_type_taxonomy_filtering' );

if ( ! function_exists( 'wpc_custom_post_type_taxonomy_filtering' ) ) {

    function wpc_custom_post_type_taxonomy_filtering() {

        $screen = get_current_screen();

        // Single out WordPress default post types
        $restricted_post_type = array(
            'post',
            'page',
            'attachment',
            'revision',
            'nav_menu_item',
        );

        if ( 'edit' === $screen->base && ! in_array( $screen->post_type, $restricted_post_type ) ) {

            // Retrieve each taxonomy
            $taxonomies = get_object_taxonomies( $screen->post_type, 'objects' );

            // Loop through each taxonomy
            foreach ( $taxonomies as $taxonomy ) {

                if ( $taxonomy->show_admin_column && $taxonomy->hierarchical ) {

                    echo '<label for="filter-by-' . $taxonomy->query_var . '" class="screen-reader-text">' . $taxonomy->{'labels'}->filter_by_item . '</label>
                    <select name="' . $taxonomy->query_var . '" id="filter-by-' . $taxonomy->query_var . '">
                        <option selected="selected" value="">' . $taxonomy->{'labels'}->all_items . '</option>';

                    // Retrieve each term
                    $terms = get_terms(
                        array(
                            'taxonomy' => $taxonomy->query_var,
                            'hide_empty' => false,
                            'pad_counts' => true,
                        )
                    );
                    
                    // Loop through each term
                    foreach ( $terms as $term ) { 

                        // Retrieve each parent
                        $parents = get_term_parents_list( $term->term_id, $term->taxonomy,
                        array(
                            'format' => 'slug',
                            'link' => false,
                            'inclusive' => false,
                        )
                        );

                        // Count each parent
                        $parents_count = sizeof( explode( '/', $parents ) );

                        echo '<option value="' . $term->slug . '">' . str_repeat( str_repeat( '&#160;', 3 ), $parents_count - 1 ) . $term->name . '</option>';

                    };

                    echo '</select>';

                };

            };

        };

    };

};
