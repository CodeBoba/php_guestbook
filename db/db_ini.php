<?php
require_once 'config.php'; //ini Daten einlesen
//Datenbank mittels PHP erstellen on the fly
$myPDO = new PDO("mysql:host=".INI['HOST'] ,  INI['USER'] , INI['PASS']);
$myPDO->exec( 'CREATE DATABASE IF NOT EXISTS '.INI['DBNAME'] );
// Bereitstellen der Datenbank
$myPDO->exec('USE '.INI['DBNAME']);//jetzt Tabellen möglich
$myPDO->exec('SET NAMES utf8');// Zeichencodierung
// Tabelle aufbauen
$sql = 'CREATE TABLE IF NOT EXISTS '.INI['TBNAME'].'
        (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        text VARCHAR(255) NOT NULL,
        datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
        ';
$myPDO->exec($sql);
// nach Ausführung SQL können Fehler zurückkommen

//Test Datenbank füllen
//$myPDO->exec('INSERT INTO '.INI['TBNAME'].' (name,text) VALUES ("Otto","Ich sag nix")'); 

// eine Spalte hinzufügen
// $myPDO->exec('ALTER TABLE '.INI['TBNAME'].' ADD file VARCHAR(250) NULL');

$arr = $myPDO->errorInfo();// liefert SQL Fehler
echo $arr[2];//Textausgabe
?>

