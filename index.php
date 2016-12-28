<?php
$test = "accountant";
$url = "https://www.stepstone.nl/5/job-search.html?stf=freeText&ns=1&qs=%5B%5D&companyID=0&cityID=0&sourceOfTheSearchField=resultlistpage%3Ageneral&searchOrigin=Resultlist_top-search&ke=".$test."&ws=&ra=30";
$url = htmlentities($url);
$doc = new DOMDocument();
$doc->loadHTML($url);
$path = new DOMXPath($doc);
$divcontent = $path->query('//head/title');

echo $divcontent->length;