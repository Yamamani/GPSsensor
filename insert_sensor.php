<?php
$server = "■■■■■■■■■.phy.lolipop.lan";
$username = "LAA1593625";
$password = "testTEST";
$database = "LAA1593625-test";

// MySQLに接続
$db = new mysqli($server, $username, $password, $database);

// JSON形式で出力することを通知
header("Content-type: application/json; charset=utf-8");

// パラメータを受け取る
$x = isset($_POST['x']) ? (float)$_POST['x'] : null;
$y = isset($_POST['y']) ? (float)$_POST['y'] : null;
$z = isset($_POST['z']) ? (float)$_POST['z'] : null;

// SQL文
$stmt = $db->prepare("INSERT INTO G (id,x, y, z, time) VALUES (1,?, ?, ?, CURRENT_TIMESTAMP)");

// パラメータ部分のデータ型と実際の値を設定
$stmt->bind_param('ddd', $x, $y, $z); // 'ddd'はfloat用

// SQL文を実行
$ret = $stmt->execute();

if ($ret == false) {
    echo json_encode(["result" => "NG", "error" => $stmt->error]);
} else {
    echo json_encode(["result" => "OK"]);
}

$stmt->close();
$db->close();
?>
