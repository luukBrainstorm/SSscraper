<?php
include "Scrape.php";
$scrape = new Scrape();
$scrape->scrapeListing($_POST["keyword"]);
$scrape->getJobID();
