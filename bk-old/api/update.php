<?php

include_once('../db.php');





if(!is_null($_POST['id'])){
    $id=$_POST['id'];
    $file=find('files',$id);
    echo "1";
}else{
    echo "0";
    exit();
}


if(!empty($_FILES['img']['tmp_name'])){
    $imagePath = "../imgs/".$file['name'];
    move_uploaded_file($_FILES["img"]["tmp_name"],$imagePath);
    
}

if(!empty($_POST['name']) && $_POST['name']!=$file['name']){

    $imagePath = "../imgs/".$file['name'];
    $file['name']=$_POST['name'];
    $subname=end(explode(".",$file['name']));
    $tmp=explode(".",$file['name']);
    $tmp[count($tmp)-1]=$subname;
    if(!empty($_FILES['img']['tmp_name'])){
        $subname=end(explode(".",$_FILES['img']['name']));
        $tmp=explode(".",$file['name']);
        $tmp[count($tmp)-1]=$subname;
    }
    $file['name']=join(".",$tmp);
   






    $newPath="../imgs/".$file['name'];

    rename($imagePath,$newPath);

}

$file['type']=$_FILES["img"]["type"];
$file['size']=$_FILES["img"]["size"];
// 


update('files',$id,$file);
header("location:../manage.php");


// if(!empty($_FILES['img']['tmp_name'])){
    // echo "87";

    // $subname=end($tmp);

    // if(!is_null($_POST['name']) && $_POST['name']!=$file['name']){

    //     $imagePath = "../imgs/".$file['name'];

    //     $file['name']=$_POST['name'].".".$subname;

    //     rename($file['name'],$imagePath);


    // }
  


    

    // move_uploaded_file($_FILES["img"]["tmp_name"],$imagePath);

    

//     $file['type']=$_FILES["img"]["type"];
//     $file['size']=$_FILES["img"]["size"];
// // 


//     update('files',$id,$file);




    
    // header("location:../upload.php?img=".$filename);
    // header("location:../manage.php");
    
// }else{

    // echo "87";




    
    // header("location:../upload.php?err=上傳失敗");
    // echo "上傳失敗";
// }
