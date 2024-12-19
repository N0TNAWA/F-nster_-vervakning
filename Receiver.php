<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $windowState = isset($_POST['sensor']) ? $_POST['sensor'] : null;
    $pinID = isset($_POST['pin']) ? $_POST['pin'] : null;

    if ($windowState !== null && $pinID !== null) {

        if ($windowState == '1') {
            echo "The window is open | $pinID";
            require ('sqlHandler.php');

            changeState($pinID, 1);

            //$windowArray = findWindow($pinID);

            //for ($i = 0; $i < count($windowArray); $i++) {
            //    print_r($windowArray[$i]);
            //}
        } else {
            echo "The window is closed | $pinID";
            require ('sqlHandler.php');

            changeState($pinID, 0);
        }
    } else {
        echo "Error: Missing window state.";
    }
} else {
    echo "Error: This script only handles POST requests.";
}
?>