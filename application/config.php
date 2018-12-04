<?php

/*
 * Author: Bradley Stegbauer
 * Date: 11/06/2018
 * File: config.php
 * Description: set application settings
 * 
 */

//error reporting level: 0 to turn off all error reporting; E_ALL to report all
error_reporting(E_ALL);

//local time zone
date_default_timezone_set('America/New_York');

//base url of the application
define("BASE_URL", "http://localhost/mvc_final");

/*************************************************************************************
 *                       settings for dvds                                         *
 ************************************************************************************/

//define default path for media images
define("DVD_IMG", "www/img/dvds/");