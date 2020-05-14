<?php
require_once '../database/dbase.php';
$query=$db_con->prepare("SELECT * FROM products WHERE id IN 
    (SELECT id FROM (SELECT id FROM products ORDER BY -LOG(1-RAND())/price LIMIT 30) t)");
$query->execute();
$arr = array();
if($query->rowCount() > 0) {
    while($row = $query->fetchObject()) {
        $arr[] = $row;
    }
}
echo $json_response = json_encode($arr);
?>

