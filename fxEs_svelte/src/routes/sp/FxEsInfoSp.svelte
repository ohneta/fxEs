<!--
	FxEsInfoSp.svelte
  fxEsデータを定期的に取得して表示する
-->
<script lang="ts">
  import { onMount } from "svelte";

  //------------------------
  // fxEsJSON 取得URL
	const url = "https://service.moyurani.com/fxes/fxEsJSON.php?from=sample";

  // fxEsJSONデータ形式
  interface FxEsJSON {
    DateTimeJST: string;
    Okinawa: string;
    Yamagawa: string;
    Kokubunji: string;
    Wakkanai: string;
  }

  // 表示データ形式
  interface Item {
    datetime: string;
    okinawa: string;
    yamagawa: string;
    kokubunji: string;
    wakkanai: string;
  }

  //------------------------
  // 初期値
  let gotFxEsDateTime: string = "***";

  let items: Array<Item> = new Array(8).fill({
    datetime: 'xxx',
    okinawa: '----',
    yamagawa: '----',
    kokubunji: '----',
    wakkanai: '----',
  })

  // データを取得する間隔の秒数
  const intervalTimeSec = 1 * 60;

  let targetDate: string = "***";

  //------------------------------------------------
  // 
  onMount(async () => {
    // データを取得して表示
    getFxEsJSON(url);

    // 定期的にデータを取得して表示
    let intervalId = setInterval(() => {
      getFxEsJSON(url);
    }, intervalTimeSec * 1000);
	})

  /**
   * fxEsを取得して表示する。
   * 
   * @param url fxEsJsonを返すURL
   * @return void
   */
  const	getFxEsJSON = async (url: string) => {
    gotFxEsDateTime = new Date().toLocaleDateString("ja-JP", {
                                                      year: "numeric",
                                                      month: "2-digit",
                                                      day: "2-digit",
                                                      hour: "2-digit",
                                                      minute: "2-digit",
                                                      second: "2-digit",
     })

    fxEsJsonToView(await getData(url));
  }

  /**
  * fsEx JSON形式データを　items[]に設定。items[]はリアクティブ
  *
  * @param fxEsJson fsEx JSON形式データ
  * @return void
  */
  const fxEsJsonToView = (fxEsJson: FxEsJSON[]): void => {

    targetDate = fxEsJson[0].DateTimeJST.substring(5, 10);  // 月日のみ

    fxEsJson.map((item: FxEsJSON, index: number) => {
      items[index] = {
        datetime: item.DateTimeJST.substring(11, 16), // 時分のみ
        okinawa: item.Okinawa,
        yamagawa: item.Yamagawa,
        kokubunji: item.Kokubunji,
        wakkanai: item.Wakkanai,
      };
    });
  }

  /**
   * fsExの値を取得
   * 
   * @param url string fsExのURL
   * @return Promise<FxEsJSON[]>
   */
  const getData = async (url: string): Promise<FxEsJSON[]> => {
		const response: any = await fetch(url, {
				method: "GET",
				mode: "cors",
				cache: "no-cache",
				credentials: "same-origin",
				redirect: "follow",
				referrerPolicy: "no-referrer",
		});

		const retJson: FxEsJSON[] = await response.json();
		return retJson;
	};

  //------------------------------------------------
</script>

<div class="module">
  <div class="fxEsDateTime"><span>取得日時:</span> <span class="dateTime">{gotFxEsDateTime}</span></div>
  <div class="infos">
    <table>
      <tr>
        <th class="constinfo">{targetDate}</th>
        <th class="constinfo">沖 縄</th>
        <th class="constinfo">山 川</th>
        <th class="constinfo">国分寺</th>
        <th class="constinfo">稚 内</th>
      </tr>
      {#each items as _, i}
        <tr class="fxesdata">
          <td class="constinfo">{items[i].datetime}</td>

            {#if items[i].okinawa == '----'}
              <td class="nonFreq">{items[i].okinawa}</td>
            {:else if Number(items[i].okinawa) > 9}
              <td class="over9Freq">{items[i].okinawa}</td>
            {:else if Number(items[i].okinawa) > 8}
              <td class="over8Freq">{items[i].okinawa}</td>
            {:else if Number(items[i].okinawa) > 7}
              <td class="over7Freq">{items[i].okinawa}</td>
            {:else}
              <td class="under7Freq">{items[i].okinawa}</td>
            {/if}

            {#if items[i].yamagawa == '----'}
              <td class="nonFreq">{items[i].yamagawa}</td>
            {:else if Number(items[i].yamagawa) > 9}
              <td class="over9Freq">{items[i].yamagawa}</td>
            {:else if Number(items[i].yamagawa) > 8}
              <td class="over8Freq">{items[i].yamagawa}</td>
            {:else if Number(items[i].yamagawa) > 7}
              <td class="over7Freq">{items[i].yamagawa}</td>
            {:else}
              <td class="under7Freq">{items[i].yamagawa}</td>
            {/if}

            {#if items[i].kokubunji == '----'}
              <td class="nonFreq">{items[i].kokubunji}</td>
            {:else if Number(items[i].kokubunji) > 9}
              <td class="over9Freq">{items[i].kokubunji}</td>
            {:else if Number(items[i].kokubunji) > 8}
              <td class="over8Freq">{items[i].kokubunji}</td>
            {:else if Number(items[i].kokubunji) > 7}
              <td class="over7Freq">{items[i].kokubunji}</td>
            {:else}
              <td class="under7Freq">{items[i].kokubunji}</td>
            {/if}

            {#if items[i].wakkanai == '----'}
              <td class="nonFreq">{items[i].wakkanai}</td>
            {:else if Number(items[i].wakkanai) > 9}
              <td class="over9Freq">{items[i].wakkanai}</td>
            {:else if Number(items[i].wakkanai) > 8}
              <td class="over8Freq">{items[i].wakkanai}</td>
            {:else if Number(items[i].wakkanai) > 7}
              <td class="over7Freq">{items[i].wakkanai}</td>
            {:else}
              <td class="under7Freq">{items[i].wakkanai}</td>
            {/if}
        </tr>
      {/each}
    </table>
  </div>
</div>

<style>
.module {
}

.fxEsDateTime {
	color: #33f;
	background-color: #fff;
	font-size: 0.8rem;
}

.fxEsDateTime {
	color: #f08;
	background-color: #fff;
	font-size: 1rem;
  font-weight: bold;
}

.infos {
	font-size: 1rem;
}


.fxesdata {
  width: 4rem;
  text-align: right;
}

div {
	font-size: 1rem;
}
table {
	background-color: #fff;
}
td, th {
  border-style: solid;	
  border-collapse: collapse;
  border-color: #888;
  border-width: 1px;
}

.constinfo {
  font-weight: normal;
  background-color: pink;
}

.nonFreq {
  background-color: white;
}
.under7Freq {
  background-color: aqua;
}
.over7Freq {
  background-color: yellow;
}
.over8Freq {
  background-color: hotpink;
}
.over9Freq {
  background-color: red;
}

</style>