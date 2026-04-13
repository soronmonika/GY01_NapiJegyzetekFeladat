<?php

class Feladat
{
  //Adattagok
  private string $ID;
  private string $Nev;
  private bool $Kesz;
  private string $Datum;


  //Konstruktor
  public function __construct(string $ID, string $Nev, bool $Kesz, string $Datum)
  {
    $this->setID($ID);
    $this->setNev($Nev);
    $this->setKesz($Kesz);
    $this->setDatum($Datum);
  }

  //getter
  public function getID(): string
  {
    return $this->ID;
  }

  public function getNev(): string
  {
    return $this->Nev;
  }

  public function getKesz(): bool
  {
    return $this->Kesz;
  }

  public function getDatum(): string
  {
    return $this->Datum;
  }


  //setter
  public function setID(string $ID): void
  {
    $ID = trim($ID);
    if ($ID == "") {
      throw new InvalidArgumentException("Az azonosító megadása kötelező!");
    }
    $this->ID = $ID;
  }

  public function setNev(string $Nev): void
  {
    $Nev = trim($Nev);
    if ($Nev == "") {
      throw new InvalidArgumentException("A név megadása kötelező!");
    }
    $this->Nev = $Nev;
  }

  public function setKesz(bool $Kesz): void
  {
    $this->Kesz = $Kesz;
  }

  public function setDatum(string $Datum): void
  {
    $Datum = trim($Datum);
    if ($Datum == "") {
      throw new InvalidArgumentException("A dátum megadása kötelező!");
    }

    $d = DateTime::createFromFormat("Y-m-d", $Datum);
    if (!$d || $d->format("Y-m-d") !== $Datum) {
      throw new InvalidArgumentException(("A dátum formátuma hibás! (YYYY-MM-DD"));
    }

    $this->Datum = $Datum;
  }
}
