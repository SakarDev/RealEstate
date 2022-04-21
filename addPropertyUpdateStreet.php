<?php 

require_once('includes/conn.php');
 
if(isset($_POST["city_id"]) && !empty($_POST["city_id"])){ 
    // Fetch street data based on the specific city 
    $query = "SELECT * FROM street WHERE city_id_streetfk = ".$_POST['city_id']." ORDER BY street_name DESC"; 
    $result = $conn->query($query); 
     
    // Generate HTML of street select box 
    if($result->num_rows > 0){ 
        echo '<option selected disabled value="">Choose...</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['street_id'].'">'.$row['street_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">No Street available</option>'; 
    } 
}
?>