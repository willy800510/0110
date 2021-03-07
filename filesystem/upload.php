<?php
    // var_dump($_FILES["gallery"]);
    
    // 第一種寫法
    // echo $_FILES["gallery"]["name"];
    // echo "<br>";
    // echo $_FILES["gallery"]["type"];
    // echo "<br>";
    // echo $_FILES["gallery"]["tmp_name"];
    // echo "<br>";
    // echo $_FILES["gallery"]["error"];
    // echo "<br>";
    // echo $_FILES["gallery"]["size"];
    // echo "<br>";
    
    // 第二種寫法
    
    // extract($_FILES);
    // 上述會得到一個2維陣列（陣列裡有陣列）
    // 所以在取得陣列時可以直接解開第一層

    extract($_FILES["gallery"]);
    // echo 'Test';

    // 以判斷式，判斷檔名
    // switch($type) {
    //     case 'image/jpeg':
    //         $gallery_name = md5(uniqid()).".jpg";
    //         break;
    //     case 'image/gif':
    //         $gallery_name = md5(uniqid()).".gif";
    //         break;
    //     case 'image/png':
    //         $gallery_name = md5(uniqid()).".png";
    //         break;
    //     default:
    //         header("location:index.php?error=1");
    // }
    
    // but在程式中最好減少判斷式 
    // 取得副檔名，直接執行改名，減少判斷
    $ext = strtolower(pathinfo($name,PATHINFO_EXTENSION));
    // ext是代表副檔名
    // pathinfo() 可以取得 完整名稱，檔名，副檔名，資料夾名稱
    // strtolower 強制轉小寫 strtouppers
    if($ext !="jpg" && $ext !="jpeg" && $ext !="gif" && $ext !="png"){
        // && and || or
        header("location:index.php?error=1");
        return;
        // return 回傳/終止
    }

    $sql = "INSERT INTO galleries (gallery_name, name, created_at)VALUES(?,?,?)";
    $stmt = $pdo ->prepare($sql);

    $gallery_name = md5(uniqid()).".".$ext;
    // 常見加密方式：time(),uniqid(),md5(),sha1()
    $target = "images/".$gallery_name;
    // echo $target;

    // 若無資料夾 建立資料夾
    if(!is_dir("images")){
        // ！代表否定運算子 is_dir 檢查指定文件是否是目錄
        mkdir("images");
    }


    if($error == 0){
        if(move_uploaded_file($tmp_name,$target)){
            // move_uploaded_file：移動已經暫存的檔案（暫存的位置,實際放的位置）
            echo "上傳成功";
            $stmt->execute([$gallery_name,$name,NOW()]);
            header("Refresh:1;url=index.php");
            // 1s後 重新回到要導向的頁面
        }else{
            echo "上傳失敗";
        }
    }else{
        echo "上傳錯誤";
    }
?>