<?php

if ( ! defined( 'ABSPATH' ) ) {

    exit;

};

/**
 * Plugin Name: CPT-Admin-Taxonomy-Filtering
 * Text Domain: cpt-admin-taxonomy-filtering
 * Plugin URI: https://github.com/amarinediary/CPT-Admin-Taxonomy-Filtering
 * Description: A non-invasive, lightweight WordPress plugin adding custom post type admin taxonomy filtering support. CPT-Admin-Taxonomy-Filtering is a plug-and-play plugin with no required configuration.
 * Version: 1.0.0
 * Requires at least: 4.8.0
 * Requires PHP: 4.0
 * Tested up to: 5.7.1
 * Author: amarinediary
 * Author URI: https://github.com/amarinediary
 * License: CC0 1.0 Universal (CC0 1.0) Public Domain Dedication
 * License URI: https://github.com/amarinediary/CPT-Admin-Taxonomy-Filtering/blob/main/LICENSE
 * GitHub Plugin URI: https://github.com/amarinediary/CPT-Admin-Taxonomy-Filtering
 * GitHub Branch: main
 */
add_action( 'restrict_manage_posts', 'cpt_admin_taxonomy_filtering' );

if ( ! function_exists( 'cpt_admin_taxonomy_filtering' ) ) {

    function cpt_admin_taxonomy_filtering() {

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

                if ( $taxonomy->show_admin_column ) {

                    wp_dropdown_categories(
                        array(
                            'show_option_all' => $taxonomy->labels->all_items,
                            'pad_counts' => true,
                            'show_count' => true,
                            'hierarchical' => true,
                            'name' => $taxonomy->query_var,
                            'id' => 'filter-by-' . $taxonomy->query_var,
                            'value_field' => 'slug',
                            'taxonomy' => $taxonomy->query_var,
                            'hide_if_empty' => true,
                        )
                    );

                };

            };

        };

    };

};
