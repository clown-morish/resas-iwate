<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PopulationController extends Controller
{
	public function __construct()
	{
		$this->iwate_cd = "3";
		$this->tokyo_cd = "13";
		$this->takizawa_cd = "03216";
		$this->sinjuku_cd = "13104";
	}

	public function index()
	{
		$population['iwate'] = $this->getPopulation($this->iwate_cd,$this->takizawa_cd);
		$population['tokyo'] = $this->getPopulation($this->tokyo_cd,$this->sinjuku_cd);
		// return view('welcome',response()->json($population));
	}

	public function getPopulation($pref_cd, $city_cd)
	{
		$api_key = "UPX5SZobrRouNAHKJksmpsixcgtDbcQfPXCo2UV9";
		$headers = [
			"Content-Type: application/json",
			"X-API-KEY: " . $api_key,
		];
		$url = "https://opendata.resas-portal.go.jp/api/v1/townPlanning/commuteSchool/areaPopulationCircle?prefecture_cd=".$pref_cd."&city_cd=".$city_cd."&mode=2&year=2010";
		$curl = curl_init(); 
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$res = curl_exec($curl);
		curl_close($curl);
		$res_array = json_decode($res, true);

		$result['noonDataSum'] = $res_array['result']['noonDataSum'];
		$result['nightDataSum'] = $res_array['result']['nightDataSum'];
		$result['dayNightRate'] = $res_array['result']['dayNightRate'];
		
		return $result;
	}
}
