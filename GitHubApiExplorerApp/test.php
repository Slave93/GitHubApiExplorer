<?php
/**
 * Created by PhpStorm.
 * User: zmaj
 * Date: 12/14/2015
 * Time: 11:44 PM
 *//*
require_once("functions.php");
$jsonOdgovor = brojRepozitorijuma("Java");
echo "printr".print_r($jsonOdgovor)."<br>"."vardump".var_dump($jsonOdgovor)."<br>";
echo "working";*/

/*$curl = curl_init("https://api.github.com/search/repositories?q=language:java");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
//curl_setopt($curl, CURLOPT_POST, false);
$curl_odgovor = curl_exec($curl);
print_r(curl_getinfo($curl));
var_dump($curl_odgovor);
$parsiran_json = json_decode($curl_odgovor);
var_dump($parsiran_json);

$url = "https://api.github.com/search/repositories?q=language:java";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,1);
curl_setopt($ch, CURLOPT_USERPWD, "Slave93:Slavko.kom123");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$content = curl_exec($ch);
curl_close($ch);
var_dump($content);

//Zameniti URL putanjom serverskog dela REST servisa i zameniti vrednost API kljuèa
$url='https://api.github.com/search/repositories?q=java';
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
//za FON-ovu mrezu treba podesiti proksi. Za ostale mreze linije za proksi treba da budu pod komentarom
//curl_setopt($curl, CURLOPT_PROXY, 'proxy.fon.rs:8080');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
$curl_odgovor = curl_exec($curl);
$parsiran_json = json_decode ($curl_odgovor);
var_dump($parsiran_json);
?>*/
require_once("functions.php");
/*echo brojRepozitorijumaJezika('Java');
echo "<br>";
echo brojRepozitorijumaJezikaSaZvezdicama('Java','5');
echo "<br>";
echo brojBagovaJezika('Java',null);
echo "<br>";
echo brojBagovaJezika('Java','open');
echo "<br>";
echo brojBagovaJezika('Java','closed');
echo "<br>";*/
//echo najnovijiBagJezika('Java')["datum"].najnovijiBagJezika('Java')["naslov"].najnovijiBagJezika('Java')["sadrzaj"];
echo brojKorisnikaJezika("Java"); echo "<br>";
echo brojKorisnikaJezikaIzZemlje("Java","Serbia");
echo "<br>";