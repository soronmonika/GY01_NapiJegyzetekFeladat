<?php

include_once(__DIR__ . "/../model/Repositories/FeladatRepo.php");


$ID = $_POST["ID"];
$Kesz = $_POST["Kesz"];

FeladatRepo::updateKesz($ID, (int)$Kesz);

echo json_encode(["status" => "ok"]);
