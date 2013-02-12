<?php
/**
 * @package DesktopServer for WordPress
 * @version 1.0.0
 */
/*
Plugin Name: DesktopServer for WordPress
Plugin URI: http://serverpress.com/products/desktopserver/
Description: DesktopServer for WordPress eases localhost to live server deployment by publishing hosting provider server details via a protected XML-RPC feed to an authorized administrator only. For more information, please visit http://serverpress.com/.
Author: Stephen Carroll
Version: 1.0.0
Author URI: http://steveorevo.com/
*/

add_filter('xmlrpc_methods', 'ds_xmlrpc_methods');

function ds_xmlrpc_methods( $methods ){
    $methods['ds_get_server_details'] = 'ds_get_server_details';
    $methods['ds_begin_site_xfer'] = 'ds_begin_site_xfer';
    $methods['ds_end_site_xfer'] = 'ds_end_site_xfer';
    $methods['ds_receive_xfer'] = 'ds_receive_xfer';
    return $methods;
}

function ds_get_server_details( $args ){
    
    // Authenticate the user
    global $wp_xmlrpc_server;
    global $wp_version;
    if ( !$wp_xmlrpc_server->login($args[0], $args[1]) ) {
        return $wp_xmlrpc_server->error;
    }
    
    // Return server details needed for DesktopServer deployment
    $wp_constants  = array( 'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'DB_HOST');
    $server_details = array();
    foreach($wp_constants as $constant){
        $value = '';
        if ( defined( $constant ) ){
            $value = constant( $constant );
        }
        $server_details[$constant] = $value;
    }
    $server_details['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
    $pdata = get_plugin_data(__FILE__);
    $server_details['DS_VERSION'] = $pdata['Version'];
    $server_details['WP_VERSION'] = $wp_version;
    return $server_details;
}

function ds_begin_site_xfer( $args ) {
    
    // Authenticate the user
    global $wp_xmlrpc_server;
    global $wp_version;
    if ( !$wp_xmlrpc_server->login($args[0], $args[1]) ) {
        return $wp_xmlrpc_server->error;
    }
    
    
}

function ds_end_site_xfer( $args ) {
    
    // Authenticate the user
    global $wp_xmlrpc_server;
    global $wp_version;
    if ( !$wp_xmlrpc_server->login($args[0], $args[1]) ) {
        return $wp_xmlrpc_server->error;
    }
}

function ds_receive_xfer( $args ) {
    
    // Authenticate the user
    global $wp_xmlrpc_server;
    global $wp_version;
    if ( !$wp_xmlrpc_server->login($args[0], $args[1]) ) {
        return $wp_xmlrpc_server->error;
    }
    
}

?>
