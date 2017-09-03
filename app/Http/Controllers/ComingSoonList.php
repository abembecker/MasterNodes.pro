<?php

namespace App\Http\Controllers;

use App\Blocks;
use Validator, Input, Redirect, View, Auth;
use App\Mnl;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\elasticSearch;

class ComingSoonList extends Controller
{
	// COIN LISTS

	public function ComingSoonCoinList()
	{
		$i             = 0;
		$coin          = [];
		$coin['name']  = 'TerraCoin';
		$coin['coin']  = 'trc';
		$coin['url']   = 'http://www.terracoin.info/';
		$coin['logo']  = 'https://files.coinmarketcap.com/static/img/coins/128x128/terracoin.png';
		$coin['notes'] = 'Waiting for CodeBase updates of ActiveCoins';
		$coins[$i]     = $coin;
		$i++;
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

}