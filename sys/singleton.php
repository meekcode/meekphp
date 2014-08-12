<?php
/**
 * <meek/singleton.php>
 *
 * This file contains the singleton pattern base class for the kernel.
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
 * @package    meekphp-sys
 * @subpackage singleton
 * @author     Michael Edwards <meekcode.com@gmail.com>
 * @copyright  2014 Michael Edwards
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GPL version 2
 * @link       https://github.com/meekcode/meekphp/
 */

/**
 * This is the singleton pattern base class for the kernel.
 *
 * @package    meekphp-sys
 * @subpackage singleton
 */
abstract class meekSingleton extends meekObject {

    /**
     * Disable creation of classes by making the constructor protected.
     */
    final protected function __construct() {
        $this->_init();
    }

    /**
     * Disable clone creation of classes by making this function private.
     */
    final private function __clone() {
    }

    /**
     * Finalise destructor and call overloadable _kill function.
     */
    final public function __destruct() {
        $this->_kill();
    }

    /**
     * Overloadable init function for sub classes.
     *
     * @return void
     */
    protected function _init() {
    }

    /**
     * Overloadable kill function for sub classes.
     *
     * @return void
     */
    protected function _kill() {
    }

    /**
     * Return the only instance of a class-type. If one doesn't exist then
     * create one and return it.
     *
     * @return mixed
     */
    final public static function instance() {

        /* this array holds all the instances of all the class types */
        static $instances = array();

        /* lookup class type and return instance */
        $classname = get_called_class();
        if (array_key_exists($classname, $instances) == true) {
            if ($instances[$classname] != null) {
                return ($instances[$classname]);
            }
        }

        /* if instance doesn't exist, create new one and return it */
        return ($instances[$classname] = new $classname());
    }
}

