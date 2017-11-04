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
		$takizawa_pop = $this->getPopulation($this->iwate_cd,$this->takizawa_cd);
		$tokyo_pop = $this->getPopulation($this->tokyo_cd,$this->sinjuku_cd);

		dd($tokyo_pop);
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
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($curl);
		$result = json_decode($response, true);
	}
}
