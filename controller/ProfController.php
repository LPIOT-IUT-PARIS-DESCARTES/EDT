<?php
require("./model/Prof.php");

class ProfController{

  //Retourne tous les profs
  public function index(){
    $profs = Prof::getAllProfs();
    $array_json = array();

    while ($prof = $profs->fetch()){
      $obj_json = array('id' => utf8_encode($prof['id_prof']),
      'nom' => utf8_encode($prof['nom']),
      'prenom' => utf8_encode($prof['prenom']), 
      'email' => utf8_encode($prof['email']),
      'label' => utf8_encode($prof['label']),
      'login' => utf8_encode($prof['login_prof']),
      'pass' => utf8_encode($prof['pass_prof']),
      'date' => utf8_encode($prof['date_prof']),
      'photo' => utf8_encode($prof['urlPhoto']),
      'couleur' => utf8_encode($prof['couleur']),
      'bConnect' => utf8_encode($prof['bConnect']),
    );
      array_push($array_json,$obj_json);
    }
    echo  json_encode($array_json);
  }


  /**
   * Login du professeur
   */
  public function loginProf(){
    if (isset($_POST['id']) && isset($_POST['password'])){
      $id = $_POST['id'];
      $password = $_POST['password'];
      $qProf = Prof::getProfLogin($id,$password);
      $profinfo = $qProf->fetch();

      if ($id == $profinfo['login_prof'] && $password == $profinfo['pass_prof'] && $id != null && $password != null){
        session_start();
        $_SESSION['id_prof'] = utf8_encode($profinfo['id_prof']);
        $_SESSION['nom'] = utf8_encode($profinfo['nom']);
        $_SESSION['prenom'] = utf8_encode($profinfo['prenom']);
      }
    }
    header("Location: index.php");
    exit();
  }

  public function disconnectProf(){
    session_destroy();
    header("Location: index.php");
    exit();
  }

}
?>