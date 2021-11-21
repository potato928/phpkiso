<?php
function time_diff($d1, $d2){
	 //初期化
	 $diffTime = array();
	 //タイムスタンプ
	 $timeStamp1 = strtotime($d1);
	 $timeStamp2 = strtotime($d2);
	 //タイムスタンプの差を計算
	 $difSeconds = $timeStamp2 - $timeStamp1;
	 //秒の差を取得
	 $diffTime['seconds'] = $difSeconds % 60;
	 //分の差を取得
	 $difMinutes = ($difSeconds - ($difSeconds % 60)) / 60;
	 $diffTime['minutes'] = $difMinutes % 60;
	 //時の差を取得
	 $difHours = ($difMinutes - ($difMinutes % 60)) / 60;
	 $diffTime['hours'] = $difHours;
	 //結果を返す
	 return $diffTime;
}

session_start();
if (isset($_SESSION['number'])) {//ログインしているとき
	$month_1 = $_POST['month'];
	$date = new DateTime($month_1);
	$date->modify('+1 months');
	$month_2 = $date->format('Y-m');
	$slaveNumber = $_SESSION['number'];

	try{
		$dsn = 'mysql:dbname=phpkiso;host=localhost';
		$user = 'root';
		$password = '';
		$dbh = new PDO($dsn, $user, $password);
		$sql = 'SELECT * FROM attendance WHERE slaveNumber = :slaveNumber AND typeCode = 0 ORDER BY date' ;
		$stmt = $dbh -> prepare($sql);
		$stmt->bindValue(':slaveNumber', $slaveNumber, PDO::PARAM_INT);
		$stmt -> execute();

		print '日付,';
		print '出勤時間,';
		print '退勤時間,';
		print '勤務時間,';
		print '<br/>';


		while(1)
		{
			$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($rec==false )
			{
				break;
			}
			else if($rec['date'] >= $month_1 && $rec['date'] < $month_2){
				$sql = 'SELECT * FROM attendance WHERE slaveNumber = :slaveNumber AND typeCode = 1 ORDER BY date' ;
				$stmt_2 = $dbh -> prepare($sql);
				$stmt_2->bindValue(':slaveNumber', $slaveNumber, PDO::PARAM_INT);
				$stmt_2 -> execute();
				while(1){
					$rec_2 = $stmt_2 -> fetch(PDO::FETCH_ASSOC);
					if($rec_2==false )
					{
						break;
					}
					else if($rec['date'] == $rec_2['date']){
						print $rec['date'].',';
						print substr($rec['time'],0,5).',';
						print substr($rec_2['time'],0,5).',';
						$diffTimeOutPut = array();
 						$diffTimeOutPut = time_diff($rec['time'], $rec_2['time']);
						print sprintf('%02d',$diffTimeOutPut['hours']).':'.sprintf('%02d',$diffTimeOutPut['minutes']);
						print '<br/>';
						break;
					}
				}
			}
		}
		$dbh = null;
		print'</br><a href="kensaku2.php">検索画面に戻る</a>';
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
