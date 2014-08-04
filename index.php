<?php

/* enable error reporting */

ini_set('error_reporting', E_ALL);

ini_set('display_errors', 'On');

/* save server path */

define("__PATH__", realpath(dirname(__FILE__)) . '/');

/* include system files */

require_once(__PATH__ . 'meek/object.php');

require_once(__PATH__ . 'meek/singleton.php');

/* include application script */

require_once(__PATH__ . 'config.php');

