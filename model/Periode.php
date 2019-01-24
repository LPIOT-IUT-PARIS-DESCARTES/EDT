<?php
require 'model/connectDb.php';
  class Periode extends connectDb{
    private $id_period;
    private $id_promo;
    private $label;
    private $tDeb;
    private $tFin;
    private $diff;

    public static function getAllPeriodes()
    {
      $db = connectDb::dbConnect();
      $periodes = $db->prepare('SELECT
                                                id_period,
                                                id_promo,
                                                label,
                                                tDeb,
                                                tFin,
                                                ROUND(DATEDIFF(
                                                    FROM_UNIXTIME(tFin),
                                                    FROM_UNIXTIME(tDeb)
                                                )/7) AS diff
                                            FROM
                                                `period`
                                            ORDER BY
                                                FROM_UNIXTIME(tDeb)
                                            DESC');
      $periodes->execute();
      return $periodes;
    }

    public static function getAllPeriodePromos()
    {
      $db = connectDb::dbConnect();
      $periodes = $db->prepare('SELECT period.id_period, promotion.id_promo, period.label as "label_period", period.tDeb, period.tFin, promotion.label as "label_promo" FROM `period` INNER JOIN promotion ON promotion.id_promo = period.id_promo');
      $periodes->execute();
      return $periodes;
    }
  }
?>