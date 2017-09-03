<?php

namespace App\Http\Controllers;

use App\Blocks;
use Validator, Input, Redirect, View, Auth;
use App\Mnl;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\elasticSearch;

class DonateList extends Controller
{
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

	public function donateCoinList()
	{
		$client     = new Client();
		$resCMCCORE = $client->request(
			'GET', 'https://blockchain.info/ticker'
		);
		$i          = 0;
		$ticker     = json_decode($resCMCCORE->getBody()->getContents(), true);

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
}