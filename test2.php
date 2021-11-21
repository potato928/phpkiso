<?php

//try
//{

$dsn = 'mysql:dbname=phpkiso;host=phpkiso.cssqav9ikuua.us-east-2.rds.amazonaws.com';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//$sql='SELECT number,name FROM users WHERE 1';
//$stmt=$dbh->prepare($sql);
//$stmt->execute();

//$dbh=null;

//while(true)
//{
//        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
//        if($rec==false)
//        {
//                break;
//        }
//        print $rec['number'];
//        print $rec['name'];

//}

//}
//catch (Exception $e)
//{
//        print 'データーベース接続エラー発生';
//        exit();
//}
print'テスト';
?>