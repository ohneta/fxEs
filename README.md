# fxEs
## about this
fxEs は NICT fxEsへのいくつかのアクセスをサポートするライブラリです。

## fxEsJson_php
fxEsJson_php は PHPによる fxEsサイト(https://wdc.nict.go.jp/Ionosphere/realtime/latest-fxEs.html および https://wdc.nict.go.jp/Ionosphere/realtime/fxEs/latest-fxEs.html)から 必要な情報をJSONで取得するPHPライブラリです。

実際には
https://wdc.nict.go.jp/Ionosphere/realtime/fxEs/latest-fxEs.html
のHTML情報から 必要な情報を作成しJSON形式で出力します。

出力形式の違いで、下記の3つのライブラリがあります。

- fxEsNowJSON.php
  * 直近の1つのfxEs情報を取得します。
- fxEsJSON.php
  * 直近の2時間分のfxEs情報を取得します。
- fxEsJSON2.php
  * 直近の2時間分のfxEs情報を取得します。
  * fxEsJSON.phpとfxEsJSON2.phpは同じデータを返しますがJSONフォーマットが違います。


## fxEs_svelte
fxEsJson_php/fxEsJSON.php から取得したfxEs情報をweb表示するためのサンプルです。

ページの作成にはsvelte4を利用しています。


## サンプルページ
上記のものを下記URLでサンプルとして動作せています。

https://service.moyurani.com/fxes/

