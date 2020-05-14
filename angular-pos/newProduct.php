<?php
include 'database/dbase.php';
if(is_numeric($_POST["catg"])){
    $bbl = $db_con->prepare("INSERT INTO products (cat_id,name,price,datex) VALUES(:a,:b,:c,:d)");
    if ($bbl->execute(array(':a' => $_POST['catg'],':b' => $_POST['prdName'],':c'=>$_POST['price'],':d'=>date("Y-m-d h:i:s")))){
        echo 'successfull Inserted';
    }else{
        echo 'No Inserted';
    }exit();
}else{echo "Please Select Category.";}
exit();