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


//  Verifie (via @login) et charge les informations
  public function LoadProfil(){
      $id = $_POST['id'];
      $password = $_POST['password'];
      $array_json = array();

      $islog = $this->login($id, $password);


      if ($islog == true){
          $qProf = Prof::getProfById($islog['id']);
          $prof = $qProf->fetch();

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
          echo  json_encode($array_json);



      } else {
          echo "c'est la merde";
      }
  }

//  Verifie login & mot de passe
    public function login($id, $password){

        $prof = Prof::getProfLogin($id, $password);
        $proflog = $prof->fetch();

        if($proflog['cp'] == 1){
            $profinfo = array(
                'islog' => true,
                'id' => $proflog['id_prof'],
            );
        } else{
            $profinfo = array(
                'islog' => false,
                'id' => null,
            );
        };

        return $profinfo;
    }
}
?>