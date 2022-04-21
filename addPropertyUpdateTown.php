<?php 

require_once('includes/conn.php');
 
if(isset($_POST["city_id"]) && !empty($_POST["city_id"])){ 
    // Fetch town data based on the specific city 
    $query = "SELECT * FROM town WHERE city_id_townfk = ".$_POST['city_id']." ORDER BY town_name DESC"; 
    $result = $conn->query($query); 
     
    // Generate HTML of town select box 
    if($result->num_rows > 0){ 
        echo '<option selected disabled value="">Choose...</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['town_id'].'">'.$row['town_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">No town available</option>'; 
    } 
}
?>