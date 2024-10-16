<?php
/**
 * Plugin Name:  Shipment Tracking Woo - MC shortcode
 * Description:  Plugin para buscar y mostrar tracking number de una orden utilizando el plugin Shipment Tracking Woo.
 * Version:      1.7
 * Author:       Jairo Herrera
 * Author URI:   https://github.com/jairoseo/
 *
 * @category Shortcode
 * @package  STMCS
 * @author   Jairo Herrera <jairo.seo@gmail.com>
 * @license  GPLv2 http://www.gnu.org/licenses/gpl-2.0.txt
 */

if (!defined('ABSPATH')) {
    exit;
}

add_shortcode('mc_tracking_form', 'mostrarFormulario');

function generarMsg($clases,$mensaje)
{
    return '<div class="'.$clases.'" role="alert">'.$mensaje.'</div>';
}

function Mc_tracking_form()
{
    // Datos de ingreso api
    // Ruta wp-admin > woocommerce > avanzado > API REST
    $APIKEYCLIENTE = "ck_00000000";
    $APISECRETCLIENTE = "cs_00000000";

    global $wpdb;

    // Error general
    $error = generarMsg("alert alert-danger","Datos incorrectos, verifícalos o habla con soporte para ayudarte.");

    if (!isset($_POST['tracking_nonce']) || !wp_verify_nonce($_POST['tracking_nonce'], 'mc_seguridad-ogt')) {
        wp_die('Verificación de seguridad fallida');
    }

    if (!empty($_POST) && $_POST['orden'] != '' && is_numeric($_POST['orden']) && is_email($_POST['email']))
    {
        $customer = $wpdb->get_row( "SELECT wco.status, wco.order_id FROM ".$wpdb->prefix."wc_order_stats wco, ".$wpdb->prefix."wc_customer_lookup wcc WHERE wco.order_id = '".(int) $_POST['orden']."' and wcc.email = '".$_POST['email']."' and wco.customer_id=wcc.customer_id" );

        if($customer)
        {
            $apiCurl = curl_init();
            curl_setopt($apiCurl, CURLOPT_URL, get_home_url().'/wp-json/wc-shipment-tracking/v3/orders/'.$customer->order_id.'/shipment-trackings/');
            curl_setopt($apiCurl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($apiCurl, CURLOPT_HTTPGET, true);
            curl_setopt($apiCurl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($apiCurl, CURLOPT_USERPWD, "$APIKEYCLIENTE:$APISECRETCLIENTE");
            $response = curl_exec($apiCurl);
            curl_close($apiCurl);
            $response = json_decode($response);            

                if(isset($response) && count($response) > 0){
                    ob_start();
                    include(plugin_dir_path(__FILE__) . '/templates/resultado-tracking.php');
                    $print = ob_get_clean();
                }else{
                    // El pedido existe, pero no tiene guia asignada
                    $print = generarMsg("alert alert-warning","El pedido no tiene guia asignada, si tienes alguna duda habla con soporte para ayudarte.");
                }
            
        }else{
            // El pedido no existe
            $print = $error;
        }
        
    }else{
        // Datos incorrectos, mal formato o incompletos.
        $print = $error;
    }
    return $print;   
}

function mostrarFormulario()
{
    wp_enqueue_style('css_mc_tracking', plugins_url('/assets/css/bootstrap.min.css', __FILE__));
    ob_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo Mc_tracking_form();
    }
    include(plugin_dir_path(__FILE__) . '/templates/formulario-tracking.php');
    return ob_get_clean();
}
?>