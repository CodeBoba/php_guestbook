<?php

class Model{
  private static $myPDO;// Instanz zum Datenbankobjekt

  private static function connectDB(){
    //                      Typ   Host                ;Datenbank                Username       Password
    self::$myPDO = new PDO('mysql:host='.INI['HOST'].';dbname='.INI['DBNAME'], INI['USER'], INI['PASS'] );
  }

  private static function getAllData($mask){
    $mask->execute();// hole Daten von Datenbank
    return $mask->fetchAll(); //Liefer mir das Ergebnis als Array
  }
  
  private static function setIntoDB($mask){
    return $mask->execute(); // in Datenbank Schreiben
  }

  private static function sanitizeSQL($sql){
    //Datenbankverbindung
    self::connectDB();
    return self::$myPDO->prepare($sql);// SQL sicher auf Server speichern, Freier Platz für Variablen bleibt offen
  }

  ##########################################
  #                SQL                     #
  ##########################################

  public static function getAllComments(){
    $sql = 'SELECT * FROM '.INI['TBNAME'];
    // statische Methoden benutzen self statt this
    $mask = self::sanitizeSQL($sql); // SQL Injektionsicherheit herstellen
    // $mask->bindValue
    return self::getAllData($mask); 
  }
  public static function setNewComment($name,$text){
    $sql = 'INSERT INTO '.INI['TBNAME'].' (name,text) VALUES (?,?)';
    $mask = self::sanitizeSQL($sql);//SQLInjektion sicher im Speicher
    $mask->bindValue(1,$name,PDO::PARAM_STR);
    $mask->bindValue(2,$text,PDO::PARAM_STR);
    return self::setIntoDB($mask);
  }

}



?>