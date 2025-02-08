<?php

require_once '_database.php';
require_once 'classes/class.band.php';
require_once 'classes/class.sponsor.php';
require_once 'classes/class.merchant.php';
require_once 'classes/class.gallery.php';

// Les groupes du vendredi.
$bandsFriday = getBandPerYearPerDay($dbCo, 6);

// Les groupes du samedi.
$bandsSaturday = getBandPerYearPerDay($dbCo, 7);

// Les groupes du dimanche 
$bandsSunday = getBandPerYearPerDay($dbCo, 1);

// Sponsors actifs
$activeSponsors = fetchActiveSponsors($dbCo);

// Tous les sponsors
$allSponsors = fetchAllSponsors($dbCo);

// Commerçants actifs
$activeMerchants = fetchActiveMerchants($dbCo);

// Tous les événements
$allEvents = fetchAllEvents($dbCo);