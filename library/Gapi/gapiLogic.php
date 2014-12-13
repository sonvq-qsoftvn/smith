<?php

class gapiLogic {

	protected $ga;
	protected $profileid;
	protected $startdate;
	protected $enddate;

	public function __construct($account, $password, $profileid) {
		try {
			$this->ga = new gManagementApi($account, $password);
		} catch (Exception $e) {
        	$analytics = new SxCms_Analytics();
			$analytics->unsetAll()
				->save();
			header('Location: /admin/analytics');
			exit;
		}
		if (!isset($e)) {
			$this->profileid = $profileid;
		}
	}

	public function setDates($from, $to) {
		$this->startdate = $from;
		$this->enddate = $to;
	}

	public function secondsTotime($seconds) {
		$minutes = floor($seconds/60);
		$seconds = round($seconds-($minutes*60));
		return ($minutes>0?"$minutes ".($minutes>1?"minuten ":"minuut "):"")."$seconds ".($seconds>1||$seconds<1?"seconden":"seconde");
	}

	public function getVisits() {
		$this->ga->requestReportData($this->profileid, array('date'), array("visits"), 'date', null, $this->startdate, $this->enddate, 1, 365);
		foreach ($this->ga->getResults() as $result) {
			$day[] = (string)$result;
			$visits[] = $result->getVisits();
		}
		if (!isset($day) OR !isset($visits)) {
			$day[] = "Niet genoeg data beschikbaar";
			$visits[] = "0";
		}
		$return = array("day" => $day, "visits" => $visits);
		return $return;
	}

	public function getTopkeywords($max = 5) {
		$this->ga->requestReportData($this->profileid, array('keyword'), array('pageviews'), array('-pageviews'), 'keyword != (not set) && keyword != (not provided)', $this->startdate, $this->enddate, 1, $max);
		foreach ($this->ga->getResults() as $result) {
		    $keyword[] = $result->getKeyword();
		    $searches[] = $result->getpageViews();
		}
		if (!isset($keyword) OR !isset($searches)) {
			$keyword[] = "Niet genoeg data beschikbaar";
			$searches[] = "0";
		}
		$return = array("keyword" => $keyword, "searches" => $searches);
		return $return;
	}

	public function getCountries() {
		$this->ga->requestReportData($this->profileid, array('country', 'continent'), array('visits'), array('-visits'), 'country != (not set) && continent != (not set)', $this->startdate, $this->enddate);
		$isocodes = array("Africa" => "002", "Europe" => "150", "Americas" => "019", "Asia" => "142", "Oceania" => "009");
		foreach ($this->ga->getResults() as $result) {
		    $country[] = $result->getCountry();
			$continent[] = $isocodes[$result->getContinent()];
		    $visits[] = $result->getVisits();
		}
		if (!isset($country) OR !isset($continent) OR !isset($visits)) {
			$country[] = "Niet genoeg data beschikbaar";
			$continent[] = "Niet genoeg data beschikbaar";
			$visits[] = "0";
		}
		$return = array("country" => $country, "continent" => $continent, "visits" => $visits);
		return $return;
	}

	public function getCities($country) {
		$this->ga->requestReportData($this->profileid, array('city', 'country', 'latitude', 'longitude'), array('visits'), array('-visits'), 'city != (not set) && country == '.$country, $this->startdate, $this->enddate, 1, 200);
		foreach ($this->ga->getResults() as $result) {
			if (!isset($city) || !in_array($result->getCity(), $city)) {
			    $city[] = $result->getCity();
				$latitude[] = $result->getLatitude();
				$longitude[] = $result->getLongitude();
			    $visits[] = $result->getVisits();
			} else {
				$key = array_search($result->getCity(), $city);
				$visits[$key] += $result->getVisits();
			}
		}
		if (!isset($city) OR !isset($visits)) {
			$city[] = "Niet genoeg data beschikbaar";
			$latitude[] = "Niet genoeg data beschikbaar";
			$longitude[] = "Niet genoeg data beschikbaar";
			$visits[] = "0";
		}
		$return = array("city" => $city, "latitude" => $latitude, "longitude" => $longitude, "visits" => $visits);
		return $return;
	}

	public function getTopsources($max = 5) {
		$this->ga->requestReportData($this->profileid, array('source'), array('visits'), array('-visits'), 'source != (direct)', $this->startdate, $this->enddate, 1, $max);
		foreach ($this->ga->getResults() as $result) {
		    $source[] = $result->getSource();
		    $visits[] = $result->getVisits();
		}
		if (!isset($source) OR !isset($visits)) {
			$source[] = "Niet genoeg data beschikbaar";
			$visits[] = "0";
		}
		$return = array("source" => $source, "visits" => $visits);
		return $return;
	}

	public function getMedium() {
		$this->ga->requestReportData($this->profileid, array('medium'), array('visits'), array('-visits'), 'medium == organic || medium == (none)', $this->startdate, $this->enddate);
		foreach ($this->ga->getResults() as $result) {
			if ($result->getMedium() == "organic") {
				$medium[] = "Zoekmachines";
				$visits[] = $result->getVisits();
			} else {
				$medium[] = "Direct";
				$visits[] = $result->getVisits();
			}
		}
		if (!isset($medium) OR !isset($visits)) {
			$medium[] = "Niet genoeg data beschikbaar";
			$visits[] = "0";
		}
		$return = array("medium" => $medium, "visits" => $visits);
		return $return;
	}

	public function getToppages($max = 5) {
		$this->ga->requestReportData($this->profileid, array('pagePath','pageTitle'), array('pageviews'), '-pageviews', null, $this->startdate, $this->enddate, 1, $max);
		foreach ($this->ga->getResults() as $result) {
			$titles[] = $result->getpageTitle();
			$numbers[] = $result->getpageViews();
		}
		if (!isset($titles) OR !isset($numbers)) {
			$titles[] = "Niet genoeg data beschikbaar";
			$numbers[] = "0";
		}
		$return = array("titles" => $titles, "numbers" => $numbers);
		return $return;
	}

	public function getAllpages($start = 1, $max = 30) {
		$this->ga->requestReportData($this->profileid, array('pagePath', 'pageTitle', 'hostname'), array('pageviews', 'avgPageLoadTime'), '-pageviews', null, $this->startdate, $this->enddate, $start, $max);
		foreach ($this->ga->getResults() as $result) {
			$path[] = $result->gethostName()."".$result->getpagePath();
			$title[] = $result->getpageTitle();
			$visits[] = $result->getpageViews();
			$loadtime[] = $result->getAvgpageloadtime();
		}
		if (!isset($path) OR !isset($title) OR !isset($visits)) {
			$path[] = "#";
			$title[] = "Niet genoeg data beschikbaar";
			$visits[] = "0";
			$loadtime[] = "0";
		}
		if (count($path) < 30) $path[] = $title[] = $visits[] = $loadtime[] = "last";
		$return = array("path" => $path, "title" => $title, "visits" => $visits, "loadtime" => $loadtime);
		return $return;
	}

	public function getAllkeywords($start = 1, $max = 30) {
		$this->ga->requestReportData($this->profileid, array('keyword'), array('pageviews'), array('-pageviews'), 'keyword != (not set) && keyword != (not provided)', $this->startdate, $this->enddate, $start, $max);
		foreach ($this->ga->getResults() as $result) {
			$keyword[] = $result->getKeyword();
			$searches[] = $result->getpageViews();
		}
		if (!isset($keyword) OR !isset($searches)) {
			$keyword[] = "Niet genoeg data beschikbaar";
			$searches[] = "0";
		}
		if (count($keyword) < 30) $keyword[] = $searches[] = "last";
		$return = array("keyword" => $keyword, "searches" => $searches);
		return $return;
	}

	public function getTotals() {
		$this->ga->requestReportData($this->profileid, array('pagePath'), array('pageviews', 'visits', 'avgTimeOnPage', 'avgTimeOnSite'), null, null, $this->startdate, $this->enddate);
		$return = array("pageviews" => $this->ga->getpageViews(), "visits" => $this->ga->getVisits(), "averagetime" => $this->secondsTotime($this->ga->getavgtimeonSite()));
		return $return;
	}

	public function getVisitsLastWeek() {
		$this->ga->requestReportData($this->profileid, array('pagePath'), array('visits'), null, null, date('Y-m-d', strtotime('-7 days')), date('Y-m-d'));
		$return = array("visits" => $this->ga->getVisits());
		return $return;
	}

	public function getPagesLastWeek($max = 3) {
		$this->ga->requestReportData($this->profileid, array('pagePath','pageTitle', 'hostname'), array('pageviews'), '-pageviews', null, date('Y-m-d', strtotime('-7 days')), date('Y-m-d'), 1, $max);
		foreach ($this->ga->getResults() as $result) {
			$path[] = $result->gethostName()."".$result->getpagePath();
			$title[] = $result->getpageTitle();
			$visits[] = $result->getpageViews();
		}
		if (!isset($path) OR !isset($title) OR !isset($visits)) {
			$path[] = "Niet genoeg data beschikbaar";
			$title[] = "Niet genoeg data beschikbaar";
			$visits[] = "0";
		}
		$return = array("path" => $path, "title" => $title, "visits" => $visits);
		return $return;
	}

	public function getAvgpageviews() {
		$totals = $this->getTotals();
		$return = round(($totals["pageviews"]<1?1:$totals["pageviews"])/($totals["visits"]<1?1:$totals["visits"]), 2);
		return array("average" => $return);
	}

	public function getUnique() {
		$this->ga->requestReportData($this->profileid, array('visitorType'), array("visits"), null, null, $this->startdate, $this->enddate);
		$return = 0;
		foreach ($this->ga->getResults() as $result) {
			if ((string)$result == "New Visitor")
				$return = array("unique" => $result->getVisits());
		}
		return $return;
	}

	public function getReturning() {
		$totals = $this->getTotals();
		$unique = $this->getUnique();
		$return = round(100*(1-($unique["unique"]/$totals["visits"])), 2);
		return array("returning" => $return);
	}

	public function getBrowsers($max = 5) {
		$this->ga->requestReportData($this->profileid, array('browser'), array('visits'), '-visits', null, $this->startdate, $this->enddate, 1, $max);
		foreach ($this->ga->getResults() as $result) {
			$browser[] = (string)$result;
			$visits[] = $result->getVisits();
		}
		if (!isset($browser) OR !isset($visits)) {
			$browser[] = "Niet genoeg data beschikbaar";
			$visits[] = "0";
		}
		$return = array("browser" => $browser, "visits" => $visits);
		return $return;
	}

	public function getMobile() {
		$this->ga->requestReportData($this->profileid, array('isMobile'), array('visits'), '-visits', null, $this->startdate, $this->enddate);
		foreach ($this->ga->getResults() as $result) {
			if ((string)$result == "Yes") $return["yes"] = $result->getVisits();
			else $return["no"] = $result->getVisits();
		}
		if (!isset($return["yes"])) $return["yes"] = 0;
		if (!isset($return["no"])) $return["no"] = 0;
		return $return;
	}

	public function getDevices($max = 5) {
		$this->ga->requestReportData($this->profileid, array('mobileDeviceInfo'), array('visits'), '-visits', 'mobileDeviceInfo != (not set) && mobileDeviceInfo != (not provided)', $this->startdate, $this->enddate, 1, $max);
		foreach ($this->ga->getResults() as $result) {
			$device[] = (string)$result;
			$visits[] = $result->getVisits();
		}
		if (!isset($device) OR !isset($visits)) {
			$device[] = "Niet genoeg data beschikbaar";
			$visits[] = "0";
		}
		$return = array("device" => $device, "visits" => $visits);
		return $return;
	}

}