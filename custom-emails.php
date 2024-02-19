<?php
/*
Plugin Name: Custom Emails
Description: Customize NFR (Password Reset) emails. Developed by Emerya.
*/

function custom_password_reset_menu() {
    add_menu_page(
        'Password Reset Email Settings',
        'Reset Password Email',
        'manage_options',
        'password_reset_email_settings',
        'password_reset_email_settings_page'
    );
}
add_action('admin_menu', 'custom_password_reset_menu');

function password_reset_email_settings_page() {
    ?>
    <div class="wrap">
        <h2>Paramètres de messagerie de réinitialisation du mot de passe</h2>
        <form method="post" action="options.php">
            <?php settings_fields('password_reset_email_settings_group'); ?>
            <?php do_settings_sections('password_reset_email_settings_page'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
function custom_password_reset_settings() {
    register_setting('password_reset_email_settings_group', 'password_reset_email_subject');
    register_setting('password_reset_email_settings_group', 'password_reset_email_message');
    
    add_settings_section('password_reset_email_section', 'Paramètres de messagerie', 'password_reset_email_section_callback', 'password_reset_email_settings_page');
    
    add_settings_field('password_reset_email_subject', 'Sujet', 'password_reset_email_subject_callback', 'password_reset_email_settings_page', 'password_reset_email_section');
    add_settings_field('password_reset_email_message', ' Message', 'password_reset_email_message_callback', 'password_reset_email_settings_page', 'password_reset_email_section');
}
add_action('admin_init', 'custom_password_reset_settings');

function password_reset_email_section_callback() {
    echo '<p>Personnalisez le contenu de l e-mail de réinitialisation du mot de passe.</p>';
}

function password_reset_email_subject_callback() {
    $subject = get_option('password_reset_email_subject', 'Réinitialisation du mot de passe');
    echo '<input type="text" name="password_reset_email_subject" value="' . esc_attr($subject) . '" class="regular-text" />';
}

function password_reset_email_message_callback() {
    $message = get_option('password_reset_email_message', 'Default message goes here.');
    echo '<textarea name="password_reset_email_message" rows="5" class="large-text">' . esc_textarea($message) . '</textarea>';
}

// Modify the email content based on settings
function custom_password_reset_email_content($message, $key, $user_login, $user_data) {
    $subject = get_option('password_reset_email_subject', 'Password Reset');
    $custom_message = get_option('password_reset_email_message', 'Default message goes here.');

    $message = "Bonjour " . $user_data->user_login . ",\n\n";
    $message .= $custom_message . "\n\n";
    $message .= "Cliquez sur le lien suivant pour réinitialiser votre mot de passe:\n";
    $message .= site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\n\n";
    $message .= "Si vous n'avez pas demandé cette réinitialisation, ignorez simplement cet e-mail.\n\n";
    $message .= "Cordialement,\n" . get_bloginfo('name');

    return $message;
}
add_filter('retrieve_password_message', 'custom_password_reset_email_content', 10, 4);
