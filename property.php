<?php

$page='';
require_once('includes/conn.php');

if(isset($_GET['property_id']) && !empty($_GET['property_id'])){
    $sql = "SELECT * FROM property JOIN city ON property.city_id_propertyfk=city.city_id 
    JOIN street ON property.street_id_propertyfk=street.street_id 
    JOIN property_type ON property.property_type_id_propertyfk = property_type.property_type_id
    and property_id =".$_GET['property_id'];
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row['town_id_propertyfk'] != null){
        $town_sql = "select town_name from property JOIN town ON property.town_id_propertyfk=town.town_id and town_id=".$row['town_id_propertyfk'];
        $town_res = $conn->query($town_sql);
        $town_row = $town_res->fetch_assoc();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Property</title>
    <link rel="icon" id="favicon" href="assets/icons/logo.ico" />

    <style>
        .cards {
            margin: 0 !important;
            margin-bottom: 30px !important;
        }

        #telephone-group a {
            text-decoration: none;
        }

        #telephone-group i {
            margin: 0 5px;
        }
    </style>


</head>

<body>

    <div class="navigationOnly">
        <?php require_once('includes/header.php'); ?>
    </div>


    <div class="container p-5">
        <form enctype="multipart/form-data" id="addProperty-form" action="addPropertyFormProcess.php" method="POST"
            class="row g-3 col-xl-8 col-lg-10 col-12  mx-auto border p-3">

            <!-- property image	 -->
            <div id="property_image-group" class="cards col-12"
                <?php echo "style=background-image:url(".$row['property_image'].");"; ?>>
            </div>
            <br>

            <!-- property title -->
            <div id="property_title-group" class="col-md-6 form-group">
                <label class="form-label"><b>Property title:</b>
                    <?php echo $row['property_title']; ?>
                </label>
            </div>

            <!-- select box  property_type  -->
            <div id="property_type-group" class="col-md-6 form-group">
                <label class="form-label"><b> Property type: </b>
                    <?php echo $row['property_type_name']; ?>
                </label>

            </div>

            <!-- transaction type -->
            <div id="transaction_type-group" class="col-md-6 form-group">
                <label class="form-label"><b> Transaction type:</b>
                    <?php echo $row['transaction_type']; ?>
                </label>
            </div>

            <!-- select box  city -->
            <div id="city-group" class="col-md-6 form-group">
                <label class="form-label"><b> City:</b>
                    <?php echo $row['city_name']; ?>
                </label>
            </div>

            <?php
            if($row['town_id_propertyfk'] != null){
                $town_sql = "select town_name from property JOIN town ON property.town_id_propertyfk=town.town_id and town_id=".$row['town_id_propertyfk'];
                $town_res = $conn->query($town_sql);
                $town_row = $town_res->fetch_assoc();
            ?>
            <!-- select box town  -->
            <div id="town-group" class="col-md-6 form-group">
                <label class="form-label"><b> Town: </b>
                    <?php echo $town_row['town_name']; ?>
                </label>
            </div>
            <?php } ?>

            <!-- select box  street -->
            <div id="street-group" class="col-md-6 form-group">
                <label class="form-label"><b> Street: </b>
                    <?php echo $row['street_name']; ?>
                </label>
            </div>

            <!-- area -->
            <div id="area-group" class="col-md-6 form-group">
                <label class="form-label"><b> Area in sq ft: </b>
                    <?php echo $row['area']; ?>
                </label>
            </div>
            <!-- price -->
            <div id="price-group" class="col-md-6 form-group">
                <label class="form-label"><b> Price: </b>
                    <?php echo $row['price']; ?>
                </label>
            </div>
            <!-- number of bedrooms -->
            <div id="no_bedrooms-group" class="col-md-6 form-group">
                <label class="form-label"><b> Number of bedrooms: </b>
                    <?php echo $row['no_bedrooms']; ?>
                </label>
            </div>
            <!-- number of bathrooms -->
            <div id="no_bathrooms-group" class="col-md-6 form-group">
                <label class="form-label"><b> Number of bathrooms: </b>
                    <?php echo $row['no_bathrooms']; ?>
                </label>
            </div>
            <!-- number of garages -->
            <div id="no_garages-group" class="col-md-6 form-group">
                <label class="form-label"><b> Number of garages: </b>
                    <?php echo $row['no_garages']; ?>
                </label>
            </div>
            <!-- number of floors -->
            <div id="no_floors-group" class="col-md-6 form-group">
                <label class="form-label"><b> Number of floors: </b>
                    <?php echo $row['no_floors']; ?>
                </label>
            </div>
            <!-- property telephone -->
            <div id="telephone-group" class="col-md-6 form-group">
                <label class="form-label"><b> Phone Number: </b>

                    <a href="tel:+<?php echo $row['property_telephone'];?>">
                        <i class="fa fa-phone"></i><?php echo $row['property_telephone']; ?></a>
                </label>
            </div>
            <!-- description -->
            <div id="description-group" class="col-md-6 form-group">
                <label class="form-label"><b> Discription: </b>
                    <?php echo $row['description']; ?>
                </label>
            </div>
            <!-- description -->
            <div id="time-group" class="col-md-6 form-group">
                <label class="form-label"><b> Publishing time: </b>
                    <?php echo $row['time']; ?>
                </label>
            </div>
        </form>
    </div>



    <?php require_once('includes/footer.php'); ?>




</body>

</html>