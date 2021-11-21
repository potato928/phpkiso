<?php
$name = $_POST['name'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$dsn = "mysql:host=localhost; dbname=phpkiso; charset=utf8";
$username = "root";
$password = "";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

    $sql = "INSERT INTO users(name, pass) VALUES (:name, :pass)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':pass', $pass);
    $stmt->execute();

    $sql = "SELECT MAX(number) AS largestNumber FROM users";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $number = $stmt->fetch();
    $msg = '貴方のユーザ番号は「'.$number['largestNumber'].'」です。';
    $link = '<a href="login_form.php">ログインページ</a>';

    $dbh=null;
?>

<h1><?php echo $msg; ?></h1><!--メッセージの出力-->
<?php echo $link; ?>