<?php 
session_start();
if (!isset($_GET['producto'])) {
    header("Location: index.php");
}
if (isset($_POST['total'])) {

$data = array(
    "CCLW" => "BE4A1C0D785CFE434B766DF8FB2842721A62E73542A5DBEE92DC429EAE1924796E69EB6A72B775DD87640BCCBF9574DF4A274038C59BE12D5C81ECF38FAF9A48",
    "CMTN" => $_POST['total'],
    "CDSC" => $_POST['titulo'],
    "RETURN_URL" => 'https://ofmptygroup.com/resp_paguelofacil.php',
    "PARM_1" => $_POST['id_product'],
    "PARM_2" => $_SESSION['user_id'],
    "PARM_3" => $_POST['cantidad'],
    "PARM_4" => $_POST['monto_unitario'],
    "EXPIRES_IN" => 3600,
    );
    $postR="";
    foreach($data as $mk=>$mv) { $postR .= "&".$mk."=".$mv; }
    $ch = curl_init();
    //curl_setopt($ch,CURLOPT_URL, "https://secure.paguelofacil.com/LinkDeamon.cfm");
    curl_setopt($ch,CURLOPT_URL, "https://secure.paguelofacil.com/LinkDeamon.cfm");
    
    //curl_setopt($ch,CURLOPT_URL, "https://secure.paguelofacil.com/LinkDeamon.cfm/AUTH");   ****En Caso de querer Pre-autorizar  y capturar en procesos separados.
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','Accept: */*'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postR);
    $result = curl_exec($ch);
    //$responseArray = json_decode($result, true);
    //$paymentUrl = $responseArray['data']['url'];

    curl_close($ch);
    
    // Decodificar la respuesta JSON
    $responseArray = json_decode($result, true);
    //echo $responseArray['data']['url'];
    // Si la respuesta tiene la URL de pago, redirigir
    if (isset($responseArray['data']['url'])) {
        $paymentUrl = $responseArray['data']['url'];
        header("Location: $paymentUrl");
        exit(); // Termina el script para asegurarte que no se ejecute más código
    } else {
        echo "Error al generar la URL de pago. Por favor, intente nuevamente.";
    }

}