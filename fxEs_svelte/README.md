# fxEs_svelte

xEsJson_php/fxEsJSON.php から取得したfxEs情報をweb表示するためのサンプルです。

ページの作成はsvelte4/TypeScriptで書かれています。

fxEsJson_phpのfxEsJSON.phpを1分毎にアクセスし表示します。


## 開発環境

npm か yarnを使用して依存関係をインストールしたら開発環境サーバを起動します。

```bash
npm run dev

# webブラウザと同時に実行する場合
npm run dev -- --open
```

## ビルド

実行するにはnpmを使ってビルドします。

buildディレクトリにできたファイルをすべてwebサーバのドキュメントルートに設置すると動作します。

```bash
npm run build
```
