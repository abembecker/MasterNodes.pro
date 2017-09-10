<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
	array('domain' => 'masternodes.pro'), function () {
	Route::get('/', array('uses' => 'coin@index'))->middleware('throttle:6');
	Route::get('/sortActiveView', array('uses' => 'coin@sortActiveView'))->middleware('throttle:6');
	Route::get('/active', array('uses' => 'coin@active'))->middleware('throttle:6');
	Route::get('/active/{coin}', array('uses' => 'coin@activeCoin'))->middleware('throttle:6');
	Route::get('/soon', array('uses' => 'coin@soon'))->middleware('throttle:6');
	Route::get('/soon/{coin}', array('uses' => 'coin@soonCoin'))->middleware('throttle:6');
	Route::get('/donate', array('uses' => 'coin@donate'))->middleware('throttle:6');
	Route::get('/donate/{coin}', array('uses' => 'coin@donateCoin'))->middleware('throttle:6');
	Route::get('/callCoinAPIS', array('uses' => 'coin@callCoinAPIS'))->middleware('throttle:2');
//Route::get('/CallCoinMarketCap', array('uses' => 'coin@CallCoinMarketCap'));
	Route::get('/getPrice/{coin}', array('uses' => 'coin@GetPrice'))->middleware('throttle:2');
//Route::get('/donateAPI', array('uses' => 'coin@donateCoinList'));
	/*  Stats Pages */
	Route::group(
		['prefix' => '/stats/{coin}/api', 'middleware' => 'throttle:2'], function () {
		Route::get('/datapack', array('uses' => 'stats@DataPack'));
	}
	);
	Route::get('/stats/{coin}', array('as' => 'statsIndex', 'uses' => 'stats@index'))->middleware('throttle:6');
	Route::get('/stats/{coin}/advanced/list', array('as' => 'advlist', 'uses' => 'stats@moreList'))->middleware('throttle:6');
	Route::get('/stats/{coin}/advanced/stats', array('as' => 'advstats', 'uses' => 'stats@moreStats'))->middleware('throttle:6');
	Route::get('/stats/{coin}/advanced/map', array('as' => 'advmap', 'uses' => 'stats@moreMap'))->middleware('throttle:6');
	Route::get('/stats/{coin}/advanced/graph', array('as' => 'advgraph', 'uses' => 'stats@moreLineGraphs'))->middleware('throttle:6');
	Route::get('/stats/{coin}/advanced/graph/data/', array('as' => 'mlgdata', 'uses' => 'stats@moreLineGraphsData'))->middleware('throttle:6');
	Route::get('/stats/{coin}/nodedetails/', array('as' => 'nodedetails', 'uses' => 'stats@nodeDetails'))->middleware('throttle:6');
	Route::get('/stats/{coin}/guides/', array('as' => 'guides', 'uses' => 'stats@guides'))->middleware('throttle:6');
}
);


Route::group(
	array('domain' => '{account}.masternodes.pro'), function () {
	Route::get(
		'/', function ($account) {
		if ($account === 'www') {
			return Redirect::to('http://masternodes.pro/');
		} else {
			return Redirect::to('http://masternodes.pro/stats/' . $account);
		}
	}
	);
}
);