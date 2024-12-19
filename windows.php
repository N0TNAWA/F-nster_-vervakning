<?php
require('db.php');

$sql = "SELECT ID, Floor, Classroom, Time, pinId, sensorState FROM windows";
$result = mysqli_query($con, $sql);

$items = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = [
            "ID" => $row["ID"],
            "Floor" => $row["Floor"],
            "Classroom" => $row["Classroom"],
            "Time" => $row["Time"],
            "pinId" => $row["pinId"],
            "sensorState" => $row["sensorState"]
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($items);
} else {
    header('Content-Type: application/json');
    echo json_encode(["message" => "No items found."]);
}

mysqli_close($con);
?>