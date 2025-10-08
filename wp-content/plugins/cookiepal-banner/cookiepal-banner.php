<?php
/*
Plugin Name: CookiePal Banner
Description: Adds the CookiePal banner script to the site header. Allows the client to input their Website ID.
Version: 1.1
Author: CookiePal
Requires Plugins: wp-consent-api
License: AGPLv3
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/* ------------------------------------------------------------------------- */
/* Admin – menu, settings, styles */
/* ------------------------------------------------------------------------- */

function cookiepal_add_admin_menu()
{
    add_options_page(
        'CookiePal Banner Settings',
        'CookiePal Banner',
        'manage_options',
        'cookiepal-banner',
        'cookiepal_options_page'
    );
}
add_action('admin_menu', 'cookiepal_add_admin_menu');

function cookiepal_settings_init()
{
    register_setting(
        'cookiepal_options',
        'cookiepal_website_id',
        array(
            'type' => 'string',
            'sanitize_callback' => 'cookiepal_sanitize_website_id',
            'default' => '',
        )
    );

    add_settings_section(
        'cookiepal_section',
        __('CookiePal Settings', 'cookiepal-banner'),
        null,
        'cookiepal_options'
    );

    add_settings_field(
        'cookiepal_website_id',
        __('Website ID', 'cookiepal-banner'),
        'cookiepal_website_id_render',
        'cookiepal_options',
        'cookiepal_section'
    );
}
add_action('admin_init', 'cookiepal_settings_init');

function cookiepal_sanitize_website_id($input)
{
    return sanitize_text_field($input);
}

function cookiepal_enqueue_admin_style($hook)
{
    if ($hook !== 'settings_page_cookiepal-banner') {
        return;
    }

    wp_enqueue_style(
        'cookiepal-admin-style',
        esc_url(plugins_url('assets/admin-style.css', __FILE__)),
        array(),
        '1.0.0'
    );
}
add_action('admin_enqueue_scripts', 'cookiepal_enqueue_admin_style');

function cookiepal_website_id_render()
{
    $website_id = get_option('cookiepal_website_id');
    ?>
    <input type="text" name="cookiepal_website_id"
        value="<?php echo isset($website_id) ? esc_attr($website_id) : ''; ?>" class="cookiepal-input">
    <p class="description">Enter your CookiePal Website ID.</p>
    <?php
}

function cookiepal_options_page()
{
    ?>
    <div class="wrap cookiepal-settings-wrap">
        <h1>
            <?php esc_html_e('CookiePal Banner Settings', 'cookiepal-banner'); ?>
            <img src="<?php echo esc_url(plugins_url('/assets/logo.svg', __FILE__)); ?>" alt="CookiePal Logo"
                style="vertical-align: middle; width: 125px; height: 40px; margin-left: 11.5rem; margin-bottom: 9px;">
        </h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('cookiepal_options');
            do_settings_sections('cookiepal_options');
            submit_button(__('Save Settings', 'cookiepal-banner'));
            ?>
        </form>
    </div>
    <?php
}

/* ------------------------------------------------------------------------- */
/* Front‑end – banner script */
/* ------------------------------------------------------------------------- */

function cookiepal_enqueue_frontend_scripts()
{
    $website_id = get_option('cookiepal_website_id');
    if (empty($website_id)) {
        return;
    }

    $source_flag = 'wordpress';
    $script_url = 'https://dev-cdn.cookiepal.io/client_data/' . esc_attr($website_id) . '/script.js?source=' . esc_attr($source_flag);

    wp_enqueue_script(
        'cookiepal-banner-script',
        $script_url,
        array(),
        '1.0.0',
        false
    );
}
add_action('wp_enqueue_scripts', 'cookiepal_enqueue_frontend_scripts');
add_filter( 'wp_consent_api_registered_' . plugin_basename( __FILE__ ), '__return_true' );
