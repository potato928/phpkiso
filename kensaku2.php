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
			document.getElementById("thisMonth").value=yyyy+'-'+MM;
			}
		</script>
		
		<form method ="post" action="kekka.php">
		月を入力してください。</br>
		<input name="month" type="month" style="width:150px" id="thisMonth"><br/>
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