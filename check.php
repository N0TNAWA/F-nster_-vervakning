<?php
require ('db.php');
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
header("Connection: keep-alive");

while(true) {

    global $con;
    $sql = "SELECT * FROM windows";
    if ($stmt = $con->prepare($sql)) {
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                $array = array('pinId' => $row['pinId'], 'sensorState' => $row['sensorState']);

                echo "data: " . json_encode($array) . "\n\n";

                ob_flush();
                flush();
            }

        } else {

            echo "No records found.";

        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }

    sleep(1);

}

?>