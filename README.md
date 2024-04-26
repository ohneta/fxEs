# fxEs
## about this
fxEs は NICT fxEsへアクセスをサポートするのいくつかのライブラリです。

## fxEsJson_php
fxEsJson_php は PHPによる NICTイオノゾン電離圏観測サイト(https://wdc.nict.go.jp/Ionosphere/) のスポラディックE層のリアルタイムページから 必要な情報をJSONで取得するPHPライブラリです。

実際には
https://wdc.nict.go.jp/Ionosphere/realtime/fxEs/latest-fxEs.html
のHTML情報から 必要な情報を抽出してJSON形式で出力します。

出力形式の違いで、下記の3つのライブラリがあります。

- fxEsNowJSON.php
  * 最新の1つのfxEs情報を取得します。
```
JSONフォーマット
{
  DateTimeJST: "<観測日時(JST)>",
  Okinawa: "<沖縄の観測データ>",
  Yamagawa: "<山川の観測データ>",
  Kokubunji: "<国分寺の観測データ>",
  Wakkanai: "<稚内の観測データ>"
}
```
- fxEsJSON.php
  * 直近の2時間分のfxEs情報を取得します。
```
JSONフォーマット
[
  {
    DateTimeJST: "<観測日時(JST)>",
    Okinawa: "<沖縄の観測データ>",
    Yamagawa: "<山川の観測データ>",
    Kokubunji: "<国分寺の観測データ>",
    Wakkanai: "<稚内の観測データ>"
  },
  {
     <次の観測データ>
  },
  ... (全部で8こ)
]
```
- fxEsJSON2.php
  * 直近の2時間分のfxEs情報を取得します。
  * fxEsJSON.phpとfxEsJSON2.phpは同じデータを返しますがJSONフォーマットが違います。
```
JSONフォーマット
[
  [
    [
      "DateTimeJST",
      "Okinawa",
      "Yamagawa",
      "Kokubunji",
      "Wakkanai"
    ],
    [
      "<観測日時(JST)>",
      "<沖縄の観測データ>",
      "<山川の観測データ>",
      "<国分寺の観測データ>",
      "<稚内の観測データ>"
    ],
    [
      <次の観測データ>
    ],
    ... (全部で8こ)
  ]
]
```

## fxEs_svelte
fxEsJson_php/fxEsJSON.php から取得したfxEs情報をweb表示するためのサンプルです。

ページの作成はsvelte4/TypeScriptで書かれています。


## サンプルページ
上記のものを下記URLでサンプルとして動作せています。

https://service.moyurani.com/fxes/

