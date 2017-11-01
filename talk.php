<?php
require_once("config.php");

if(isset($_POST["msg"]))
{
    //フォームの受取
    $send_msg = $_POST["msg"];

    //「今日の天気は？」と送られるとlivedoorのweather hacks(http://weather.livedoor.com/weather_hacks/webservice)から神戸市の天気を取得 
    if($send_msg == "今日の天気は？")
    {
        $tmp_url = "http://weather.livedoor.com/forecast/webservice/json/v1?city=280010";
        $json = file_get_contents($tmp_url,true) or die("Failed to get json");
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $weather_obj = json_decode($json);
        $weather = $weather_obj->forecasts[0]->image->title;
        $return_msg = "今日は".$weather."だよ！今日も一日がんばろう！";
    }
    else
    //それ以外だとdocomoの雑談対話API(https://dev.smt.docomo.ne.jp/?p=docs.api.page&api_name=dialogue&p_name=api_usage_scenario)で会話が成り立っているっぽくする
    {
        //会話を継続させるために'context'を取得
        if(isset($return_context))
        {
            $send_context = $return_context;
        }
        else
        {
            $send_context = '';
        }

        //レスポンスボディで'mode'を指定するとしりとりもできるらしいからその設定（たまにおかしいけど多分API側の問題）
        if(isset($return_mode))
        {
            $send_mode = $return_mode;
        }
        else
        {
            $send_mode = '';
        }


        //それっぽい感じでリクエストを送る。詳しくはこのURLを参照 https://dev.smt.docomo.ne.jp/?p=docs.api.page&api_name=dialogue&p_name=api_1#tag01を参照
        $api_key = $key['docomo'];
        $api_url = sprintf('https://api.apigw.smt.docomo.ne.jp/dialogue/v1/dialogue?APIKEY=%s', $api_key);
        $req_body = array('utt' => $send_msg, 't' => 30, 'place' => '神戸', 'sex' => '男', 'context' => $send_context, 'mode' => $send_mode);
        $headers = array(
            'Content-Type: application/json; charset=UTF-8',
        );
        $options = array(
            'http'=>array(
                'method'  => 'POST',
                'header'  => implode("\r\n", $headers),
                'content' => json_encode($req_body),
                )
            );
        $stream = stream_context_create($options);
        $response = json_decode(file_get_contents($api_url, false, $stream));

        $return_msg = $response->utt; //返信メッセージ
        $return_context = $response->context; //会話を継続させるためのやつ
        $return_mode = $response->mode; //しりとりのやつ
    }
}
?>

<html>  
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <img src="image/KTvanilla.png" alt="">

        <form method="post" action=".">
            <textarea name="msg" cols="80" rows="3" placeholder="メッセージを入力してね"><?php if(isset($send_msg)){echo $send_msg;} ?></textarea>
            <input type="submit">
        </form>

        <div class="res">
            <div class="balloon4">
                <p>
                    <?php if(isset($return_msg)){echo $return_msg;} ?>
                </p>
            </div> 
        </div>
    </body>
</html>