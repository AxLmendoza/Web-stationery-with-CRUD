<?php
// Archivo: geocode.php

function geocodeAddress($address) {
    $apiKey = 'HHgyM0WxbkmCqm5PeFR95TV59i0jiYZMgs4W0H4eV8cvZSLP813HxF4QO50utQz8'; 
    $url = "https://api.distancematrix.ai/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . $apiKey;

    // Inicia cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecuta la solicitud y decodifica el JSON
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    // Verifica si hay resultados válidos
    if ($data['status'] == 'OK') {
        $lat = $data['results'][0]['geometry']['location']['lat'];
        $lng = $data['results'][0]['geometry']['location']['lng'];
        return ['lat' => $lat, 'lng' => $lng];
    } else {
        return null; // En caso de error
    }
}
?>

