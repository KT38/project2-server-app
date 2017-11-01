<?php
require_once("config.php");

//セッションからデータをとる
session_start();

$id = $_SESSION['join']['id'];
$pass = $_SESSION['join']['pass'];
$sex = $_SESSION['join']['sex'];
$bloodtype = $_SESSION['join']['bloodtype'];
$year = $_SESSION['join']['year'];
$month = $_SESSION['join']['month'];
$day = $_SESSION['join']['day'];

$pass_hash =  password_hash($pass, PASSWORD_DEFAULT);

//登録ボタンが押されたらデータベースに追加
if(!empty($_POST))
{
    //mysqli_report(MYSQLI_REPORT_ERROR); //テスト用

    //接続
    $mysqli = new mysqli($db['host'], $db['user'], $db['pass'], $db['dbname']);
    if(!$mysqli)
    {
        echo "データベースの接続エラー";
    }
    //文字コード
    $mysqli->set_charset("utf-8");

    //クエリの発行
    $query = "insert into user values('{$id}','{$pass_hash}','{$sex}','{$bloodtype}',{$year},{$month},{$day})";
    //var_dump($query); //テスト用
    $result = $mysqli->query($query);
    //var_dump($result); //テスト用
    //切断
    $mysqli->close();
}

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <script language="JavaScript">
            //二度押し防止
            function nidooshi(form) {
                var elements = form.elements;
                for (var i = 0; i < elements.length; i++) {
                    if (elements[i].type == 'submit') {
                        elements[i].disabled = true;
                    }
                }
            } 
            
        </script>

    </head>
    <body>
        <div class="user_info">
            <p>ユーザ名:<?php echo htmlspecialchars($id) ?></p>
            <p>パスワード:<?php echo htmlspecialchars($pass) ?></p>
            <p>性別:<?php echo $sex ?></p>
            <p>血液型:<?php echo $bloodtype ?></p>
            <p>生年月日:<?php echo $year."年".$month."月".$day."日" ?></p>
        </div>

        <form method="post" action="">
            <input type="button" value = "戻る" onclick="history.back()">
            <input type="submit" value = "登録" name="add" onSubmit="return nidooshi(this)">
        </form>
    </body>
</html>