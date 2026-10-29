<?php

//Variabelen vullen
$attractie = $_POST['attractie'] ?? '';
$melder = $_POST['melder'] ?? '';
$overig = $_POST['overig'] ?? '';


if(is_numeric($_POST['capaciteit'])){
    $capaciteit = $_POST['capaciteit'];
}

else {
    $capaciteit = 0;
}

$type = $_POST['melder'] ?? '';

$allowed_types = [
'achtbaan',
'draaiend',
'water',
'overige',
];

if(in_array($_POST['type'],$allowed_types, true)) {
    $type = $_POST['type'];
}
else {
    $type = '';
}

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query = "

        INSERT INTO meldingen
            (melder, capaciteit, attractie, type, overige_info)
        VALUES
            (:melder, :capaciteit, :attractie, :type, :extra)
    ";
//3. Prepare
$statement = $conn->prepare($query);

//4. Execute

$statement->execute([
    ":melder" => $melder,
    ":capaciteit" => $capaciteit,
    ":attractie" => $attractie,
    ":type" => $type,
    ":extra" => $overig
]);

header('Location:'. $base_url .'/resources/views/meldingen/index.php?msg=Je melding is opgeslagen');
exit;