<?php 
/*controleur c1.php :
  fonctions-action de gestion (c1)
*/
ini_set('display_errors', 1);
function a11() {
	//require ("./modele/m1.php");	//accès aux fcts modèle de m1.php
    ini_set('display_errors', 1);
	//définition de variables PHP utiles pour le template
    require ("./vue/layout/layout.tpl"); //layout lançant le template de vue du service
    require("./vue/layout/edt.tpl");
}

function a12() {
	//require ("./modele/m1.php");	
	
	require ("./vue/layout/layout.tpl"); //layout lançant le template de vue du service
    require("././modele/Module.php");
    require("././modele/Periode.php");
    $periodepromo = getAllPeriodePromo();
    $periode = getAllPeriode();
    $module = getAllModule();
    $moduleform = getAllModuleFormation();
    require ("./vue/layout/test.php");
}
function controlleurAllModule(){
    require ("./vue/layout/layout.tpl");
    require("././model/Module.php");
    $modules = getAllModule();
}

?>
