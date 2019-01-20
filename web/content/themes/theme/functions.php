<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$oxboot_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Oxboot &rsaquo; Error', 'theme');
    $footer = '<a href="https://oxboot.com/">oxboot.com</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $oxboot_error(__('You must be using PHP 7.1 or greater.', 'theme'), __('Invalid PHP version', 'theme'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $oxboot_error(__('You must be using WordPress 4.7.0 or greater.', 'theme'), __('Invalid WordPress version', 'theme'));
}

/**
 * Require Soberwp Controller
 */
require $root_dir . '/vendor/oxboot/controller/controller.php';

/**
 * Oxboot required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($oxboot_error) {
    $file = "./inc/{$file}.php";
    if (!locate_template($file, true, true)) {
        $oxboot_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'theme'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require __DIR__.'/config/assets.php',
            'theme' => require __DIR__.'/config/theme.php',
            'view' => require __DIR__.'/config/view.php',
        ]);
    }, true);
