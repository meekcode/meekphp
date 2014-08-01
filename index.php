<?php

/******************************************************************************/

/** comment these out to disable errors **/

ini_set('error_reporting', E_ALL);

ini_set('display_errors', 'On'); 

/** define file path on server for meekphp **/

define("__PATH__", realpath(dirname(__FILE__)) . '/');

/** run config file **/

include(__PATH__ . 'config.php');

/******************************************************************************/

