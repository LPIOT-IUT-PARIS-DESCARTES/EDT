<?php
//APPEL A LA DB
require_once('connectBD.php');
//faire une classe, qui va hérité de la classe connectDB, dans ce constructeur faire appel au constructeur parent
//Ici le constrcuteur fait uniquement 
class ModuleService extends connectDB {

    function __construct(){
        parent::__construct();
    }
    function getAllModule()
    {
        $db = dbConnect();
        $module = $db->prepare('SELECT * FROM `uemodule`');
        $module->execute();

        return $module;
    }

    // function getModuleById($id){
    // $db = dbConnect();
    // $module = $db->prepare('SELECT * FROM `uemodule` WHERE `id=`'$id);
    // $module->execute();

    // return $module;
    // }

    function getAllModuleFormation()
    {
        $db = dbConnect();
        $module = $db->prepare('SELECT uemodule.id_uemod, uemodule.classif, uemodule.nom as "nom_module", uemodule.label, formation.id_form, formation.nom as "nom_form", formation.label FROM `uemodule` INNER JOIN formation ON formation.id_form = uemodule.id_form');
        $module->execute();

        return $module;
    }
}