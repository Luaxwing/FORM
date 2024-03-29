<?php
/**
 * 1.建立資料庫及資料表來儲存檔案資訊
 * 2.建立上傳表單頁面
 * 3.取得檔案資訊並寫入資料表
 * 4.製作檔案管理功能頁面
 */

include_once('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案管理功能</title>
    <!-- BS5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<h1 class="header">檔案管理練習</h1>

<!----建立上傳檔案表單及相關的檔案資訊存入資料表機制----->

<!-- <h3><a href="upload.php">上傳檔案</a></h3> -->

<form action="./api/upload.php" method="post" enctype="multipart/form-data">

<input type="file" name="img" id="" >
<input type="text" name="desc" id="" value="" placeholder="請輸入檔案描述">
<!-- encode_type -->
<input type="submit" name="" value="上傳">

</form>
<br><br><hr>




<!----透過資料表來顯示檔案的資訊，並可對檔案執行更新或刪除的工作----->

<?php
$files=all('files');

?>
<div class="col-8 mx-auto">
    <table class='table table-success'>
        <tr>
            <td>id</td>
            <td>檔名</td>
            <td>類型</td>
            <td>大小</td>
            <td>描述</td>
            <td>上傳時間</td>
            <td>修改</td>
        </tr>
    <?php
    foreach($files as $file){
        // $serchType=substr($file['type'],0,5);
        $serchType=$file['type'];
        $typeName=strstr($serchType ,'/',true);
        // echo $serchType;
        // echo $typeName;
        switch($typeName){
            case "image":
                inputType($file,'image');
                // image_Type($file);  
    break;
         default:
                inputType($file,'');
                // echo $serchType;
                // file_Type($file);
         break;
        }
    }


    ?>    
    </table>
</div>


</body>
</html>


