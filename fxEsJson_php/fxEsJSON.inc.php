<?php
//----------------------------------------------------------------
/**
 * NICT スポラディックE層(最新2時間)取得 ライブラリ
 * 動作条件
 *  PHP7以上(DOM関数、cURL関数 がインストールしてあること)
 */
//----------------------------------------------------------------

  // NICT スポラディックE層(最新2時間)のURL
  $gFxEsURL = "https://wdc.nict.go.jp/Ionosphere/realtime/fxEs/latest-fxEs.html";

  //----------------------------------------------------------------
  /**
   * NICTリアルタイムfxEs情報を取得
   *
   * @param string $fxEsURL NICT fxEsのURL文字列
   * @return string fxEsのHTML形式文字列
   */
  function getNictHttp(string $fxEsURL): string
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $fxEsURL);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $httpStr = curl_exec($ch);
    curl_close($ch);

    return $httpStr;
  }

  //----------------------------------------------------------------
  /**
   * NICTリアルタイムfxEs情報HTMLから必要な情報のみをarrayで取得する
   *
   * @param string $httpStr fxEs HTML文字列
   * @return array|null 下記のフォーマットで必要な情報を配列で返す。解析失敗したならnull
   *      $tableValues[0] = array('Date Time(JST)', 'Okinawa', 'Yamagawa', 'Kokubunji', 'Wakkanai')
   *      $tableValues[1...8] = array('YYYY/MM/DD HH:mm', Okinawa-fxEs value, Yamagawa-fxEs value, Kokubunji-fxEs value, Wakkanai-fxEs value)
   */
  function domToValues(string $httpStr): array|null
  {
    $tableValues = [];

    $domDoc = new DOMDocument();
    @$domDoc->loadHTML($httpStr);

    $table1Node = $domDoc->getElementsByTagName('table')->item(1);
    if (!$table1Node->hasChildNodes())  return null;

    $tableChildNodeList = $table1Node->childNodes;
    $trMax = $tableChildNodeList->count();

    // TR-1列目 - 観測地
    $tr0Node = $tableChildNodeList->item(0);
    {
//      $tableValues[0][0] = $tr0Node->childNodes->item(0)->textContent; // DateTime
      $tableValues[0][0] = 'DateTimeJST'; // DateTime
      $tableValues[0][1] = $tr0Node->childNodes->item(1)->textContent; // Okinawa
      $tableValues[0][2] = $tr0Node->childNodes->item(2)->textContent; // Yamagawa
      $tableValues[0][3] = $tr0Node->childNodes->item(3)->textContent; // Kokubunji
      $tableValues[0][4] = $tr0Node->childNodes->item(4)->textContent; // Wakkanai
    }

    // TR-2列目以降(周波数)
    for ($i = 1; $i < $trMax; $i++) {
      $trNode = $tableChildNodeList->item($i);
      {
        $tdMax = $trNode->childNodes->count();
        $tdCount = 0;
        for ($j = 0; $j < $tdMax; $j++) {
          $tdNode = $trNode->childNodes->item($j);
          if ($tdNode != null) {
            $textContent = trim($tdNode->textContent);
            if (($textContent != null) && ($textContent != '')) {
              $tableValues[$i][$tdCount] = trim($tdNode->textContent);
              $tdCount++;
            }
          }
        }
      }
    }

    return $tableValues;
  }

  //----------------------------------------------------------------

//----------------------------------------------------------------
?>
