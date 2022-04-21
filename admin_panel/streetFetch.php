<?php 

require_once('includes/conn.php');


$output= array();
$sql = "SELECT street_id, street_name, city_name FROM street JOIN city ON street.city_id_streetfk=city.city_id ";
$totalResult = $conn->query($sql);
$total_num_rows = $totalResult->num_rows;


$columns = array(
	0 => 'street_id',
	1 => 'street_name',
	2 => 'city_name',
);

if(isset($_POST['search']['value'])){
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE street_name like '%".$search_value."%'";
    $sql .= " OR city_name like '%".$search_value."%'";

}

if(isset($_POST['order'])){
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}else{
	$sql .= " ORDER BY street_id desc";
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
	$sub_array[] = $row['street_id'];
	$sub_array[] = $row['street_name'];
	$sub_array[] = $row['city_name'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['street_id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['street_id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$num_rows ,
	'recordsFiltered'=>   $total_num_rows,
	'data'=>$data,
);
echo json_encode($output);
