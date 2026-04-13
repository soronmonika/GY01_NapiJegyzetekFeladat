<?php

$ErrorUzenet = "";
$SuccessUzenet = "";

if (isset($_GET["success"])) {
  $SuccessUzenet = "Sikeres mentés!";
}

include_once("../controller/controller.php");

View($ErrorUzenet, $SuccessUzenet);
