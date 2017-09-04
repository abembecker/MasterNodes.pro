<?php

namespace App\Http\Controllers;

use App\Blocks;
use Validator, Input, Redirect, View, Auth;
use App\Mnl;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\elasticSearch;

class coin extends Controller
{
	public static $sort = 'roi';

	public function index()
	{
		$data     = null;
		$type     = isset($_GET['sort']) ? $_GET['sort'] : 'roi';
		$view     = isset($_GET['view']) ? $_GET['view'] : 'grid';
		$sort     = 'roi';
		$coinList = $this->coinList();
		foreach ($coinList as $one) {
			if (Storage::exists('' . strtolower($one['coin']) . '.json')) {
				$coinData = json_decode(Storage::get('' . strtolower($one['coin']) . '.json'), true);
				if (isset($coinData['time'])) {
					$data['coinList'][$one['coin']]['totalMasterNodes']        = $coinData['masterNodeCount']['enabled'];
					$data['coinList'][$one['coin']]['masterNodeCoinsRequired'] = $coinData['coinData']['masterNodeCoinRequired'];
					$data['coinList'][$one['coin']]['income']                  = $coinData['last24Hours']['perNode']['values']['price_usd'];
					$data['coinList'][$one['coin']]['lastUpdated']             = $coinData['lastUpdated'];
					$data['coinList'][$one['coin']]['cmc']                     = $coinData['cmcData'];
					$data['coinList'][$one['coin']]['market_cap']              = $coinData['cmcData']['market_cap_usd'];
					$data['coinList'][$one['coin']]['coin_supply']             = $coinData['cmcData']['available_supply'];
					$data['coinList'][$one['coin']]['percent_change_24h']      = $coinData['cmcData']['percent_change_24h'];
					$data['coinList'][$one['coin']]['coinLocked']              = $coinData['coinLocked']['total'];
					$data['coinList'][$one['coin']]['dailyRev']                = $coinData['last24Hours']['perNode']['values']['price_usd']['daily'];
					$data['coinList'][$one['coin']]['weeklyRev']               = $coinData['last24Hours']['perNode']['values']['price_usd']['weekly'];
					$data['coinList'][$one['coin']]['monthlyRev']              = $coinData['last24Hours']['perNode']['values']['price_usd']['monthly'];
					$data['coinList'][$one['coin']]['yearlyRev']               = $coinData['last24Hours']['perNode']['values']['price_usd']['yearly'];
					$data['coinList'][$one['coin']]['coin']                    = $one['coin'];
					$data['coinList'][$one['coin']]['name']                    = $one['name'];
					$data['coinList'][$one['coin']]['roi']                     = $coinData['last24Hours']['perNode']['values']['price_usd']['roi'];
					$data['coinList'][$one['coin']]['realRoi']                 = $data['coinList'][$one['coin']]['roi'];
					$data['coinList'][$one['coin']]['logo']                    = $coinData['coinData']['logo'];
					if (isset($one['ads'])) {
						$data['coinList'][$one['coin']]['ads'] = $one['ads'];
						$data['coinList'][$one['coin']]['url'] = $one['url'];
					}
				} else {
					$data['coinListOld'][$one['coin']]                       = $coinData;
					$CMC                                                     = json_decode(Storage::get('' . strtolower($one['coin']) . '-CMC.json'), true);
					$data['coinListOld'][$one['coin']]['cmc']                = $CMC;
					$data['coinListOld'][$one['coin']]['market_cap']         = $CMC['market_cap_usd'];
					$data['coinListOld'][$one['coin']]['coin_supply']        = $CMC['total_supply'];
					$data['coinListOld'][$one['coin']]['percent_change_24h'] = $CMC['percent_change_24h'];
					$data['coinListOld'][$one['coin']]['coinLocked']         = isset($coinData['totalMasterNodes']) ? $coinData['totalMasterNodes'] * $coinData['masterNodeCoinsRequired'] : 0;
					$data['coinListOld'][$one['coin']]['dailyRev']           = isset($coinData['income']) ? $coinData['income']['daily'] : 0;
					$data['coinListOld'][$one['coin']]['weeklyRev']          = isset($coinData['income']) ? $coinData['income']['weekly'] : 0;
					$data['coinListOld'][$one['coin']]['monthlyRev']         = isset($coinData['income']) ? $coinData['income']['monthly'] : 0;
					$data['coinListOld'][$one['coin']]['yearlyRev']          = isset($coinData['income']) ? $coinData['income']['yearly'] : 0;
					$data['coinListOld'][$one['coin']]['coin']               = $one['coin'];
					$data['coinListOld'][$one['coin']]['name']               = $one['name'];
					if (isset($one['notes'])) {
						$data['coinListOld'][$one['coin']]['notes'] = $one['notes'];
					}
					$data['coinListOld'][$one['coin']]['roi']     = isset($coinData['income']) ? $coinData['income']['yearly'] / number_format($CMC['price_usd'] * $coinData['masterNodeCoinsRequired'], 2, '.', '') * 100 : 0;
					$data['coinListOld'][$one['coin']]['realRoi'] = $data['coinListOld'][$one['coin']]['roi'];
					if (isset($one['badroi'])) {
						$data['coinListOld'][$one['coin']]['roi'] = 0;
					}
					$data['coinListOld'][$one['coin']]['logo'] = $one['logo'];
					if (isset($one['ads'])) {
						$data['coinListOld'][$one['coin']]['ads'] = $one['ads'];
						$data['coinListOld'][$one['coin']]['url'] = $one['url'];
					}
				}
			}
		}
		if ($type === 'roi') $sort = 'roi';
		if ($type === 'marketCap') $sort = 'market_cap';
		if ($type === 'coinSupply') $sort = 'coin_supply';
		if ($type === 'totalMasterNodes') $sort = 'totalMasterNodes';
		if ($type === 'coinsLocked') $sort = 'coinLocked';
		if ($type === 'dailyRev') $sort = 'dailyRev';
		if ($type === 'weeklyRev') $sort = 'weeklyRev';
		if ($type === 'monthlyRev') $sort = 'monthlyRev';
		if ($type === 'yearlyRev') $sort = 'yearlyRev';
		usort(
			$data['coinList'], function ($a, $b) use ($sort) {
			return $a[$sort] < $b[$sort];
		}
		);
		usort(
			$data['coinListOld'], function ($a, $b) use ($sort) {
			return $a[$sort] < $b[$sort];
		}
		);
		$data['clselect']           = $type;
		$data['clview']             = $view;
		$data['ComingSoonCoinList'] = $this->ComingSoonCoinList();
		$data['donateCoinList']     = json_decode(Storage::get('donateCoins.json'), true);
		if (is_array($data['donateCoinList'])) {
			usort(
				$data['donateCoinList'], function ($a, $b) {
				return $a['balance'] > $b['balance'];
			}
			);
		}
		return view('main.welcome', $data);
	}

	public function active()
	{
		$data     = null;
		$coinList = $this->coinList();
		foreach ($coinList as $one) {
			if (Storage::exists('' . strtolower($one['coin']) . '.json')) {
				$coinData                               = json_decode(Storage::get('' . strtolower($one['coin']) . '.json'), true);
				$data['coinList'][$one['coin']]         = $coinData;
				$data['coinList'][$one['coin']]['cmc']  = json_decode(Storage::get('' . strtolower($one['coin']) . '-CMC.json'), true);
				$data['coinList'][$one['coin']]['coin'] = $one['coin'];
				$data['coinList'][$one['coin']]['name'] = $one['name'];
				$data['coinList'][$one['coin']]['roi']  = $coinData['income']['yearly'] / number_format($coinData['currentUSDPrice'] * $coinData['masterNodeCoinsRequired'], 2, '.', '') * 100;
				$data['coinList'][$one['coin']]['logo'] = $one['logo'];
			}
		}
		usort(
			$data['coinList'], function ($a, $b) {
			return $a['roi'] < $b['roi'];
		}
		);
		return view('active', $data);
	}

	public function activeCoin($coin)
	{
		$data     = null;
		$coinList = $this->coinList();
		foreach ($coinList as $one) {
			if (Storage::exists('' . $one['coin'] . '.json')) {
				$coinData                               = json_decode(Storage::get('' . strtolower($one['coin']) . '.json'), true);
				$data['coinList'][$one['coin']]         = $coinData;
				$data['coinList'][$one['coin']]['coin'] = $one['coin'];
				$data['coinList'][$one['coin']]['name'] = $one['name'];
				$data['coinList'][$one['coin']]['roi']  = $coinData['income']['yearly'] / number_format($coinData['currentUSDPrice'] * $coinData['masterNodeCoinsRequired'], 2, '.', '') * 100;
				$data['coinList'][$one['coin']]['logo'] = $one['logo'];
			}
		}
		$data     = null;
		$coinList = $this->coinList();
		foreach ($coinList as $value) {
			if (strtolower($value['coin']) === strtolower($coin) || strtolower($value['name']) === strtolower($coin)) {
				$one                 = json_decode(Storage::get('' . strtolower($value['coin']) . '.json'), true);
				$one['coin']         = $value['coin'];
				$one['name']         = $value['name'];
				$one['roi']          = ($one['income']['yearly'] / number_format($one['currentUSDPrice'] * $one['masterNodeCoinsRequired'], 2, '.', '')) * 100;
				$one['logo']         = $value['logo'];
				$data['coinList'][0] = $one;
			}
		}
		return view('active', $data);
	}

	public function soon()
	{
		$data = null;

		$data['ComingSoonCoinList'] = $this->ComingSoonCoinList();
		return view('soon', $data);
	}

	public function soonCoin($coin)
	{
		$data     = null;
		$coinList = $this->ComingSoonCoinList();
		foreach ($coinList as $value) {
			if (strtolower($value['coin']) === strtolower($coin)) {
				$data['ComingSoonCoinList'][0] = $value;
			}
			if (strtolower($value['name']) === strtolower($coin)) {
				$data['ComingSoonCoinList'][0] = $value;
			}
		}
		return view('soon', $data);
	}

	public function donate()
	{
		$data                   = null;
		$data['donateCoinList'] = json_decode(Storage::get('donateCoins.json'), true);
		usort(
			$data['donateCoinList'], function ($a, $b) {
			return $a['balance'] > $b['balance'];
		}
		);
		return view('donate', $data);
	}

	public function donateCoin($coin)
	{
		$data     = null;
		$coinList = json_decode(Storage::get('donateCoins.json'), true);
		foreach ($coinList as $value) {
			if (strtolower($value['coin']) === strtolower($coin)) {
				$data['donateCoinList'][0] = $value;
			}
			if (strtolower($value['name']) === strtolower($coin)) {
				$data['donateCoinList'][0] = $value;
			}
		}
		return view('donate', $data);
	}

	public function getBalance($donate)
	{
		$client = new Client();
		$total  = 0;
		foreach ($donate as $key => $value) {
			if ($key === 'bitcoin') {
				try {
					$res        = $client->request(
						'GET', 'https://blockchain.info/q/getreceivedbyaddress/' . $value . '?api_code=4721538e-899d-456e-890b-0967fffac802'
					);
					$contentCMC = (float)$res->getBody()->getContents();
				}
				catch (\Exception $e) {
					$contentCMC = 0.00;
				}
				$total = $total + ($contentCMC / 100000000);
			} else {
				$url       = 'http://chainz.cryptoid.info/' . $key . '/api.dws?q=ticker.btc';
				$res       = $client->request(
					'GET', $url
				);
				$tickerBTC = (float)$res->getBody()->getContents();
				$url       = 'http://chainz.cryptoid.info/' . $key . '/api.dws?q=getreceivedbyaddress&a=' . $value;
				$res       = $client->request(
					'GET', $url
				);
				$cointotal = (float)$res->getBody()->getContents();
				$coin2btc  = number_format($cointotal * $tickerBTC, '8', '.', '');
				$total     = $total + $coin2btc;
			}
		}
		return $total;
	}


	// COIN LISTS

	public function ComingSoonCoinList()
	{
		$i             = 0;
		$coin          = [];
		$coin['name']  = 'MarteXcoin';
		$coin['coin']  = 'mxt';
		$coin['url']   = 'http://martexcoin.org/';
		$coin['logo']  = 'https://files.coinmarketcap.com/static/img/coins/128x128/martexcoin.png';
		$coin['notes'] = 'Waiting for CodeBase updates of ActiveCoins';
		$coins[$i]     = $coin;
		$i++;
		$coin          = [];
		$coin['name']  = 'Flaxscript';
		$coin['coin']  = 'flax';
		$coin['url']   = 'http://flaxscript.org/';
		$coin['logo']  = 'https://files.coinmarketcap.com/static/img/coins/128x128/flaxscript.png';
		$coin['notes'] = 'Waiting for CodeBase updates of ActiveCoins';
		$coins[$i]     = $coin;
		$i++;
		$coin          = [];
		$coin['name']  = 'DigitalPrice';
		$coin['coin']  = 'DP';
		$coin['url']   = 'https://bitcointalk.org/index.php?topic=2120481.new';
		$coin['logo']  = 'https://files.coinmarketcap.com/static/img/coins/128x128/digitalprice.png';
		$coin['notes'] = 'Waiting for CodeBase updates of ActiveCoins';
		$coins[$i]     = $coin;
		$i++;
		$coin          = [];
		$coin['name']  = 'PepeCoin';
		$coin['coin']  = 'pepe';
		$coin['url']   = 'https://bitcointalk.org/index.php?topic=1391598.0';
		$coin['logo']  = 'https://files.coinmarketcap.com/static/img/coins/128x128/memetic.png';
		$coin['notes'] = 'Waiting for CodeBase updates of ActiveCoins';
		$coins[$i]     = $coin;
		$i++;
		$coin          = [];
		$coin['name']  = 'CoinonatX';
		$coin['coin']  = 'xcxt';
		$coin['url']   = 'http://coinonatx.com/';
		$coin['logo']  = 'https://files.coinmarketcap.com/static/img/coins/128x128/coinonatx.png';
		$coin['notes'] = 'Waiting for CodeBase updates of ActiveCoins';
		$coins[$i]     = $coin;
		$i++;
		$coin          = [];
		$coin['name']  = 'TerraCoin';
		$coin['coin']  = 'trc';
		$coin['url']   = 'http://www.terracoin.info/';
		$coin['logo']  = 'https://files.coinmarketcap.com/static/img/coins/128x128/terracoin.png';
		$coin['notes'] = 'ONHOLD Waiting for HardFork to enable MasterNodes';
		$coins[$i]     = $coin;
		$i++;
		$coin          = [];
		$coin['name']  = 'PIECoin';
		$coin['coin']  = 'PIE';
		$coin['url']   = 'http://piecoin.info/';
		$coin['logo']  = 'https://files.coinmarketcap.com/static/img/coins/128x128/piecoin.png';
		$coin['notes'] = 'ONHOLD Per request from CoinDev';
		$coins[$i]     = $coin;
		$i++;
		$coin          = [];
		$coin['name']  = 'InsaneCoin';
		$coin['coin']  = 'INSN';
		$coin['notes'] = 'ONHOLD Per request from CoinDev';
		$coin['url']   = 'http://www.insanecoin.com/';
		$coin['logo']  = 'https://files.coinmarketcap.com/static/img/coins/128x128/insanecoin-insn.png';
		$coins[$i]     = $coin;
		$i++;
		$coin          = [];
		$coin['name']  = 'Wagerr';
		$coin['coin']  = 'wgr';
		$coin['notes'] = 'ONHOLD Per request from CoinDev';
		$coin['url']   = 'http://www.wagerr.com/';
		$coin['logo']  = '/img/wager.png';
		$coins[$i]     = $coin;
		$i++;
		foreach ($coins as $one) {
			$data[$one['coin']] = $one;
		}
		return $data;
	}

	public function donateCoinList()
	{
		$client     = new Client();
		$resCMCCORE = $client->request(
			'GET', 'https://blockchain.info/ticker'
		);
		$i          = 0;
		$ticker     = json_decode($resCMCCORE->getBody()->getContents(), true);

		$coin                      = [];
		$coin['name']              = 'MonacoCoin';
		$coin['coin']              = 'XMCC';
		$coin['url']               = 'http://www.monacocoin.net/';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/monacocoin.png';
		$coin['donate']['bitcoin'] = '1CzhURHzEpYfNZ9iFX71uCgzNYAEJ6y9cW';
		$coin['current']           = (float)($this->getBalance($coin['donate']) * $ticker['USD']['15m']);
		$coin['need']              = 400;
		$coin['balance']           = $coin['need'] - $coin['current'];
		$coins[$i]                 = $coin;
		$i++;


		$coin                      = [];
		$coin['name']              = 'AmsterdamCoin';
		$coin['coin']              = 'AMS';
		$coin['url']               = 'https://bitcointalk.org/index.php?topic=1152947.0';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/amsterdamcoin.png';
		$coin['donate']['bitcoin'] = '1NehzUSWN4PXsgacywY77LDujQCswAy8iH';
		$coin['current']           = (float)($this->getBalance($coin['donate']) * $ticker['USD']['15m']);
		$coin['need']              = 400;
		$coin['balance']           = $coin['need'] - $coin['current'];
		$coins[$i]                 = $coin;
		$i++;

		$coin                      = [];
		$coin['name']              = 'Vsync';
		$coin['coin']              = 'VSX';
		$coin['url']               = 'https://bitcointalk.org/index.php?topic=2133048.0';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/vsync.png';
		$coin['donate']['bitcoin'] = '12ymoQwY3QXg9naat82VHpc5cFFEq7rcPW';
		$coin['current']           = (float)($this->getBalance($coin['donate']) * $ticker['USD']['15m']);
		$coin['need']              = 400;
		$coin['balance']           = $coin['need'] - $coin['current'];
		$coins[$i]                 = $coin;
		$i++;

		$coin                      = [];
		$coin['name']              = 'Bitradio';
		$coin['coin']              = 'BRO';
		$coin['url']               = 'http://www.bitrad.io/';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/bitradio.png';
		$coin['donate']['bitcoin'] = '1wRRMpXM65JBpeAQwBEXbwJgiNodd4Nqa';
		$coin['current']           = (float)($this->getBalance($coin['donate']) * $ticker['USD']['15m']);
		$coin['need']              = 400;
		$coin['balance']           = $coin['need'] - $coin['current'];
		$coins[$i]                 = $coin;
		$i++;

		// Old coin $200 credit
		$coin                      = [];
		$coin['name']              = 'TransferCoin';
		$coin['coin']              = 'TX';
		$coin['url']               = 'http://txproject.io/';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/transfercoin.png';
		$coin['donate']['bitcoin'] = '147jcyRuHY1HLZgfPdJngmA6CToHuuMBgG';
		$coin['current']           = (float)($this->getBalance($coin['donate']) * $ticker['USD']['15m']) + 200;
		$coin['need']              = 400;
		$coin['balance']           = $coin['need'] - $coin['current'];
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = '8Bit';
		$coin['coin']              = '8bit';
		$coin['url']               = 'http://www.8-bit.ga/';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/8bit.png';
		$coin['donate']['bitcoin'] = '17oi1eAEak2PgADLUKKUDvPrvynxXsSgXE';
		$coin['current']           = (float)($this->getBalance($coin['donate']) * $ticker['USD']['15m']) + 200;
		$coin['need']              = 400;
		$coin['balance']           = $coin['need'] - $coin['current'];
		$coins[$i]                 = $coin;
		$i++;
		foreach ($coins as $one) {
			$data[$one['coin']] = $one;
		}
		Storage::put('donateCoins.json', json_encode($data));
	}

	public function coinList()
	{
		$i                         = 0;
		$coin                      = [];
		$coin['name']              = 'ION';
		$coin['coin']              = 'ion';
		$coin['listed']            = '05/01/2016';
		$coin['tagable']['active'] = true;
		$coin['tagable']['daemon'] = 'iond';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['logo']              = '//ion.masternodes.pro/img/logo.png';
		$coins[$i]                 = $coin;
		$i++;


		$coin                      = [];
		$coin['name']              = 'Braincoin';
		$coin['coin']              = 'BRAIN';
		$coin['listed']            = '08/15/2017';
		$coin['tagable']['active'] = true;
		$coin['tagable']['daemon'] = 'brain-cli';
		$coin['url']               = 'https://cryptocointalk.com/topic/46137-braincoin-info-powpossoon';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/braincoin.png';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'Cream';
		$coin['coin']              = 'crm';
		$coin['url']               = 'https://creamcoin.com/';
		$coin['listed']            = '08/14/2017';
		$coin['tagable']['active'] = true;
		$coin['tagable']['daemon'] = 'creamd';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/cream.png';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'DAS';
		$coin['coin']              = 'das';
		$coin['listed']            = '08/08/2017';
		$coin['tagable']['active'] = true;
		$coin['tagable']['daemon'] = 'das-cli';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/das.png';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coins[$i]                 = $coin;
		$i++;

		$coin                      = [];
		$coin['name']              = 'SIBCoin';
		$coin['coin']              = 'SIB';
		$coin['url']               = 'http://sibcoin.org/';
		$coin['listed']            = '08/01/2017';
		$coin['tagable']['active'] = false;
		$coin['tagable']['daemon'] = 'sibcoin-cli';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/sibcoin.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'Linda';
		$coin['coin']              = 'linda';
		$coin['url']               = 'http://lindacoin.com/';
		$coin['listed']            = '08/01/2017';
		$coin['tagable']['active'] = false;
		$coin['tagable']['daemon'] = 'Linda';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/linda.png';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'Crown';
		$coin['coin']              = 'CRW';
		$coin['listed']            = '07/31/2017';
		$coin['url']               = 'http://crown.tech/';
		$coin['tagable']['active'] = false;
		$coin['tagable']['daemon'] = 'crown-cli';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/crown.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'Renos';
		$coin['coin']              = 'RNS';
		$coin['tagable']['active'] = true;
		$coin['tagable']['daemon'] = 'renosd';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['listed']            = '07/27/2017';
		$ads['start']              = '07/27/2017';
		$ads['end']                = '08/28/2017';
		$ads['cost']               = '5000RNS';
		$ads['location']           = 'top';
		$ads['type']               = 'list';
		$coin['ads']               = $ads;
		$coin['url']               = 'https://renoscoin.com/?track=MNP';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/renos.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'ChainCoin';
		$coin['coin']              = 'chc';
		$coin['listed']            = '07/27/2017';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['tagable']['active'] = false;
		$coin['tagable']['daemon'] = 'chaincoin-cli';
		$coin['badroi']            = true;
		$coin['logo']              = '//chc.masternodes.pro/img/logo.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'PIVX';
		$coin['coin']              = 'pivx';
		$coin['listed']            = '07/27/2017';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['tagable']['active'] = true;
		$coin['tagable']['daemon'] = 'pivx-cli';
		$coin['badroi']            = true;
		$coin['logo']              = 'https://raw.githubusercontent.com/PIVX-Project/Official-PIVX-Graphics/master/digital/bottom%20tag/portrait/White/White_Port.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'Neutron';
		$coin['coin']              = 'ntrn';
		$coin['listed']            = '07/27/2017';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['tagable']['active'] = true;
		$coin['tagable']['daemon'] = 'Neutrond';
		$coin['logo']              = 'https://static.wixstatic.com/media/f2591a_f17f4b3fcbb74848b2bccf59bbeae490~mv2.png/v1/fill/w_708,h_520,al_c,lg_1/f2591a_f17f4b3fcbb74848b2bccf59bbeae490~mv2.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'ArcticCoin';
		$coin['coin']              = 'arc';
		$coin['listed']            = '07/27/2017';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['tagable']['active'] = false;
		$coin['tagable']['daemon'] = 'arcticcoin-cli';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/arcticcoin.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'CRAVE';
		$coin['coin']              = 'crave';
		$coin['listed']            = '07/27/2017';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['tagable']['active'] = true;
		$coin['tagable']['daemon'] = 'craved';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/crave.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'MonetaryUnit';
		$coin['coin']              = 'MUE';
		$coin['listed']            = '07/27/2017';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['tagable']['active'] = false;
		$coin['tagable']['daemon'] = 'mue-cli';
		$coin['url']               = 'http://www.monetaryunit.org/';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/monetaryunit.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'ExclusiveCoin';
		$coin['coin']              = 'EXCL';
		$coin['listed']            = '07/27/2017';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['tagable']['active'] = false;
		$coin['tagable']['daemon'] = 'exclusivecoind';
		$coin['url']               = 'http://exclusivecoin.pw/';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/exclusivecoin.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'DASH';
		$coin['coin']              = 'DASH';
		$coin['listed']            = '07/27/2017';
		$coin['tagable']['active'] = false;
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['tagable']['daemon'] = 'dash-cli';
		$coin['url']               = 'https://www.dash.org/';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/dash.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'Syndicate';
		$coin['coin']              = 'SYNX';
		$coin['listed']            = '07/27/2017';
		$coin['tagable']['active'] = false;
		$coin['tagable']['daemon'] = 'Syndicated';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['url']               = 'http://syndicatelabs.io/';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/syndicate.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'Eternity';
		$coin['coin']              = 'ent';
		$coin['listed']            = '07/27/2017';
		$coin['tagable']['active'] = false;
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['tagable']['daemon'] = 'eternity-cli';
		$coin['url']               = 'http://ent.eternity-group.org/';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/eternity.png';
		$coins[$i]                 = $coin;
		$i++;
		$coin                      = [];
		$coin['name']              = 'Bitsend';
		$coin['coin']              = 'bsd';
		$coin['tagable']['active'] = false;
		$coin['tagable']['daemon'] = 'bitsend-cli';
		$coin['notes']             = "New Wallet, Moving DB to ElasticSearch, New Stats Site!";
		$coin['url']               = 'http://www.bitsend.info/';
		$coin['logo']              = 'https://files.coinmarketcap.com/static/img/coins/128x128/bitsend.png';
		$coins[$i]                 = $coin;
		$i++;
		return $coins;
	}

	// END COIN LISTS

	public function callCoinAPIS()
	{
		$this->CallCoinMarketCap();
		$coinList = $this->coinList();
		foreach ($coinList as $one) {
			$this->coinApi($one['coin']);
		}
		$coinDonateList = $this->donateCoinList();
	}

	public function coinApi($name)
	{
		$stats = new stats();
//		$client = new Client();
//		try {
//			$res = $client->request(
//				'GET', 'http://masternodes.pro/stats/' . strtolower($name) . '/api/datapack'
//			);
//		}
//		catch (\Exception $ex) {
//			echo "http://masternodes.pro/stats/".strtolower($name)."/api/datapack AGH!<br>";
//		}
//		if (isset($res)) {
//			$content = $res->getBody();
			$content = $stats->DataPackCore(strtolower($name));
//			if ($this->isJson($content)) {
			echo 'GOT THIS '.strtolower($name).'<br>';
			Storage::put('' . strtolower($name) . '.json', $content);
//			}
//		}
	}

	function isJson($string)
	{
		return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
	}

	public function GetPrice($coin)
	{
		return Storage::get('' . strtolower($coin) . '-CMC.json');
	}

	public function CallCoinMarketCap()
	{
		$es         = new elasticSearch();
		$client     = new Client();
		$resCMCCORE = $client->request(
			'GET', 'https://api.coinmarketcap.com/v1/ticker/'
		);
		$contentCMC = $resCMCCORE->getBody();
		$CORE       = json_decode($contentCMC, true);
		$resCMCCORE = $client->request(
			'GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=GBP'
		);
		$contentCMC = $resCMCCORE->getBody();
		$GBP        = json_decode($contentCMC, true);
		$resCMCCORE = $client->request(
			'GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=AUD'
		);
		$contentCMC = $resCMCCORE->getBody();
		$AUD        = json_decode($contentCMC, true);
		$resCMCCORE = $client->request(
			'GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=CAD'
		);
		$contentCMC = $resCMCCORE->getBody();
		$CAD        = json_decode($contentCMC, true);
		$resCMCCORE = $client->request(
			'GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=CNY'
		);
		$contentCMC = $resCMCCORE->getBody();
		$CNY        = json_decode($contentCMC, true);
		$resCMCCORE = $client->request(
			'GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=RUB'
		);
		$contentCMC = $resCMCCORE->getBody();
		$RUB        = json_decode($contentCMC, true);

		$coinList           = $this->coinList();
		$ComingSoonCoinList = $this->ComingSoonCoinList();
		$NewCore            = [];
		foreach ($CORE as $key => $coin) {
			foreach ($GBP as $ALTcoin) {
				if ($ALTcoin['symbol'] === $coin['symbol']) {
					$coin['price_gbp'] = $ALTcoin['price_gbp'];
				}
			}
			foreach ($AUD as $ALTcoin) {
				if ($ALTcoin['symbol'] === $coin['symbol']) {
					$coin['price_aud'] = $ALTcoin['price_aud'];
				}
			}
			foreach ($CAD as $ALTcoin) {
				if ($ALTcoin['symbol'] === $coin['symbol']) {
					$coin['price_cad'] = $ALTcoin['price_cad'];
				}
			}
			foreach ($CNY as $ALTcoin) {
				if ($ALTcoin['symbol'] === $coin['symbol']) {
					$coin['price_cny'] = $ALTcoin['price_cny'];
				}
			}
			foreach ($RUB as $ALTcoin) {
				if ($ALTcoin['symbol'] === $coin['symbol']) {
					$coin['price_rub'] = $ALTcoin['price_rub'];
				}
			}
			foreach ($coinList as $one) {
				if (strtoupper($coin['name']) === strtoupper($one['name'])) {
					$coin['lastUpdate'] = (float)time();
					$config['ES_coin']  = strtolower($one['coin']);
					$config['ES_type']  = 'coinmarketcap';
					$config['ES_id']    = time();
					$es->esPUT($coin, $config);
					Storage::put('' . strtolower($one['coin']) . '-CMC.json', json_encode($coin));
					$NewCore[] = $coin;
				}
			}
			foreach ($ComingSoonCoinList as $one) {
				if (strtoupper($coin['name']) === strtoupper($one['name'])) {
					$coin['lastUpdate'] = (float)time();
					$config['ES_coin']  = strtolower($one['coin']);
					$config['ES_type']  = 'coinmarketcap';
					$config['ES_id']    = time();
					$es->esPUT($coin, $config);
					Storage::put('' . strtolower($one['coin']) . '-CMC.json', json_encode($coin));
					$NewCore[] = $coin;
				}
			}
		}
		$Data = $NewCore;
		return "<pre>" . json_encode($Data, JSON_PRETTY_PRINT) . "</pre>";
	}

}