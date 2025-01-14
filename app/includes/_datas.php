<?php

require_once '_database.php';
require_once 'classes/class.band.php';

$bands = getBandPerYear($dbCo);