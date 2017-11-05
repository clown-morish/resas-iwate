<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function __construct()
	{
		// 岩手県盛岡市
		$this->firstPrefCode = "3";
		$this->firstCityCode = "03201";
		// 東京都港区
		$this->secondPrefCode = "13";
		$this->secondCityCode = "13103";
	}

	public function index()
	{
		$api_key = "UPX5SZobrRouNAHKJksmpsixcgtDbcQfPXCo2UV9";
		$headers = [
			"Content-Type: application/json",
			"X-API-KEY: " . $api_key,
		];
		$url = "https://opendata.resas-portal.go.jp/api/v1/cities?prefCode=".$this->firstPrefCode;
		$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$res = curl_exec($curl);
		curl_close($curl);
		$iwate_res = json_decode($res, true);
		$iwate = $iwate_res["result"];

		$url = "https://opendata.resas-portal.go.jp/api/v1/cities?prefCode=".$this->secondPrefCode;
		$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$res = curl_exec($curl);
		curl_close($curl);
		$tokyo_res = json_decode($res, true);
		$tokyo = $tokyo_res["result"];

		$cities = array('iwate' => $iwate, 'tokyo' => $tokyo);

		return view('index', $cities);	
	}

}
