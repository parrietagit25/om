<?php

// Importar archivo .env
include '.env';

// IMPORTAR ARCHIVO BgFirma.php
include 'src/BgFirma.php';

use Bg\BgFirma;

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$domain = $protocol . $_SERVER['HTTP_HOST'];

// verificar credenciales
$response = BgFirma::checkCredentials(ID_DEL_COMERCIO, CLAVE_SECRETA, $domain);

if ($response && $response['success']) {
    // Inicializar objeto para poder generar el hash

    $bg = new BgFirma(
        $_POST["total"],
        ID_DEL_COMERCIO,
        'USD',
        $_POST["subtotal"],
        $_POST["taxes"],
        $response['unixTimestamp'],
        'YAP',
        'VEN',
        $_POST["orderId"],
        $_POST["successUrl"],
        $_POST["failUrl"],
        $domain,
        CLAVE_SECRETA,
        MODO_DE_PRUEBAS,
        $response['accessToken'],
        $_POST["tel"]
    );
    $response = $bg->createHash();
    if ($response['success']) {
        /**
         * Al verificar si se creó con éxito el hash, podremos obtener el url de la siguiente manera
         * @var response contiente los valores
         * @var response['url'] = contiene el url a redireccionar para continuar con el pago.
         */
        $url = $response['url'];
        echo "
                <script type=\"text/javascript\">
                window.location.replace(\"$url\");
                </script>
            ";
    } else {
        /**
         * Aquí es donde se mostrarán los errores generados por
         * cualquier tipo de validación de campos necesarios para realizar la transacción.
         * @var response contiene los valores
         * @var response['msg'] = contiene el mensaje de error a mostrar
         * @var response['class'] = contiene la clase de error que es, pueden ser: alert (amarillo), invalid (rojo)
         */
        $bg->showAlertError($response);
    }
} else {
    echo '<style>';
    include 'main.css';
    echo '</style>';
    echo "<div class='alert'>Algo salió mal. Contacta con el administrador</div>";
}
