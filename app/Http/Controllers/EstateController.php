<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstateController extends Controller
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
		$Estate['iwate'] = $this->getEstate($this->firstPrefCode,$this->firstCityCode);
		$Estate['tokyo'] = $this->getEstate($this->secondPrefCode,$this->secondCityCode);
		return response()->json($Estate);
	}

	public function getEstate($pref_cd, $city_cd)
	{
		$api_key = "UPX5SZobrRouNAHKJksmpsixcgtDbcQfPXCo2UV9";
		$headers = [
			"Content-Type: application/json",
			"X-API-KEY: " . $api_key,
		];
		$url = "https://opendata.resas-portal.go.jp/api/v1/townPlanning/estateTransaction/bar?year=2015&prefCode=".$pref_cd."&cityCode=".$city_cd."&displayType=1";

		$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$res = curl_exec($curl);
		curl_close($curl);
		$res_array = json_decode($res, true);

		$result['year'] = $res_array['result']['years'][0]['year'];
		$result['value'] = $res_array['result']['years'][0]['value'];
		
		return $result;
	}
}
