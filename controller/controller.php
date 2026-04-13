<?php

function betoltes($class)
{
  $path1 = __DIR__ . "/../model/" . $class . ".php";
  $path2 = __DIR__ . "/../model/Repositories/" . $class . ".php";

  if (file_exists($path1)) {
    include_once($path1);
    return;
  }
  if (file_exists($path2)) {
    include_once($path2);
    return;
  }
}
spl_autoload_register("betoltes");


function View(string $error = "", string $success = ""): void
{
  $ErrorUzenet = $error;
  $SuccessUzenet = $success;


  include_once(__DIR__ . "/../view/Fooldal.php");
}

function post(string $kulcs, string $default = ""): string
{
  return array_key_exists($kulcs, $_POST) ? trim((string)$_POST[$kulcs]) : $default;
}


function Mentes(): void
{
  $Datum = post("datum");
  if ($Datum == "") {
    View("A dátum megadása kötelező!");
    return;
  }

  $Nev = post("name");
  if ($Nev == "") {
    View("Név megadása kötelező!");
    return;
  }

  $Kesz = 0;

  $ID = uniqid("F_");
  $feladat = new Feladat($ID, $Nev, $Kesz, $Datum);
  FeladatRepo::createFeladat($feladat);
  header("Location: /KCS_202507/03_GYAKORLAS_VIZSGÁRA/VizsgaFeladatGyakorlás/GY01/view/index.php?success=1");
  exit;
}

function main(): void
{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
      $Mentes = post("mentes");
      if ($Mentes == "mentes") {
        Mentes();
        return;
      }
      View("Ismeretlen mentés típus");
      return;
    } catch (Exception $error) {
      View("Hiba történt a mentés során!");
      return;
    }
  }
}
main();
