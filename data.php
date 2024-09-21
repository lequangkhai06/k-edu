<?php
// Retrieve the requested page number
$page = $_POST['page'];

// Simulated JSON data
$data = array();
for ($i = 1; $i <= 1000; $i++) {
    $data[] = array(
        'id' => $i,
        'name' => 'Item ' . $i
    );
}

// Generate HTML content for the fetched data
$html = '';
$startIndex = ($page - 1) * 10;
$endIndex = min($startIndex + 10, count($data));
for ($i = $startIndex; $i < $endIndex; $i++) {
    $html .= '<div class="dataItem">' . $data[$i]['name'] . '</div>';
}

// Return the HTML content
echo $html;
