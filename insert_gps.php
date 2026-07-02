<?php
$server = "■■■■■■■■■■";
$username = "■■■■■■■■■";
$password = "■■■■■■■■■";
$database = "■■■■■■■■■";

// MySQLに接続
$db = new mysqli($server, $username, $password, $database);

// JSON形式で出力することを通知
header("Content-type: application/json; charset=utf-8");

// パラメータを受け取る
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$altitude = $_POST['altitude'];

// SQL文
$stmt = $db->prepare("INSERT INTO GPS (id,latitude, longitude, altitude, time) VALUES (1,?, ?, ?,CURRENT_TIMESTAMP)");

// データ型を設定
$stmt->bind_param('ddd', $latitude, $longitude, $altitude);

// SQL文を実行
$ret = $stmt->execute();

if ($ret == false) {
    echo '{"result":"NG"}';
} else {
    echo '{"result":"OK"}';
}

$db->close();
?>
