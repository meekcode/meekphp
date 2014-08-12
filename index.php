<?php
/**
 * <index.php>
 *
 * This file is the entry point to the framework.
 *
 * Error reporting is enabled/disabled, current server path is saved, meekphp
 * system class files are loaded and then finally the application script is
 * run.
 *
 * <Licence>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    meekphp
 * @subpackage index
 * @author     Michael Edwards <meekcode.com@gmail.com>
 * @copyright  2014 Michael Edwards
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GPL version 2
 * @link       https://github.com/meekcode/meekphp/
 */

/* enable/disable error reporting */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');

/* save current server path */
define("__PATH__", realpath(dirname(__FILE__)) . '/');

/* load meekphp system class files */
require_once(__PATH__ . 'sys/object.php');
require_once(__PATH__ . 'sys/singleton.php');
require_once(__PATH__ . 'sys/service.php');
require_once(__PATH__ . 'sys/application.php');
require_once(__PATH__ . 'sys/kernel.php');

/* Run config script */
require_once(__PATH__ . 'config.php');

