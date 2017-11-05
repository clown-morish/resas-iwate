<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WageController extends Controller
{
	public function __construct()
	{
		// 岩手県盛岡市
		$this->firstPrefCode = $request->firstPrefCode;
		$this->firstCityCode = $request->firstCityCode;
		// 東京都港区
		$this->secondPrefCode = $request->secondPrefCode;
		$this->secondCityCode = $request->secondCityCode;
	}

	public function index()
	{
		$wages['iwate'] = $this->getWage($this->firstPrefCode,$this->firstCityCode);
		$wages['tokyo'] = $this->getWage($this->secondPrefCode,$this->secondCityCode);
		return response()->json($wages);
	}

	public function getWage($pref_cd, $city_cd)
	{
		$api_key = "UPX5SZobrRouNAHKJksmpsixcgtDbcQfPXCo2UV9";
		$headers = [
			"Content-Type: application/json",
			"X-API-KEY: " . $api_key,
		];
		$url = "https://opendata.resas-portal.go.jp/api/v1/municipality/wages/perYear?prefCode=".$pref_cd."&city_cd=".$city_cd."&simcCode=-&wagesAge=10&sicCode=-";
		$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$res = curl_exec($curl);
		curl_close($curl);
		$res_array = json_decode($res, true);
		$recent_num = count($res_array['result']['data'])-1;
		$result['year'] = $res_array['result']['data'][$recent_num]['year'];
		$result['value'] = $res_array['result']['data'][$recent_num]['value'];
		
		return $result;
	}
}
