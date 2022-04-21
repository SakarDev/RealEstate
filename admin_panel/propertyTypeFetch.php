<?php 

require_once('includes/conn.php');


$output= array();
$sql = "SELECT * FROM property_type ";
$totalResult = $conn->query($sql);
$total_num_rows = $totalResult->num_rows;


$columns = array(
	0 => 'property_type_id',
	1 => 'property_type_name',
);

if(isset($_POST['search']['value'])){
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE property_type_name like '%".$search_value."%'";
}

if(isset($_POST['order'])){
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}else{
	$sql .= " ORDER BY property_type_id desc";
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
	$sub_array[] = $row['property_type_id'];
	$sub_array[] = $row['property_type_name'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['property_type_id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['property_type_id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$num_rows ,
	'recordsFiltered'=>   $total_num_rows,
	'data'=>$data,
);
echo json_encode($output);
