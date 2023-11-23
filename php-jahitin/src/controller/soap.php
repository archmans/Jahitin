<?php
function newSubscription($id) {
    $url = "http://soap-app:8003/ws/subscription?wsdl";
    $requestBody = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.jahitin.com/">
                        <soapenv:Header/>
                        <soapenv:Body>
                            <ser:newSubscription>
                                <arg0>' . $id . '</arg0>
                            </ser:newSubscription>
                        </soapenv:Body>
                    </soapenv:Envelope>';
    $header = array(
        "Content-type: text/xml; charset=utf-8",
        "x-api-key: PHPClient",
        "Content-length: " . strlen($requestBody),
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function getStatus($id) {
    $url = "http://soap-app:8003/ws/subscription?wsdl";
    $requestBody = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.jahitin.com/">
                        <soapenv:Header/>
                        <soapenv:Body>
                            <ser:getStatus>
                                <arg0>' . $id . '</arg0>
                            </ser:getStatus>
                        </soapenv:Body>
                    </soapenv:Envelope>';
    $header = array(
        "Content-type: text/xml; charset=utf-8",
        "x-api-key: PHPClient",
        "Content-length: " . strlen($requestBody),
    );
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($ch);
    curl_close($ch);
    $ret = simplexml_load_string($response);
    return $ret->xpath('//return')[0];
}
?>
