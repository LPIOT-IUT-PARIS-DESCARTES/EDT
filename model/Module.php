<?php
require 'model/connectDb.php';
  class Module extends connectDB{
    private $id_uemod;
    private $id_form;
    private $classif;
    private $nom;
    private $label;

    public static function getAllModules()
    {
      $db = connectDb::dbConnect();
      $modules = $db->prepare('SELECT * FROM `uemodule` ORDER BY id_uemod DESC');
      $modules->execute();
      return $modules;
    }
    
  }

?>