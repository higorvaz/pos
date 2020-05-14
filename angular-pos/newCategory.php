<?php
include 'database/dbase.php';
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $bbl = $db_con->prepare("INSERT INTO cat (cat_name,date) VALUES(:aaa,:bbb)");
        if ($bbl->execute(array(':aaa' => $_POST['categName'],':bbb'=>date("Y-m-d h:i:s")))){
           echo 'success';
        }else{
echo 'No Inserted';
        }exit();
}else{echo "No Direct Access.";}
exit();