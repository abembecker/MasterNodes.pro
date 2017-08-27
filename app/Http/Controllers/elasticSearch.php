<?php

namespace App\Http\Controllers;

class elasticSearch extends Controller
{

	private $search_host = '10.99.0.201';
	private $search_port = '9200';

	private function buildURL($config)
	{
		$url = 'http://' . $this->search_host . ':' . $this->search_port . '/';
		if (isset($config['ES_coin'])) {
			$url .= $config['ES_coin'] . '/';
			if (isset($config['ES_type'])) {
				$url .= $config['ES_type'] . '/';
				if (isset($config['ES_id'])) {
					$url .= $config['ES_id'] . '';
				}
			}
		}
		return $url;
	}

	function esPUT($process, $config)
	{
		$json_doc = json_encode($process, JSON_PRETTY_PRINT);
		$baseUri  = $this->buildURL($config);

		$ci = curl_init();
		curl_setopt($ci, CURLOPT_URL, $baseUri);
		curl_setopt($ci, CURLOPT_PORT, $this->search_port);
		curl_setopt($ci, CURLOPT_TIMEOUT, 200);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ci, CURLOPT_FORBID_REUSE, 0);
		curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ci, CURLOPT_POSTFIELDS, $json_doc);
		$response = curl_exec($ci);

		return $response;
	}

	function esSEARCH($process, $config)
	{
		$json_doc = json_encode($process, JSON_PRETTY_PRINT);
		$baseUri  = $this->buildURL($config) . '_search';
		$ci = curl_init();
		curl_setopt($ci, CURLOPT_URL, $baseUri);
		curl_setopt($ci, CURLOPT_PORT, $this->search_port);
		curl_setopt($ci, CURLOPT_TIMEOUT, 200);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ci, CURLOPT_FORBID_REUSE, 0);
		curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ci, CURLOPT_POSTFIELDS, $json_doc);
		$response = curl_exec($ci);
		$res      = json_decode($response, true);
		$return   = json_encode($res['hits']['hits']);
		return $return;
	}

	function esGET($config)
	{
		$baseUri = $this->buildURL($config);

		$ci = curl_init();
		curl_setopt($ci, CURLOPT_URL, $baseUri);
		curl_setopt($ci, CURLOPT_PORT, $this->search_port);
		curl_setopt($ci, CURLOPT_TIMEOUT, 200);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ci, CURLOPT_FORBID_REUSE, 0);
		curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'GET');
		$response = curl_exec($ci);
		$res      = json_decode($response, true);
		if (isset($res['_source'])) {
			$return = json_encode($res['_source']);
			return $return;
		}
	}

	function esUPDATE($process, $config)
	{
		$json_doc = json_encode($process, JSON_PRETTY_PRINT);
		$baseUri  = $this->buildURL($config) . '/_update';

		$ci = curl_init();
		curl_setopt($ci, CURLOPT_URL, $baseUri);
		curl_setopt($ci, CURLOPT_PORT, $this->search_port);
		curl_setopt($ci, CURLOPT_TIMEOUT, 200);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ci, CURLOPT_FORBID_REUSE, 0);
		curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ci, CURLOPT_POSTFIELDS, $json_doc);
		$response = curl_exec($ci);

		return $response;
	}
}