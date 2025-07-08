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

add_action('plugins_loaded', function () {
    add_action('init', function () {

        $elementor_pro_loaded = did_action('elementor_pro/init') ? '✅ Yes' : '❌ No';
        $record_class_exists = class_exists('\ElementorPro\Modules\Forms\Classes\Form_Record') ? '✅ Yes' : '❌ No';

        if (
            ! did_action('elementor_pro/init') ||
            ! class_exists('\ElementorPro\Modules\Forms\Classes\Form_Record')
        ) {
            add_action('admin_notices', function () use ($elementor_pro_loaded, $record_class_exists) {
                echo '<div class="notice notice-error">';
                echo '<p><strong>Universal Query Param Tracker:</strong> Elementor Pro is <span style="color:red;">not fully loaded</span>.</p>';
                echo '<ul>';
                echo '<li>🔍 <strong>did_action(\'elementor_pro/init\'):</strong> ' . $elementor_pro_loaded . '</li>';
                echo '<li>📦 <strong>Record Class Exists:</strong> ' . $record_class_exists . '</li>';
                echo '</ul>';
                echo '<p>Please ensure that Elementor Pro is <strong>installed, activated, and up to date</strong>.</p>';
                echo '</div>';
            });
            return;
        }
    });
});

// Use elementor_pro/init hook to ensure Elementor Pro is loaded before we proceed
add_action('elementor_pro/init', function () {

    // Check if Elementor Pro Forms Record class exists (correct class name)
    if (! class_exists('\ElementorPro\Modules\Forms\Classes\Form_Record')) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p><strong>Universal Query Param Tracker</strong> requires Elementor Pro Forms module to be loaded.</p></div>';
        });
        return;
    }

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
        if (! $record instanceof \ElementorPro\Modules\Forms\Classes\Form_Record) {
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
