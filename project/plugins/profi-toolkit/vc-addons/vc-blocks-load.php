<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

// Class started
class profiVCExtendAddonClass {

    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'profiIntegrateWithVC' ) );
    }

    public function profiIntegrateWithVC() {
        // Checks if Visual composer is not installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            add_action( 'admin_notices', array( $this, 'profiShowVcVersionNotice' ) );

            return;
        }

        // visual composer addons.
        include PROFI_ACC_PATH . '/vc-addons/vc-home-slides.php';
        include PROFI_ACC_PATH . '/vc-addons/vc-about.php';
        include PROFI_ACC_PATH . '/vc-addons/vc-services.php';
        include PROFI_ACC_PATH . '/vc-addons/vc-projects.php';
        include PROFI_ACC_PATH . '/vc-addons/vc-testimonials.php';
        include PROFI_ACC_PATH . '/vc-addons/vc-fun-facts.php';
        include PROFI_ACC_PATH . '/vc-addons/vc-contact.php';
        include PROFI_ACC_PATH . '/vc-addons/vc-section-title.php';
        include PROFI_ACC_PATH . '/vc-addons/vc-btn.php';

        // Add vc default templates
        include PROFI_ACC_PATH . '/vc-addons/vc-templates.php';

    }

    // show visual composer version
    public function profiShowVcVersionNotice() {
        $theme_data = wp_get_theme();
        echo '
        <div class="notice notice-warning">
          <p>' . sprintf( __( '<strong>%s</strong> recommends <strong><a href="' . site_url() . '/wp-admin/themes.php?page=tgmpa-install-plugins" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'profi-shovondesign' ), $theme_data->get( 'Name' ) ) . '</p>
        </div>';
    }
}

// Finally initialize code
new profiVCExtendAddonClass();