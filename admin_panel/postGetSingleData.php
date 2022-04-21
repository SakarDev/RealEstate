<?php
require_once('includes/conn.php');

if (isset($_POST['property_id']) && !empty($_POST['property_id'])) {
    $sql = "SELECT * FROM property JOIN city ON property.city_id_propertyfk=city.city_id 
    JOIN street ON property.street_id_propertyfk=street.street_id 
    JOIN property_type ON property.property_type_id_propertyfk = property_type.property_type_id
    and property_id =" . $_POST['property_id'];
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

echo "<style>
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
</style>". 
'<div class="container mt-1">
<form enctype="multipart/form-data" id="addProperty-form" action="addPropertyFormProcess.php" method="POST" >

    
    <div id="property_title-group" class="col-md-12 form-group">
        <label class="form-label"><b>Property title: </b>'.$row['property_title'].
        '</label>
        </div>
        <div id="property_type-group" class="col-md-12 form-group">
            <label class="form-label"><b> Property type: </b>'.$row['property_type_name'].
            ' </label>
            </div>
            <div id="transaction_type-group" class="col-md-12 form-group">
                <label class="form-label"><b> Transaction type:</b>'.$row['transaction_type']. 
                '            </label>
                </div>
                <div id="city-group" class="col-md-12 form-group">
                    <label class="form-label"><b> City:</b>'.$row['city_name'].
                    '</label>
                    </div>';
                    if ($row['town_id_propertyfk'] != null) {
                        $town_sql = "select town_name from property JOIN town ON property.town_id_propertyfk=town.town_id and town_id=" . $row['town_id_propertyfk'];
                        $town_res = $conn->query($town_sql);
                        $town_row = $town_res->fetch_assoc();
                        echo '<div id="town-group" class="col-md-12 form-group">
                        <label class="form-label"><b> Town: </b>'.$town_row['town_name']. 
                        '  </label>
                        </div>';
                    }
                    
                        echo '
                        <div id="street-group" class="col-md-12 form-group">
                        <label class="form-label"><b> Street: </b>'.$row['street_name'].
                        '            </label>
                        </div>
                
                        <div id="area-group" class="col-md-12 form-group">
                            <label class="form-label"><b> Area in sq ft: </b>'.$row['area']. 
                            '</label>
                            </div>
                            <div id="price-group" class="col-md-12 form-group">
                                <label class="form-label"><b> Price: </b>'.$row['price']. 
                                '    </label>
                                </div>
                                <div id="no_bedrooms-group" class="col-md-12 form-group">
                                    <label class="form-label"><b> Number of bedrooms: </b>'.$row['no_bedrooms']. 
                                    '   </label>
                                    </div>
                                    <div id="no_bathrooms-group" class="col-md-12 form-group">
                                        <label class="form-label"><b> Number of bathrooms: </b>'.$row['no_bathrooms']. 
                                        '   </label>
                                        </div>
                                        <div id="no_garages-group" class="col-md-12 form-group">
                                            <label class="form-label"><b> Number of garages: </b>'. $row['no_garages'].
                                            '    </label>
                                            </div>
                                            <div id="no_floors-group" class="col-md-12 form-group">
                                                <label class="form-label"><b> Number of floors: </b>'.$row['no_floors'].
                            '     </label>
                            </div>
                            <div id="telephone-group" class="col-md-12 form-group">
                                <label class="form-label"><b> Phone Number: </b>
                    
                                    <a href="tel:+'.$row['property_telephone']. '">
                                    <i class="fa fa-phone"></i>'.$row['property_telephone'].
                            '        </a>
                            </label>
                        </div>
                        <div id="description-group" class="col-md-12 form-group">
                            <label class="form-label"><b> Discription: </b>'.$row['description'].
                            '   </label>
                            </div>
                            <div id="description-group" class="col-md-12 form-group">
                                <label class="form-label"><b> Publishing time: </b>'.$row['time']. 
                                '</label>
                                </div>
                            </form>
                        </div>';
                                    

?>


        
            