<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

include_once("php_xlsxwriter/xlsxwriter.class.php");

$data = [];

$files = glob(__DIR__ . '/data/*.json');

foreach ($files as $key => $value) {
    $c = json_decode(file_get_contents($value), true);

    if((int)$c['product_category_id'] !== (int)"26"){
        $data[] = [
            'barcode' => $c['product_barcode'],
            'model' => 'TE-' . rand(111111, 999999),
            'brand' => '',
            'category' => '2951',
            'unit' => 'TRY',
            'name' => "Toptanevim " . $c['product_name'],
            'description' => $c['product_specification'],
            'market_fee' => (((double)$c['product_fee'] / 100) * 50) + (double)$c['product_fee'],
            'trendyol_fee' => (((double)$c['product_fee'] / 100) * 40) + (double)$c['product_fee'],
            'stock' => $c['product_stok'],
            'stock_code' => $c['product_barcode'],
            'kdv' => '18',
            'desi' => $c['product_desi'],
            'image_1' => ($c['product_image1'] == '') ? '' : 'https://toptanevim.com/' . $c['product_image1'],
            'image_2' => ($c['product_image2'] == '') ? '' : 'https://toptanevim.com/' . $c['product_image2'],
            'image_3' => ($c['product_image3'] == '') ? '' : 'https://toptanevim.com/' . $c['product_image3'],
            '1' => '',
            '2' => '',
            '3' => '',
            '4' => '',
            '5' => '',
            '6' => '',
            '7' => '',
            '8' => '',
            'desi2' => $c['product_desi'],
        ];
    }
}
echo "<pre>";
print_r($data);
echo "<pre>";

$writer = new XLSXWriter();
$writer->writeSheet($data);
$writer->writeToFile('output.xlsx');