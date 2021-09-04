<?php

function webhook($endpoint, $data)
{

    $webhook = 'https://b24-qiznit.bitrix24.com.br/rest/1/6d73es313ty19cic/';
    $ch = curl_init($webhook . $endpoint);
    $query = http_build_query($data);

    curl_setopt_array($ch, array(
        CURLOPT_HEADER => 0,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $query,
        CURLOPT_RETURNTRANSFER => true
    ));

    $result = curl_exec($ch);

    curl_close($ch);

    return json_decode($result, 1);
}
