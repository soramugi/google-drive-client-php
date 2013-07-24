<?php

require_once __DIR__ . '/../vendor/autoload.php';

$client = new Soramugi\GoogleDrive\Client;

// get client id
// https://code.google.com/apis/console/
$client->setClientId('your client id');
$client->setClientSecret('your client secret');

// json type string
// get access_token
// https://gist.github.com/soramugi/6060776
$token = '{"access_token":"your_access_token","token_type":"Bearer","expires_in":3600,"refresh_token":"your_refresh_token","created":0000000000}';
$client->setAccessToken($token);
