<!-- 
pdo PHP Data Obiect 能夠支援超過10種伺服器
php的資料庫擴展，速度較快，OOP(Object Oriented Programming)的寫法，物件導向,有效防止資料庫注入攻擊，安全性較高
 -->
<?php
    $db_host = "localhost";
    $db_user = "willyL";
    $db_pw = "800510";
    $db_name = "lccnet";
    $db_charset = "utf8mb4";

    $dsn = "mysql:host={$db_host};dbname={$db_name};charset={$db_charset}";
    // mysql:host={}資料庫的位置 /  dbname={} 資料庫的名稱/ dbname={} 資料庫的編碼
    // $dsn data Sourse name

    // $pdo = new PDO($dsn,$db_user,$db_pw); //建立實體

    // 例外處理 錯誤處理 方便日後連線除錯
    try {
        $pdo = new PDO($dsn,$db_user,$db_pw);
        // 寫下要執行的事件
        // $pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_SILENT); 
            //不主動報錯  setAttribute設定屬性（設定錯誤,不主動報錯）
        // $pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING); 
            //主動報錯 setAttribute設定屬性（設定錯誤,主動報錯）
        $pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //主動報錯 setAttribute設定屬性（設定錯誤,主動報例外）
    }catch(PDOException $e){
        // PDOException 所有出現的錯誤/例外 存放在 $e
        echo $e->getMessage();
        // ->getMessage() Returns the Exception message.
    }

    // 若用PDO::ERRMODE_SILENT用以下
    // $sql = "SELECT * FROM test";
    // $res = $pdo -> exec($sql); // 當做 mysqli_query($conn,$sql);
    // if($res){
    //     var_dump($result);
    // }else{
    //     echo $pdo->errorCode();
    //     echo "<br>";
    //     var_dump($pdo->errorInfo());
    // }

    // 若用PDO::ERRMODE_EXCEPTION用以下
    try{
        $sql = "SELECT * FROM test";
        $res = $pdo -> exec($sql);
        // exec(）執行給定的命令，但不輸出結果，而是返回結果的最後一行
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    //？為何要寫兩次echo $e->getMessage();
    // FROM test??
?>