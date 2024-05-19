<?php
require 'vendor/autoload.php';

use Goutte\Client as GoutteClient;

$httpClient = new GoutteClient();
$response = $httpClient->request('GET', 'https://giacaphe.com/gia-ca-phe-noi-dia/');

// get prices into an array
$prices = [];
$response->filter('.row li article div.product_price p.price_color')->each(function ($node) use (&$prices) {
    $prices[] = $node->text();
});

// echo titles and prices
$priceIndex = 0;
$response->filter('.row li article h3 a')->each(function ($node) use ($prices, &$priceIndex) {
    echo $node->text() . ' @ ' . $prices[$priceIndex] . PHP_EOL;
    $priceIndex++;
});
