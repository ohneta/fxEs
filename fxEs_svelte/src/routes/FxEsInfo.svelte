<!--
	FxEsInfo.svelte
-->
<script lang="ts">
  import { onMount } from "svelte";

  //------------------------
	const url = "https://service.moyurani.com/fxes/fxEsJSON.php?from=sample";

  interface FxEsJSON {
    DateTimeJST: string;
    Okinawa: string;
    Yamagawa: string;
    Kokubunji: string;
    Wakkanai: string;
  };

  interface Item {
    datetime: string;
    okinawa: string;
    yamagawa: string;
    kokubunji: string;
    wakkanai: string;
  }

  //------------------------

  let itemDefaultValue: Item = {
      datetime: 'xxx',
      okinawa: '----',
      yamagawa: '----',
      kokubunji: '----',
      wakkanai: '----',
    };

  let items: Array<Item> = new Array(8).fill(itemDefaultValue);
  let gotFxEsDateTime: string = "***";

  onMount(async () => {
      getFxEsJSON(url);

      let intervalId = setInterval(() => {
        getFxEsJSON(url);
      }, 1 * 60 * 1000);
	});

  async function getFxEsJSON(url: string): void {
    gotFxEsDateTime = new Date().toLocaleString("ja"); 

		const fxEsJson = await getData(url);
    fxEsJsonToView(fxEsJson);
  }

  //------------------------------------------------
  /**
  * 
  * @param fxEsJson
  */
  const fxEsJsonToView = function(fxEsJson: FxEsJSON[]) {
    fxEsJson.map((item: FxEsJSON, index: number) => {
      items[index] = {
        datetime: item.DateTimeJST,
        okinawa: item.Okinawa,
        yamagawa: item.Yamagawa,
        kokubunji: item.Kokubunji,
        wakkanai: item.Wakkanai,
      };
    });
  }

  //------------------------------------------------
  /**
   * 
   * @param url string fsExのURL
   */
	async function getData(url: string): FxEsJSON[] {
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
      <tr class="datetime">
        <th>Date Time (JST)</th>
        <th>Okinawa</th>
        <th>Yamagawa</th>
        <th>Kokubunji</th>
        <th>Wakkanai</th>
      </tr>
      {#each items as _, i}
        <tr class="fxesdata">
          <td class="constinfo">{items[i].datetime}</td>

            {#if items[i].okinawa == '----'}
              <td class="nonFreq">{items[i].okinawa}</td>
            {:else if items[i].okinawa > 9}
              <td class="over9Freq">{items[i].okinawa}</td>
            {:else if items[i].okinawa > 8}
              <td class="over8Freq">{items[i].okinawa}</td>
            {:else if items[i].okinawa > 7}
              <td class="over7Freq">{items[i].okinawa}</td>
            {:else}
              <td class="under7Freq">{items[i].okinawa}</td>
            {/if}

            {#if items[i].yamagawa == '----'}
              <td class="nonFreq">{items[i].yamagawa}</td>
            {:else if items[i].yamagawa > 9}
              <td class="over9Freq">{items[i].yamagawa}</td>
            {:else if items[i].yamagawa > 8}
              <td class="over8Freq">{items[i].yamagawa}</td>
            {:else if items[i].yamagawa > 7}
              <td class="over7Freq">{items[i].yamagawa}</td>
            {:else}
              <td class="under7Freq">{items[i].yamagawa}</td>
            {/if}

            {#if items[i].kokubunji == '----'}
              <td class="nonFreq">{items[i].kokubunji}</td>
            {:else if items[i].kokubunji > 9}
              <td class="over9Freq">{items[i].kokubunji}</td>
            {:else if items[i].kokubunji > 8}
              <td class="over8Freq">{items[i].kokubunji}</td>
            {:else if items[i].kokubunji > 7}
              <td class="over7Freq">{items[i].kokubunji}</td>
            {:else}
              <td class="under7Freq">{items[i].kokubunji}</td>
            {/if}

            {#if items[i].wakkanai == '----'}
              <td class="nonFreq">{items[i].wakkanai}</td>
            {:else if items[i].wakkanai > 9}
              <td class="over9Freq">{items[i].wakkanai}</td>
            {:else if items[i].wakkanai > 8}
              <td class="over8Freq">{items[i].wakkanai}</td>
            {:else if items[i].wakkanai > 7}
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
	font-size: 1rem;
}

.fxEsDateTime .dateTime {
	color: #f08;
	background-color: #fff;
	font-size: 1.2rem;
}

.infos {
	font-size: 1rem;
}

.datetime {
  background-color: pink;
  width: 10rem;
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