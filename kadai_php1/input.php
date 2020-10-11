<?php
    $dsn = 'mysql:host=localhost;dbname=kadai_app;charset=utf8';
    $user = 'root';
    $pass = 'root';
    
    try{
            $dbh = new PDO($dsn, $user, $pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            
            // SQLの準備
            $sql = 'SELECT * FROM kadai_data';
            // SQLの実行
            $stmt = $dbh->query($sql);
            // SQLの結果を受け取る
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            
            // var_dump($result); //結果の確認
            // $dbh = null;

    } catch(PDOException $e){
            echo '接続失敗' . $e->getMessage(); //エラーを出力
            error_log($e, 3, '../error.log');  //ログを出力
            return $result;
            exit();
    }
  ?>


<html>

<head>
    <meta charset="utf-8">
    <title>課題テンプレート</title>
</head>

<body>
    <form action="dbc.php" method="post">
        お名前: <input type="text" name="name">
        EMAIL: <input type="text" name="mail">
        居住地: <input type="text" name="pref">
        使用言語：<select id="options" name="language">
                    <option value="英語"> 英語 </option>
                    <option value="中国語"> 中国語 </option>
                    <option value="日本語"> 日本語 </option>
                </select>
        <input type="submit" value="送信">
    </form>

    <!-- <form action="read.php" method="post">
        <input type="submit" value="受信">
    </form>
    <form action="read.php" method="post">
        <input type="submit" value="グラフ化">
    </form> -->
    <table>
        <tr>
            <th>No</th>
            <th>お名前</th>
            <th>EMAIL</th>
            <th>居住地</th>
            <th>使用言語</th>
        </tr>
        <?php foreach($result as $column): ?>
        <tr>
            <th><?php echo $column['id'] ?></th>
            <th><?php echo $column['name'] ?></th>
            <th><?php echo $column['mail'] ?></th>
            <th><?php echo $column['pref'] ?></th>
            <th><?php echo $column['language'] ?></th>
        </tr>
        <?php endforeach; ?>
    </table>
  
</body>

</html>
