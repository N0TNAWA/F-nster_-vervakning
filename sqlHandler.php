<?php
require ('db.php');

function newWindow($id, $floor, $classroom, $time, $pinId, $windowState) {
    $window = array();
    $window["ID"] = $id;
    $window["floor"] = $floor;
    $window["classroom"] = $classroom;
    $window["time"] = $time;
    $window["pinId"] = $pinId;
    $window["sensorState"] = $windowState;
    return $window;
}

function changeState($pinID, $id) {
    global $con;
    $sql = "SELECT * FROM windows WHERE pinId = $pinID";
    if ($stmt = $con->prepare($sql)) {
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $sql = "UPDATE windows SET sensorState = '$id' WHERE pinId = $pinID";
            if($stmt = $con->prepare($sql)) {
                $stmt->execute();
                echo "stateChange&$id";
            }
        } else {

            echo "No records found.";

        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
}

function findWindow($pinID) {
    global $con;
    $window = [];
    $sql = "SELECT * FROM windows WHERE pinId = $pinID";
    if ($stmt = $con->prepare($sql)) {
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $window[] = newWindow($row["ID"], $row["Floor"], $row["Classroom"], $row["Time"], $row["pinId"], $row["sensorState"]);
            }

        } else {

            echo "No records found.";

        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
    $con->close();
    return $window;
}

?>