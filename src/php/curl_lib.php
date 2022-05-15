<?php

function singleCurl($urlToCurl)
{

    $curlObj = curl_init();
    $urlToCurl = $urlToCurl;

    curl_setopt($curlObj, CURLOPT_URL, $urlToCurl);
    curl_setopt($curlObj, CURLOPT_ENCODING, '');
    curl_setopt($curlObj, CURLOPT_HEADER, false);
    curl_setopt($curlObj, CURLOPT_POST, false);
    curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);

    $resultOfCurl = curl_exec($curlObj);
    curl_close($curlObj);
    return $resultOfCurl;
}

function multipleCurl($urlsToMultiCurl)
{
    $resultOfMultiCurl = array();
    $multiCurlArr = array();
    $multiCurlHandle = curl_multi_init();

    for ($i = 0; $i < count($urlsToMultiCurl); $i++) {

        $fetchURL = $urlsToMultiCurl[$i];
        $multiCurlArr[$i] = curl_init();
        curl_setopt($multiCurlArr[$i], CURLOPT_URL, $fetchURL);
        curl_setopt($multiCurlArr[$i], CURLOPT_ENCODING, '');
        curl_setopt($multiCurlArr[$i], CURLOPT_HEADER, false);
        curl_setopt($multiCurlArr[$i], CURLOPT_POST, false);
        curl_setopt($multiCurlArr[$i], CURLOPT_RETURNTRANSFER, true);
        curl_multi_add_handle($multiCurlHandle, $multiCurlArr[$i]);
    }
    $index = null;
    do {
        curl_multi_exec($multiCurlHandle, $index);
    } while ($index > 0);

    foreach ($multiCurlArr as $mainArray => $SubArray) {
        $resultOfMultiCurl[$mainArray] = curl_multi_getcontent($SubArray);
        curl_multi_remove_handle($multiCurlHandle, $SubArray);
    }
    curl_multi_close($multiCurlHandle);

    return $resultOfMultiCurl;
}

?>