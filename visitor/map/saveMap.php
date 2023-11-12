<?php 

require '../config/database.php';

//save map
if($_POST) {
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $locationID = $_POST['locationID'];

    //check if the user already regsitered a location
    $sql = mysqli_query($connection, "SELECT * FROM location_tab WHERE ID = '$locationID'");
    $row = mysqli_fetch_assoc($sql);

    if($row != 0) {
       $query = ('UPDATE location_tab SET locationLatitude = ?, locationLongitude = ? WHERE ID = ?');
         $stmt = $connection->prepare($query);
            $stmt->bind_param('sss', $lat, $lng, $locationID);
            $stmt->execute();
            $stmt->close();
            
    } else {
        $query = ('INSERT INTO location_tab (locationLatitude, locationLongitude, ID) VALUES (?, ?, ?)');
        $stmt = $connection->prepare($query);
        $stmt->bind_param('sss', $lat, $lng, $locationID);
        $stmt->execute();
        $stmt->close();
        $locationID = $connection->insert_id;

        //save the location to the user
        $query = ('UPDATE users SET location = ? WHERE id = ?');
        $stmt = $connection->prepare($query);
        $stmt->bind_param('ss', $locationID, $_SESSION['user-id']);
        $stmt->execute();
        $stmt->close();

    }
    header('location: index.php');
}
