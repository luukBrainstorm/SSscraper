<?php
$test = "software";
$url = "https://www.stepstone.nl/5/job-search.html?stf=freeText&ns=1&qs=%5B%5D&companyID=0&cityID=0&sourceOfTheSearchField=resultlistpage%3Ageneral&searchOrigin=Resultlist_top-search&ke=".$test."&ws=&ra=30";
$url = htmlentities($url);

$doc = new DOMDocument;
libxml_use_internal_errors(true);
$doc->loadHTMLFile($url);
$xpath = new DOMXPath($doc);
$query = "//div[@class='jobitem__header']";
$entries = $xpath->query($query);
echo $entries->length."<br>";

for($ii = 0; $ii < $entries->length; $ii++){
    echo $entries->item($ii)->nodeValue."<br>";
}