<?php
class Scrape
{
    static $joblinks = [];
    static $jobIDs = [];

    public function scrapeListing($search)
    {
        $keyword = $search;
        $url = "https://www.stepstone.nl/5/job-search.html?ke=" . $keyword . "&li=100";

        $doc = new DOMDocument;
        libxml_use_internal_errors(true);
        $doc->loadHTMLFile($url);
        $xpath = new DOMXPath($doc);
        $query = "//div[@class='jobitem__header']/a/@href";
        $query2 = "//div[@class='jobitem__header']";
        $query3 = "//li[@class='list-group-item']/@data-offer-anchor";
        $links = $xpath->query($query);
        $listing = $xpath->query($query2);
        $jobListing = $xpath->query($query3);
//        echo $links->length . "<br>" . "<br>";

        for ($ii = 0; $ii < $links->length; $ii++) {
            $jobID = $jobListing->item($ii)->nodeValue;
            $href = $links->item($ii)->nodeValue;
            $job = $listing->item($ii)->nodeValue;

            self::$joblinks[$ii] = $href;
            self::$jobIDs[$ii] = explode("joblisting-", $jobID);

//            echo "<a href='$href'>$job</a>" . "<br>";
        }
    }

    public function getJobOffer(){
          var_dump(self::$joblinks);
    }

    public function getJobID(){
//        var_dump(self::$jobIDs);
        for($ii = 0; $ii < count(self::$jobIDs); $ii++){
           echo self::$jobIDs[$ii][1]."<br>";
        }
    }
}
