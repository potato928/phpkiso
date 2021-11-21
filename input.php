<?php
session_start();

if (isset($_SESSION['number'])) {//ログインしているとき
{
	echo <<<EOT
		<script>
			window.onload = function () {
			//今日の日時を表示
			var date = new Date();

			var yyyy = date.getFullYear();
			var MM = ("0"+(date.getMonth()+1)).slice(-2);
			var dd = ("0"+date.getDate()).slice(-2);

			var hh = ("0"+date.getHours()).slice(-2);
			var mm = ("0"+date.getMinutes()).slice(-2);
			var ss = ("0"+date.getSeconds()).slice(-2);

			document.getElementById("today").value=yyyy+'-'+MM+'-'+dd;
			document.getElementById("currentTime").value=hh+':'+mm;
			}
		</script>
		<form method ="post" action="check2.php">
		タイプコード</br>
		<select name="typeCode" type="number" style="width:100px">
			<option value="0">出勤</option>
			<option value="1">退勤</option>
		</select><br/>
		日付</br>
		<input name="date" type="date" style="width:150px" id="today"><br/>
		時刻</br>
		<input name="time" type="time" style="width:100px"id="currentTime"><br/>
		<br/>
		<input type="submit" value="送信">
		</form>
		<br/>
		<a href="index.php">ホーム</a>
	EOT;
}
} else {//ログインしていない時
	$msg_notLogin = 'ログインしていません';
	$link_login = '<a href="login_form.php">ログイン</a>';
	
	echo "<h1>".$msg_notLogin."</h1>";
	echo $link_login;
}
?>