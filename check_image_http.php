<?php
$url = 'http://127.0.0.1:8000/images/quan-1.png';
echo "Checking: $url\n";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$result = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$error = curl_error($ch);

curl_close($ch);

if ($error) {
    echo "Error: $error\n";
} else {
    echo "HTTP Status: $http_code\n";
    echo "Content-Type: $content_type\n";
    if ($http_code === 200) {
        echo "✓ File exists and is accessible!\n";
    } elseif ($http_code === 404) {
        echo "✗ File not found (404). Check if quan_1.png exists in public/images\n";
    } else {
        echo "Status: $http_code\n";
    }
}
?>
