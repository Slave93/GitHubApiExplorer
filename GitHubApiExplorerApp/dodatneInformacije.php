<?php
require_once("functions.php");
if(isset($_GET["obug"]) && isset($_GET["language"])){
    echo json_encode(najstarijiBagJezika($_GET["language"]));
}
if(isset($_GET["nbug"]) && isset($_GET["language"])){
    echo json_encode(najnovijiBagJezika($_GET["language"]));
}
if(isset($_GET["country"]) && isset($_GET["language"])){
    echo json_encode(brojKorisnikaJezikaIzZemlje($_GET["language"],$_GET["country"]));
}
if(isset($_GET["stars"]) && isset($_GET["language"])){
    echo json_encode(brojRepozitorijumaJezikaSaZvezdicama($_GET["language"],$_GET["stars"]));
}