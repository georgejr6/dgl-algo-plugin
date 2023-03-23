<?php
/**
 *
 *
 * @wordpress-plugin
 * Plugin Name:       DIGITVL Crypto Gateway
 * Plugin URI:        
 * Description:       The description  DIGITVL Crypto Gateway
 * Version:           2.0.0
 * Author:            George
 * Author URI:        https://digitvl.com/
 * Text Domain:       cryptoalgo
 * Domain Path:       /languages
 * License: 		  GPL-3.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

function activate_cryptoalgo() {
  require_once plugin_dir_path(__FILE__) . 'includes/class-cryptoalgo-activator.php';
  CryptoAlgo_Activator::activate();
}

register_activation_hook(__FILE__, 'activate_cryptoalgo');

function deactive_cryptoalgo() {
  require_once plugin_dir_path(__FILE__) . 'includes/class-cryptoalgo-deactivator.php';
  CryptoAlgo_Deactivator::deactivate();
}

register_deactivation_hook(__FILE__, 'deactive_cryptoalgo');

require plugin_dir_path(__FILE__) . 'includes/class-cryptoalgo.php';


function run_cryptoalgo() {
	if ( class_exists( 'woocommerce' ) ) {
		$cryptoalgo = new CryptoAlgo();
		$cryptoalgo->run();
	} else {
		add_action( 'admin_notices', 'ap_wc_not_active' );
	}
}

add_action( 'plugins_loaded', 'run_cryptoalgo' );



function ap_wc_not_active() {
    ?>
    <div class="error notice">
        <p><?php _e( 'CryptoAlgo - Algo Payments: woocommerce is not activated/installed. Please activate or deactivate CryptoAlgo.', 'cryptoalgo' ); ?></p>
    </div>
    <?php
}




