<?php
session_start();

if (isset($_SESSION['number'])) {//ログインしているとき
	$slaveNumber = $_SESSION['number'];
	$date = $_POST['date'];
	$typeCode = $_POST['typeCode'];
	$time = $_POST['time'];

	$slaveNumber = htmlspecialchars($slaveNumber);
	$date = htmlspecialchars($date);
	$typeCode = htmlspecialchars($typeCode);
	$time = htmlspecialchars($time);


	if($slaveNumber=='')
	{
		print'ユーザ番号が入力されていません。<br/>';
	}
	else
	{
		print'社畜番号:';
		print $slaveNumber;
		print'<br/>';
	}

	if($typeCode=='')
	{
		print'タイプが入力されていません。<br/>';
	}
	else
	{
		print'タイプ:';
		if($typeCode=='0')print '出勤';
		if($typeCode=='1')print '退勤';
		print '<br/>';
	}

	if($date=='')
	{
		print'日付が入力されていません。<br/>';
	}
	else
	{
		print'日付:';
		print $date;
		print'<br/>';
	}

	if($time=='')
	{
		print'時刻が入力されていません。<br/>';
	}
	else
	{
		print'時刻:';
		print $time;
		print '<br/>';
	}

		try{
		$dsn = 'mysql:dbname=phpkiso;host=localhost';
		$user = 'root';
		$password = '';
		$dbh = new PDO($dsn, $user, $password);
		$dbh -> query('SET NAMES utf8');

		$slaveNumber = htmlspecialchars($slaveNumber);
		$date = htmlspecialchars($date);
		$typeCode = htmlspecialchars($typeCode);
		$time = htmlspecialchars($time);

		$sql = "SELECT * FROM attendance WHERE slaveNumber = :slaveNumber AND date=:date AND typeCode = :typeCode";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':slaveNumber', $slaveNumber, PDO::PARAM_INT);
		$stmt->bindValue(':date', $date);
		$stmt->bindValue(':typeCode', $typeCode, PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt->fetch() !== false || $slaveNumber=='' || $date=='' || $typeCode=='' || $time=='') {
			// 存在しない
			if ($stmt->fetch() !== false)print'レコード登録済みです、DB管理者に削除してもらってください';
			print'<form>';
			print'<input type="button"onclick="history.back()"value="戻る">';
			print'</form>';
		}
		else
		{
			print'<form method="post"action="thanks2.php">';
			print'<input name="slaveNumber" type="hidden" value="'.$slaveNumber.'">';
			print'<input name="date" type="hidden"value="'.$date.'">';
			print'<input name="typeCode" type="hidden"value="'.$typeCode.'">';
			print'<input name="time" type="hidden"value="'.$time.'">';
			print'<input type="button"onclick="history.back()"value="戻る">';
			print'<input type="submit" value="登録">';
			print'</form>';
		}
		$dbh = null;
		}	
		catch(Exception $e)
		{
			print'ただいま障害により大変ご迷惑お掛けしております。';
		}

} else {//ログインしていない時
	$msg_notLogin = 'ログインしていません';
	$link_login = '<a href="login_form.php">ログイン</a>';
	
	echo "<h1>".$msg_notLogin."</h1>";
	echo $link_login;
}
?>
