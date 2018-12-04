<?php
/*
 * Author: Bradley Stegbauer
 * Date: 11/08/2018
 * Name: index.php
 * Description: The homepage, this starts the dispatcher, and loads the required files for the website
 */
//load application settings
require_once ("application/config.php");

//load autoloader
require_once ("vendor/autoload.php");

//load the dispatcher that dissects a request URL
new Dispatcher();