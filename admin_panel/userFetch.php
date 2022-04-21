<?php 

require_once('includes/conn.php');


$output= array();
$sql = "SELECT * FROM user ";
$totalResult = $conn->query($sql);
$total_num_rows = $totalResult->num_rows;


$columns = array(
	0 => 'user_id',
	1 => 'firstName',
	2 => 'lastName',
	3 => 'email',
	4 => 'telephone',
	5 => 'role',
);

if(isset($_POST['search']['value'])){
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE firstName like '%".$search_value."%'";
    $sql .= " OR lastName like '%".$search_value."%'";
    $sql .= " OR email like '%".$search_value."%'";
	$sql .= " OR telephone like '%".$search_value."%'";
	$sql .= " OR role like '%".$search_value."%'";
}

if(isset($_POST['order'])){
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}else{
	$sql .= " ORDER BY user_id desc";
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
	$sub_array[] = $row['user_id'];
	$sub_array[] = $row['firstName'];
	$sub_array[] = $row['lastName'];
    $sub_array[] = $row['email'];
	$sub_array[] = $row['telephone'];
	$sub_array[] = $row['role'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['user_id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$num_rows ,
	'recordsFiltered'=>   $total_num_rows,
	'data'=>$data,
);
echo json_encode($output);
