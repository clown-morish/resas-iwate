<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandController extends Controller
{
	public function __construct(Request $request)
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
		$Land['iwate'] = $this->getLand($this->firstPrefCode,$this->firstCityCode);
		$Land['tokyo'] = $this->getLand($this->secondPrefCode,$this->secondCityCode);
		return response()->json($Land);
	}

	public function getLand($pref_cd, $city_cd)
	{
		$api_key = "UPX5SZobrRouNAHKJksmpsixcgtDbcQfPXCo2UV9";
		$headers = [
			"Content-Type: application/json",
			"X-API-KEY: " . $api_key,
		];
		$url = "https://opendata.resas-portal.go.jp/api/v1/forestry/land/forStacked?prefCode=".$pref_cd."&cityCode=".$city_cd;
		$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$res = curl_exec($curl);
		curl_close($curl);
		$res_array = json_decode($res, true);

		$recent_num = count($res_array['result']['years'])-1;

		$result['year'] = $res_array['result']['years'][1]['year'];
		$result['privatearea'] = $res_array['result']['years'][1]['statearea'];
		$result['statearea'] = $res_array['result']['years'][1]['privatearea'];
		
		return $result;
	}
}
