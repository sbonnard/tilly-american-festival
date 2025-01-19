<?php

require_once '_database.php';
require_once 'classes/class.band.php';
require_once 'classes/class.sponsor.php';

// Les groupes du samedi.
$bandsSaturday = getBandPerYearPerDay($dbCo, 7);

// Les groupes du dimanche 
$bandsSunday = getBandPerYearPerDay($dbCo, 1);

// Sponsors actifs

$activeSponsors = fetchActiveSponsors($dbCo);