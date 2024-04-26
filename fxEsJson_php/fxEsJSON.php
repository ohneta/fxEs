<?php
//----------------------------------------------------------------
/**
 * NICT スポラディックE層(最新2時間)を JSON形式で取得する
 * NICT 'fxEs' values for the past two hours
 * (JSON format)
 *
 * 動作方法
 *  $php fxEsJSON.php
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

  $retValues = [];
  for ($i = 1; $i < count($tableValues); $i++) {
    $retValues[$i - 1] = [
      $tableValues[0][0] => $tableValues[$i][0],
      $tableValues[0][1] => $tableValues[$i][1],
      $tableValues[0][2] => $tableValues[$i][2],
      $tableValues[0][3] => $tableValues[$i][3],
      $tableValues[0][4] => $tableValues[$i][4],
    ];
  }

  $retJson = json_encode($retValues);
  print($retJson);
  print("\n");

//----------------------------------------------------------------
?>
