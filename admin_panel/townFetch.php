<?php 

require_once('includes/conn.php');


$output= array();
$sql = "SELECT town_id, town_name, city_name FROM town JOIN city ON town.city_id_townfk=city.city_id ";
$totalResult = $conn->query($sql);
$total_num_rows = $totalResult->num_rows;


$columns = array(
	0 => 'town_id',
	1 => 'town_name',
	2 => 'city_name',
);

if(isset($_POST['search']['value'])){
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE town_name like '%".$search_value."%'";
    $sql .= " OR city_name like '%".$search_value."%'";

}

if(isset($_POST['order'])){
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}else{
	$sql .= " ORDER BY town_id desc";
}

if($_POST['length'] != -1){
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$result = $conn->query($sql);
$num_rows = $result->num_rows;
$data = array();
while($row = $result->fetch_assoc()){
	$sub_array = array();
	$sub_array[] = $row['town_id'];
	$sub_array[] = $row['town_name'];
	$sub_array[] = $row['city_name'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['town_id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['town_id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$num_rows ,
	'recordsFiltered'=>   $total_num_rows,
	'data'=>$data,
);
echo json_encode($output);
