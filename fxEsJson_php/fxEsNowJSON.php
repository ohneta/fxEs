<?php
//----------------------------------------------------------------
/**
 * NICT スポラディックE層の最新情報を JSON形式で取得する
 * (JSON format)
 *
 * 動作方法
 *  $php fxEsNowJSON.php
 *
 * 動作条件
 *  PHP7以上(DOM関数、cURL関数 がインストールしてあること)
 */
//----------------------------------------------------------------

  include_once("./fxEsJSON.inc.php");

  //----------------------------------------------------------------

  $httpStr = getNictHttp($gFxEsURL);
  $tableValues = domToValues($httpStr);
  if ($tableValues == null) {
    exit(-1);
  }

  $retValues = [
//    'date' => $tableValues[8][0],
    $tableValues[0][0] => $tableValues[8][0],
    $tableValues[0][1] => $tableValues[8][1],
    $tableValues[0][2] => $tableValues[8][2],
    $tableValues[0][3] => $tableValues[8][3],
    $tableValues[0][4] => $tableValues[8][4],
  ];

  $retJson = json_encode($retValues);
  print($retJson);
  print("\n");

//----------------------------------------------------------------
?>
