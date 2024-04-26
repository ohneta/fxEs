<script lang="ts">
	import FxEsInfo from './FxEsInfo.svelte';
</script>

<svelte:head>
	<title>fxEs</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
</svelte:head>

 <h1>
    NICT スポラディックE層情報を JSON形式で取得
  </h1>
  <h2>
    NICT 'fxEs' values（JSON format)
  </h2>

 <div>
    <a href="https://service.moyurani.com/fxes/fxEsNowJSON.php">最新fxEs</a><br />
    <a href="https://service.moyurani.com/fxes/fxEsJSON.php">過去2時間fxEs その1</a><br />
    <a href="https://service.moyurani.com/fxes/fxEsJSON2.php">過去2時間fxEs その2</a><br />
  </div>

<hr />

<h4>表示サンプル</h4>
<FxEsInfo />

<a href="https://wdc.nict.go.jp/Ionosphere/realtime/latest-fxEs.html">NICT fxEsの本家</a>

