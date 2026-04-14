<?php

include_once("../model/Repositories/FeladatRepo.php");
header("Content-Type: application/json; charset=utf-8");

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "GET") {
  $lista = FeladatRepo::getFeladatok();

  $adatok = [];
  foreach ($lista as $b) {
    $adatok[] = [
      "ID" => $b->getID(),
      "Nev" => $b->getNev(),
      "Kesz" => $b->getKesz(),
      "Datum" => $b->getDatum(),
    ];
  }
  echo json_encode($adatok);
  exit;
}

if ($method == "PUT") {
  parse_str(file_get_contents("php://input"), $putData);

  $ID = trim($putData["ID"] ?? "");
  $Nev = trim($putData["Nev"] ?? "");
  $Datum = trim($putData["Datum"] ?? "");

  if ($ID == "") {
    http_response_code(400);
    echo json_encode(["error" => "Hiányzó ID"]);
    exit;
  }

  FeladatRepo::updateFeladatok($ID, $Nev, $Datum);
  echo json_encode(["ok" => true]);
  exit;
}

http_response_code(405);
echo json_encode(["error" => "Nem támogatott metódus!"]);
