<?php
require_once('includes/conn.php');

if(isset($_GET['getAllData'])){

    $sql = "SELECT * FROM property JOIN city ON property.city_id_propertyfk=city.city_id JOIN street ON property.street_id_propertyfk=street.street_id";

    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            echo "
            
            <div class='cards' style='background-image:url(".$row['property_image'].");'>
            <a href='property.php?property_id=".$row['property_id']."'>
            <div class='card-overlay'>
            <div class='cards-text'>
            <div class='cards-title'>
            <p id='title'>
            ".$row['property_title'].
            "
            </p>
            <div class='line'></div>
            <p class='subtitle'>
            ";

            if($row['town_id_propertyfk'] != null){
                $town_sql = "select town_name from property JOIN town ON property.town_id_propertyfk=town.town_id and town_id=".$row['town_id_propertyfk'];
                $town_res = $conn->query($town_sql);
                $town_row = $town_res->fetch_assoc();
                echo $row['city_name'] . ", " . $town_row['town_name'] . ", " . $row['street_name'];
            }else{
                echo $row['city_name'] . ", " . $row['street_name'];
            }

            echo "
            </p>
            </div>
            <p id='price'>$
            ".$row['price'].
            "
            </p>
            <div class='desc'>
            <p id='br'><i class='fa fa-bed'></i>
            ".$row['no_bedrooms'].
            " Br</p>
            <p id='ba'><i class='fa fa-shower'></i>".
            $row['no_bathrooms'].
            " Ba</p>
            <p id='ft'><i class='fa fa-th-large'></i>".
            $row['area'].
            " sq.Ft
            </p>
            </div>
            </div>
            </div>
            </a>
            </div>
            ";
        }
    }
}else if(isset($_POST['getSearchedData'])){
    $sql = "SELECT * FROM property JOIN city ON property.city_id_propertyfk=city.city_id JOIN street ON property.street_id_propertyfk=street.street_id ";

    if(isset($_POST['transaction_type']) && !empty($_POST['transaction_type'])){
        $sql .= " WHERE transaction_type ="."'".$_POST['transaction_type']."'";
    }

    if(isset($_POST['property_type']) && !empty($_POST['property_type'])){
        $sql .= " AND property_type_id_propertyfk =".$_POST['property_type'];
    }

    if(isset($_POST['city']) && !empty($_POST['city'])){
        $sql .= " AND city_id_propertyfk  =".$_POST['city'];
    }

    if(isset($_POST['street']) && !empty($_POST['street'])){
        $sql .= " AND street_id_propertyfk  =".$_POST['street'];
    }

    $sql .= " ORDER BY property_id DESC ";

    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='cards' onclick='openCardPage(".$row['property_id'].")' style='background-image:url(".$row['property_image'].");'>
            <a href='property.php?property_id=".$row['property_id']."'>
            <div class='card-overlay'>
            <div class='cards-text'>
            <div class='cards-title'>
            <p id='title'>
            ".$row['property_title'].
            "
            </p>
            <div class='line'></div>
            <p class='subtitle'>
            ";

            if($row['town_id_propertyfk'] != null){
                $town_sql = "select town_name from property JOIN town ON property.town_id_propertyfk=town.town_id and town_id=".$row['town_id_propertyfk'];
                $town_res = $conn->query($town_sql);
                $town_row = $town_res->fetch_assoc();
                echo $row['city_name'] . ", " . $town_row['town_name'] . ", " . $row['street_name'];
            }else{
                echo $row['city_name'] . ", " . $row['street_name'];
            }

            echo "
            </p>
            </div>
            <p id='price'>$
            ".$row['price'].
            "
            </p>
            <div class='desc'>
            <p id='br'><i class='fa fa-bed'></i>
            ".$row['no_bedrooms'].
            " Br</p>
            <p id='ba'><i class='fa fa-shower'></i>".
            $row['no_bathrooms'].
            " Ba</p>
            <p id='ft'><i class='fa fa-th-large'></i>".
            $row['area'].
            " sq.Ft
            </p>
            </div>
            </div>
            </div>
            </a>
            </div>
            ";
        }
    }else{
        echo '<div class="alert alert-warning">No result found!</div>';
    }

}


?>