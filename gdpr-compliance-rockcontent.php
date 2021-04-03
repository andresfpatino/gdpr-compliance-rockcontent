<?php

/**
 *
 * @link              https://github.com/andresfpatino/Plugin-GDPR-Compliance-Rock-Content
 * @since             1.0.0
 * @package           Gdpr_Compliance
 *
 * @wordpress-plugin
 * Plugin Name:      GDPR Compliance - [Rock Content]
 * Plugin URI:        https://github.com/andresfpatino/Plugin-GDPR-Compliance-Rock-Content
 * Description:       GDPR é uma regulamentação que solicita que sites da europa apresentem uma mensagem de consentimento informando que o website utiliza cookies.
 * Version:           1.0.0
 * Author:            Andrés Felipe Patiño
 * Author URI:        https://github.com/andresfpatino
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gdpr-compliance
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'Gdpr_Compliance_VERSION', '1.0.0' );

/**
 * Shortcode generate message.
 */
require_once plugin_dir_path( __FILE__ ) . 'public/gdpr-compliance-generate.php';

/** 
 *	Add custom option page
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/option-page.php';

/**
 * Register Scripts - Styles
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/scripts.php';


/** 
 *  Redirect options page after activate plugin
 */
function activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=gdpr-compliance-options' ) ) );
    }
}
add_action( 'activated_plugin', 'activation_redirect' );


/** 
 *  Activation admin notices
 */
register_activation_hook(__FILE__, 'gdpr_compliance_activation');
function gdpr_compliance_activation() {
  $notices= get_option('gdpr_compliance_deferred_admin_notices', array());
  $notices[]= __( 'Plugin GDPR Compliance Rock Content ativado corretamente', 'gdpr-compliance' );
  update_option('gdpr_compliance_deferred_admin_notices', $notices);
}

add_action('admin_notices', 'gdpr_compliance_admin_notices');
function gdpr_compliance_admin_notices() {
  if ($notices= get_option('gdpr_compliance_deferred_admin_notices')) {
    foreach ($notices as $notice) {
      echo "<div class='notice notice-success is-dismissible'><p>$notice</p></div>";
    }
    delete_option('gdpr_compliance_deferred_admin_notices');
  }
}

register_deactivation_hook(__FILE__, 'gdpr_compliance_deactivation');
function gdpr_compliance_deactivation() { 
  delete_option('gdpr_compliance_deferred_admin_notices'); 
}

