<?php
session_start ();


use Celf\UI\conf\CelfUISetup;
use Rasty\utils\RastyUtils;
use Rasty\factory\ApplicationFactory;
use Rasty\utils\Logger;


include_once   'vendor/autoload.php';

CelfUISetup::initialize("celf_ui", false);

$type = RastyUtils::getParamGET('type') ;

ApplicationFactory::build( $type )->execute();
?>