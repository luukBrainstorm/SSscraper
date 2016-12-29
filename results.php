<?php
include "Scrape.php";
$scrape = new Scrape();
$scrape->scrapeListing($_POST["keyword"]);
echo $scrape->getJobID();
echo $scrape->getJobListing();
echo $scrape->getEmail();
$scrape->getLocation();