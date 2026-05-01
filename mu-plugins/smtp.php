<?php
/**
 * Plugin Name: SMTP Config
 * Description: Configure PHPMailer via Docker environment variables (SMTP_HOST, SMTP_USER, SMTP_PASS, SMTP_FROM, SMTP_FROM_NAME, SMTP_PORT).
 * Version: 1.1
 */

// Force GD over Imagick (Imagick fails on resize in some containers)
add_filter('wp_image_editors', function ($editors) {
    return ['WP_Image_Editor_GD', 'WP_Image_Editor_Imagick'];
});

add_action('phpmailer_init', function ($phpmailer) {
    $host = getenv('SMTP_HOST');
    $user = getenv('SMTP_USER');
    $pass = getenv('SMTP_PASS');
    $port = (int) (getenv('SMTP_PORT') ?: 587);
    $from = getenv('SMTP_FROM') ?: $user;
    $name = getenv('SMTP_FROM_NAME') ?: get_bloginfo('name');

    if (!$host || !$user || !$pass) {
        return;
    }

    $phpmailer->isSMTP();
    $phpmailer->Host       = $host;
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = $port;
    $phpmailer->Username   = $user;
    $phpmailer->Password   = $pass;
    $phpmailer->SMTPSecure = $port === 465 ? 'ssl' : 'tls';
    $phpmailer->From       = $from;
    $phpmailer->FromName   = $name;
});
