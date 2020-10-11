<?php

  $dsn = 'mysql:host=localhost;dbname=kadai_app;charset=utf8';
  $user = 'root';
  $pass = 'root';

  try{
        $dbh = new PDO($dsn, $user, $pass,[
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        
        // SQLの準備
        $sql = 'SELECT * FROM blog_test';
        // SQLの実行
        $stmt = $dbh->query($sql);
        // SQLの結果を受け取る
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        
        // var_dump($result); 結果の確認
        // $dbh = null;

  } catch(PDOException $e){
        echo '接続失敗' . $e->getMessage(); //エラーを出力
        error_log($e, 3, '../error.log');  //ログを出力
        return $result;
        exit();
  }

  //データの取得
  $name = $_POST['name'];
  $mail = $_POST['mail'];
  $pref = $_POST['pref'];
  $language = $_POST['language'];

  //入力データを文字列化して保存
  function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
  }
  //入力が空白の場合の処理
  if (empty($name)){
    exit('名前を入力してください');
  }
  if (empty($mail)){
    exit('メールアドレスを入力してください');
  }
  if (empty($pref)){
    exit('居住地を入力してください');
  }


  try{
    // INSERT文を変数に格納
    $sql = "INSERT INTO kadai_data (name, mail, pref, language) VALUES (:name, :mail, :pref, :language)";
    
    // 挿入する値は空のまま、SQL実行の準備をする
    $stmt = $dbh->prepare($sql);
    
    // 挿入する値を配列に格納する
    $params = array(':name' => $name, ':mail' => $mail, ':pref' => $pref, ':language' => $language);
    
    // 挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params);
    
    // 登録完了のメッセージ
    echo '登録完了しました';
  } catch(PDOException $e){
    echo $e->getMessage(); //エラーを出力
    exit();
  }


?>

<html>
    <head>
        <meta charset="utf-8">
        <title>データベース書き込み</title>
    </head>
    <body>
        <h1>書き込みしました。</h1>
        <p> <?= $str ?></p>
            <h2>戻るボタンで表示を確認しましょう！</h2>
        <ul>
            <li><a href="input.php">戻る</a></li>
        </ul>
    </body>
</html>
