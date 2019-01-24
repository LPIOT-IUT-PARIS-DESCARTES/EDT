<?php
require(dbResources.php);
 class connectDb{

    function __construct(){
        dbConnect();
    }

    function dbConnect()
    {
        $hostname = "localhost";
        $base= "proj";
        $loginBD= "root";
        $passBD="root";

        try
        {
            $db = new PDO(dbResources::$connexionString);
            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
    //Ajouter une fonction qui permet d'ajouter une requête et une autre qui permet de commit une requête bitch
}

?>
