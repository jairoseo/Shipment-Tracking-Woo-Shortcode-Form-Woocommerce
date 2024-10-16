# Shipment Tracking Woo - MC shortcode form

Plugin para buscar y mostrar tracking number de una orden utilizando el plugin Shipment Tracking Woo.

## Como funciona este plugin?

1. Subir la carpeta mc-tracking a la carpeta plugins de wordpress

2. Tener instalado Woocommerce y Shipment Tracking Woo

3. Activar API REST de Woocommerce

    ```sh
    Ruta : wp-admin > woocommerce > avanzado > API REST
    ```

4. Editar el archivo mc-tracking.php

    ```sh
    $APIKEYCLIENTE = "ck_0000000000000";
    $APISECRETCLIENTE = "cs_0000000000000";
    ```
5. Activar el plugin "Shipment Tracking Woo - MC shortcode"

6. Crear una pagina y utiliza el shortcode para desplegar el formulario.

  ```sh
  [mc_tracking_form]
  ```

Plugin por: Jairo Herrera