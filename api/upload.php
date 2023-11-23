<?php

echo $_POST['desc'];
echo "<br>";
if(!empty($_FILES['img']['tmp_name'])){
    echo $_FILES['img']['tmp_name'];
    echo "<br>";
    echo $_FILES['img']['name'];
    echo "<br>";
    echo $_FILES['img']['type'];
    echo "<br>";
    echo $_FILES['img']['size'];
        // 將檔案名稱按照「.」進行分割，取得檔案的副檔名
    $tmp=explode('.',$_FILES['img']['name']);
    $subname=end($tmp);
    // 產生一個新的檔案名稱，結合日期、時間和隨機數
    $filename=date("YmdHis").rand(10000,99999).".".$subname;

     // 上傳成功後，在此返回圖片路徑
     $imagePath = "../imgs/".$filename;
     // 圖片的路徑，這是將要移動到的位置

     // 將上傳的檔案移動到指定位置
    move_uploaded_file($_FILES["img"]["tmp_name"],$imagePath);

    




    
    header("location:../upload.php?img=".$filename);
    
}else{
    header("location:../upload.php?err=上傳失敗");
    // echo "上傳失敗";
}
