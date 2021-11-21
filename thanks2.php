<?php
session_start();
if (isset($_SESSION['number'])) {//ログインしているとき

	try{
		$dsn = 'mysql:dbname=phpkiso;host=localhost';
		$user = 'root';
		$password = '';
		$dbh = new PDO($dsn, $user, $password);
		$dbh -> query('SET NAMES utf8');

		$slaveNumber = $_POST['slaveNumber'];
		$date = $_POST['date'];
		$typeCode = $_POST['typeCode'];
		$time = $_POST['time'];

		$slaveNumber = htmlspecialchars($slaveNumber);
		$date = htmlspecialchars($date);
		$typeCode = htmlspecialchars($typeCode);
		$time = htmlspecialchars($time);

		print $_SESSION['name'];
		print'様<br/>';
		print'お疲れ様です。<br/>';
		print'タイプ:';
		if($typeCode=='0')print '出勤';
		if($typeCode=='1')print '退勤';
		print'<br/>';
		print'日付:';
		print $date;
		print'<br/>';
		print'時刻:';
		print $time;
		print'<br/>';


		$sql = 'INSERT INTO attendance(slaveNumber, date, typeCode, time) VALUES("'.$slaveNumber.'", "'.$date.'", "'.$typeCode.'", "'.$time.'")';
		$stmt = $dbh -> prepare($sql);
		$stmt -> execute();

		$dbh = null;
		print'<a href="index.php">ホーム</a>';
	}
	catch(Exception $e)
	{
		print'ただいま障害により大変ご迷惑お掛けしております。';
	}
}
else {//ログインしていない時
	$msg_notLogin = 'ログインしていません';
	$link_login = '<a href="login_form.php">ログイン</a>';
	
	echo "<h1>".$msg_notLogin."</h1>";
	echo $link_login;
}
?>
