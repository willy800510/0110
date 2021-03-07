<?php
    require_once("pdo.php");
    $sql = "SELECT * FROM galleries";
    // 
    // 以下是為了保護$sql
    $stmt = $pdo -> prepare($sql);
    // 預備陳述式
    $stmt->execute(); // 等同於 mysqli_query()
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
        // fetch()指定返回陣列或是物件. 資料顯示方法需要先設定setFetchMode 包括以下：
        // PDO::FETCH_ASSOC 返回以欄位名稱作為索引鍵(key)的陣列(array)
        // PDO::FETCH_NUM 返回以數字作為索引鍵(key)的陣列(array)
        // PDO::FETCH_BOTH 返回 FETCH_ASSOC 和 FETCH_NUM 的結果
        // PDO::FETCH_CLASS 返回一個物件，以欄位名稱設定屬性，並把設值給該屬性

        var_dump($row);
        // echo $row["name"];
        echo "<br>";
    }
    include("template/header.php");
?>
<?php
    // echo time();
    // echo md5(time());
    // echo sha1(time());
    // echo uniqid();
    // echo "Fish".md5(sha1(uniqid(time())))."SAN";
?>
<div class="row">
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <!-- enctype="multipart/form-data" 關乎到檔案上傳,必須填寫-->
        <input type="file" name="gallery" id="formFileSm" class="form-control form-control-sm">
        <!-- input type="file" 可以選擇資料夾 -->
        <input type="submit" value="上傳" class="btn btn-primary">
    </form>
</div>
<div class="d-flex justify-content-center align-items-end">
    <?php
        $galleries = glob('images/*');
        // glob(); 返回匹配指定模式的檔名或目錄/抓取你資料夾內所有東西
        // * 代表所有檔案
        // var_dump($galleries);
        foreach($galleries as $g){
        //因為$galleries是陣列，要用回圈解析 
    ?>
    <div class="display">
        <!-- <a href="<?php #echo $g; ?>" target="_blank"><?php #echo $g; ?></a> -->
        <img src="<?php echo $g; ?>" width="200">
        <form action="delete.php" method="post">
            <input type="hidden" name="g" value="<?php echo $g; ?>">
            <input type="submit" value="刪除" onclick="return confirm('確認刪除？')" class="btn btn-danger">
            <input type="color" value="color">
        </form>

    </div>

    <?php } ?>
</div>

<?php
    include("template/footer.php");
?>