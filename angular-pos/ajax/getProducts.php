<?php 
require_once '../database/dbase.php';
$data = json_decode(file_get_contents("php://input"));
$query=$db_con->prepare("select * from products WHERE cat_id='".$data->cat_id."' order by name,id ASC ");
$query->execute();
$arr = array();
if($query->rowCount() > 0) {
	while($row = $query->fetchObject()) {
		$arr[] = $row;	
	}
}
echo $json_response = json_encode($arr);
?>

