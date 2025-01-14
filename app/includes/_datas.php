<?php

require_once '_database.php';
require_once 'classes/class.band.php';

// Les groupes du samedi.
$bandsSaturday = getBandPerYearPerDay($dbCo, 7);

// Les groupes du dimanche 
$bandsSunday = getBandPerYearPerDay($dbCo, 1);