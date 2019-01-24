<?php
require("./model/Promotion.php");

class PromotionController{

  //Retourne tous les promotions
  public function index(){
    $promotions = Periode::getAllPromotions();
    $array_json = array();

    while ($promotion = $promotions->fetch()){
      $obj_json = array('id' => utf8_encode($promotion['id_promo']),
      'form' => utf8_encode($promotion['id_form']), 
      'num' => utf8_encode($promotion['num']),
      'label' => utf8_encode($promotion['label']),
      );

      array_push($array_json,$obj_json);
    }
    echo  json_encode($array_json);
  }
}
?>