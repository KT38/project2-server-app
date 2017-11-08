<?
require_once("config.php");

session_start();

$id = $_POST["id"];
$pass = $_POST["pass"];

//接続
$mysqli = new mysqli($db['host'], $db['user'], $db['pass'], $db['dbname']);
//文字コード

$mysqli -> set_charset("utf-8");

//クエリの発行
$query = "select pass from user where id='{$id}'";
if(!$query)
{
    $_SESSION['error'] = "idが存在しません";
}
//var_dump($query); //テスト用
$pass_hash = $mysqli->query($query);
//var_dump($result); //テスト用
//切断
$mysqli->close();

if(password_verify($pass,$pass_hash))
{
    $_SESSION['join']['id'] = $id;
    header('Location: talk.php');
    exit();
}
else
{
    $_SESSION['error'] = "パスワードが違います";
    header('Location: index.html');
    exit();
}
?>