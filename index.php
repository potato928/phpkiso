<?php
session_start();

$link_logout = '<a href="logout.php">ログアウト</a>';
$link_login = '<a href="login_form.php">ログイン</a>';
$link_input = '<a href="input.php">入力</a>';
$link_kensaku2 = '<a href="kensaku2.php">索引</a>';

if (isset($_SESSION['number'])) {//ログインしているとき
	$username = $_SESSION['name'];
	$msg_login = 'こんにちは「' . htmlspecialchars($username, \ENT_QUOTES, 'UTF-8') . '」さん';

	echo "<h1>".$msg_login."</h1>";
	echo $link_input."<br>";
	echo $link_kensaku2."<br>";
	echo $link_logout;
} else {//ログインしていない時
	$msg_notLogin = 'ログインしていません';
	
	echo "<h1>".$msg_notLogin."</h1>";
	echo $link_login;
}
?>