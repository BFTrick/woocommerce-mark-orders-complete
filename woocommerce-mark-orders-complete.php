<?php
/**
 * Plugin Name: WooCommerce Mark Orders as Complete
 * Description: Automagically mark all WooCommerce orders complete regardless of product type.
 * Version: 1.0.0
 * Author: Patrick Rauland
 * Author URI: http://www.patrickrauland.com
 * Requires at least: 3.6
 * Tested up to: 3.6
 *
 *    Copyright: © 2013 Patrick Rauland
 *    License: GNU General Public License v3.0
 *    License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


/***
 * Mark all orders to complete status regardless of product type
 *
 * @param string $order_status The order status.
 * @param int    $order_id     The order id.
 *
 * @return string
 */
function wc_mark_all_orders_as_complete( $order_status, $order_id ) {
	$order = wc_get_order( $order_id );
	if ( $order_status == 'processing' && in_array( $order->get_status(), array( 'on-hold', 'pending', 'failed' ) ) ) {
		return 'completed';
	}

	return $order_status;
}

add_filter( 'woocommerce_payment_complete_order_status', 'wc_mark_all_orders_as_complete', 10, 2 );
