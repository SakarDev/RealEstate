<?php 

require_once('includes/conn.php');





$output= array();
$sql = "SELECT * FROM property JOIN city ON property.city_id_propertyfk=city.city_id 
    JOIN user ON property.user_id_propertyfk =user.user_id ";
$totalResult = $conn->query($sql);
$total_num_rows = $totalResult->num_rows;


$columns = array(
	0 => 'property_id',
	1 => 'property_title',
	2 => 'email',
	3 => 'city_name',
	4 => 'time',
);

if(isset($_POST['search']['value'])){
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE property_title like '%".$search_value."%'";
    $sql .= " OR email like '%".$search_value."%'";
    $sql .= " OR city_name like '%".$search_value."%'";
	$sql .= " OR time like '%".$search_value."%'";
}

if(isset($_POST['order'])){
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}else{
	$sql .= " ORDER BY property_id desc";
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
	$sub_array[] = $row['property_id'];
	$sub_array[] = $row['property_title'];
	$sub_array[] = $row['email'];
    $sub_array[] = $row['city_name'];
	$sub_array[] = $row['time'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['property_id'].'"  class="btn btn-info btn-sm viewbtn" >View</a>  <a href="javascript:void();" data-id="'.$row['property_id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$num_rows ,
	'recordsFiltered'=>   $total_num_rows,
	'data'=>$data,
);
echo json_encode($output);
