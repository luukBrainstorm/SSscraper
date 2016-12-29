<?php

class Scrape {
	static $joblinks;
	static $jobIDs;
	static $jobListing;
	static $jobEmail;
	static $jobPlace;
	static $jobPhone;

	/**
	 * Scrape constructor.
	 */
	public function __construct() {
		self::$joblinks = [];
		self::$jobIDs = [];
		self::$jobListing = [];
		self::$jobEmail = [];
		self::$jobPlace = [];
		self::$jobPhone = [];
	}

	public function scrapeListing($search) {
		$keyword = $search;
		$url = "https://www.stepstone.nl/5/job-search.html?ke=" . $keyword . "&li=25";

		$doc = new DOMDocument;
		libxml_use_internal_errors(true);
		$doc->loadHTMLFile($url);
		$xpath = new DOMXPath($doc);
		$query = "//div[@class='jobitem__header']/a/@href";
		$query2 = "//div[@class='jobitem__header']";
		$query3 = "//li[@class='list-group-item']/@data-offer-anchor";
		$query4 = "//p[@class='jobitem__location']/a";
		$links = $xpath->query($query);
		$listing = $xpath->query($query2);
		$jobListing = $xpath->query($query3);
		$jobPlace = $xpath->query($query4);

		for ($ii = 0; $ii < $links->length; $ii++) {
			$jobID = $jobListing->item($ii)->nodeValue;
			$href = $links->item($ii)->nodeValue;
			$job = $listing->item($ii)->nodeValue;
			$location = $jobPlace->item($ii)->nodeValue;

			self::$jobPlace[$ii] = $location;
			self::$jobListing[$ii] = $job;
			self::$joblinks[$ii] = $href;
			self::$jobIDs[$ii] = explode("joblisting-", $jobID);
		}
	}

	public function getJobListing() {
		for ($ii = 0; $ii < count(self::$jobIDs); $ii++) {
			echo self::$jobListing[$ii] . "<br>";
		}
	}

	public function getEmail() {
		for ($ii = 0; $ii < count(self::$jobIDs); $ii++) {
			echo self::$jobEmail[$ii];
		}
	}

	public function getPhoneNumber() {
		for ($ii = 0; $ii < count(self::$jobIDs); $ii++) {
			echo self::$jobEmail[$ii] = $this->getJobIframe(self::$joblinks[$ii]) . "<br>";
		}
	}

	public function parsePhoneNumber($string) {
		preg_match_all('/\b[0-9]{3}\s*-\s*[0-9]{3}\s*-\s*[0-9]{4}\b/', $string, $matches);
		return @$matches;
	}

	public function getJobIframe($href) {
		$doc = new DOMDocument;
		libxml_use_internal_errors(true);
		@$doc->loadHTMLFile($href);
		$body = $doc->getElementsByTagName('body');
		if ($body && 0 < $body->length) {
			return $this->parseEmail($body = $body->item(0)->nodeValue);
		}
	}

	public function parseEmail($string) {
		$pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';
		preg_match_all($pattern, $string, $matches);
		return @$matches[0][0];
	}

	public function getJobOffer() {
		var_dump(self::$joblinks);
	}

	public function getJobID() {
		for ($ii = 0; $ii < count(self::$jobIDs); $ii++) {
			echo self::$jobIDs[$ii][1] . "<br>";
//			$this->insert(self::$jobIDs[$ii][1], self::$jobEmail[$ii], self::$jobListing[$ii], self::$joblinks[$ii]);
		}
	}

	public function getLocation() {
		for ($ii = 0; $ii < count(self::$jobIDs); $ii++) {
			echo self::$jobPlace[$ii] . "<br>";
//			$this->insert(self::$jobIDs[$ii][1], self::$jobEmail[$ii], self::$jobListing[$ii], self::$joblinks[$ii]);
		}
	}

	private function connection() {

	}

	private function insert($jobID, $jobEmail, $jobListing, $jobLink) {

	}

	public function getScrappedData() {

	}
}
