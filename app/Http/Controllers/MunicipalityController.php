<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
	public function __construct(Request $request)
	{
		// 岩手県盛岡市
		$this->firstPrefCode = $request->firstPrefCode;
		// 東京都港区
		$this->secondPrefCode = $request->fecondPrefCode;
	}

	public function index()
	{
		$municipality['iwate'] = $this->getMunicipality($this->firstPrefCode);
		$municipality['tokyo'] = $this->getMunicipality($this->secondPrefCode);
		return response()->json($municipality);
	}

	public function getMunicipality($pref_cd)
	{
		$api_key = "UPX5SZobrRouNAHKJksmpsixcgtDbcQfPXCo2UV9";
		$headers = [
			"Content-Type: application/json",
			"X-API-KEY: " . $api_key,
		];
		$url = "https://opendata.resas-portal.go.jp/api/v1/municipality/job/perYear?prefCode=".$pref_cd;

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
