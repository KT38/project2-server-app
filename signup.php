<?php

session_start();

//POSTの送信があったか
if (!empty($_POST))
{
    //エラー処理
    //フォームからのデータを受け取るのは$_POSTでissetするよりfilter_inputのほうがいいらしい http://php.net/manual/ja/function.filter-input.php
    if (!$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS)) 
    {
        $error['id'] = 'ユーザー名を入力してください';
    }
    if (iconv_strlen($id) > 8) 
    {
        $error['id'] = 'ユーザー名は8文字以内にしてください';
    }
    
    if (!$pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS)) 
    {
        $error['pass'] = 'パスワードを入力してください';
    }

    if (iconv_strlen($pass) > 10) 
    {
        $error['pass'] = 'パスワードは10文字以内にしてください';
    }
    


    //エラーがなかったらデータをセッションに入れて確認ページに飛ばす
    if(empty($error))
    {
        $_SESSION['join'] = $_POST;
        header('Location: check.php');
        exit();
    }
}

?>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script language="JavaScript">
            //送信ボタンの二度押し防止
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
        <?php if(!empty($error['id'])):?>
            <div class = 'id_error'>
                <p><?php echo $error['id']; ?></p>
            </div>
        <?php endif ?>

        <?php if(!empty($error['pass'])):?>
            <div class = 'pass_error'>
                <p><?php echo $error['pass']; ?></p>
            </div>
        <?php endif ?>
<!-- ここから会員登録のやつ -->
        <form method = "post" action="">
            <fieldset>
                <legend>会員登録</legend>
                <label for="id">
                    ユーザ名：<input type="text" name="id" value=<?php echo filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS) ?>>(必須)
                </label>
                <br>
                <label for="pass">
                    パスワード：<input type="password" name="pass" value=<?php echo filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS) ?>>(必須)
                </label>
                <br>
                <!-- ユーザー名とパスワード以外は空でもおｋ-->
                <label for="sex">
                    性別:<input type="radio" name="sex" value="男">男 
                    <input type="radio" name="sex" value="女">女 
                    <input type="radio" name="sex"value="  " checked="checked" style="display:none;" />
                </label>
                <br>
                <label for="bloodtype">
                    血液型：
                    <select name="bloodtype">
                        <option value="" selected>  </option>
                        <option value="A">A型</option>
                        <option value="B">B型</option>
                        <option value="O">O型</option>
                        <option value="AB">AB型</option>
                    </select>
                </label>
                <br>
                <label for="birthday">
                    生年月日：
                    <select name="year">
                        <option value="  "></option>
                        <option value="1950">1950</option>
                        <option value="1951">1951</option>
                        <option value="1952">1952</option>
                        <option value="1953">1953</option>
                        <option value="1954">1954</option>
                        <option value="1955">1955</option>
                        <option value="1956">1956</option>
                        <option value="1957">1957</option>
                        <option value="1958">1958</option>
                        <option value="1959">1959</option>
                        <option value="1960">1960</option>
                        <option value="1961">1961</option>
                        <option value="1962">1962</option>
                        <option value="1963">1963</option>
                        <option value="1964">1964</option>
                        <option value="1965">1965</option>
                        <option value="1966">1966</option>
                        <option value="1967">1967</option>
                        <option value="1968">1968</option>
                        <option value="1969">1969</option>
                        <option value="1970">1970</option>
                        <option value="1971">1971</option>
                        <option value="1972">1972</option>
                        <option value="1973">1973</option>
                        <option value="1974">1974</option>
                        <option value="1975">1975</option>
                        <option value="1976">1976</option>
                        <option value="1977">1977</option>
                        <option value="1978">1978</option>
                        <option value="1979">1979</option>
                        <option value="1980">1980</option>
                        <option value="1981">1981</option>
                        <option value="1982">1982</option>
                        <option value="1983">1983</option>
                        <option value="1984">1984</option>
                        <option value="1985">1985</option>
                        <option value="1986">1986</option>
                        <option value="1987">1987</option>
                        <option value="1988">1988</option>
                        <option value="1989">1989</option>
                        <option value="1990">1990</option>
                        <option value="1991">1991</option>
                        <option value="1992">1992</option>
                        <option value="1993">1993</option>
                        <option value="1994">1994</option>
                        <option value="1995">1995</option>
                        <option value="1996">1996</option>
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                        <option value="1999">1999</option>
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                    </select>
                    年 
                    <select name="month">
                        <option value="  "></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    月 
                    <select name="day">
                        <option value="  "></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    日 <br>
                </label>
                <br>
            </fieldset>
            <input type="submit" value = "確認" onSubmit="return nidooshi(this)">
            <input type="reset">
        </form>
<!-- ここまで -->
    </body>
</html>