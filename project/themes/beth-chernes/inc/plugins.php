<?php

require_once( __DIR__ . "/../../../../wp-admin/includes/plugin.php" );

// Activate Required Plugins
// Prevents deactivation of required plugins.
// Plugin Name, Network Activate, Silent Mode
activate_plugins( "acf-content-analysis-for-yoast-seo/yoast-acf-analysis.php" );
activate_plugins( "advanced-custom-fields-pro/acf.php" );
activate_plugins( "akismet/akismet.php" );
activate_plugins( "classic-editor/classic-editor.php" );
activate_plugins( "contact-form-7/wp-contact-form-7.php" );
activate_plugins( "redirection/redirection.php" );
activate_plugins( "wp-security-audit-log/wp-security-audit-log.php" );
activate_plugins( "wp-mail-logging/wp-mail-logging.php" );
activate_plugins( "wp-mail-smtp/wp-mail-smtp.php" );
activate_plugins( "wordpress-seo/wp-seo.php" );

// Security Plugins.
if ( getenv("POUTINE_LOCAL_DEV") !== "1" ) {
  activate_plugins( "better-wp-security/better-wp-security.php" );
  activate_plugins( "sucuri-scanner/sucuri.php" );
  activate_plugins( "wordfence/wordfence.php" );
} else {
  // Plugin Name, Silent Mode, Network Deactivate
  deactivate_plugins( "better-wp-security/better-wp-security.php", true );
  deactivate_plugins( "sucuri-scanner/sucuri.php", true );
  deactivate_plugins( "wordfence/wordfence.php", true );
}