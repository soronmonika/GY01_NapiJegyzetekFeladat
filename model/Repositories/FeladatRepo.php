<?php

include_once(__DIR__ . "/../Feladat.php");


class FeladatRepo
{
  public static function getFeladatok(): array
  {
    $con = new mysqli("127.0.0.1", "root", "", "NapiFeladatok_SoronMonika");
    if ($con->connect_error) {
      throw new Exception("DB kapcsolat hiba: " . $con->connect_error);
    }
    $con->set_charset("utf8mb4");

    $stmt = $con->prepare("SELECT ID, Nev, Kesz, Datum FROM Feladatok;");
    if (!$stmt) throw new Exception("SQL prepare hiba: " . $con->error);
    if (!$stmt->execute()) throw new Exception("SQL execute hiba: " . $stmt->error);

    $stmt->bind_result($ID, $Nev, $Kesz, $Datum);

    $feladat = [];
    while ($stmt->fetch()) {
      $feladat[] = new Feladat($ID, $Nev, $Kesz, $Datum);
    }

    $stmt->close();
    $con->close();
    return $feladat;
  }

  public static function createFeladat(Feladat $feladatok): void
  {
    $con = new mysqli("127.0.0.1", "root", "", "NapiFeladatok_SoronMonika");
    if ($con->connect_error) {
      throw new Exception("DB kapcsolat hiba: " . $con->connect_error);
    }
    $con->set_charset("utf8mb4");

    $stmt = $con->prepare("INSERT INTO Feladatok (ID, Nev, Kesz, Datum) VALUES (?, ?, ?, ?);");
    if (!$stmt) throw new Exception("SQL prepare hiba: " . $con->error);

    $ID = $feladatok->getID();
    $Nev = $feladatok->getNev();
    $Kesz = $feladatok->getKesz();
    $Datum = $feladatok->getDatum();

    $stmt->bind_param("ssis", $ID, $Nev, $Kesz, $Datum);
    if (!$stmt->execute()) throw new Exception("SQL execute hiba: " . $stmt->error);

    $stmt->close();
    $con->close();
  }


  public static function updateKesz(string $ID, int $Kesz): void
  {
    $con = new mysqli("127.0.0.1", "root", "", "NapiFeladatok_SoronMonika");
    if ($con->connect_error) {
      throw new Exception("DB kapcsolat hiba: " . $con->connect_error);
    }
    $con->set_charset("utf8mb4");

    $stmt = $con->prepare("UPDATE Feladatok SET Kesz = ? WHERE ID= ?");
    $stmt->bind_param("is", $Kesz, $ID);
    $stmt->execute();

    $stmt->close();
    $con->close();
  }
}
