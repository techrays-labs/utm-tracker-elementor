<?php

/**
 * Plugin Name: Universal Query Param Tracker for Elementor Forms
 * Description: Automatically captures all query parameters from URLs and appends them to Elementor Pro form submissions.
 * Version: 1.0.0
 * Author: Techrays Labs Private Limited
 * Author URI: https://techrayslabs.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: utm-tracker-elementor
 * Domain Path: /languages
 */

defined('ABSPATH') || exit;

// Wait until Elementor is fully initialized
add_action('elementor/init', function () {

    // Check if Elementor Pro and its Forms module is available
    if (
        ! did_action('elementor_pro/init') ||
        ! class_exists('\ElementorPro\Modules\Forms\Classes\Record')
    ) {
        // Show admin notice if Elementor Pro not found
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p><strong>Universal Query Param Tracker</strong> requires <a href="https://elementor.com/pro" target="_blank">Elementor Pro</a> to function properly.</p></div>';
        });
        return;
    }

    // ✅ Safe to run plugin logic now

    // Enqueue the JS script to store query parameters
    add_action('wp_enqueue_scripts', function () {
        wp_register_script(
            'utm-tracker-script',
            plugin_dir_url(__FILE__) . 'utm-tracker.js',
            [],
            '1.1.1',
            true
        );
        wp_enqueue_script('utm-tracker-script');
    });

    // Hook into Elementor Pro Forms submission
    add_action('elementor_pro/forms/new_record', function ($record, $handler) {
        if (! $record instanceof \ElementorPro\Modules\Forms\Classes\Record) {
            return;
        }

        foreach ($_COOKIE as $cookie_name => $cookie_value) {
            if (strpos($cookie_name, 'qp_') === 0) {
                $param_name = substr($cookie_name, 3);
                $handler->add_field([
                    'id'    => $param_name,
                    'value' => sanitize_text_field($cookie_value),
                ]);
            }
        }
    }, 10, 2);
});
