<?php
/**
 * Plugin Name: SMTP Config
 * Description: Configure PHPMailer via variables d'environnement Docker (SMTP_HOST, SMTP_USER, SMTP_PASS, SMTP_FROM, SMTP_FROM_NAME).
 * Version: 1.0
 */

// Forcer GD en priorité sur Imagick (Imagick échoue sur resize dans certains conteneurs)
add_filter('wp_image_editors', function ($editors) {
    return ['WP_Image_Editor_GD', 'WP_Image_Editor_Imagick'];
});

add_action('phpmailer_init', function ($phpmailer) {
    $host = getenv('SMTP_HOST');
    $user = getenv('SMTP_USER');
    $pass = getenv('SMTP_PASS');
    $from = getenv('SMTP_FROM') ?: $user;
    $name = getenv('SMTP_FROM_NAME') ?: get_bloginfo('name');

    if (!$host || !$user || !$pass) {
        return;
    }

    $phpmailer->isSMTP();
    $phpmailer->Host       = $host;
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 587;
    $phpmailer->Username   = $user;
    $phpmailer->Password   = $pass;
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->From       = $from;
    $phpmailer->FromName   = $name;
});
