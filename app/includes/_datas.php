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

// Tous les groupes
$allBandsEver = fetchAllBands($dbCo);

// Groupes du Wall Of Fame
$wallOfFame = fetchAllBands($dbCo);

// Sponsors actifs
$activeSponsors = fetchActiveSponsors($dbCo);

// Tous les sponsors
$allSponsors = fetchAllSponsors($dbCo);

// Commerçants actifs
$activeMerchants = fetchActiveMerchants($dbCo);

// Tous les événements
$allEvents = fetchAllGalleryEvents($dbCo);

// Adresse mail contact
$contactMail = "contact@tillyamericanfestival.com";
