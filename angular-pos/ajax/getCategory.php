<?php
require_once '../database/dbase.php';
$query=$db_con->prepare("select * from cat order by cat_name,cat_id ASC ");
$query->execute();
$arr = array();
if($query->rowCount() > 0) {
    while($row = $query->fetchObject()) {
        $arr[] = $row;
    }
}
echo $json_response = json_encode($arr);
?>