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
