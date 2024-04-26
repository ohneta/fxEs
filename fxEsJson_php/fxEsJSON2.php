<?php
//----------------------------------------------------------------
/**
 * NICT スポラディックE層(最新2時間)を JSON形式で取得する
 * NICT 'fxEs' values for the past two hours
 * (JSON format)
 *
 * 動作方法
 *  $php fxEsJSON2.php
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


  $retJson = json_encode($tableValues);
  print($retJson);
  print("\n");
  exit(0);

//----------------------------------------------------------------
?>
