<?php
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */
include_once("db.php");
$id=$_GET['id'];
$file=find('files',$id);

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
 <h1 class="header">檔案更新練習</h1>
 <!----建立你的表單及設定編碼----->

<form action="./api/update.php" method="post" enctype="multipart/form-data">
<label for="img">檔案</label>
<input type="file" name="img" id="" >
<label for="name">名稱</label>
<input type="text" name="name" id="" value="<?=$file['name']?>">
<label for="desc">描述</label>
<input type="text" name="desc" id="" value="<?=$file['desc']?>" >
<!-- encode_type -->
<input type="hidden" name="id" value="<?=$id?>">
<input type="submit" name="" value="更新">

</form>

<br><hr><br>



<div class="col-8 mx-auto">
    <table class='table table-success'>
        <tr>
            <td>id</td>
            <td>檔名</td>
            <td>類型</td>
            <td>大小</td>
            <td>描述</td>
            <td>上傳時間</td>
        </tr>






<!----建立一個連結來查看上傳後的圖檔---->  

<tr>
    <td><?=$file['id']?></td>
    <td>
    <?php
$serchType=$file['type'];
$typeName=strstr($serchType ,'/',true);
switch($typeName){
    case "image":
        image_Type($file);         
break;
 default:
 file_Type($file);                
 break;
}
?>
    </td>
    <td><?=$file['type']?></td>
    <td><?=$file['size']?></td>
    <td><?=$file['desc']?></td>
    <td><?=$file['create_at']?></td>
</tr>

    </table>
</div>






</body>
</html>